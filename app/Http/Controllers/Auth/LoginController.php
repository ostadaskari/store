<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Ipe\Sdk\Facades\SmsIr;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    // ... متدهای showMobileForm، sendVerificationCode، verifyCode و authenticate (که قبلا به‌روزرسانی شد) در اینجا قرار دارند و بدون تغییر می‌مانند.

    /**
     * Show the initial mobile number input form for login.
     * This route is used both for showing the mobile form (step 1) and the OTP form (step 2).
     */
    public function showMobileForm(Request $request)
    {
        // Check session for current step. Default is 1 (Mobile Input).
        $step = session('login_step', 1);
        $mobile = session('login_mobile', '');

        // If step 2 (OTP form) is active but mobile number is missing, reset state for safety.
        if ($step === 2 && empty($mobile)) {
            session()->forget(['login_step', 'login_mobile']);
            $step = 1;
        }

        return view('front.auth.login', [
            'step' => $step,
            'mobile' => $mobile
        ]);
    }

    /**
     * Send the verification code for login and proceed to the OTP input form (Step 2).
     */
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/'],
        ], [
            'mobile.required' => 'شماره موبایل الزامی است.',
            'mobile.regex' => 'فرمت شماره موبایل صحیح نیست.',
        ]);

        $mobile = $request->input('mobile');

        // CRITICAL CHECK: For LOGIN, the user MUST EXIST.
        if (!User::where('mobile', $mobile)->exists()) {
            return back()->withErrors(['mobile' => 'این شماره در سیستم ثبت نشده است. لطفاً ثبت نام کنید.']);
        }

        $code = rand(1000, 9999); // Generate a 4-digit code

        // 1. Send SMS via SMS.ir
        try {
            $templateId = env('SMSIR_TEMPLATE_ID');
            $parameters = [
                ["name" => "Code", "value" => (string)$code]
            ];

            SmsIr::verifySend($mobile, $templateId, $parameters);

        } catch (\Exception $e) {
            \Log::error('SMSIR Login Error: ' . $e->getMessage());
        }

        // 2. Save/Update the code in the database
        $expiresAt = Carbon::now()->addMinutes(5);

        VerificationCode::updateOrCreate(
            ['mobile' => $mobile],
            ['code' => $code, 'expires_at' => $expiresAt]
        );

        // 3. Set session to proceed to step 2 (OTP form)
        session(['login_step' => 2, 'login_mobile' => $mobile]);

        return redirect()->route('client.login.mobile.form');
    }

    /**
     * Verify the entered code and log the user in.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/'],
            'code' => ['required', 'digits:4'],
        ]);

        $mobile = $request->input('mobile');
        $inputCode = $request->input('code');

        $record = VerificationCode::where('mobile', $mobile)
            ->where('code', $inputCode)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$record) {
            session(['login_step' => 2, 'login_mobile' => $mobile]); // Keep user on step 2
            return back()->withErrors(['code' => 'کد تایید اشتباه یا منقضی شده است.']);
        }

        // Code is correct and valid: delete the temporary record
        $record->delete();

        // Find the user and log them in
        $user = User::where('mobile', $mobile)->first();

        if ($user) {
            Auth::login($user);
            session()->forget(['login_step', 'login_mobile']); // Clear session data
            return redirect()->intended('/')->with('success', 'شما با موفقیت وارد شدید.');
        }

        // Fallback: This should ideally not happen if user exists check was done in step 1
        return redirect()->route('client.login.mobile.form')->withErrors([
            'mobile' => 'خطا در احراز هویت. لطفاً دوباره تلاش کنید.'
        ]);
    }

    /**
     * مدیریت درخواست ورود استاندارد (ایمیل و رمز عبور)
     */
    public function authenticate(Request $request)
    {
        // اعتبار سنجی ورودی ها با پیام های فارسی
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'وارد کردن آدرس ایمیل الزامی است.',
            'email.email' => 'فرمت آدرس ایمیل وارد شده صحیح نیست.',
            'password.required' => 'وارد کردن کلمه عبور الزامی است.',
        ]);

        // تلاش برای ورود
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // هدایت به صفحه مقصد یا صفحه اصلی
            return redirect()->intended(route('home'))->with('success', 'شما با موفقیت وارد شدید.');
        }

        // اگر ورود موفقیت آمیز نبود، خطا را برگردانید
        throw ValidationException::withMessages([
            'email' => ['اطلاعات کاربری وارد شده صحیح نمی‌باشد.'],
        ]);
    }

    // --- متدهای جدید برای تکمیل ثبت نام شبکه اجتماعی ---

    /**
     * نمایش فرم دریافت شماره موبایل پس از احراز هویت اجتماعی (مرحله ۱ یا ۲).
     */
    public function showMobileRegistrationForSocial(Request $request)
    {
        // باید حتماً از طریق SocialAuthController آمده باشد
        if (!session('social_registration_in_progress') || !session('social_user_id')) {
            return redirect('/')->withErrors(['error' => 'جریان احراز هویت نامعتبر.']);
        }

        // بررسی وضعیت فعلی
        $step = session('social_mobile_step', 1);
        $mobile = session('social_mobile', '');

        // اگر کاربری که شماره موبایلش را تکمیل نکرده است مستقیماً به این صفحه بیاید،
        // باید مطمئن شویم که داده‌های Social در سشن باشد.

        return view('front.auth.social_mobile_register', [
            'step' => $step,
            'mobile' => $mobile,
            'email' => session('social_email'),
        ]);
    }

    /**
     * ارسال کد تایید برای شماره موبایل وارد شده پس از احراز هویت اجتماعی.
     */
    public function sendSocialMobileCode(Request $request)
    {
        if (!session('social_registration_in_progress') || !session('social_user_id')) {
            return redirect('/')->withErrors(['error' => 'جریان احراز هویت نامعتبر.']);
        }

        $request->validate([
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/', 'unique:users,mobile'],
        ], [
            'mobile.required' => 'شماره موبایل الزامی است.',
            'mobile.regex' => 'فرمت شماره موبایل صحیح نیست.',
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است. لطفاً وارد حساب کاربری خود شوید.',
        ]);

        $mobile = $request->input('mobile');
        $code = rand(1000, 9999);

        // 1. Send SMS via SMS.ir
        try {
            $templateId = env('SMSIR_TEMPLATE_ID'); // از همان تمپلیت استفاده می‌کنیم
            $parameters = [
                [
                 "name" => "Code",
                 "value" => (string)$code
                ]
            ];

            SmsIr::verifySend($mobile, $templateId, $parameters);

        } catch (\Exception $e) {
            \Log::error('SMSIR Social Mobile Error: ' . $e->getMessage());
        }

        // 2. Save/Update the code in the database
        $expiresAt = Carbon::now()->addMinutes(5);
        VerificationCode::updateOrCreate(
            ['mobile' => $mobile],
            ['code' => $code, 'expires_at' => $expiresAt]
        );

        // 3. Set session to proceed to step 2 (OTP form)
        session(['social_mobile_step' => 2, 'social_mobile' => $mobile]);

        return redirect()->route('client.social.complete.mobile');
    }

    /**
     * تایید کد OTP، به‌روزرسانی اطلاعات کاربر و ورود نهایی.
     */
    public function completeSocialRegistration(Request $request)
    {
        if (!session('social_registration_in_progress') || !session('social_user_id')) {
            return redirect('/')->withErrors(['error' => 'جریان احراز هویت نامعتبر.']);
        }

        $request->validate([
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/'],
            'code' => ['required', 'digits:4'],
        ]);

        $mobile = $request->input('mobile');
        $inputCode = $request->input('code');
        $userId = session('social_user_id');

        $record = VerificationCode::where('mobile', $mobile)
            ->where('code', $inputCode)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$record) {
            session(['social_mobile_step' => 2, 'social_mobile' => $mobile]); // Keep user on step 2
            return back()->withErrors(['code' => 'کد تایید اشتباه یا منقضی شده است.']);
        }

        // کد تایید شد، رکورد موقت را حذف می‌کنیم
        $record->delete();

        // به‌روزرسانی اطلاعات کاربر
        $user = User::find($userId);
        if ($user) {
            $user->mobile = $mobile;
            $user->save();

            // ورود نهایی
            Auth::login($user);
            session()->forget(['social_registration_in_progress', 'social_user_id', 'social_email', 'social_mobile_step', 'social_mobile']);

            return redirect()->intended('/')->with('success', 'ثبت‌نام شما با موفقیت تکمیل شد و وارد شدید.');
        }

        // فال‌بک
        return redirect()->route('client.login.mobile.form')->withErrors([
            'mobile' => 'خطا در یافتن حساب کاربری. لطفاً دوباره تلاش کنید.'
        ]);
    }


    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'شما با موفقیت از حساب کاربری خارج شدید.');
    }
}
