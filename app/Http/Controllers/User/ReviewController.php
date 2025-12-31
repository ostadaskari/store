<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $request->validate(['comment' => 'required|string|max:1000']);

        $review = Review::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'order_id' => $request->order_id,
            ],
            [
                'comment' => $request->comment,
                'status' => 'pending', // Reset to pending if edited
            ]
        );

        return back()->with('success', 'نظر شما ثبت شد و پس از تایید مدیریت نمایش داده می‌شود.');
    }

    public function destroy($id)
    {
        $review = Review::where('user_id', auth()->id())->findOrFail($id);
        if($review->status == 'pending') {
            $review->delete();
            return back()->with('success', 'نظر حذف شد.');
        }
        return back()->with('error', 'نظرات تایید شده قابل حذف نیستند.');
    }
}
