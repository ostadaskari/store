@extends('front.layouts.app')

@section('style')
 <style>

        /* --- تنظیمات محتوای اصلی (لایه رویی) --- */
        .main-content {
            position: relative;
            margin-bottom: 300px;
            background: #507596;
            background: radial-gradient(circle, rgba(80, 117, 150, 1) 0%, rgba(0, 49, 83, 1) 100%);
            min-height: 355px;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .contactContainer {
            width: 80%;
            position: absolute;
            top: 23vh;
            right:0;
            left: 0;
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);     
            border-top: 1px solid rgba(255, 255, 255, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px 20px 0 0; 
            color: #333; 
        }
        .bgheader {
            width: 100vw;
            height:355px;
        }
        .topPadd {
            padding-top: 163px;
        }
        
        .icon-circle {
            background-color: #dbeafe;
            color: #2563eb;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            font-size: 1.25rem;
        }
        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 10px 20px;
        }
        .text-contact{
            color:rgb(203 203 203);
        }
        .imgFollow{
            width: 180px;
            position: absolute;
            left: -18px;
            top: -14vh;
        }
        /* بهینه سازی برای موبایل */
        @media (max-width: 768px) {
            .main-content {
            padding-top:33px;
        }
        .contactContainer {
            top: 10vh;
            width: 90%;
        }
        .bgheader{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }
        }
    </style>
@endsection

@section('content')
     <main class="main-content container-fluid topPadd">
        <img class="imgFollow" src="{{ asset('design/image/iconFollow.png') }}" alt="follow us">
        <div class="bgheader text-center"></div>
        <div class="container py-2 contactContainer">
            <div class="mt-3">
                <p class="lh-lg text-center m-0" style="color:#021010;">
                    برای مراجعه حضوری یا تماس تلفنی می‌توانید از اطلاعات زیر استفاده کنید. همکاران ما در ساعات اداری پاسخگوی شما هستند.
                </p>
            </div>
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="px-4" style="border-left: 1px solid #9db1c563;">
                        <form>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label text-contact">نام و نام خانوادگی:</label>
                                    <input type="text" class="form-control" id="name" placeholder="نام خود را وارد کنید">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label text-contact fw-medium">شماره تماس:</label>
                                    <input type="tel" class="form-control input-ltr" id="phone" placeholder="0912..." dir="ltr">
                                </div>
                            </div>

                            <div class="mb-3 px-2">
                                <label for="email" class="form-label text-contact fw-medium">ایمیل:</label>
                                <input type="email" class="form-control input-ltr" id="email" placeholder="example@domain.com" dir="ltr">
                            </div>

                            <div class="mb-2 px-2">
                                <label for="message" class="form-label text-contact fw-medium">پیام شما:</label>
                                <textarea class="form-control" id="message" rows="4" placeholder="متن پیام خود را بنویسید..." style="resize: none;"></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-submit d-flex align-items-center justify-content-center gap-2">
                                    <span>ارسال پیام</span>
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 pt-5 position-relative">
                    <img class="imgFollow" src="{{ asset('design/image/iconFollow.png') }}" alt="follow us">
                    <div class="ps-lg-4">
                        <div class="d-flex flex-column gap-3 mb-5">
                            <div class="d-flex align-items-start gap-3 icon-box-wrapper">
                                <div class="icon-circle flex-shrink-0">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">آدرس دفتر مرکزی</h6>
                                    <p class="text-contact mb-0 lh-base">
                                      شیراز، چهارراه پارامونت، خیابان قصرالدشت ،کوچه 2 , ساختمان داور
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3 icon-box-wrapper">
                                <div class="icon-circle flex-shrink-0">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">تلفن تماس</h6>
                                    <p class="text-contact mb-0" dir="ltr">071 - 8888 1234</p>
                                    <p class="text-contact mb-0" dir="ltr">071 - 8888 5678</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3 icon-box-wrapper">
                                <div class="icon-circle flex-shrink-0">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">پست الکترونیک</h6>
                                    <p class="text-contact mb-0 font-monospace">info@shirazchip.ir</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 text-center">
                            <h6 class="fw-bold text-dark mb-3">شبکه‌های اجتماعی</h6>
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="#" class="social-link"><i class="bi bi-instagram fs-5"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-twitter-x fs-5"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-linkedin fs-5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>



@endsection

@section('script')

@endsection
