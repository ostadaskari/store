<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $data['banners'] = Banner::orderBy('sort_order','asc')->get();
        $data['header_title'] = 'خانه';

        return view('front.home', $data);
    }

    public function about()
    {

        $data['header_title'] = 'درباره ما';

        return view('front.about', $data);
    }

    public function contact()
    {
        $data['header_title'] = 'تماس با ما';

        return view('front.contact', $data);
    }
}
