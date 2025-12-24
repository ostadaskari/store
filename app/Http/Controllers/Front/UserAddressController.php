<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the user's addresses.
     */
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        $addresses = Auth::user()->addresses()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['status' => true, 'addresses' => $addresses]);
    }



    /**
     * Define the common validation rules.
     */
    protected function getValidationRules()
    {
        return [
            // Note: 'first_name' and 'last_name' are merged from 'full_name' via prepareNameFields
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
        ];
    }

    /**
     * Store a newly created address in storage.
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
        $validator = Validator::make($request->all(), $this->getValidationRules(), [
            'required' => 'فیلد :attribute الزامی است.',
            'regex' => 'فرمت فیلد :attribute معتبر نیست.',
            'max' => 'حداکثر طول فیلد :attribute :max کاراکتر است.',
            'first_name.required' => 'وارد کردن نام کامل گیرنده الزامی است.',
            'last_name.required' => 'وارد کردن نام کامل گیرنده الزامی است.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'لطفا اطلاعات آدرس را به درستی وارد کنید.',
                'errors' => $validator->errors()
            ], 422);
        }

        // 3. Store Address
        $address = $user->addresses()->create($request->only(array_keys($this->getValidationRules())));

        // 4. Return the new address object
        return response()->json([
            'status' => true,
            'message' => 'آدرس با موفقیت ذخیره شد.',
            'addresses' => $user->addresses()->orderByDesc('created_at')->get()
        ]);

    }

    /**
     * Update the specified address in storage.
     * @param Request $request
     * @param UserAddress $address (Model Binding)
     */
    public function update(Request $request, UserAddress $address)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        // Authorization Check: Ensure the user owns the address
        if ($address->user_id !== Auth::id()) {
            return response()->json(['status' => false, 'message' => 'شما مجاز به ویرایش این آدرس نیستید.'], 403);
        }



        // 1. Validation
        $validator = Validator::make($request->all(), $this->getValidationRules(), [
            'required' => 'فیلد :attribute الزامی است.',
            'regex' => 'فرمت فیلد :attribute معتبر نیست.',
            'max' => 'حداکثر طول فیلد :attribute :max کاراکتر است.',
            'first_name.required' => 'وارد کردن نام کامل گیرنده الزامی است.',
            'last_name.required' => 'وارد کردن نام کامل گیرنده الزامی است.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'لطفا اطلاعات آدرس را به درستی وارد کنید.',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Update Address
        $address->update($request->only(array_keys($this->getValidationRules())));

        // 3. Return the updated address object
        return response()->json([
            'status' => true,
            'message' => 'آدرس با موفقیت ویرایش شد.',
            'address' => $address->fresh()
        ]);
    }

    /**
     * Remove the specified address from storage.
     * @param UserAddress $address (Model Binding)
     */
    public function destroy(UserAddress $address)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        // Authorization Check: Ensure the user owns the address
        if ($address->user_id !== Auth::id()) {
            return response()->json(['status' => false, 'message' => 'شما مجاز به حذف این آدرس نیستید.'], 403);
        }

        try {
            $address->delete();
            return response()->json([
                'status' => true,
                'message' => 'آدرس با موفقیت حذف شد.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'خطا در حذف آدرس.'
            ], 500);
        }
    }
}
