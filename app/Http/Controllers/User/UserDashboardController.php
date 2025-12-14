<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'داشبورد کاربر';
        $data['orders_count'] = Order::where('user_id',Auth::user()->id)->count();
        $data['user_orders'] = Order::where('user_id',Auth::user()->id)->get();
        $data['user_orders_complete'] = Order::where('user_id',Auth::user()->id)->where('status', 'completed')->get();
        $data['user_orders_complete_count'] = Order::where('user_id',Auth::user()->id)->where('status', 'completed')->count();
        $data['user_orders_canceled'] = Order::where('user_id',Auth::user()->id)->where('status', 'canceled')->get();
        $data['user_orders_canceled_count'] = Order::where('user_id',Auth::user()->id)->where('status', 'canceled')->count();

        return view('user.dashboard', $data);
    }
}
