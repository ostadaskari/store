<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Ipe\Sdk\Facades\SmsIr;


class RegisterController extends Controller
{
    public function resetMobile()
    {
        session()->forget(['step', 'mobile']);
        return redirect()->route('client.register.mobile.form');
    }

    /**
     * Show the initial mobile number input form.
     */
    public function showMobileForm(Request $request)
    {
        // Determine the current step for the view
        $step = session('step', 1);
        $mobile = session('mobile', '');

        // If step 2 is active, we need to pass the mobile number to the view
        if ($step === 2 && empty($mobile)) {
            // Safety measure: if user navigates back, reset to step 1
            session()->forget(['step', 'mobile']);
            $step = 1;
        }

        return view('front.auth.register', compact('step', 'mobile'));
    }

    /**
     * Send the verification code and show the OTP input form.
     */
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/', 'unique:users,mobile'],
        ], [
            'mobile.required' => 'شماره موبایل الزامی است.',
            'mobile.regex' => 'فرمت شماره موبایل صحیح نیست.',
            // We use 'unique:users,mobile' here to check if the user exists
            'mobile.unique' => 'این شماره قبلاً ثبت شده است. لطفاً وارد شوید.',
        ]);

        $mobile = $request->input('mobile');
        $code = rand(1000, 9999); // Generate a 4-digit code
        \Log::info("OTP for {$mobile} is {$code}"); // <--- See the code in logs

        // 1. Send SMS via SMS.ir
        try {
            $templateId = env('SMSIR_TEMPLATE_ID');
            $parameters = [
                ["name" => "Code", "value" => (string)$code]
            ];

            // Using the service based on user's documentation
            $response = SmsIr::verifySend($mobile, $templateId, $parameters);
            \Log::info('SMSIR Sandbox Response: ', (array) $response);

            // Check if SMSir returned an error, although a success response is expected for production
            // if (!$response->IsSuccessful) {
            //     return back()->withErrors(['mobile' => 'خطا در ارسال پیامک. لطفاً دوباره تلاش کنید.']);
            // }

        } catch (\Exception $e) {
            // Log the error and return a generic message
            \Log::error('SMSIR Error: ' . $e->getMessage());
            // In test/dev, we skip the actual send for simplicity
            // return back()->withErrors(['mobile' => 'خطا در اتصال به سرویس پیامکی.']);
        }

        // 2. Save/Update the code in the database
        $expiresAt = Carbon::now()->addMinutes(5);

        VerificationCode::updateOrCreate(
            ['mobile' => $mobile],
            ['code' => $code, 'expires_at' => $expiresAt]
        );

        // 3. Set session to proceed to step 2 (OTP form)
        session(['step' => 2, 'mobile' => $mobile]);

        return redirect()->route('client.register.mobile.form');
    }

    /**
     * Verify the entered code.
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
            session(['step' => 2, 'mobile' => $mobile]); // Keep user on step 2
            return back()->withErrors(['code' => 'کد تایید اشتباه یا منقضی شده است.']);
        }

        // Code is correct and valid: delete the temporary record
        $record->delete();

        // Check if user exists (Login or Register)
        $user = User::where('mobile', $mobile)->first();

        if ($user) {
            // User exists: LOG THEM IN
            Auth::login($user);
            session()->forget(['step', 'mobile']); // Clear session data
            return redirect()->intended('/')->with('success', 'شما با موفقیت وارد شدید.');
        } else {
            // New user: Proceed to final registration form (Step 3)
            session(['step' => 3, 'mobile' => $mobile]);
            return redirect()->route('client.register.final.form');
        }
    }

    /**
     * Show the final registration form (Step 3).
     */
    public function showRegistrationForm(Request $request)
    {
        if (session('step') !== 3 || !session('mobile')) {
            // Guard: Must come from verification step
            return redirect()->route('client.register.mobile.form');
        }

        $step = 3;
        $mobile = session('mobile');
        return view('front.auth.register', compact('step', 'mobile'));
    }

    /**
     * Handle the final registration request (Step 3).
     */
    public function finalRegister(Request $request)
    {
        if (session('step') !== 3 || $request->mobile !== session('mobile')) {
            // Security check: mobile must be verified via session
            return redirect()->route('client.register.mobile.form');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            // Mobile is already validated/unique in step 1, but we check existence again
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/', 'unique:users,mobile'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'وارد کردن نام الزامی است.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور مطابقت ندارد.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the new user in
        Auth::login($user);
        session()->forget(['step', 'mobile']); // Clean up session

        return redirect()->intended('/')->with('success', 'حساب کاربری شما با موفقیت ایجاد شد.');
    }
}
