<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $header_title = 'اطلاعات نمایش';
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

        // Fetch current page items with INFORMATION relation
        $products = $query->orderByDesc('id')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->with('information') // eager load information relation (store DB)
            ->get();

        // Sort products:
        //  - incomplete INFORMATION (any empty field) first
        //  - complete ones after
        //  - within each group, order by id DESC
        $sorted = $products->sort(function ($a, $b) {
            $aInformation = $a->information;
            $bInformation = $b->information;

            $aIncomplete = !$aInformation
                || trim($aInformation->title) === ''
                || trim($aInformation->description) === '';


            $bIncomplete = !$bInformation
                || trim($bInformation->title) === ''
                || trim($bInformation->description) === '';

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
            ['path' => route('information.index'), 'query' => $request->query()]
        );

        return view('admin.information.index', [
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
            'title' => 'nullable|string|max:255',
            'description' => 'nullable',

        ]);

        // Find or create by product_part_number
        $information = Information::updateOrCreate(
            ['product_part_number' => $data['product_part_number']],
            [
                'title' => $data['title'],
                'description' => $data['description'],
            ]
        );

        return response()->json([
            'status' => 'ok',
            'message' => 'اطلاعات محصول با موفقیت ذخیره شد ✅',
            'information' => $information
        ]);
    }
}
