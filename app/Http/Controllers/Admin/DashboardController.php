<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = "داشبورد ادمین";
        return view('admin.dashboard',$data);
    }
}
