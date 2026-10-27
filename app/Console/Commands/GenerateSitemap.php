<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Warehouse\Product;
use App\Models\Warehouse\Category;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Automatically generate sitemap XML for products and categories';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // 1. Homepage
        $sitemap->add(
            Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        // 2. Add all categories
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

        // 3. Add all products / part numbers
        Product::with('category')
            ->select('id', 'category_id', 'slug', 'part_number', 'updated_at')
            ->chunk(500, function ($products) use ($sitemap) {
                foreach ($products as $product) {
                    $categorySlug = $product->category->slug ?? 'uncategorized';
                    $productSlug  = $product->slug ?? $product->id;

                    if ($productSlug) {
                        $url = Url::create(route('front.product.show', [
                            'category' => $categorySlug,
                            'product'  => $productSlug
                        ]))
                            ->setPriority(0.9)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

                        if ($product->updated_at) {
                            $url->setLastModificationDate(Carbon::parse($product->updated_at));
                        }

                        $sitemap->add($url);
                    }
                }
            });

        // Save file to public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap successfully generated at public/sitemap.xml');
    }
}
