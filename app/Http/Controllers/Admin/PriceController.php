<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse\Product;
use App\Models\PriceSetting;
use App\Models\ProductPrice;
use App\Exports\ProductsPriceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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

    public function exportExcel(Request $request)
    {
        // دریافت نرخ تبدیل از اینپوت کاربر (پیش‌فرض 7.2 اگر خالی بود)
        $cnyUsdRate = $request->input('cny_usd_rate', 7.2);

        return Excel::download(new ProductsPriceExport($cnyUsdRate), 'products-price-comparison.xlsx');
    }


    /**
     * مرحله اول: خواندن فایل اکسل و شمارش تغییرات (Preview)
     */
    public function importPreview(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('excel_file');

        $data = Excel::toArray(new class implements \Maatwebsite\Excel\Concerns\ToArray {
            public function array(array $array): void {}
        }, $file);

        $rows = $data[0] ?? [];

        if (empty($rows) || count($rows) <= 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'فایل اکسل خالی است یا فرمت آن نامعتبر است.'
            ], 422);
        }

        $header = array_shift($rows);

        $changedCount = 0;
        $changedPartsList = [];
        $preparedData = []; // فقط پارت‌نامبرهای تغییریافته اینجا ذخیره می‌شوند

        foreach ($rows as $row) {
            $partNumber = trim($row[0] ?? '');
            if ($partNumber === '') continue;

            $excelCny = isset($row[2]) && $row[2] !== '' ? (float) $row[2] : null;
            $excelUsd = isset($row[4]) && $row[4] !== '' ? (float) $row[4] : null;
            $excelDiscount = isset($row[5]) && $row[5] !== '' ? (float) $row[5] : 0.0;
            $excelSpecialProfit = isset($row[6]) && $row[6] !== '' ? (float) $row[6] : 0.0;

            $currentPrice = ProductPrice::where('product_part_number', $partNumber)->first();

            $currentCny = ($currentPrice && $currentPrice->cny_price !== null) ? (float) $currentPrice->cny_price : null;
            $currentUsd = ($currentPrice && $currentPrice->usd_price !== null) ? (float) $currentPrice->usd_price : null;
            $currentDiscount = $currentPrice ? (float) $currentPrice->discount_percent : 0.0;
            $currentSpecialProfit = $currentPrice ? (float) $currentPrice->special_profit_percent : 0.0;

            $isCnyChanged = (string)$excelCny !== (string)$currentCny;
            $isUsdChanged = (string)$excelUsd !== (string)$currentUsd;
            $isDiscountChanged = (float)$excelDiscount !== (float)$currentDiscount;
            $isSpecialProfitChanged = (float)$excelSpecialProfit !== (float)$currentSpecialProfit;

            $hasChanged = $isCnyChanged || $isUsdChanged || $isDiscountChanged || $isSpecialProfitChanged;

            if ($hasChanged) {
                $isNewRecord = is_null($currentPrice);

                $changedCount++;
                $changedPartsList[] = [
                    'part_number' => $partNumber,
                    'old_usd' => $currentUsd ?? 'ثبت نشده',
                    'new_usd' => $excelUsd ?? 'خالی',
                    'is_new' => $isNewRecord
                ];

                // نکته کلیدی: فقط رکوردهایی که تغییر کرده‌اند را برای آپدیت نهایی نگه می‌داریم
                $preparedData[] = [
                    'part_number' => $partNumber,
                    'cny_price' => $excelCny,
                    'usd_price' => $excelUsd,
                    'discount_percent' => $excelDiscount,
                    'special_profit_percent' => $excelSpecialProfit,
                    'toman_price' => $currentPrice ? $currentPrice->toman_price : null
                ];
            }
        }

        $cacheKey = 'import_prices_' . auth()->id() . '_' . time();
        Cache::put($cacheKey, $preparedData, now()->addMinutes(5));

        return response()->json([
            'status' => 'ok',
            'changed_count' => $changedCount,
            'changed_parts' => $changedPartsList,
            'cache_key' => $cacheKey,
            'message' => "تعداد {$changedCount} تغییر شناسایی شد."
        ]);
    }

    /**
     * مرحله دوم: تایید نهایی و اعمال تغییرات در دیتابیس + محاسبه قیمت‌های نهایی
     */
    public function importConfirm(Request $request)
    {
        $request->validate([
            'cache_key' => 'required|string',
        ]);

        $cacheKey = $request->input('cache_key');
        $rows = Cache::get($cacheKey);

        if (!$rows) {
            return response()->json([
                'status' => 'error',
                'message' => 'اطلاعات منقضی شده است. لطفاً دوباره فایل را آپلود کنید.'
            ], 422);
        }

        $settings = PriceSetting::first() ?? new PriceSetting([
            'dollar_rate' => 0,
            'profit_percent' => 0,
            'extra_percent' => 0
        ]);

        $updatedCount = 0;

        foreach ($rows as $row) {
            $partNumber = $row['part_number'];
            $cny = $row['cny_price'];
            $usd = $row['usd_price'];
            $toman = $row['toman_price'];
            $discount = $row['discount_percent'];
            $specialProfit = $row['special_profit_percent'];

            // اگر هم دلار و هم تومان خالی بودند، رکورد قیمت را حذف می‌کنیم
            if (is_null($usd) && is_null($toman)) {
                ProductPrice::where('product_part_number', $partNumber)->delete();
                continue;
            }

            // محاسبه قیمت‌های جدید با استفاده از متد داخلی شما
            $calc = $this->calculateFinalPrices(
                $usd,
                $toman,
                $discount,
                $specialProfit,
                $settings
            );

            // بروزرسانی یا ایجاد رکورد در دیتابیس
            ProductPrice::updateOrCreate(
                ['product_part_number' => $partNumber],
                [
                    'cny_price' => $cny,
                    'usd_price' => $usd,
                    'toman_price' => $toman,
                    'discount_percent' => $discount,
                    'special_profit_percent' => $specialProfit,
                    'original_price' => $calc['original_price'],
                    'final_usd' => $calc['final_usd'],
                    'sell_price_toman' => $calc['sell_price_toman'],
                ]
            );

            $updatedCount++;
        }

        // پاک کردن کش پس از اتمام کار
        Cache::forget($cacheKey);

        return response()->json([
            'status' => 'ok',
            'message' => "با موفقیت تعداد {$updatedCount} محصول بروزرسانی و قیمت‌ها محاسبه شدند."
        ]);
    }
}
