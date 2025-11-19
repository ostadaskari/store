<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Warehouse\Category;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share categories tree with all views (header)
        View::composer('*', function ($view) {
            $categories = Category::whereNull('parent_id')
                ->with('childrenRecursive')
                ->get();

            $view->with('categoriesTree', $categories);
        });
    }
}
