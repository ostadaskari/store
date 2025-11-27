<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Auth\RegisterController; // Import to reuse SMS logic

class PasswordController extends Controller
{
    // Reuse the SMS logic from RegisterController
    protected $registerController;

    public function __construct(RegisterController $registerController)
    {
        $this->registerController = $registerController;
    }

    // 1. Show Forgot Password Form (Mobile Input)
    public function showForgotForm()
    {
        return view('front.auth.forgot_password');
    }

    // 2. Send Reset Code via SMS
    public function sendResetCode(Request $request)
    {
        $request->validate(['mobile' => 'required|regex:/^09[0-9]{9}$/'], [
            'mobile.required' => 'شماره موبایل الزامی است.',
            'mobile.regex' => 'فرمت شماره موبایل صحیح نیست.'
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            // Be vague for security, but return to the same form
            return back()->with('status', 'اگر این شماره در سیستم ما ثبت شده باشد، کد بازیابی ارسال خواهد شد.');
        }

        // Use the SMS sending utility
        if ($this->registerController->sendVerificationSms($user)) {
            return redirect()->route('client.password.reset.form')
                ->with('mobile', $user->mobile)
                ->with('success', 'کد تایید به شماره موبایل شما ارسال شد.');
        }

        return back()->with('error', 'خطا در ارسال پیامک. دوباره تلاش کنید.');
    }

    // 3. Show Reset Password Form (Code & New Password Input)
    public function showResetForm(Request $request)
    {
        if (!$request->session()->has('mobile')) {
            return redirect()->route('client.password.forgot');
        }
        $mobile = $request->session()->get('mobile');

        return view('front.auth.reset_password', compact('mobile'));
    }

    // 4. Verify Code and Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
            'code' => 'required|digits:4',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return back()->withErrors(['code' => 'کاربر با این شماره یافت نشد.']);
        }

        // Check code and expiration
        if ($user->verification_code === $request->code && Carbon::now()->lessThan($user->code_expires_at)) {

            // Success: Update password and clear codes
            $user->update([
                'password' => Hash::make($request->password),
                'verification_code' => null,
                'code_expires_at' => null,
            ]);

            return redirect()->route('client.login')
                ->with('success', 'رمز عبور شما با موفقیت تغییر یافت. اکنون وارد شوید.');

        } else if (Carbon::now()->greaterThan($user->code_expires_at)) {
            return back()->withErrors(['code' => 'کد تایید منقضی شده است.']);
        } else {
            return back()->withErrors(['code' => 'کد تایید اشتباه است.']);
        }
    }
}
