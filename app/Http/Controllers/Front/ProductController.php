<?php

namespace App\Http\Controllers\Front;

use App\Services\CaptchaService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Product;
use App\Models\Review; // 🌟 اضافه کردن مدل Review
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'featureValues.feature',
            'pdfs'
        ]);

        // 🌟 --- دریافت نظرات تایید شده این محصول به همراه اطلاعات کاربر ---
        $approvedReviews = Review::where('product_id', $product->id)
            ->where('status', 'approved')
            ->whereNotNull('comment') // 🌟 فقط نظراتی که متن دارند
            ->where('comment', '!=', '') // 🌟 و متنشان خالی نیست
            ->with('user')
            ->latest()
            ->get();

        // --- 3) Related products ---
        $parent = $product->category;
        while ($parent->parent_id !== null) {
            $parent = $parent->parent;
        }

        $categoryIds = [$parent->id];
        $categoryIds = array_merge($categoryIds, $parent->getAllChildrenIds());

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

        // 🌟 ارسال $approvedReviews به صفحه ویو
        return view('front.products.single', compact(
            'product',
            'relatedProducts',
            'breadcrumbs',
            'header_title',
            'currentCartQty',
            'approvedReviews'
        ));
    }

    public function addToWishlist(Request $request)
    {
        try{
            return response()->json(['success'],200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 🌟 --- متد جدید برای ذخیره دیدگاه و امتیاز ستاره‌ای کاربر ---


    public function storeReview(Request $request, Product $product)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::check() ? Auth::id() : null;
        $ipAddress = $request->ip();
        $hasComment = !empty(trim($request->comment));

        try {
            if (!$hasComment) {
                // ثبت امتیاز ستاره‌ای آنی (بدون نیاز به کپچا)
                $attributes = [
                    'product_id' => $product->id,
                    'comment'    => '',
                ];

                if ($userId) {
                    $attributes['user_id'] = $userId;
                } else {
                    $attributes['ip_address'] = $ipAddress;
                }

                Review::updateOrCreate($attributes, [
                    'rating'     => $request->rating,
                    'status'     => 'approved',
                    'user_id'    => $userId,
                    'ip_address' => $ipAddress,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'امتیاز شما با موفقیت ثبت شد.'
                ]);
            } else {
                // 🌟 بررسی کپچا فقط برای ثبت دیدگاه متنی
                if (!CaptchaService::verify($request->captcha, 'product_review')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'کد امنیتی وارد شده صحیح نیست. لطفاً دوباره تلاش کنید.'
                    ], 422);
                }

                // ثبت دیدگاه متنی کامل
                Review::create([
                    'user_id'    => $userId,
                    'ip_address' => $ipAddress,
                    'product_id' => $product->id,
                    'rating'     => $request->rating,
                    'comment'    => $request->comment,
                    'status'     => 'pending',
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'دیدگاه شما با موفقیت ثبت شد و پس از تایید مدیر نمایش داده خواهد شد.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطایی رخ داد. لطفاً دوباره تلاش کنید.'
            ], 500);
        }
    }
}
