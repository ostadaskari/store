<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order; // Import Order Model
use App\Models\OrderItem; // Import OrderItem Model
use App\Models\Shipping;
use App\Models\UserAddress;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart; // Ensure this package is correctly imported

class CartController extends Controller
{
    // Add product to cart
    public function add(Product $product)
    {
        $qty = request('qty', 1);

        // 1. Check if the requested quantity exists in stock
        if ($qty > $product->available_qty) {
            $errorMsg = 'تعداد انتخاب شده بیشتر از موجودی انبار است. موجودی فعلی: ' . $product->available_qty;
            if (request()->ajax()) {
                return response()->json(['status' => 'error', 'message' => $errorMsg], 422);
            }
            return back()->with('error', $errorMsg);
        }

        // 2. Check if item is already in cart, then check the COMBINED total against stock
        $existingItem = \Cart::get($product->id);
        if ($existingItem) {
            $totalInCart = $existingItem->quantity + $qty;
            if ($totalInCart > $product->available_qty) {
                $errorMsg = 'شما قبلاً این محصول را در سبد دارید. مجموعاً نمی‌توانید بیش از ' . $product->available_qty . ' عدد سفارش دهید.';
                if (request()->ajax()) {
                    return response()->json(['status' => 'error', 'message' => $errorMsg], 422);
                }
                return back()->with('error', $errorMsg);
            }
        }

        \Cart::add([
            'id' => $product->id,
            'name' => $product->part_number,
            'price' => $product->display_price_toman,
            'quantity' => $qty,
            'attributes' => [
                'slug' => $product->slug,
                'image' => $product->coverImage->url ?? '', // Safety check
            ],
        ]);

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'محصول با موفقیت به سبد خرید اضافه شد.',
                'count_html' => view('front.layouts._cart_count')->render(),
                'list_html' => view('front.layouts._cart_dropdown')->render(),
            ]);
        }

        return back()->with('success', 'محصول به سبد اضافه شد.');
    }

    // Show cart
    public function index()
    {
        $header_title = 'سبد خرید';
        return view('front.cart.index', [
            'cart' => \Cart::getContent(),
            'total' => \Cart::getTotal(),
            'header_title' => $header_title
        ]);
    }

    // Update quantity
    public function update($id)
    {
        $item = \Cart::get($id);
        if (!$item) return back()->with('error', 'محصول یافت نشد.');

        $newQty = (int)request('qty');
        $product = Product::find($item->id);

        if ($newQty > $product->available_qty) {
            return back()->with('error', 'تعداد انتخابی بیش از موجودی انبار (' . $product->available_qty . ') است.');
        }

        \Cart::update($id, [
            'quantity' => ['relative' => false, 'value' => $newQty]
        ]);

        return back()->with('success', 'بروزرسانی انجام شد.');
    }

    //update AJAX
    public function ajaxUpdate($id)
    {
        $item = \Cart::get($id);
        if (!$item) return response()->json(['error' => 'محصول یافت نشد'], 404);

        $newQty = (int)request('qty');
        $product = Product::find($item->id);

        // Server-side validation against DB
        if ($newQty > $product->available_qty) {
            return response()->json([
                'error' => 'تعداد انتخاب شده بیشتر از موجودی انبار است. حداکثر: ' . $product->available_qty
            ], 422);
        }

        \Cart::update($id, [
            'quantity' => ['relative' => false, 'value' => $newQty]
        ]);

        return response()->json([
            'success'     => true,
            'line_total'  => (\Cart::get($id)->price * \Cart::get($id)->quantity),
            'grand_total' => \Cart::getTotal(),
            'count_html'  => view('front.layouts._cart_count')->render(),
            'list_html'   => view('front.layouts._cart_dropdown')->render(),
        ]);
    }

    public function ajaxRemove($id)
    {
        \Cart::remove($id);

        return response()->json([
            'success'     => true,
            'grand_total' => \Cart::getTotal(),
            'is_empty'    => \Cart::isEmpty(),
            'count_html'  => view('front.layouts._cart_count')->render(),
            'list_html'   => view('front.layouts._cart_dropdown')->render(),
        ]);
    }


    // Remove item
    public function remove($id)
    {
        \Cart::remove($id);
        return back()->with('success', 'محصول حذف شد.');
    }

    // Clear cart
    public function clear()
    {
        \Cart::clear();
        return back()->with('success', 'سبد خرید خالی شد.');
    }

    public function checkout()
    {
        $header_title = 'صفحه پرداخت';
        $shippings = Shipping::active()
            ->orderBy('sort_order')
            ->get();

        // Ensure user is authenticated before checkout
        if (!Auth::check()) {
            return redirect()->route('client.login.mobile.form')->with('error', 'برای ادامه فرآیند خرید، ابتدا وارد حساب کاربری خود شوید.');
        }

        return view('front.cart.checkout', compact('header_title', 'shippings'));
    }

    /**
     * Helper function to generate a unique 9-digit order number.
     * Uses random_int which is cryptographically secure (better than mt_rand).
     * @return string
     */
    protected function generateUniqueOrderNumber(): string
    {
        do {
            // Generate a random 9-digit number
            // Using random_int is generally preferred for security/unpredictability
            $orderNumber = (string) random_int(100000000, 999999999);
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Process the checkout form and create the Order and OrderItems.
     */

    public function place_order(Request $request)
    {
        // 1. Validation
        // اکنون تنها به ID آدرس انتخابی نیاز داریم، نه تمام جزئیات آدرس
        $request->validate([
            'user_address_id' => 'required|integer|exists:user_addresses,id', // مطمئن شوید آدرس وجود دارد

            'email'           => 'required|email|max:255',  // نگهداری برای گزارش‌دهی
            'shipping_slug'   => 'required|string|exists:shippings,slug',
            'payment_method'  => 'required|string|in:credit,cash',
            'company_name'    => 'nullable|string|max:100', // اختیاری
            'note'            => 'nullable|string', // اختیاری
        ]);

        // Check if cart is empty
        if (\Cart::getContent()->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'سبد خرید شما خالی است.']);
        }

        // Fetch selected address to ensure it belongs to the user (extra security)
        $address = UserAddress::where('id', $request->user_address_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$address) {
            return response()->json(['status' => false, 'message' => 'آدرس انتخابی معتبر نیست یا متعلق به شما نمی‌باشد.']);
        }


        // Get shipping info
        $shipping = Shipping::where('slug', $request->shipping_slug)->firstOrFail();

        // Calculate final amounts
        $cartTotal = \Cart::getTotal();
        $discountAmount = session('cart.discount.amount') ?? 0;
        $shippingAmount = $shipping->price;
        $totalAmount = $cartTotal + $shippingAmount - $discountAmount;
        $discountCode = session('cart.discount.code') ?? null;


        // 2. Transaction for atomic operations
        try {
            DB::beginTransaction();

            // 1. PRE-CHECK STOCK AGAIN: Prevent race condition right before order
            foreach (\Cart::getContent() as $item) {
                $product = Product::find($item->id);

                if (!$product || $item->quantity > $product->available_qty) {
                    // برگرداندن پاسخ به صورت JSON برای نمایش در Swal
                    return response()->json([
                        'status' => false,
                        'message' => "متأسفانه موجودی محصول «{$item->name}» به پایان رسیده یا کمتر از مقدار درخواستی شماست. (موجودی فعلی: {$product->available_qty} عدد)"
                    ]);
                }
            }

            // --- Generate Unique Order Number ---
            $orderNumber = $this->generateUniqueOrderNumber();

            // 3. Create Order
            $order = Order::create([
                'user_id'         => Auth::id(),
                'order_number'    => $orderNumber, // ADDED: Save the unique order number
                'user_address_id' => $address->id, // <<--- لینک کردن به آدرس ذخیره شده

                // حفظ فیلدهای فردی در جدول Order برای سوابق و گزارش‌دهی
                'first_name'      => $request->first_name,
                'last_name'       => $request->last_name,
                'email'           => $request->email,

                // سایر فیلدها
                'company_name'    => $request->company_name,
                'note'            => $request->note,
                'shipping_id'     => $shipping->id,
                'discount_code'   => $discountCode,
                'discount_amount' => $discountAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount'    => $totalAmount,
                'payment_method'  => $request->payment_method,
                'status'          => 'pending',
                'is_payment'      => false,
            ]);

            // 4. Create Order Items
            foreach (\Cart::getContent() as $item) {
                // فرض می‌شود مدل OrderItem قبلاً تعریف شده است
                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id'  => $item->id,
                    'quantity'    => $item->quantity,
                    'price'       => $item->price,
                    'total_price' => $item->quantity * $item->price,
                ]);

                // Optional: Update product stock here if needed
            }

            // 5. Clear discount session data after use
            session()->forget('cart.discount');

            DB::commit();

            // 6. Redirect to payment step
            $json['status'] = true;
            $json['message'] = "سفارش با موفقیت ثبت شد.";
            $json['redirect'] = url('checkout/payment?order_id=' . base64_encode($order->id));
            return response()->json($json);

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Order Placement Failed: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'خطا در ثبت نهایی سفارش. لطفا مجددا تلاش کنید.',
            ]);
        }
    }

    // ... Other methods like checkout_payment (No change needed here as it uses Order::find)
    public function checkout_payment(Request $request)
    {
        // ... (The provided code for checkout_payment is correct as it relies only on order_id)
        if (\Cart::getSubTotal() > 0 && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);
            $order = Order::find($order_id);

            if (!empty($order)) {

                // Ensure order belongs to the current user (security check)
                if ($order->user_id !== Auth::id()) {
                    return redirect('cart')->with('error', "خطای امنیتی: سفارش برای کاربر فعلی نیست.");
                }

                // 2. Cash on Delivery (COD) logic
                if ($order->payment_method === 'cash') {

                    // Update order status and clear cart
                    $order->status = 'processing';
                    $order->is_payment = true; // Payment confirmed for COD
                    $order->save();

                    \Cart::clear();

                    return redirect('cart')->with('success', "سفارش شما با موفقیت ثبت شد و به صورت پرداخت در محل است.");

                }
                // 3. Online Payment (Gateway Redirect) logic
                elseif ($order->payment_method === 'credit') {

                    // Implement actual payment gateway logic here
                    // $gateway = new PaymentGateway();
                    // return $gateway->pay($order->total_amount, $order->id);

                    // For now, redirect to cart with a message about payment setup
                    return redirect('cart')->with('info', "سفارش ثبت شد. درگاه پرداخت هنوز فعال نیست.");

                }
            }
        }

        // Fallback for invalid request or empty cart
        return redirect('cart')->with('error', "خطا در فرآیند پرداخت. لطفا دوباره تلاش کنید.");
    }
}
