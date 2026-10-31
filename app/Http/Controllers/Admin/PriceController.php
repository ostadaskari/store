<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse\Product;
use App\Models\PriceSetting;
use App\Models\ProductPrice;

class PriceController extends Controller
{
    public function index(Request $request)
    {
        $header_title = 'Product Prices';

        $settings = PriceSetting::first() ?? new PriceSetting([
            'dollar_rate' => 0,
            'profit_percent' => 0,
            'extra_percent' => 0
        ]);

        /*
        |--------------------------------------------------------------------------
        | Product Search
        |--------------------------------------------------------------------------
        */

        $search = trim($request->input('search', ''));

        $productsQuery = Product::with('price');

        if ($search !== '') {

            $escapedSearch = addcslashes($search, '%_\\');

            $productsQuery->where(
                'part_number',
                'LIKE',
                '%' . $escapedSearch . '%'
            );
        }

        $products = $productsQuery
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | AJAX Request
        |--------------------------------------------------------------------------
        */

        if ($request->ajax()) {
            return response()->json([
                'status' => 'ok',
                'html' => view(
                    'admin.price._products_table',
                    compact('products')
                )->render(),
                'pagination' => $products->links()->toHtml(),
                'search' => $search,
                'total' => $products->total(),
            ]);
        }

        return view(
            'admin.price.index',
            compact(
                'header_title',
                'settings',
                'products',
                'search'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Save Global Settings
    |--------------------------------------------------------------------------
    */

    public function saveSettings(Request $request)
    {
        $data = $request->validate([
            'dollar_rate' => 'required|numeric|min:0',
            'profit_percent' => 'required|numeric|min:0',
            'extra_percent' => 'required|numeric|min:0',
        ]);

        $settings = PriceSetting::updateOrCreate(
            ['id' => 1],
            $data
        );

        $prices = ProductPrice::cursor();

        foreach ($prices as $p) {

            if (is_null($p->usd_price) && is_null($p->toman_price)) {
                $p->delete();
                continue;
            }

            $calc = $this->calculateFinalPrices(
                $p->usd_price,
                $p->toman_price,
                $p->discount_percent,
                $p->special_profit_percent,
                $settings
            );

            $p->update([
                'original_price'   => $calc['original_price'] ?? 0,
                'final_usd'        => $calc['final_usd'] ?? 0,
                'sell_price_toman' => $calc['sell_price_toman'] ?? 0,
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'تنظیمات ذخیره و قیمت‌ها بروزرسانی شدند.'
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Save Single Product Price
    |--------------------------------------------------------------------------
    */

    public function saveProductPrice(Request $request)
    {
        $data = $request->validate([
            'product_part_number' => 'required|string',
            'usd_price' => 'nullable|numeric|min:0',
            'toman_price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'special_profit_percent' => 'nullable|numeric|min:0',
        ]);

        $usd = (isset($data['usd_price']) && $data['usd_price'] > 0)
            ? (float) $data['usd_price']
            : null;

        $toman = (isset($data['toman_price']) && $data['toman_price'] > 0)
            ? (float) $data['toman_price']
            : null;

        $discount = (isset($data['discount_percent']) && $data['discount_percent'] > 0)
            ? (float) $data['discount_percent']
            : 0;

        $specialProfit = (isset($data['special_profit_percent']) && $data['special_profit_percent'] > 0)
            ? (float) $data['special_profit_percent']
            : 0;

        // اگر هر دو قیمت خالی یا صفر باشند، رکورد قیمت حذف شود
        if (is_null($usd) && is_null($toman)) {

            ProductPrice::where(
                'product_part_number',
                $data['product_part_number']
            )->delete();

            return response()->json([
                'status' => 'ok',
                'message' => 'قیمت محصول پاک شد و به حالت قیمت ثبت نشده برگشت.',
                'price' => null
            ]);
        }

        $settings = PriceSetting::first() ?? new PriceSetting([
            'dollar_rate' => 0,
            'profit_percent' => 0,
            'extra_percent' => 0
        ]);

        $calc = $this->calculateFinalPrices(
            $usd,
            $toman,
            $discount,
            $specialProfit,
            $settings
        );

        $price = ProductPrice::updateOrCreate(
            [
                'product_part_number' => $data['product_part_number']
            ],
            [
                'usd_price' => $usd,
                'toman_price' => $toman,
                'discount_percent' => $discount,
                'special_profit_percent' => $specialProfit,

                'original_price' => $calc['original_price'],
                'final_usd' => $calc['final_usd'],
                'sell_price_toman' => $calc['sell_price_toman'],
            ]
        );

        return response()->json([
            'status' => 'ok',
            'message' => 'قیمت محصول با موفقیت ذخیره شد.',
            'price' => $price
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Calculate Final Prices
    |--------------------------------------------------------------------------
    */

    protected function calculateFinalPrices(
        ?float $usd,
        ?float $toman,
        ?float $discount,
        ?float $specialProfit,
        PriceSetting $settings
    ): array {

        $rate = (float) $settings->dollar_rate;

        $profit = (float) $settings->profit_percent;

        $extra = (float) $settings->extra_percent;

        $specialProfit = $specialProfit ?? 0;

        // مجموع سود عمومی، اضافی و سود خاص محصول
        $totalProfit = $profit + $extra + $specialProfit;

        $costMult = 1 + ($totalProfit / 100);

        $discMult = 1 - (($discount ?? 0) / 100);

        $originalPrice = null;
        $finalUsd = null;
        $sellToman = null;

        if ($usd && $usd > 0) {

            $baseWithProfit = $usd * $costMult;

            $originalPrice = round($baseWithProfit * $rate);

            $finalUsd = $baseWithProfit * $discMult;

            $sellToman = round(($finalUsd * $rate) / 10) * 10;

        } elseif ($toman && $toman > 0) {

            $originalPrice = $toman * $costMult;

            $sellToman = round(($originalPrice * $discMult) / 10) * 10;

        }

        return [
            'original_price' => $originalPrice,
            'final_usd' => $finalUsd,
            'sell_price_toman' => $sellToman,
        ];
    }
}
