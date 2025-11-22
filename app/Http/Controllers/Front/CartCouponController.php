<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartCouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $code = strtoupper(trim($request->code));
        $discount = Discount::where('code', $code)->first();

        if (!$discount || !$discount->isActive()) {
            return response()->json(['status'=>'error','message'=>'کپن نامعتبر یا منقضی شده.'], 422);
        }

        // cart total
        $cartTotal = \Cart::getTotal();

        // min order check
        if ($discount->min_order_amount && $cartTotal < $discount->min_order_amount) {
            return response()->json(['status'=>'error','message'=>'سفارش کمتر از حداقل مبلغ مورد نیاز است.'], 422);
        }

        // per-user limit
        if ($discount->per_user_limit && auth()->check()) {
            $userUses = DB::table('discount_usages')
                ->where('discount_id',$discount->id)
                ->where('user_id', auth()->id())
                ->count();

            if ($userUses >= $discount->per_user_limit) {
                return response()->json(['status'=>'error','message'=>'شما قبلاً از این کپن کد تخفیف استفاده کرده‌اید.'], 422);
            }
        }

        // compute discount
        $discountAmount = $this->calcDiscountAmount($discount, $cartTotal);

        // store in session
        session([
            'cart.discount' => [
                'id'    => $discount->id,
                'code'  => $discount->code,
                'amount'=> $discountAmount,
                'type'  => $discount->type,
                'value' => $discount->value
            ]
        ]);

        $grandTotal = $cartTotal - $discountAmount;

        // text for UI
        $discountText = ($discount->type === 'percent')
            ? "مبلغ تخفیف ({$discount->value}٪): {$discountAmount} تومان"
            : "مبلغ تخفیف: {$discountAmount} تومان";

        return response()->json([
            'status'          => 'ok',
            'message'         => 'کپن اعمال شد.',
            'discount_amount' => $discountAmount,
            'discount_type'   => $discount->type,
            'discount_value'  => $discount->value,

            // totals
            'total'           => $cartTotal,
            'payable'         => $grandTotal,
            'discount_text'   => $discountText,
        ]);
    }

    public function remove(Request $request)
    {
        session()->forget('cart.discount');

        return response()->json([
            'status'  => 'ok',
            'message' => 'کپن حذف شد.',
            'total'   => \Cart::getTotal(),   // 👉 return total again
            'payable' => \Cart::getTotal(),   // 👉 payable equals total now
        ]);
    }

    protected function calcDiscountAmount(Discount $discount, $cartTotal)
    {
        if ($discount->type === 'percent') {
            return round(($discount->value / 100) * $cartTotal, 0);
        }

        return min($discount->value, $cartTotal);
    }
}
