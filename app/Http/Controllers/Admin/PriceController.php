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
            'dollar_rate' => 0, 'profit_percent' => 0, 'extra_percent' => 0
        ]);

        $products = Product::with('price')
            ->orderByDesc('id')
            ->paginate(25);

        return view('admin.price.index', compact('header_title', 'settings', 'products'));
    }

    public function saveSettings(Request $request)
    {
        $data = $request->validate([
            'dollar_rate' => 'required|numeric|min:0',
            'profit_percent' => 'required|numeric|min:0',
            'extra_percent' => 'required|numeric|min:0',
        ]);

        $settings = PriceSetting::updateOrCreate(['id' => 1], $data);

        // Recalculate all product_prices
        $prices = ProductPrice::cursor();
        foreach ($prices as $p) {
            // FIXED: Now passing 4 arguments: USD, Toman, Discount, and Settings
            $calc = $this->calculateFinalPrices(
                $p->usd_price,
                $p->toman_price,
                $p->discount_percent,
                $settings
            );

            $p->update([
                'final_usd' => $calc['final_usd'],
                'sell_price_toman' => $calc['sell_price_toman'],
            ]);
        }

        return response()->json(['status' => 'ok', 'message' => 'تنظیمات قیمت ذخیره شد و تمام قیمت‌ها بروزرسانی شدند.']);
    }


    public function saveProductPrice(Request $request)
    {
        $data = $request->validate([
            'product_part_number' => 'required|string',
            'usd_price' => 'nullable|numeric|min:0',
            'toman_price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
        ]);

        $settings = PriceSetting::first() ?? new PriceSetting([
            'dollar_rate' => 0, 'profit_percent' => 0, 'extra_percent' => 0
        ]);

        $calc = $this->calculateFinalPrices(
            $data['usd_price'] ?? 0,
            $data['toman_price'] ?? 0,
            $data['discount_percent'] ?? 0,
            $settings
        );

        $price = ProductPrice::updateOrCreate(
            ['product_part_number' => $data['product_part_number']],
            [
                'usd_price' => $data['usd_price'],
                'toman_price' => $data['toman_price'],
                'discount_percent' => $data['discount_percent'] ?? 0,
                'final_usd' => $calc['final_usd'],
                'sell_price_toman' => $calc['sell_price_toman'],
            ]
        );

        return response()->json(['status' => 'ok', 'message' => 'قیمت محصول ذخیره شد.', 'price' => $price]);
    }

    protected function calculateFinalPrices(?float $usd, ?float $toman, ?float $discount, PriceSetting $settings): array
    {
        $rate = (float) $settings->dollar_rate;
        $profit = (float) $settings->profit_percent;
        $extra = (float) $settings->extra_percent;

        $costMult = 1 + (($profit + $extra) / 100);
        $discMult = 1 - (($discount ?? 0) / 100);

        $finalUsd = 0;
        $sellToman = 0;

        if ($usd && $usd > 0) {
            $finalUsd = $usd * $costMult * $discMult;
            $sellToman = round($finalUsd * $rate / 10) * 10;
        } elseif ($toman && $toman > 0) {
            $finalUsd = 0;
            $sellToman = round(($toman * $costMult * $discMult) / 10) * 10;
        }

        return [
            'final_usd' => $finalUsd,
            'sell_price_toman' => $sellToman,
        ];
    }

}

