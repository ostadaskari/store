<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
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
        $products = Product::whereIn('category_id', $categoryIds)
            ->with(['coverImage']) // load cover image with product
            ->paginate(12);

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
