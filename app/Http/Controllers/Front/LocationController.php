<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
{
    /**
     * Returns a JSON list of Iran's provinces and cities by reading from two JSON files.
     * The files are expected to be located in: public/design/json/
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIranLocations()
    {
        // مسیرهای فایل‌های JSON را تعیین می‌کنیم
        $basePath = public_path('design/json/');
        $provincesFile = $basePath . 'provinces(minify).json';
        $citiesFile = $basePath . 'provinces_cities(minify).json';

        // بررسی وجود فایل‌ها
        if (!File::exists($provincesFile) || !File::exists($citiesFile)) {
            return response()->json([
                'status' => false,
                'message' => 'Error: Required JSON files (provinces.json or provinces_cities.json) not found in public/design/json.',
                'locations' => []
            ], 404);
        }

        // خواندن و دکد کردن محتوای فایل‌ها
        try {
            $provincesData = json_decode(File::get($provincesFile), true);
            $citiesData = json_decode(File::get($citiesFile), true);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: Failed to decode JSON files.',
                'locations' => [],
                'error_detail' => $e->getMessage()
            ], 500);
        }

        // --- ساختاردهی داده‌ها ---

        // 1. ساختن یک نقشه سریع از Province ID به Province Name
        $provinceNameMap = [];
        foreach ($provincesData as $province) {
            $provinceNameMap[$province['provinceId']] = $province['provinceName'];
        }

        // 2. گروه‌بندی شهرها بر اساس استان (Province Name)
        $locations = [];

        // ابتدا، مطمئن می‌شویم که همه استان‌ها به عنوان کلید وجود دارند، حتی اگر شهری نداشته باشند (اختیاری)
        foreach ($provinceNameMap as $id => $name) {
            $locations[$name] = [];
        }

        // پر کردن شهرها در زیرمجموعه استان مربوطه
        foreach ($citiesData as $city) {
            $provinceName = $city['provinceName'];
            $cityName = $city['cityName'];

            // ما از Province Name برای گروه‌بندی استفاده می‌کنیم.
            if (isset($locations[$provinceName])) {
                $locations[$provinceName][] = $cityName;
            } else {
                // اگر استان در لیست اولیه (provinces.json) نبود، آن را اضافه می‌کنیم
                $locations[$provinceName] = [$cityName];
            }
        }

        // 3. مرتب‌سازی شهرها (اختیاری)
        foreach ($locations as $province => $cities) {
            sort($locations[$province], SORT_NATURAL);
        }

        // مرتب‌سازی استان‌ها (اختیاری)
        ksort($locations, SORT_NATURAL);


        return response()->json([
            'status' => true,
            'message' => 'Iran locations loaded successfully from external JSON files.',
            'locations' => $locations // این آرایه همان ساختار استان => [شهرها] است که جاوا اسکریپت نیاز دارد
        ]);
    }
}
