<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class SocialAuthController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            // در صورت بروز خطا در دریافت اطلاعات از گوگل
            return redirect('/login')->withErrors(['google' => 'خطا در احراز هویت با گوگل.']);
        }

        $user = User::where('email', $googleUser->getEmail())->first();
        $isNewUser = false;

        if (!$user) {
            // کاربر جدید است، او را ثبت می‌کنیم
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
                // 💡 ایمیل را به عنوان تأیید شده علامت می‌زنیم
                'email_verified_at' => Carbon::now(),
                // 'mobile' به صورت پیش‌فرض NULL است
            ]);
            $isNewUser = true;
        }

        // بررسی می‌کنیم که آیا کاربر جدید است یا قبلاً ثبت‌نام کرده اما شماره موبایلش را وارد نکرده است.
        if ($isNewUser || empty($user->mobile)) {
            // داده‌های کاربر را در سشن ذخیره می‌کنیم و او را به مرحله ثبت موبایل هدایت می‌کنیم
            session([
                'social_registration_in_progress' => true,
                'social_user_id' => $user->id,
                'social_email' => $user->email,
            ]);

            return redirect()->route('client.social.complete.mobile');
        }

        // کاربر قدیمی و کامل است، وارد سیستم می‌شود
        Auth::login($user);

        return redirect('/')->with('success', 'شما با موفقیت وارد شدید.');
    }
}
