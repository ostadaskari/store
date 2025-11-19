<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

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

        // check min order
        $cartTotal = \Cart::getTotal(); // from darryldecode/cart
        if ($discount->min_order_amount && $cartTotal < $discount->min_order_amount) {
            return response()->json(['status'=>'error','message'=>'سفارش کمتر از حداقل مبلغ مورد نیاز است.'], 422);
        }

        // check per-user limit (if logged in)
        if ($discount->per_user_limit && auth()->check()) {
            $userUses = DB::table('discount_usages')
                ->where('discount_id',$discount->id)
                ->where('user_id', auth()->id())
                ->count();
            if ($userUses >= $discount->per_user_limit) {
                return response()->json(['status'=>'error','message'=>'شما قبلاً از این کپن استفاده کرده‌اید.'], 422);
            }
        }

        // TODO: check applicable_products/categories vs cart items (if needed)
        // Compute discount value
        $discountAmount = $this->calcDiscountAmount($discount, $cartTotal);

        // Save coupon to session/cart meta
        session(['cart.discount' => [
            'id' => $discount->id,
            'code' => $discount->code,
            'amount' => $discountAmount,
        ]]);

        return response()->json(['status'=>'ok','message'=>'کپن اعمال شد.','discount_amount' => $discountAmount, 'grand_total' => $cartTotal - $discountAmount]);
    }

    public function remove(Request $request)
    {
        session()->forget('cart.discount');
        return response()->json(['status'=>'ok','message'=>'کپن حذف شد.']);
    }

    protected function calcDiscountAmount(Discount $discount, $cartTotal)
    {
        if ($discount->type === 'percent') {
            return round(($discount->value / 100) * $cartTotal, 0);
        }
        return min($discount->value, $cartTotal);
    }
}
