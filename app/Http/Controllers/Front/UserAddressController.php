<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the user's addresses.
     * Used by the front-end to load saved addresses.
     */
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        // Fetch user's addresses, ordered by newest first (optional: maybe by usage history)
        $addresses = Auth::user()->addresses()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['status' => true, 'addresses' => $addresses]);
    }

    /**
     * Store a newly created address in storage.
     * Used by the front-end AJAX when submitting a new address.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'برای ذخیره آدرس باید وارد شوید.'], 401);
        }

        $user = Auth::user();

        // 1. Check Address Limit (Maximum 4 addresses)
        if ($user->addresses()->count() >= 4) {
            return response()->json(['status' => false, 'message' => 'شما حداکثر تعداد آدرس مجاز (4 عدد) را ثبت کرده‌اید.'], 403);
        }

        // 2. Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'mobile' => 'required|regex:/^09[0-9]{9}$/', // Simple Iranian mobile format check
            'province' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'plate' => 'required|string|max:10',
            'post_code' => 'required|regex:/^[0-9]{10}$/', // 10 digit postal code
            'phone' => 'nullable|string|max:15',
            'company_name' => 'nullable|string|max:100',
            'note' => 'nullable|string',
        ], [
            'required' => 'فیلد :attribute الزامی است.',
            'regex' => 'فرمت فیلد :attribute معتبر نیست.',
            'max' => 'حداکثر طول فیلد :attribute :max کاراکتر است.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'لطفا اطلاعات آدرس را به درستی وارد کنید.',
                'errors' => $validator->errors()
            ], 422);
        }

        // 3. Store Address
        $address = $user->addresses()->create($request->only([
            'first_name', 'last_name', 'province', 'city', 'address', 'plate',
            'post_code', 'mobile', 'email', 'phone', 'company_name', 'note'
        ]));

        // 4. Return the new address object
        return response()->json([
            'status' => true,
            'message' => 'آدرس با موفقیت ذخیره و انتخاب شد.',
            'address' => $address
        ]);
    }
}
