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

    /**
     * Saves or updates product information with robust error handling.
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOrUpdate(Request $request)
    {
        try {
            // 1. Validation Logic
            // We use a try-catch for validation to return custom JSON if it fails
            $data = $request->validate([
                'product_part_number' => 'required|string|max:100',
                'title'               => 'nullable|string|max:255',
                'description'         => 'nullable|string',
            ], [
                // Custom Persian validation messages (Optional)
                'product_part_number.required' => 'وارد کردن پارت نامبر الزامی است.',
                'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            ]);

            // 2. Database Transaction
            // Use a transaction to ensure that if something goes wrong, no partial data is saved
            return \DB::transaction(function () use ($data) {

                // 3. Execution Logic
                $information = Information::updateOrCreate(
                    ['product_part_number' => $data['product_part_number']],
                    [
                        'title'       => $data['title'],
                        'description' => $data['description'],
                    ]
                );

                // 4. Success Response
                return response()->json([
                    'status' => 'ok',
                    'message' => 'اطلاعات محصول با موفقیت ذخیره شد ✅',
                    'information' => $information
                ], 200);
            });

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle Validation Errors
            return response()->json([
                'status' => 'validation_error',
                'message' => 'خطا در داده‌های ورودی',
                'errors' => $e->errors()
            ], 422);

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle Database Errors (e.g. unique constraint violation, connection issue)
            \Log::error("Database Error in storeOrUpdate: " . $e->getMessage());

            return response()->json([
                'status' => 'db_error',
                'message' => 'خطا در برقراری ارتباط با پایگاه داده. لطفا مجددا تلاش کنید.'
            ], 500);

        } catch (\Exception $e) {
            // Handle any other unexpected exceptions
            \Log::error("General Error in storeOrUpdate: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'متأسفانه مشکلی پیش آمد. مدیر سیستم را مطلع کنید.',
                'debug' => config('app.debug') ? $e->getMessage() : null // Show error detail only in local/dev
            ], 500);
        }
    }
}
