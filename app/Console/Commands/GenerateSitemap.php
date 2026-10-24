<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Warehouse\Product;
use App\Models\Warehouse\Category;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'تولید خودکار فایل سایت‌مپ برای محصولات و دسته‌بندی‌ها';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // ۱. صفحه اصلی سایت
        $sitemap->add(
            Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        // ۲. اضافه کردن تمام دسته‌بندی‌ها
        Category::chunk(100, function ($categories) use ($sitemap) {
            foreach ($categories as $category) {
                if ($category->slug) {
                    $sitemap->add(
                        Url::create(route('category.show', $category->slug))
                            ->setPriority(0.8)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    );
                }
            }
        });

        // ۳. اضافه کردن تمام ۲۰۰۰+ قطعه / پارت‌نامبر
        // لود همزمان رابطه category برای ساخت آدرس دو پارامتری محصول
        Product::with('category')
            ->select('id', 'category_id', 'slug', 'part_number', 'updated_at')
            ->chunk(500, function ($products) use ($sitemap) {
                foreach ($products as $product) {
                    // مطمئن می‌شویم دسته و اسلاگ وجود دارند
                    $categorySlug = $product->category->slug ?? 'uncategorized';
                    $productSlug  = $product->slug ?? $product->id;

                    if ($productSlug) {
                        $sitemap->add(
                            Url::create(route('front.product.show', [
                                'category' => $categorySlug,
                                'product'  => $productSlug
                            ]))
                                ->setLastModificationDate($product->updated_at)
                                ->setPriority(0.9)
                                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        );
                    }
                }
            });

        // ذخیره فایل در مسیر public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('سایت‌مپ با موفقیت در مسیر public/sitemap.xml ساخته شد.');
    }
}
