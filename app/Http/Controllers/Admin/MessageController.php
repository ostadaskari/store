<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        // دریافت پیام‌ها به ترتیب جدیدترین و صفحه‌بندی ۱۰ تایی
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        // آپدیت وضعیت به خوانده شده
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        // اگر درخواست AJAX بود (از سمت دکمه مشاهده)، پاسخ موفقیت بده
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        // این خط دیگر عملاً اجرا نمی‌شود چون ما از مودال استفاده می‌کنیم
        return redirect()->back();
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'پیام با موفقیت حذف شد.');
    }
}
