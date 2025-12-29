<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    // Toggle add/remove
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $userId = auth()->id();
        $productId = $request->product_id;

        // Query the Wishlist model directly (it uses default connection)
        $wishlistEntry = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlistEntry) {
            $wishlistEntry->delete();

            return response()->json([
                'status' => 'removed',
                'message' => 'از لیست علاقه‌مندی‌ها حذف شد'
            ]);
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return response()->json([
            'status' => 'added',
            'message' => 'به لیست علاقه‌مندی‌ها اضافه شد ❤️'
        ]);
    }

    public function index()
    {
        $products = Wishlist::with([
            'product.coverImage',
            'product.price',
            'product.category'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get()
            ->pluck('product')      // 🔥 extract products
            ->filter();             // remove nulls (deleted products)

        return view('front.wishlist.index', compact('products'));
    }

}
