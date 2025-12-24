<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\UserAddress; // To fetch addresses

class ProfileController extends Controller
{
    /**
     * Display the user's profile page with all data.
     */
    public function index()
    {
        $header_title = "پروفایل";
        $user = Auth::user();
        $addresses = UserAddress::where('user_id', $user->id)->get();

        // Pass all necessary data to the view
        return view('user.profile.index', compact('header_title','user', 'addresses'));
    }

    /**
     * Handle AJAX request to update personal profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'job' => ['nullable', 'string', 'max:100'],
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'birth_date' => 'nullable|date|before:today',
        ]);

        // Merge name and family back into `name` if your model relies on it, or update them separately
        // Assuming your 'name' field holds both (e.g., 'John Doe') or you use accessors/mutators.
        // If your table has separate `first_name` and `last_name` fields, adjust below.
        // For simplicity, let's assume `name` holds the full name here (as per the input placeholder).
        $user->name = $request->input('name'); // Assuming name input is full name
        $user->family = $request->input('family'); // Assuming name input is full name
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');
        $user->job = $request->input('job');
        $user->birth_date = $request->input('birth_date');

        $user->save();

        return response()->json(['success' => true, 'message' => 'اطلاعات کاربری با موفقیت به‌روزرسانی شد.']);
    }

    /**
     * Handle AJAX request to update bank information.
     */
    public function updateBankInfo(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'account_number' => ['nullable', 'string', 'max:50'],
            'card_number' => ['nullable', 'string', 'regex:/^[0-9]{16}$/'],
            'shaba_number' => ['nullable', 'string', 'regex:/^[0-9A-Za-z]{24}$/'],
        ]);

        $user->account_number = $request->input('account_number');
        $user->card_number = $request->input('card_number');
        $user->shaba_number = $request->input('shaba_number');
        $user->save();

        return response()->json(['success' => true, 'message' => 'اطلاعات بانکی با موفقیت به‌روزرسانی شد.']);
    }

    /**
     * Handle AJAX request to change the user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('رمز عبور فعلی صحیح نمی‌باشد.');
                }
            }],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ], [
            'new_password.regex' => 'رمز عبور باید شامل حداقل ۸ کاراکتر، حروف کوچک و بزرگ، عدد و یک کاراکتر خاص باشد.',
            'new_password.confirmed' => 'رمز عبور جدید با تکرار آن مطابقت ندارد.',
        ]);

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(['success' => true, 'message' => 'رمز عبور با موفقیت تغییر یافت.']);
    }
}
