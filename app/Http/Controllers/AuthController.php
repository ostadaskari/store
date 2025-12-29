<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_admin(Request $request) {
        // If user is logged in but NOT an admin, log them out
        // to prevent session conflicts before showing the login page
        if (Auth::check() && Auth::user()->is_admin != 1) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if (Auth::check() && Auth::user()->is_admin == 1) {
            return redirect('/admin/dashboard');
        }

        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request){

        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0, 'is_delete' => 0], $remember)){
            return redirect('admin/dashboard');
        }else{
            return redirect()->back()->with('error', "ایمیل یا پسوورد شما معتبر نمیباشد!");
        }
    }
    public function logout_admin(){
        Auth::logout();
        return redirect('admin');
    }
}
