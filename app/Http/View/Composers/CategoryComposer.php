<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Warehouse\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categoriesTree = Cache::remember(
            'front.categories_tree.v1',
            now()->addMinutes(10),
            function () {

                // دریافت تمام دسته‌بندی‌ها با فقط ستون‌های موردنیاز
                $categories = Category::query()
                    ->select(['id', 'name', 'slug', 'parent_id'])
                    ->get();

                // گروه‌بندی دسته‌بندی‌ها بر اساس والد
                $grouped = $categories->groupBy(
                    fn ($category) => $category->parent_id ?? 0
                );

                // ساخت درخت در حافظه، بدون Query اضافی
                $buildTree = function ($parentId) use (&$buildTree, $grouped) {

                    return $grouped
                        ->get($parentId, collect())
                        ->each(function ($category) use (&$buildTree) {

                            $category->setRelation(
                                'childrenRecursive',
                                $buildTree($category->id)
                            );

                        });
                };

                // دسته‌بندی‌های ریشه
                return $buildTree(0);
            }
        );

        $view->with('categoriesTree', $categoriesTree);
    }
}
