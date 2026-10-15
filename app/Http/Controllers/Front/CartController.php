<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\UserAddress;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Gloudemans\Shoppingcart\Facades\Cart;
use SoapClient;
use Exception;

class CartController extends Controller
{
    protected function getWsdlUrl(): string
    {
        return config('services.behpardasht.wsdl', 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
    }

    protected function getStartPayUrl(): string
    {
        return config('services.behpardasht.start_pay_url', 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat');
    }

    public function add(Product $product)
    {
        $qty = request('qty', 1);

        $price = $product->display_price_toman;
        if (empty($price) || $price <= 0) {
            $errorMsg = 'این محصول در حال حاضر قیمت‌گذاری نشده و امکان افزودن آن به سبد خرید وجود ندارد.';
            if (request()->ajax()) {
                return response()->json(['status' => 'error', 'message' => $errorMsg], 422);
            }
            return back()->with('error', $errorMsg);
        }

        if ($qty > $product->available_qty) {
            $errorMsg = 'تعداد انتخاب شده بیشتر از موجودی انبار است. موجودی فعلی: ' . $product->available_qty;
            if (request()->ajax()) {
                return response()->json(['status' => 'error', 'message' => $errorMsg], 422);
            }
            return back()->with('error', $errorMsg);
        }

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
            'price' => $price,
            'discount_percent' => $product->price->discount_percent ?? 0,
            'quantity' => $qty,
            'attributes' => [
                'slug' => $product->slug,
                'image' => $product->coverImage->url ?? '',
                'original_price' => $product->price->original_price ?? $price,
                'discount_percent' => $product->price->discount_percent ?? 0,
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

    public function index()
    {
        $header_title = 'سبد خرید';
        return view('front.cart.index', [
            'cart' => \Cart::getContent(),
            'total' => \Cart::getTotal(),
            'header_title' => $header_title
        ]);
    }

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

    public function ajaxUpdate($id)
    {
        $item = \Cart::get($id);
        if (!$item) return response()->json(['error' => 'محصول یافت نشد'], 404);

        $newQty = (int)request('qty');
        $product = Product::find($item->id);

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

    public function remove($id)
    {
        \Cart::remove($id);
        return back()->with('success', 'محصول حذف شد.');
    }

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

        if (!Auth::check()) {
            return redirect()->route('client.login.mobile.form')->with('error', 'برای ادامه فرآیند خرید، ابتدا وارد حساب کاربری خود شوید.');
        }

        return view('front.cart.checkout', compact('header_title', 'shippings'));
    }

    protected function generateUniqueOrderNumber(): string
    {
        do {
            $orderNumber = (string) random_int(100000000, 999999999);
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    public function place_order(Request $request)
    {
        $request->validate([
            'user_address_id' => 'required|integer|exists:user_addresses,id',
            'email'           => 'required|email|max:255',
            'shipping_slug'   => 'required|string|exists:shippings,slug',
            'payment_method'  => 'required|string|in:credit,cash',
            'company_name'    => 'nullable|string|max:100',
            'note'            => 'nullable|string',
        ]);

        if (\Cart::getContent()->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'سبد خرید شما خالی است.']);
        }

        $address = UserAddress::where('id', $request->user_address_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$address) {
            return response()->json(['status' => false, 'message' => 'آدرس انتخابی معتبر نیست یا متعلق به شما نمی‌باشد.']);
        }

        $shipping = Shipping::where('slug', $request->shipping_slug)->firstOrFail();

        $cartTotal = \Cart::getTotal();
        $discountAmount = session('cart.discount.amount') ?? 0;
        $shippingAmount = $shipping->price;
        $totalAmount = ($cartTotal + $shippingAmount) - $discountAmount;
        $discountCode = session('cart.discount.code') ?? null;

        try {
            DB::beginTransaction();

            foreach (\Cart::getContent() as $item) {
                $product = Product::find($item->id);

                if (!$product || $item->quantity > $product->available_qty) {
                    return response()->json([
                        'status' => false,
                        'message' => "متأسفانه موجودی محصول «{$item->name}» به پایان رسیده یا کمتر از مقدار درخواستی شماست. (موجودی فعلی: {$product->available_qty} عدد)"
                    ]);
                }
            }

            $orderNumber = $this->generateUniqueOrderNumber();

            $order = Order::create([
                'user_id'         => Auth::id(),
                'order_number'    => $orderNumber,
                'user_address_id' => $address->id,
                'first_name'      => $request->first_name,
                'last_name'       => $request->last_name,
                'email'           => $request->email,
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

            foreach (\Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id'         => $order->id,
                    'product_id'       => $item->id,
                    'quantity'         => $item->quantity,
                    'original_price'   => $item->attributes->original_price,
                    'discount_percent' => $item->attributes->discount_percent,
                    'price'            => $item->price,
                    'total_price'      => $item->quantity * $item->price,
                ]);
            }

            session()->forget('cart.discount');

            DB::commit();

            return response()->json([
                'status'   => true,
                'message'  => "سفارش با موفقیت ثبت شد.",
                'redirect' => url('checkout/payment?order_id=' . base64_encode($order->id))
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Placement Failed: ' . $e->getMessage());
            return response()->json([
                'status'  => false,
                'message' => 'خطا در ثبت نهایی سفارش. لطفا مجددا تلاش کنید.',
            ]);
        }
    }

    public function checkout_payment(Request $request)
    {
        if (empty($request->order_id)) {
            return redirect('cart')->with('error', "پارامتر سفارش نامعتبر است.");
        }

        $order_id = base64_decode($request->order_id);
        $order = Order::find($order_id);

        if (!$order) {
            return redirect('cart')->with('error', "سفارش مورد نظر یافت نشد.");
        }

        if ($order->user_id !== Auth::id()) {
            return redirect('cart')->with('error', "خطای امنیتی: سفارش برای کاربر فعلی نیست.");
        }

        // 1. پرداخت در محل (Cash)
        if ($order->payment_method === 'cash') {
            $order->status = 'processing';
            $order->is_payment = true;
            $order->save();

            \Cart::clear();

            return redirect('cart')->with('success', "سفارش شما با موفقیت ثبت شد و به صورت پرداخت در محل است.");
        }

        // 2. پرداخت آنلاین به پرداخت ملت (Credit)
        if ($order->payment_method === 'credit') {
            try {
                $terminalId   = config('services.behpardasht.terminal_id');
                $userName     = config('services.behpardasht.username');
                $userPassword = config('services.behpardasht.password');
                $orderId      = (int) $order->order_number; // شماره یکتای خرید
                $amountRial   = (int) ($order->total_amount * 10); // تبدیل تومان به ریال
                $localDate    = date('Ymd');
                $localTime    = date('His');
                $additionalData = '';
                $callBackUrl  = route('payment.behpardasht.callback');
                $payerId      = 0;

                $client = new SoapClient($this->getWsdlUrl(), [
                    'encoding' => 'UTF-8',
                    'trace'    => 1,
                    'exceptions' => true,
                    'connection_timeout' => 15
                ]);

                $parameters = [
                    'terminalId'     => $terminalId,
                    'userName'       => $userName,
                    'userPassword'   => $userPassword,
                    'orderId'        => $orderId,
                    'amount'         => $amountRial,
                    'localDate'      => $localDate,
                    'localTime'      => $localTime,
                    'additionalData' => $additionalData,
                    'callBackUrl'    => $callBackUrl,
                    'payerId'        => $payerId,
                ];

                $result = $client->bpPayRequest($parameters);
                $resData = explode(',', $result->return);

                $resCode = $resData[0];

                if ($resCode == '0') {
                    $refId = $resData[1];

                    // فرم خودکار انتقال کاربر به درگاه به پرداخت ملت
                    return view('front.cart.behpardasht_redirect', [
                        'startPayUrl' => $this->getStartPayUrl(),
                        'refId'       => $refId
                    ]);
                } else {
                    $errorMessage = $this->getBehpardashtErrorMessage($resCode);
                    Log::error("Behpardasht PayRequest Error Code {$resCode}: {$errorMessage}");
                    return redirect('cart')->with('error', 'خطا در اتصال به درگاه به پرداخت: ' . $errorMessage);
                }

            } catch (Exception $e) {
                Log::error('Behpardasht Connection Exception: ' . $e->getMessage());
                return redirect('cart')->with('error', 'خطایی در ارتباط با سرور به پرداخت ملت رخ داده است. لطفاً بعداً تلاش کنید.');
            }
        }

        return redirect('cart')->with('error', "خطا در فرآیند پرداخت. لطفا دوباره تلاش کنید.");
    }

    public function behpardashtCallback(Request $request)
    {
        $refId           = $request->input('RefId');
        $resCode         = $request->input('ResCode');
        $saleOrderId     = $request->input('SaleOrderId');
        $saleReferenceId = $request->input('SaleReferenceId');

        $order = Order::where('order_number', $saleOrderId)->first();

        if (!$order) {
            return view('front.cart.payment_result', [
                'status'  => 'error',
                'message' => 'سفارش متناظر یافت نشد.',
                'order'   => null
            ]);
        }

        // بررسی انصراف یا خطای اولیه کاربر در صفحه پرداخت
        if ($resCode != '0') {
            $errorMessage = $this->getBehpardashtErrorMessage($resCode);
            $order->status = 'canceled';
            $order->save();

            return view('front.cart.payment_result', [
                'status'          => 'error',
                'message'         => $errorMessage,
                'order'           => $order,
                'saleReferenceId' => $saleReferenceId
            ]);
        }

        // اجرای عملیات تایید و واریز (bpVerifySettleRequest) طبق مستندات
        try {
            $terminalId   = config('services.behpardasht.terminal_id');
            $userName     = config('services.behpardasht.username');
            $userPassword = config('services.behpardasht.password');

            $client = new SoapClient($this->getWsdlUrl(), [
                'encoding' => 'UTF-8',
                'trace'    => 1,
                'exceptions' => true,
            ]);

            $parameters = [
                'terminalId'      => $terminalId,
                'userName'        => $userName,
                'userPassword'    => $userPassword,
                'orderId'         => (int) $order->order_number,
                'saleOrderId'     => (int) $saleOrderId,
                'saleReferenceId' => (int) $saleReferenceId
            ];

            $verifySettleResult = $client->bpVerifySettleRequest($parameters);
            $verifyResCode = $verifySettleResult->return;

            // کد 0 یا 43 (قبلا verify شده) و 45 (قبلا settle شده)
            if ($verifyResCode == '0' || $verifyResCode == '43' || $verifyResCode == '45') {

                // بروزرسانی وضعیت سفارش به صورت موفق
                $order->is_payment      = true;
                $order->status          = 'processing';
                $order->transaction_id  = $saleReferenceId;
                $order->save();

                // کاهش موجودی انبار
                foreach ($order->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->decrement('available_qty', $item->quantity);
                    }
                }

                // خالی کردن سبد خرید
                \Cart::clear();

                return view('front.cart.payment_result', [
                    'status'          => 'success',
                    'message'         => 'پرداخت با موفقیت انجام شد و سفارش شما به جریان افتاد.',
                    'order'           => $order,
                    'saleReferenceId' => $saleReferenceId
                ]);

            } else {
                // تایید تراکنش ناموفق بود
                $errorMessage = $this->getBehpardashtErrorMessage($verifyResCode);
                $order->status = 'failed';
                $order->save();

                return view('front.cart.payment_result', [
                    'status'          => 'error',
                    'message'         => 'خطا در تایید نهایی تراکنش: ' . $errorMessage,
                    'order'           => $order,
                    'saleReferenceId' => $saleReferenceId
                ]);
            }

        } catch (Exception $e) {
            Log::error('Behpardasht VerifySettle Exception: ' . $e->getMessage());
            return view('front.cart.payment_result', [
                'status'  => 'error',
                'message' => 'خطای غیرمنتظره در تایید تراکنش بانکی. در صورت کسر وجه ظرف ۷۲ ساعت به حساب شما بازخواهد گشت.',
                'order'   => $order
            ]);
        }
    }

    private function getBehpardashtErrorMessage($code)
    {
        $errors = [
            '0'   => 'تراکنش با موفقیت انجام شد.',
            '11'  => 'شماره کارت نامعتبر است.',
            '12'  => 'موجودی کافی نیست.',
            '13'  => 'رمز کارت نادرست است.',
            '14'  => 'تعداد دفعات وارد کردن رمز بیش از حد مجاز است.',
            '15'  => 'کارت نامعتبر است.',
            '16'  => 'دفعات برداشت وجه بیش از حد مجاز است.',
            '17'  => 'کاربر از انجام تراکنش منصرف شده است.',
            '18'  => 'تاریخ انقضای کارت گذشته است.',
            '19'  => 'مبلغ برداشت وجه بیش از حد مجاز است.',
            '21'  => 'پذیرنده نامعتبر است.',
            '23'  => 'خطای امنیتی رخ داده است.',
            '24'  => 'اطلاعات کاربری پذیرنده نامعتبر است.',
            '25'  => 'مبلغ نامعتبر است.',
            '31'  => 'پاسخ نامعتبر است.',
            '32'  => 'فرمت اطلاعات وارد شده صحیح نمی‌باشد.',
            '33'  => 'حساب نامعتبر است.',
            '34'  => 'خطای سیستمی درگاه بانک.',
            '35'  => 'تاریخ نامعتبر است.',
            '41'  => 'شماره درخواست تکراری است.',
            '42'  => 'تراکنش خرید یافت نشد.',
            '43'  => 'قبلا درخواست Verify داده شده است.',
            '44'  => 'درخواست Verify یافت نشد.',
            '45'  => 'تراکنش Settle شده است.',
            '46'  => 'تراکنش Settle نشده است.',
            '47'  => 'تراکنش Settle یافت نشد.',
            '48'  => 'تراکنش Reverse (برگشت داده) شده است.',
            '51'  => 'تراکنش تکراری است.',
            '54'  => 'تراکنش مرجع موجود نیست.',
            '55'  => 'تراکنش نامعتبر است.',
            '56'  => 'خطا در تاییدیه مالک کارت (مانا).',
            '57'  => 'خطا در استعلام هویت دارنده کارت (احراز هویت قوی).',
            '61'  => 'خطا در واریز وجه.',
            '62'  => 'مسیر بازگشت به سایت در دامنه ثبت شده برای پذیرنده قرار ندارد.',
            '98'  => 'سقف استفاده از رمز ایستا به پایان رسیده است.',
            '111' => 'صادر کننده کارت نامعتبر است.',
            '112' => 'خطای سوییچ صادر کننده کارت.',
            '113' => 'پاسخی از سامانه مقصد دریافت نشد.',
            '114' => 'دارنده کارت مجاز به انجام این تراکنش نیست.',
            '115' => 'شما امکان انجام این تراکنش را ندارید.',
            '116' => 'صادر کننده کارت قادر به پاسخگویی نیست.',
            '117' => 'صادر کننده کارت در حال حاضر قادر به پاسخگویی نیست.',
            '412' => 'شناسه قبض نادرست است.',
            '413' => 'شناسه پرداخت نادرست است.',
            '415' => 'زمان جلسه کاری به پایان رسیده است.',
            '417' => 'شناسه پرداخت کننده نامعتبر است.',
        ];

        return $errors[$code] ?? "خطای ناشناخته بانکی (کد خطا: {$code})";
    }
}
