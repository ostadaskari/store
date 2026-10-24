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

        // ۱. صفحات اصلی و ثابت سایت
        $sitemap->add(
            Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        // ۲. اضافه کردن تمام دسته‌بندی‌ها
        Category::chunk(100, function ($categories) use ($sitemap) {
            foreach ($categories as $category) {
                $sitemap->add(
                    Url::create(route('categories.show', $category->slug ?? $category->id))
                        ->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                );
            }
        });

        // ۳. اضافه کردن تمام ۲۰۰۰+ قطعه / پارت‌نامبر
        Product::select('id', 'part_number', 'updated_at')
            ->chunk(500, function ($products) use ($sitemap) {
                foreach ($products as $product) {
                    $sitemap->add(
                        Url::create(route('products.show', $product->id))
                            ->setLastModificationDate($product->updated_at)
                            ->setPriority(0.9) // priority بالا برای صفحات قطعات
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    );
                }
            });

        // ذخیره فایل در مسیر public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('سایت‌مپ با موفقیت در مسیر public/sitemap.xml ساخته شد.');
    }
}
