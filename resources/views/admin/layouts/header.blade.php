<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($header_title) ? $header_title : '' }} - ShirazChip.ir</title>

    <!-- Bootstrap 5 CSS -->
    <link href="{{asset('design/css/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('design/css/bootstrap-icons.css')}}">


    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('design/css/adminPanel.css')}}">
    <link rel="icon" href="{{asset('design/image/favicon-3.png')}}" type="image/png">
    <!-- for editor -->

    @yield('style')
</head>
<body>

<div class="container panel">
    <div class="row" dir="rtl">
        <!-- right sidebar -->
        <div class="col-2 px-0" style="width: 15%;height: 100vh;">
            <div class="offcanvas-lg offcanvas-start sidebar px-2 d-flex flex-column" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarLabel">
                <div class="offcanvas-header d-lg-none d-flex justify-content-end">
                    <button class="btn-close btn-close-white m-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column p-0">
                    <div class="d-flex flex-row align-items-end p-2 mt-2">
                        <a href="#" class="d-flex align-items-center">
                            <img src="{{asset('design/image/logo (4).png')}}" class="img-fluid">
                        </a>
                    </div>
                    <hr class="border-light" style="margin: 8.5px 0;">
                    <!-- Sidebar Navigation -->
                    <ul class="nav nav-pills flex-column mb-auto" >
                         <li><a href="{{ url('admin/dashboard') }}" class="nav-link px-0 @if(Request::segment(2) == 'dashboard') active @endif"><i class='bx bxs-dashboard mx-2 EditorSvg'></i> داشبورد</a></li>
                        <li><a href="{{ url('admin/admin/list') }}" class="nav-link px-0 @if(Request::segment(2) == 'admin') active @endif"><i class="bi bi-person-gear mx-2 EditorSvg"></i>ادمین ها</a></li>
                        <li><a href="{{ url('admin/category/list') }}" class="nav-link px-0 @if(Request::segment(2) == 'category') active @endif"><i class="bi bi-grid-1x2 mx-2 EditorSvg"></i>دسته ها</a></li>
                        <li><a href="{{ url('admin/product/list') }}" class="nav-link px-0 @if(Request::segment(2) == 'product') active @endif"><i class="bi bi-box-seam mx-2 EditorSvg"></i>محصولات</a></li>
                        <li><a href="{{ url('admin/banners') }}" class="nav-link px-0 @if(Request::segment(2) == 'banners') active @endif"><i class="bi bi-rainbow mx-2 EditorSvg"></i>بنر ها</a></li>
                        <li><a href="{{ url('admin/information') }}" class="nav-link px-0 @if(Request::segment(2) == 'information') active @endif"><i class="bi bi-info-square mx-2 EditorSvg"></i>اطلاعات محصولات</a></li>
                        <li><a href="{{ url('admin/product-seo') }}" class="nav-link px-0 @if(Request::segment(2) == 'product-seo') active @endif"><i class="bi bi-meta mx-2 EditorSvg"></i>meta's</a></li>
                        <li><a href="{{ url('/admin/prices') }}" class="nav-link px-0 @if(Request::segment(2) == 'price') active @endif"><i class="bi bi-cash-coin mx-2 EditorSvg"></i>قیمت ها</a></li>
                        <li><a href="{{ url('/admin/discounts') }}" class="nav-link px-0 @if(Request::segment(2) == 'discounts') active @endif"><i class='bi bi-tags-fill mx-2 EditorSvg'></i> تخفیف</a></li>

                        <li><a href="{{ url('/admin/shippings') }}" class="nav-link px-0 @if(Request::segment(2) == 'shippings') active @endif"><i class='bi bi-truck-front mx-2 EditorSvg'></i>باربری</a></li>
                        <li><a href="{{ url('/admin/orders') }}" class="nav-link px-0 @if(Request::segment(2) == 'orders') active @endif"><i class="bi bi-card-list mx-2 EditorSvg"></i>سفارشات</a></li>
                        <li><a href="{{ url('/admin/customers') }}" class="nav-link px-0 @if(Request::segment(2) == 'customers') active @endif"><i class='bi bi-people mx-2 EditorSvg'></i>مشتریان</a></li>
                        <li><a href="{{ url('/admin/reviews') }}" class="nav-link px-0 @if(Request::segment(2) == 'reviews') active @endif"><i class="bi bi-card-checklist mx-2 EditorSvg"></i>نظرات مشتریان</a></li>
                        <li><a href="{{ url('/admin/messages') }}" class="nav-link px-0 @if(Request::segment(2) == 'messages') active @endif"><i class='bx bxs-message-dots mx-2 EditorSvg'></i>پیام های تماس با ما</a></li>

                        <hr class="border-light my-0">
                        <li><a href="#" class="nav-link px-0" ><i class="bi bi-person-check mx-2 EditorSvg"></i> {{ Auth::user()->name }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- main side -->
        <div class="col-12 col-lg-10 mainCol ps-0">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg bg-panel borderRadius py-2 pt-3 px-0" dir="rtl">
                <div class="container px-0">
                    <!-- Hamburger menu (visible on mobile only) -->
                    <button class="btn btn-outline-secondary d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                        <i class='bx bx-menu bx-sm'></i>
                    </button>

                    <div class="row w-100 px-0">
                        <!-- Notifications and profile menu -->
                        <div class="col-12 d-flex align-items-center justify-content-end px-0">

                            <div class="d-flex flex-row align-items-center ms-3" dir="rtl">
                                <p class="mb-0 ms-3" id="live-time">00:00:00</p>
                                <span id="live-date">0000/00/00</span>
                            </div>


                            <a href="{{url('admin/logout')}}" class="nav-link px-0"><i class='bx bx-power-off bx-burst-hover mx-2'></i></a>
                        </div>

                    </div>
                </div>
            </nav>



