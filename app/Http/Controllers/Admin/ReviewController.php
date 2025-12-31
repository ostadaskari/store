<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index()
    {
        // Fetch reviews with product and user relationships to avoid N+1 queries
        $reviews = Review::with(['user', 'product', 'order'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Update the status of a review via AJAX.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:reviews,id',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        try {
            $review = Review::findOrFail($request->review_id);
            $review->status = $request->status;
            $review->save();

            return response()->json([
                'success' => true,
                'message' => 'وضعیت نظر با موفقیت بروزرسانی شد.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطایی رخ داده است.'
            ], 500);
        }
    }
    /**
     * Delete review via AJAX.
     */
    public function destroy($id)
    {
        try {
            // As an admin, we find the review by ID regardless of which user owned it
            $review = Review::findOrFail($id);

            $review->delete();

            return response()->json([
                'success' => true,
                'message' => 'نظر با موفقیت حذف گردید.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'خطا در حذف نظر'], 500);
        }
    }
    public function reply(Request $request)
    {
        try {
            $review = Review::findOrFail($request->review_id);
            $review->update([
                'admin_reply' => $request->reply,
                'status' => 'approved'
            ]);

            return response()->json(['success' => true, 'message' => 'پاسخ ثبت شد']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'خطا در پاسخ'], 500);
        }
    }

    /**
     * Delete ONLY the admin reply.
     */
    public function deleteReply($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->update([
                'admin_reply' => null
            ]);

            return response()->json(['success' => true, 'message' => 'پاسخ مدیر حذف شد']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'خطا در حذف پاسخ'], 500);
        }
    }
}
