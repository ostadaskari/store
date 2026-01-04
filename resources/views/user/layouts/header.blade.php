<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($header_title) ? $header_title : '' }} - ShirazChip.ir</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('design/css/owl.carousel.css') }}">


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- style -->
    <link rel="stylesheet" href="{{ url('design/css/style.css') }}">
    <link rel="icon" href="{{url('design/image/favicon-3.png')}}" type="image/png">
    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="rtl bg-light">
<!-- ad bar -->
<div id="adBanner" class="ad-banner">
    <button class="close-btn" onclick="closeAd()">×</button>
    <div id="adText" class="ad-text">اینجا محل تبلیغات شماست!</div>
</div>
<!--end ad bar  -->

<!-- Start Store Header -->
<div class="container-fluid custom-bg-color px-0 d-none d-md-block StoreHeader">
    <div class="row">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center px-2">
            <!-- logo -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="d-flex flex-row align-items-center">
                    <div class="logo">
                        <img class="img-fluid" src="{{ url('design/image/logo (4).png') }}">
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="col-6 d-none d-lg-block">
                <div class="input-group position-relative">
                    <!-- Input -->
                    <input type="text" class="form-control nav-font-size" placeholder="جستجو بین بیش از 2000 کالا">

                    <!-- Search Button -->
                    <button class="btn btn-success nav-font-size d-flex align-items-center" type="button">
                        <svg class="mx-1" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        جستجو
                    </button>
                </div>
            </div>

            <!-- cart and login -->
            <div class="col-12 col-md-1">
                <div class="d-flex flex-row justify-content-end w-100">
                    <!-- Cart -->
                    <div class="mx-3 position-relative" dir="rtl">
                        <a class="text-white nav-font-size d-flex justify-content-center align-items-center p-0 position-relative" id="cartBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="22" height="22" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                            </svg>
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger" id="cart-count">{{ Cart::getContent()->count() }}</span>
                        </a>

                        <!-- list dropdown -->
                        @if(!empty(Cart::getContent()->count() ))
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="min-width: 450px;z-index:9999; font-size: 14px;">
                                <div class="cart-items mb-3">
                                    @foreach(Cart::getContent() as $header_cart)
                                        @php $getCartProduct = \App\Models\Warehouse\Product::getSingle($header_cart->id) @endphp
                                        @if(!empty($getCartProduct))


                                            <li class="d-flex align-items-center mb-2 justify-content-between"  data-price="1500000">
                                                <span class="fw-bold"><img src="{{$getCartProduct->coverImage->url ?? asset('images/300x300.webp') }}" width="30"></span>
                                                <a href="{{ route('front.product.show', [
                                        'category' => $getCartProduct->category->slug,
                                        'product'  => $getCartProduct->slug
                                    ]) }}" class="flex-grow-1 mx-2">{{ $getCartProduct->part_number }}
                                                </a>
                                                <div class="d-flex align-items-center item">

                                                    <span class="spanNum">   {{ $header_cart->quantity }}  </span>
                                                    <span class="p-1"> X </span>
                                                    <span> {{ number_format($header_cart->price) }} تومان </span>
                                                </div>
                                                <a href="{{ route('cart.remove', $header_cart->id) }}" class="btn btn-sm btnHover">
                                                    <svg width="18" height="18" fill="#bb0303" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                                                    </svg>
                                                </a>



                                            </li>
                                        @endif
                                    @endforeach

                                </div>

                                <!-- جمع کل -->
                                <li class="border-top pt-2">
                                    <div class="d-flex justify-content-between mb-2 totalCart">
                                        <span> مبلغ کل:</span>
                                        <span>تومان {{ number_format(Cart::getSubTotal(),2) }}</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a class="btn btn-outline-fontColor fontColor flex-grow-1" href="{{ route('cart.index') }}">سبد خرید</a>
                                        <a class="btn addtocartProduct flex-grow-1" href="{{ url('checkout') }}">نهایی کردن خرید</a>
                                    </div>
                                </li>
                            </ul>
                        @endif
                    </div>


                    <!-- Login & User Info -->
                    <div class="mx-3">
                        <div class="dropdown">
                            <a class="text-white d-flex align-items-center dropdown-toggle nav-font-size" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="22" height="22" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end text-end mt-2 shadow rounded-3 border-0 nav-font-size" aria-labelledby="userDropdown" style="min-width: 200px;">

                                {{--  حالت: کاربر وارد شده است --}}
                                @if (Auth::check())
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('user/dashboard') }}">
                                            <svg width="16" height="16" fill="#a4bad4" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                            </svg>
                                            <span class="ms-2 me-1 ">{{ Auth::user()->name }}</span>
                                        </a>
                                    </li>
                                    <hr class="my-2" style="margin: auto; width: 80%;">
                                    <li>
                                        {{-- 🛑 دکمه خروج (با استفاده از فرم POST) --}}
                                        <form method="POST" action="{{ route('client.logout') }}" id="logout-form">
                                            @csrf
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <svg width="20" height="20" fill="#e35858" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"></path>
                                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"></path>
                                                </svg>
                                                خروج
                                            </a>
                                        </form>
                                    </li>
                                @else
                                    {{-- 🛑 حالت: کاربر وارد نشده است --}}
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('client.login.mobile.form') }}">
                                            <svg width="20" height="20" fill="#a4bad4" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                            </svg>
                                            ورود
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('client.register.mobile.form') }}">
                                            <svg width="20" height="20" fill="#a4bad4" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 1 1 0-1h.5a.5.5 0 1 1 0 1h-.5a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1 0-1h.5a.5.5 0 0 0 .5-.5V4h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 1-.5-.5V2a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 0 0 1h.5a.5.5 0 0 0 .5.5v.5a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                            ثبت نام
                                        </a>
                                    </li>
                                    <hr class="my-2" style="margin: auto; width: 80%;">
                                    {{--                                    <li>--}}
                                    {{--                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('client.password.forgot') }}">--}}
                                    {{--                                            <svg width="20" height="20" fill="#a4bad4" class="bi bi-lock" viewBox="0 0 16 16">--}}
                                    {{--                                                <path d="M8 1a2 2 0 0 0-2 2v4H5a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H9V3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3.5a.5.5 0 0 0 1 0V3a2 2 0 0 0-2-2z"/>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                            فراموشی رمز عبور--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row custom-navbar">
        <div class="container">
            <div class="row">
                <!-- Main Navbar -->
                <div class="col-12 px-0">
                    <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse collapse-right" id="mainMenu">
                            <!-- close btn -->
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-3 d-md-none"
                                    data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-label="Close"></button>
                            <!-- menu -->

                            <!-- منوی اصلی (قطعات + ابزار و ...) -->
                            <div class="ruby-menu-demo-header">
                                <div class="ruby-wrapper">
                                    <ul class="ruby-menu">

                                        <!-- home -->
                                        <li class="nav-item">
                                            <a class="nav-link active" title="خانه" href="{{url('/')}}">
                                                <svg width="18" height="18" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                                                </svg>
                                                خانه</a>
                                        </li>

                                        <!-- قطعات غیرفعال -->
                                        <li>
                                            <a href="">
                                                <svg width="18" height="18"  fill="currentColor" class="bi bi-puzzle" viewBox="0 0 16 16">
                                                    <path d="M3.112 3.645A1.5 1.5 0 0 1 4.605 2H7a.5.5 0 0 1 .5.5v.382c0 .696-.497 1.182-.872 1.469a.5.5 0 0 0-.115.118l-.012.025L6.5 4.5v.003l.003.01q.005.015.036.053a.9.9 0 0 0 .27.194C7.09 4.9 7.51 5 8 5c.492 0 .912-.1 1.19-.24a.9.9 0 0 0 .271-.194.2.2 0 0 0 .039-.063v-.009l-.012-.025a.5.5 0 0 0-.115-.118c-.375-.287-.872-.773-.872-1.469V2.5A.5.5 0 0 1 9 2h2.395a1.5 1.5 0 0 1 1.493 1.645L12.645 6.5h.237c.195 0 .42-.147.675-.48.21-.274.528-.52.943-.52.568 0 .947.447 1.154.862C15.877 6.807 16 7.387 16 8s-.123 1.193-.346 1.638c-.207.415-.586.862-1.154.862-.415 0-.733-.246-.943-.52-.255-.333-.48-.48-.675-.48h-.237l.243 2.855A1.5 1.5 0 0 1 11.395 14H9a.5.5 0 0 1-.5-.5v-.382c0-.696.497-1.182.872-1.469a.5.5 0 0 0 .115-.118l.012-.025.001-.006v-.003a.2.2 0 0 0-.039-.064.9.9 0 0 0-.27-.193C8.91 11.1 8.49 11 8 11s-.912.1-1.19.24a.9.9 0 0 0-.271.194.2.2 0 0 0-.039.063v.003l.001.006.012.025c.016.027.05.068.115.118.375.287.872.773.872 1.469v.382a.5.5 0 0 1-.5.5H4.605a1.5 1.5 0 0 1-1.493-1.645L3.356 9.5h-.238c-.195 0-.42.147-.675.48-.21.274-.528.52-.943.52-.568 0-.947-.447-1.154-.862C.123 9.193 0 8.613 0 8s.123-1.193.346-1.638C.553 5.947.932 5.5 1.5 5.5c.415 0 .733.246.943.52.255.333.48.48.675.48h.238zM4.605 3a.5.5 0 0 0-.498.55l.001.007.29 3.4A.5.5 0 0 1 3.9 7.5h-.782c-.696 0-1.182-.497-1.469-.872a.5.5 0 0 0-.118-.115l-.025-.012L1.5 6.5h-.003a.2.2 0 0 0-.064.039.9.9 0 0 0-.193.27C1.1 7.09 1 7.51 1 8s.1.912.24 1.19c.07.14.14.225.194.271a.2.2 0 0 0 .063.039H1.5l.006-.001.025-.012a.5.5 0 0 0 .118-.115c.287-.375.773-.872 1.469-.872H3.9a.5.5 0 0 1 .498.542l-.29 3.408a.5.5 0 0 0 .497.55h1.878c-.048-.166-.195-.352-.463-.557-.274-.21-.52-.528-.52-.943 0-.568.447-.947.862-1.154C6.807 10.123 7.387 10 8 10s1.193.123 1.638.346c.415.207.862.586.862 1.154 0 .415-.246.733-.52.943-.268.205-.415.39-.463.557h1.878a.5.5 0 0 0 .498-.55l-.001-.007-.29-3.4A.5.5 0 0 1 12.1 8.5h.782c.696 0 1.182.497 1.469.872.05.065.091.099.118.115l.025.012.006.001h.003a.2.2 0 0 0 .064-.039.9.9 0 0 0 .193-.27c.14-.28.24-.7.24-1.191s-.1-.912-.24-1.19a.9.9 0 0 0-.194-.271.2.2 0 0 0-.063-.039H14.5l-.006.001-.025.012a.5.5 0 0 0-.118.115c-.287.375-.773.872-1.469.872H12.1a.5.5 0 0 1-.498-.543l.29-3.407a.5.5 0 0 0-.497-.55H9.517c.048.166.195.352.463.557.274.21.52.528.52.943 0 .568-.447.947-.862 1.154C9.193 5.877 8.613 6 8 6s-1.193-.123-1.638-.346C5.947 5.447 5.5 5.068 5.5 4.5c0-.415.246-.733.52-.943.268-.205.415-.39.463-.557z"/>
                                                </svg>
                                                دسته‌بندی‌ها
                                            </a>
                                            @include('front.partials.category_menu', ['categories' => $categoriesTree])
                                        </li>


                                        <!-- other items-->
                                        <li class="nav-item">
                                            <a class="nav-link" title="عضویت" href="./registration.html">
                                                <svg width="18" height="18" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                                عضویت</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" title="بلاگ" href="./blog.html">
                                                <svg width="18" height="18" fill="currentColor" class="bi bi-blockquote-left" viewBox="0 0 16 16">
                                                    <path d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm5 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm.79-5.373q.168-.117.444-.275L3.524 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562Q2 7.587 2 7.969q0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282q.036-.305.123-.498a1.4 1.4 0 0 1 .252-.37 2 2 0 0 1 .346-.298zm2.167 0q.17-.117.445-.275L5.692 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562q-.165.31-.164.692 0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282a1.8 1.8 0 0 1 .118-.492q.087-.194.257-.375a2 2 0 0 1 .346-.3z"/>
                                                </svg>
                                                بلاگ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" title="درباره ما" href="{{route('about')}}">
                                                <svg width="18" height="18" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                                                    <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                                    <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                </svg>
                                                درباره ما
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- end menu -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Store Header -->

@include('user.layouts.mobile_header')

<!-- user account -->
<div class="container user-account" style="padding-top:90px;">
    <div class="row" style="height: 100%;" >

        @include('user.layouts.sidebar')
