<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function show(Category $category, Product $product)
    {
        $header_title = $product->part_number;
        // --- 1) Validate product belongs to category ---
        if ($product->category_id !== $category->id) {
            abort(404);
        }

        // --- 2) Load all required relations ---
        $product->load([
            'coverImage',
            'images',
            'category',
            'price',
            'featureValues.feature', // <-- FEATURES LOADED HERE
            'pdfs'
        ]);

        // --- 3) Related products ---
        // Step 1: find root parent category
        $parent = $product->category;
        while ($parent->parent_id !== null) {
            $parent = $parent->parent;
        }

        // Step 2: get all category IDs under this parent
        $categoryIds = [$parent->id];
        $categoryIds = array_merge($categoryIds, $parent->getAllChildrenIds());

        // Step 3: fetch products in these categories
        $relatedProducts = Product::whereIn('category_id', $categoryIds)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // --- 4) Build breadcrumbs recursively ---
        $breadcrumbs = collect();
        $current = $product->category;
        while ($current) {
            $breadcrumbs->prepend($current);
            $current = $current->parent;
        }

        $cartItem = \Cart::get($product->id);

        $currentCartQty = $cartItem ? $cartItem->quantity : 1;

        return view('front.products.single', compact('product', 'relatedProducts', 'breadcrumbs', 'header_title', 'currentCartQty' ));
    }
}
