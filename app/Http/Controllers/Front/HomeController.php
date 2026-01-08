<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;

use App\Models\Message;
use App\Models\OrderItem;
use App\Models\ProductPrice;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $data['header_title'] = 'خانه';

        // 1. بنرها
        $data['banners'] = Banner::orderBy('sort_order', 'asc')->get();

        // 2. محصولات دارای تخفیف
        $discountedPartNumbers = ProductPrice::where('discount_percent', '>', 0)
            ->pluck('product_part_number')
            ->toArray();

        $data['discounted_products'] = Product::whereIn('part_number', $discountedPartNumbers)
            ->with(['coverImage', 'price'])
            ->take(10)
            ->get();

        // 3. پرفروش‌ترین‌ها
        $bestSellingIds = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sales'))
            ->groupBy('product_id')
            ->orderBy('total_sales', 'desc')
            ->take(10)
            ->pluck('product_id')
            ->toArray();

        $data['best_sellers'] = Product::whereIn('id', $bestSellingIds)
            ->with(['coverImage', 'price'])
            ->get()
            ->sortBy(fn($product) => array_search($product->id, $bestSellingIds));

        // 4. جدیدترین محصولات
        $data['newest_products'] = Product::with(['coverImage', 'price'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('front.home', $data);
    }

    public function about()
    {

        $data['header_title'] = 'درباره ما';

        return view('front.about', $data);
    }

    public function contact()
    {
        $data['header_title'] = 'تماس با ما';

        return view('front.contact', $data);
    }
    public function sendContact(Request $request)
    {

        // 1. اعتبارسنجی داده‌ها
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'message' => 'required|string|min:5|max:600',
            'captcha' => 'required',
        ], [
            'required' => 'تکمیل تمامی فیلدها الزامی است.',
            'email' => 'فرمت ایمیل صحیح نیست.',
            'min' => 'متن پیام بسیار کوتاه است.',
            'max' => 'متن پیام بسیار بلند است.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // 2. بررسی کد امنیتی
        $userAnswer = $request->captcha;
        $correctAnswer = Session::get('captcha_answer');

        if (empty($correctAnswer) || $userAnswer != $correctAnswer) {
            return response()->json([
                'status' => 'error',
                'message' => 'پاسخ کد امنیتی صحیح نیست ❌'
            ], 422);
        }

        try {
            // 3. ذخیره در دیتابیس
            Message::create([
                'name'    => $request->name,
                'phone'   => $request->phone,
                'email'   => $request->email,
                'message' => $request->message,
            ]);

            // پاک کردن کپچا از سشن بعد از موفقیت
            Session::forget('captcha_answer');

            return response()->json([
                'status' => 'success',
                'message' => 'پیام شما با موفقیت ثبت شد. به زودی با شما تماس می‌گیریم.'
            ]);

        } catch (\Exception $e) {
            // برای دیباگ می‌توانید $e->getMessage() را لاگ کنید
            return response()->json([
                'status' => 'error',
                'message' => 'خطایی در هنگام ذخیره اطلاعات رخ داد. مجدداً تلاش کنید.'
            ], 500);
        }
    }
}
