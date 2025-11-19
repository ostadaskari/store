<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $data['banners'] = Banner::orderBy('sort_order','asc')->get();
        $data['header_title'] = 'Home';

        return view('front.home', $data);
    }

    public function about()
    {

        $data['header_title'] = 'About Us';

        return view('front.about', $data);
    }
}
