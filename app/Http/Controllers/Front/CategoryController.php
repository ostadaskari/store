<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $slug)
    {
        $header_title = $slug;
        // Find the current category by slug
        $category = Category::where('slug', $slug)
            ->with(['childrenRecursive', 'parent'])
            ->firstOrFail();

        // Get breadcrumb chain
        $breadcrumbs = collect([]);
        $parent = $category;
        while ($parent) {
            $breadcrumbs->prepend($parent);
            $parent = $parent->parent;
        }

        // Subcategories
        $subcategories = $category->childrenRecursive;

        //  Collect all child IDs
        $categoryIds = $category->allDescendantIds();

        //  Get products that belong to any of those leaf categories
        $productQuery = Product::whereIn('category_id', $categoryIds)
            ->with(['coverImage']);

        if ($request->input('in_stock', '1') === '1') {
            $productQuery->whereHas('lots', function ($query) {
                $query->where('lock', 0)
                    ->where('qty_available', '>', 0);
            });
        }

        $products = $productQuery
            ->paginate(15)
            ->withQueryString();

        // Full category tree for sidebar
        $allCategories = Category::whereNull('parent_id')->with('childrenRecursive')->get();

        return view('front.categories.show', compact(
            'header_title',
            'category',
            'breadcrumbs',
            'subcategories',
            'products',
            'allCategories'
        ));
    }
}
