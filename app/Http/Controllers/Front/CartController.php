<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Product;


class CartController extends Controller
{
    // Add product to cart
    public function add(Product $product)
    {

        $qty = request('qty', 1);

        // Check stock
        if ($qty > $product->available_qty) {
            return back()->with('error', 'تعداد انتخاب شده بیشتر از موجودی است.');
        }

        \Cart::add([
            'id' => $product->id,
            'name' => $product->part_number,
            'price' => $product->display_price_toman, // your final price
            'quantity' => $qty,
            'attributes' => [
                'slug' => $product->slug,
                'image' => $product->coverImage->url
            ],
        ]);

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
        $newQty = request('qty');

        $product = Product::find($item->id);

        if ($newQty > $product->available_qty) {
            return back()->with('error', 'موجودی کافی نیست.');
        }

        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $newQty
            ]
        ]);

        return back()->with('success', 'بروزرسانی انجام شد.');
    }

    //update AJAX
    public function ajaxUpdate($id)
    {
        $item = \Cart::get($id);
        $newQty = request('qty');

        if (!$item) {
            return response()->json(['error' => 'محصول در سبد پیدا نشد.']);
        }

        // Validate against real product stock
        $product = Product::find($item->id);

        if ($newQty > $product->available_qty) {
            return response()->json([
                'error' => 'موجودی کافی نیست.'
            ]);
        }

        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $newQty,
            ],
        ]);

        return response()->json([
            'success'     => true,
            'line_total'  => ($item->price * $newQty),
            'grand_total' => \Cart::getTotal(),
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
        return view('front.cart.checkout');
    }

}
