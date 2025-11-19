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

        // Recalculate all product_prices (synchronous)
        $prices = ProductPrice::cursor(); // use cursor for memory efficiency
        foreach ($prices as $p) {
            $calc = $this->calculateFinalPrices($p->usd_price, $p->toman_price, $settings);
            $p->update([
                'final_usd' => $calc['final_usd'],
                'sell_price_toman' => $calc['sell_price_toman'],
            ]);
        }

        return response()->json(['status' => 'ok', 'message' => 'تنظیمات قیمت ذخیره شد.']);
    }


    public function saveProductPrice(Request $request)
    {
        $data = $request->validate([
            'product_part_number' => 'required|string',
            'usd_price' => 'nullable|numeric|min:0',
            'toman_price' => 'nullable|numeric|min:0',
        ]);

        $settings = PriceSetting::first() ?? new PriceSetting([
            'dollar_rate' => 0, 'profit_percent' => 0, 'extra_percent' => 0
        ]);

        $calc = $this->calculateFinalPrices(
            $data['usd_price'] ?? 0,
            $data['toman_price'] ?? 0,
            $settings
        );

        $price = ProductPrice::updateOrCreate(
            ['product_part_number' => $data['product_part_number']],
            [
                'usd_price' => $data['usd_price'],
                'toman_price' => $data['toman_price'],
                'final_usd' => $calc['final_usd'],
                'sell_price_toman' => $calc['sell_price_toman'],
            ]
        );

        return response()->json(['status' => 'ok', 'message' => 'قیمت محصول ذخیره شد.', 'price' => $price]);
    }

    protected function calculateFinalPrices(?float $usd, ?float $toman, PriceSetting $settings): array
    {
        $rate = (float) $settings->dollar_rate;
        $profit = (float) $settings->profit_percent;
        $extra = (float) $settings->extra_percent;
        $mult = 1 + (($profit + $extra) / 100);

        $finalUsd = null;
        $sellToman = null;

        if ($usd && $usd > 0) {
            $finalUsd = $usd * $mult;
            $sellToman = round($finalUsd * $rate/10)*10;
        } elseif ($toman && $toman > 0) {
            $finalUsd = null;
            $sellToman = round($toman * $mult/10)*10;
        } else {
            $finalUsd = null;
            $sellToman = null;
        }

        return [
            'final_usd' => $finalUsd,
            'sell_price_toman' => $sellToman,
        ];
    }

}

