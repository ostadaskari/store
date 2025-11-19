<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Warehouse\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->get();

        $view->with('categoriesTree', $categories);
    }
}
