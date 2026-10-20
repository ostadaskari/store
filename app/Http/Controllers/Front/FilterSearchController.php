<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterSearchController extends Controller
{
    /**
     * نمایش صفحه اصلی فیلتر و جستجو
     */
    public function index()
    {
        // دریافت فقط دسته‌بندی‌های ریشه (والد) همراه با فرزندان به صورت تو در تو
        $categories = Category::whereNull('parent_id')
            ->with('childrenRecursive') // فرض بر این است که این رفرش/ریلیشن را در مدل Category دارید
            ->orderBy('name', 'asc')
            ->get();

        // اگر متد بالا را ندارید، از روش زیر برای بارگذاری درخت استفاده کنید:
        $allCategories = Category::with('children')->whereNull('parent_id')->orderBy('name', 'asc')->get();

        return view('front.search.filter', compact('allCategories'));
    }

    /**
     * دریافت لیست ویژگی‌های پویای یک دسته‌بندی و محاسبه Min/Max واقعی از دیتابیس (AJAX)
     */
    public function getFeatures($category_id = null)
    {
        try {
            $query = Feature::query();

            if (!empty($category_id) && $category_id > 0) {
                $query->where('category_id', $category_id);
            }

            $features = $query->get();
            $categoryIds = !empty($category_id) ? $this->getCategoryAndDescendants($category_id) : [];
            $connectionName = (new Feature())->getConnectionName();

            // محاسبه محدوده حداقل و حداکثر بر اساس واحد پایه
            $featuresWithBounds = $features->map(function ($f) use ($categoryIds, $connectionName) {
                $featureArr = $f->toArray();

                if (in_array($f->data_type, ['decimal(15,7)', 'range'])) {
                    $baseUnitSql = $this->getBaseUnitSqlExpression('pfv');

                    $minMaxQuery = DB::connection($connectionName)
                        ->table('product_feature_values as pfv')
                        ->join('products as p', 'p.id', '=', 'pfv.product_id')
                        ->where('pfv.feature_id', $f->id);

                    if (!empty($categoryIds)) {
                        $minMaxQuery->whereIn('p.category_id', $categoryIds);
                    }

                    $minMax = $minMaxQuery->selectRaw("
                        MIN({$baseUnitSql}) as min_val,
                        MAX({$baseUnitSql}) as max_val
                    ")->first();

                    $featureArr['min_value'] = $minMax ? (float)$minMax->min_val : 0;
                    $featureArr['max_value'] = $minMax ? (float)$minMax->max_val : 0;
                }

                return $featureArr;
            });

            return response()->json([
                'success' => true,
                'features' => $featuresWithBounds
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت ویژگی‌ها: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * اعمال فیلتر پویا و دریافت محصولات با تبدیل خودکار واحدها (AJAX)
     */
    public function getResults(Request $request)
    {
        try {
            $categoryId = $request->input('category_id');
            $query = Product::query()
                ->with([
                    'category',
                    'coverImage',
                    'price',
                    'information',
                    'lots',
                    'features'
                ]);

            if (!empty($categoryId)) {
                $categoryIds = $this->getCategoryAndDescendants($categoryId);
                $query->whereIn('category_id', $categoryIds);
            }

            $features = Feature::all();
            foreach ($features as $f) {
                $inputName = "feature_{$f->id}";
                $minName   = "feature_{$f->id}_min";
                $maxName   = "feature_{$f->id}_max";
                $unitName  = "feature_{$f->id}_unit";

                $alias = "pfv_{$f->id}";

                // الف) فیلتر بازه‌ای (Min - Max Range) با تبدیل واحد پایه
                if ($request->filled($minName) || $request->filled($maxName)) {
                    $selectedUnit = $request->input($unitName, '');
                    $unitMultiplier = $this->getUnitMultiplier($selectedUnit);

                    $query->join("product_feature_values as {$alias}", function ($join) use ($alias, $f) {
                        $join->on('products.id', '=', "{$alias}.product_id")
                            ->where("{$alias}.feature_id", '=', $f->id);
                    });

                    // عبارت SQL جهت محاسبه مقدار جدول برحسب واحد پایه (SI)
                    $baseValSql = $this->getBaseUnitSqlExpression($alias);

                    if ($request->filled($minName) && $request->filled($maxName)) {
                        $minBase = (float)$request->input($minName) * $unitMultiplier;
                        $maxBase = (float)$request->input($maxName) * $unitMultiplier;
                        $query->whereRaw("{$baseValSql} BETWEEN ? AND ?", [$minBase, $maxBase]);
                    } elseif ($request->filled($minName)) {
                        $minBase = (float)$request->input($minName) * $unitMultiplier;
                        $query->whereRaw("{$baseValSql} >= ?", [$minBase]);
                    } elseif ($request->filled($maxName)) {
                        $maxBase = (float)$request->input($maxName) * $unitMultiplier;
                        $query->whereRaw("{$baseValSql} <= ?", [$maxBase]);
                    }
                }
                // ب) فیلتر تک مقداری یا متنی/بولین/مولتی‌سلکت
                elseif ($request->filled($inputName)) {
                    $val = $request->input($inputName);

                    $query->join("product_feature_values as {$alias}", function ($join) use ($alias, $f) {
                        $join->on('products.id', '=', "{$alias}.product_id")
                            ->where("{$alias}.feature_id", '=', $f->id);
                    });

                    switch ($f->data_type) {
                        case 'boolean':
                            $expected = ($val === '1' || $val === 'true') ? 'true' : 'false';
                            $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT({$alias}.value, '$.value')) = ?", [$expected]);
                            break;

                        case 'multiselect':
                            // پشتیبانی کامل از فیلتر Multiselect (جستجو در آرایه JSON)
                            $jsonVal = json_encode($val);
                            $query->where(function ($q) use ($alias, $jsonVal, $val) {
                                $q->whereRaw("JSON_CONTAINS(JSON_EXTRACT({$alias}.value, '$.value'), ?)", [$jsonVal])
                                    ->orWhereRaw("JSON_CONTAINS(JSON_EXTRACT({$alias}.value, '$.values'), ?)", [$jsonVal])
                                    ->orWhereRaw("TRIM(JSON_UNQUOTE(JSON_EXTRACT({$alias}.value, '$.value'))) = TRIM(?)", [$val]);
                            });
                            break;

                        default:
                            $query->whereRaw("TRIM(JSON_UNQUOTE(JSON_EXTRACT({$alias}.value, '$.value'))) = TRIM(?)", [$val]);
                            break;
                    }
                }
            }

            $products = $query->distinct('products.id')->limit(30)->get();

            // رندر مستقیم کارت محصولات با Blade
            $htmlCards = '';
            if ($products->count() > 0) {
                foreach ($products as $product) {
                    $htmlCards .= view('front.components.product-card', compact('product'))->render();
                }
            } else {
                $htmlCards = '<div class="col-12 text-center py-5 text-muted"><p>هیچ محصولی با این فیلترها یافت نشد.</p></div>';
            }

            return response()->json([
                'success' => true,
                'html' => $htmlCards,
                'products' => $products
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * تولید عبارت SQL برای تبدیل مقدار ذخیره شده در JSON به واحد پایه در دیتابیس
     */
    private function getBaseUnitSqlExpression($tableAlias)
    {
        return "(
            CAST(JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.value')) AS DECIMAL(15,7)) *
            (CASE
                WHEN JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'p%' THEN 0.000000000001
                WHEN JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'n%' THEN 0.000000001
                WHEN JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'u%' OR JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'μ%' THEN 0.000001
                WHEN BINARY JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'M%' THEN 1000000.0
                WHEN BINARY JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'm%' THEN 0.001
                WHEN JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'k%' THEN 1000.0
                WHEN JSON_UNQUOTE(JSON_EXTRACT({$tableAlias}.value, '$.unit')) LIKE 'G%' THEN 1000000000.0
                ELSE 1.0
            END)
        )";
    }

    /**
     * محاسبه ضریب تبدیل ورودی کاربر بر حسب واحد انتخابی
     */
    private function getUnitMultiplier($unit)
    {
        $unit = trim($unit);
        if (empty($unit)) return 1.0;

        if (strpos($unit, 'M') === 0) return 1000000.0; // Mega (uppercase M)
        if (strpos($unit, 'm') === 0) return 0.001;     // milli (lowercase m)
        if (preg_match('/^p/i', $unit)) return 0.000000000001;
        if (preg_match('/^n/i', $unit)) return 0.000000001;
        if (preg_match('/^(u|μ)/i', $unit)) return 0.000001;
        if (preg_match('/^k/i', $unit)) return 1000.0;
        if (preg_match('/^G/i', $unit)) return 1000000000.0;

        return 1.0;
    }

    /**
     * دریافت ID دسته‌بندی و تمام زیرمجموعه‌های آن
     */
    private function getCategoryAndDescendants($categoryId)
    {
        $ids = [(int)$categoryId];
        $children = Category::where('parent_id', $categoryId)->pluck('id')->toArray();

        foreach ($children as $childId) {
            $ids = array_merge($ids, $this->getCategoryAndDescendants($childId));
        }

        return array_unique($ids);
    }
}
