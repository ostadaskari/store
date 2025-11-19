<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse\Product;
use App\Models\ProductSEO; // Store DB model
use Illuminate\Pagination\LengthAwarePaginator;

class ProductSEOController extends Controller
{
    public function index(Request $request)
    {
        $header_title = 'SEO Meta\'s';
        $perPage = 25;
        $page = max(1, (int) $request->get('page', 1));
        $q = trim($request->get('q', ''));

        // Base query on warehouse products (Product model uses warehouse connection)
        $query = Product::query();

        if (strlen($q) >= 2) {
            $query->where('part_number', 'like', "%{$q}%");
        }

        // Get total count for paginator
        $total = $query->count();

        // Fetch current page items with SEO relation
        $products = $query->orderByDesc('id')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->with('seo') // eager load seo relation (store DB)
            ->get();

        // Sort products:
        //  - incomplete SEO (any empty field) first
        //  - complete ones after
        //  - within each group, order by id DESC
        $sorted = $products->sort(function ($a, $b) {
            $aSeo = $a->seo;
            $bSeo = $b->seo;

            $aIncomplete = !$aSeo
                || trim($aSeo->meta_title) === ''
                || trim($aSeo->meta_description) === ''
                || trim($aSeo->meta_keywords) === '';

            $bIncomplete = !$bSeo
                || trim($bSeo->meta_title) === ''
                || trim($bSeo->meta_description) === ''
                || trim($bSeo->meta_keywords) === '';

            // Incomplete first
            if ($aIncomplete !== $bIncomplete) {
                return $aIncomplete ? -1 : 1;
            }

            // Both same completeness → order by id DESC
            return $b->id - $a->id;
        });

        // Reindex collection for paginator
        $items = $sorted->values()->all();

        // Create LengthAwarePaginator
        $paginator = new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => route('product_seo.index'), 'query' => $request->query()]
        );

        return view('admin.product_seo.index', [
            'products' => $paginator,
            'q' => $q,
            'header_title' => $header_title,
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        // Single row save (AJAX)
        $data = $request->validate([
            'product_part_number' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Find or create by product_part_number
        $seo = ProductSEO::updateOrCreate(
            ['product_part_number' => $data['product_part_number']],
            [
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_keywords' => $data['meta_keywords'],
            ]
        );

        return response()->json([
            'status' => 'ok',
            'message' => 'اطلاعات سئو با موفقیت ذخیره شد ✅',
            'seo' => $seo
        ]);
    }
}
