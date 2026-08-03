@extends('front.layouts.app')
@section('style')


@endsection
@section('content')


    <!-- start banner -->
    <div id="bannerCarousel" class="container carousel slide m-auto px-3 topPadd" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            @foreach ($banners as $index => $banner)
                <a class="carousel-item {{ $index === 0 ? 'active' : '' }}" href="{{ $banner->link ?? '/' }}" target="_blank">
                    <img src="{{ asset( $banner->image_path) }}"
                         alt="{{ $banner->alt_text ?? 'Banner image' }}"
                         class="d-block w-100">
                </a>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

        <div class="carousel-indicators">
            @foreach ($banners as $index => $banner)
                <button type="button"
                        data-bs-target="#bannerCarousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}">
                </button>
            @endforeach
        </div>
    </div>


<!-- end banner -->

<!-- start banner1 section -->
<section class="container mt-3 d-none d-md-block">
    <div class="row px-1">
        <div class="col-6 col-lg-3 mt-2 mt-lg-0" style="padding: 0 8px;">
            <div>
                <a href="" title="جدیدترین ها" class="text-decoration-none d-block">
                    <img class="img-fluid w-100" style="object-fit: cover; border-radius: 16px;" src="design/image/building02.jpg" alt="جدیدترین ها">
                </a>
            </div>
        </div>
        <div class="col-6 col-lg-3 mt-2 mt-lg-0" style="padding: 0 8px;">
            <div>
                <a href="" title="فروش ویژه" class="text-decoration-none d-block">
                    <img class="img-fluid w-100" style="object-fit: cover; border-radius: 16px;" src="design/image/building03.jpg" alt="فروش ویژه">
                </a>
            </div>
        </div>
        <div class="col-6 col-lg-3 mt-2 mt-lg-0" style="padding: 0 8px;">
            <div>
                <a href="" title="پر فروش ترین ها" class="text-decoration-none d-block">
                    <img class="img-fluid w-100" style="object-fit: cover; border-radius: 16px;" src="design/image/building01.jpg" alt="پر فروشترین ها">
                </a>
            </div>
        </div>
        <div class="col-6 col-lg-3 mt-2 mt-lg-0" style="padding: 0 8px;">
            <div>
                <a href="" title="قطعات RF" class="text-decoration-none d-block">
                    <img class="img-fluid w-100" style="object-fit: cover; border-radius: 16px;" src="design/image/building05.jpg" alt="قطعات RF">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end baner1 section -->

<!-- start baner1 section in mobile -->
<section class="container mt-2 d-block d-md-none">
    <div class="row px-1">
        <div class="col-6 col-lg-3 mt-2 mt-md-0" style="padding: 0 4px;">
            <div>
                <a href="" title="جدیدترین ها" class="text-decoration-none d-block">
                    <img class="img-fluid w-100 baners4" style="max-height: 120px; object-fit: cover; border-radius: 16px;" src="design/image/building04MOB.jpg" alt="جدیدترین ها">
                </a>
            </div>
        </div>
        <div class="col-6 col-lg-3 mt-2 mt-md-0" style="padding: 0 4px;">
            <div>
                <a href="" title="فروش ویژه" class="text-decoration-none d-block">
                    <img class="img-fluid w-100 baners4" style="max-height: 120px; object-fit: cover; border-radius: 16px;" src="design/image/building03MOB.jpg" alt="فروش ویژه">
                </a>
            </div>
        </div>
        <div class="col-6 col-lg-3 mt-2 mt-md-0" style="padding: 0 4px;">
            <div>
                <a href="" title="پر فروش ترین ها" class="text-decoration-none d-block">
                    <img class="img-fluid w-100 baners4" style="max-height: 120px; object-fit: cover; border-radius: 16px;" src="design/image/building01MOB.jpg" alt="پر فروشترین ها">
                </a>
            </div>
        </div>
        <div class="col-6 col-lg-3 mt-2 mt-md-0" style="padding: 0 4px;">
            <div>
                <a href="" title="قطعات RF" class="text-decoration-none d-block">
                    <img class="img-fluid w-100 baners4" style="max-height: 120px; object-fit: cover; border-radius: 16px;" src="design/image/building05MOB.jpg" alt="قطعات RF">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end baner1 section in mobile -->


<!--start discount of the day owl products offers nav -->
<div class="container position-relative mt-3">
    <div class="row">
        <div class="col-12">
            <section class="container owl-products owl-1">
                <div class="row">
                    <div class="col-sm-12 p-0 position-relative">
                        <div class="bg-header-owl">
                            <img class="d-none d-md-block mt-5" src="{{ asset('design/image/favicon-3.png') }}" width="80" height="80" alt="شگفت انگیز" title="" style="object-fit: contain;">
                            <h2 class="title-header-owl pt-2 px-1 m-0">تخفیف روز</h2>
                        </div>

                        <div class="owl-carousel product-card">

                            @foreach($discounted_products as $product)
                                {{--
                                   نکته: اگر استایل کارت‌های اسلایدر با صفحات معمولی متفاوت است،
                                   می‌توانید کدهای داخل کامپوننت را اینجا کپی کنید.
                                   در اینجا ما از کامپوننت فعلی شما استفاده می‌کنیم:
                                --}}
                                @include('front.components.product-card-home', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <div class="custom-owl-controls text-center my-4 position-absolute owl-1">
                <button id="" class="btn btn-outline-dark mx-2 custom-prev">
                    <svg width="22" height="22" fill="#fff" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                    </svg>
                </button>
                <button id="" class="btn btn-outline-dark mx-2 custom-next">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end discount of the day owl products offers nav -->


<!-- Parallax Section -->
<div class="container py-0 mt-60">
    <div class="row m-auto">
        <div class="col-12 py-0">
            <div class="parallax-section2">
                <div class=" d-flex align-items-center bg-shipping p-3" style="width: 850px;">
                    <div class="row pt-3 d-flex justify-content-center align-items-center w-100">
                        <div class="col-sm-6 col-lg-4 d-flex justify-content-center">
                            <div class="shipping d-flex p-2">
                                <img class="img-fluid pt-2" style="filter: brightness(0) invert(1);" src="design/image/shipping00.png">
                                <p class="pl-2 pt-2">ارسال  به سراسر کشور</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 d-flex justify-content-center">
                            <div class="shipping d-flex p-2">
                                <img class="img-fluid pt-2" style="filter: brightness(0) invert(1);" src="design/image/shipping000.png">
                                <p class="pl-2 pt-2">ارسال سریع با پیک</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 d-flex justify-content-center">
                            <div class="shipping d-flex p-2">
                                <img class="img-fluid pt-2" style="filter: brightness(0) invert(1);" src="design/image/shipping00000.png">
                                <p class="pl-2 pt-2">ارسال امن و مطمئن</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Parallax Section -->

<!--start The best sellers owl products offers nav -->
<div class="container position-relative mt-60">
    <div class="row">
        <div class="col-12">
            {{-- بخش پرفروش ترین ها --}}
            <section class="container owl-products owl-2 mt-5">
                <div class="row m-auto">
                    <div class="col-sm-12 p-0 position-relative" style="background-color:rgb(255, 179, 1); border-radius: 15px; overflow: hidden;">
                        <div class="bg-header-owl text-center">
                            <img class="d-none d-md-block mt-5 mx-auto" src="{{ asset('design/image/favicon-3.png') }}" width="80" height="80" alt="پرفروش ترین ها" style="object-fit: contain;">
                            <h2 class="title-header-owl pt-2 px-1 m-0">پرفروش ترین ها</h2>
                        </div>

                        <div class="owl-carousel best-seller-carousel product-card">
                            @foreach($best_sellers as $product)

                                    {{-- استفاده از همان کامپوننت کارت محصول برای یکپارچگی --}}
                                    @include('front.components.product-card-home', ['product' => $product])

                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <div class="custom-owl-controls text-center my-4 position-absolute owl-2">
                <button id="" class="btn btn-outline-dark mx-2 custom-prev">
                    <svg width="22" height="22" fill="#fff" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                    </svg>
                </button>
                <button id="" class="btn btn-outline-dark mx-2 custom-next">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end The best sellers owl products offers nav -->

<!-- Start Properties Section -->
<section class="container my-5" id="PropertiesSection">
    <div class="row w-100 d-flex flex-row justify-content-around m-auto">
        <div class="col-md-3 col-12" data-aos="fade-up">
            <div class="property">
                <svg  width="40" height="40" fill="var(--melloBlu-color)" class="bi bi-award-fill" viewBox="0 0 16 16">
                    <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z"/>
                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                </svg>
                <div  class="property__title">
                    گارانتی
                    <p>گارانتی 18 ماهه پارس مگا</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12" data-aos="fade-up" data-aos-delay="200">
            <div class="property">
                <svg width="40" height="40" fill="var(--melloBlu-color)" class="bi bi-headset" viewBox="0 0 16 16">
                    <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
                </svg>
                <div class="property__title">
                    پشتیبانی
                    <p>پشتیبانی پس از فروش تخصصی</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12" data-aos="fade-up" data-aos-delay="400">
            <div class="property">
                <svg width="40" height="40" fill="var(--melloBlu-color)" class="bi bi-send-fill" viewBox="0 0 16 16">
                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                </svg>
                <div class="property__title">
                    ارسال فوری
                    <p>
                        ارسال بلافاصله بعد از سفارش کالا
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12" data-aos="fade-up" data-aos-delay="600">
            <div class="property">
                <svg width="40" height="40" fill="var(--melloBlu-color)" class="bi bi-bookmark-star-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5M8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.18.18 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.18.18 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.18.18 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.18.18 0 0 1-.134-.098z"/>
                </svg>
                <div class="property__title">
                    ضمانت سلامت کالا
                    <p>
                        تضمین سلامت و اصالت قطعات
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Properties Section -->

<!-- start special offers nav-->
<div class="container special-offers-nav mt-60">
    <div class="row m-auto">
        <div class="col-sm-12 px-0">
            <p class="offer-section-title">
                <img src="./design/image/icons8-fire-48.png" style="width: 30px;" alt="شگفت انگیز">
                پیشنهاد شگفت انگیز</p>
            <ul class="nav nav-pills mb-3 custom-nav-pills border-bottom" dir="ltr" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">نمایشگر</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">ترانسمیتر</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <div class="container special-offers-sub-nav bg-white">
                        <div class="row mb-5">
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div>
                                </div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">نمایشگر توزین دیجیتال</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>950,000 تومان</s>
                                            <div>740,000</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">نمایشگر توزین دیجیتال</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>390,000 تومان</s>
                                            <div>280,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">نمایشگر توزین دیجیتال</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>390,000 تومان</s>
                                            <div>280,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">

                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">نمایشگر توزین دیجیتال</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>980,000 تومان</s>
                                            <div>760,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">نمایشگر توزین دیجیتال</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>5,750,000 تومان</s>
                                            <div>3,650,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">نمایشگر توزین دیجیتال</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>5,750,000 تومان</s>
                                            <div>3,650,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="container special-offers-sub-nav bg-white">
                        <div class="row mb-4">
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/PM-CT13.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">ترانسمیتر آنالوگ</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>750,000 تومان</s>
                                            <div>420,000</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/PM-CT13.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">ترانسمیتر آنالوگ</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>1,000,000 تومان</s>
                                            <div>650,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/PM-CT13.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">ترانسمیتر آنالوگ</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>1,000,000 تومان</s>
                                            <div>650,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/PM-CT13.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">ترانسمیتر آنالوگ</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>590,000 تومان</s>
                                            <div>350,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/PM-CT13.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">ترانسمیتر آنالوگ</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>5,150,000 تومان</s>
                                            <div>3,850,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 position-relative special-offers-border">
                                <div class="position-absolute offer-expire "><div class="badge bg-warning p-3 offer-expire-text-inner"></div></div>
                                <div class="d-flex justify-content-between offer-blur">
                                    <div class="img-sub-nav">
                                        <img class="first-img img-fluid" loading="lazy" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" loading="lazy" src="design/image/PM-CT13.jpg" alt="">
                                    </div>
                                    <div class="title-sub-nav">
                                        <a href="#">ترانسمیتر آنالوگ</a>
                                        <div class="star mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="offer-price mt-2">
                                            <s>1,000,000 تومان</s>
                                            <div>650,000 تومان</div>
                                        </div>
                                        <div class="count-down-timer mt-2">
                                            <p class="pt-1">فرصت باقی مانده تا پایان این پیشنهاد</p>
                                            <p  class="position-relative demos" dir="ltr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end special offers nav-->

<!--start The latest owl products offers nav -->
<div class="container position-relative mt-60">
    <div class="row">
        <div class="col-12">
            {{-- بخش جدیدترین ها --}}
            <section class="container owl-products owl-3 position-relative mt-5">
                <div class="row m-auto">
                    <div class="col-sm-12 p-0 shadow-sm">
                        <div class="bg-header-owl">
                            <img class="d-none d-md-block mt-5 mx-auto" src="{{ asset('design/image/favicon-3.png') }}" width="80" height="80" alt="جدیدترین ها" style="object-fit: contain;">
                            <h2 class="title-header-owl pt-2 px-1 m-0 text-dark">جدیدترین ها</h2>
                        </div>

                        <div class="owl-carousel newest-products-carousel product-card">
                            @foreach($newest_products as $product)

                                    @include('front.components.product-card-home', ['product' => $product])

                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <div class="custom-owl-controls text-center my-4 position-absolute owl-3">
                <button class="btn btn-outline-dark mx-2 custom-prev">
                    <svg width="22" height="22" fill="#fff" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                    </svg>
                </button>
                <button class="btn btn-outline-dark mx-2 custom-next">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end The latest owl products offers nav -->

<!-- start cat nav -->
<section class="container mt-60 offer-section" id="offerSectionDown">
    <p class="offer-section-title">
        <img src="./design/image/enlargement.png" style="width: 30px;" alt="محصولات">
        محصولات</p>
    <div class="row m-auto my-5">
        <div class="col-12 col-md-3 product-card">
            <div class="pro position-relative">
                <div class="product-overlay">
                    <button class="btnSvg">
                        <svg width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
                        </svg>
                    </button>
                    <div class="my-2">
                       <a href="" class="wishlist-btn">
                          <i class="bi bi-heart" style="font-size:20px"></i>
                       </a>
                    </div>
                </div>

                <a href="" class="text-decoration-none">

                    <div class="top">
                        <img src="design/image/PM-AD40.png" loading="lazy" alt="PM-AD40">
                    </div>
                    <div class="product-name">
                        <span class="text-dark">P/N : 293D476X0035E2TE3</span>
                    </div>
                    <div class="down">
                        <p class="card-text text-muted mb-1" dir="ltr">
                            Tantalum Capacitors - Solid SMD 47uF 35volts 20% E Case Mold...
                        </p>

                        <div class="final-price-div mb-2">
                        <span class="fw-bold text-dark">104,080 تومان</span>
                        </div>

                        <div class="box">
                            <div class="text-danger Quantity-stock">
                                موجودی: 22 عدد
                            </div>
                            <button class="btnSvg">
                                <svg width="24" height="24" fill="green" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"></path>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-3 product-card">
            <div class="pro position-relative">
                <div class="product-overlay">
                    <button class="btnSvg">
                        <svg width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
                        </svg>
                    </button>
                    <div class="my-2">
                        <a href="" class="wishlist-btn">
                           <i class="bi bi-heart" style="font-size:20px"></i>
                        </a>
                    </div>
                </div>

                <a href="" class="text-decoration-none">

                    <div class="top">
                        <img src="design/image/PM-AD40.png" loading="lazy" alt="PM-AD40">
                    </div>
                    <div class="product-name">
                        <span class="text-dark">P/N : 293D476X0035E2TE3</span>
                    </div>
                    <div class="down">
                        <p class="card-text text-muted mb-1" dir="ltr">
                            Tantalum Capacitors - Solid SMD 47uF 35volts 20% E Case Mold...
                        </p>

                        <div class="final-price-div mb-2">
                        <span class="fw-bold text-dark">104,080 تومان</span>
                        </div>

                        <div class="box">
                            <div class="text-danger Quantity-stock">
                                موجودی: 22 عدد
                            </div>
                            <button class="btnSvg">
                                <svg width="24" height="24" fill="green" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"></path>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-3 product-card">
            <div class="pro position-relative">
                <div class="product-overlay">
                    <button class="btnSvg">
                        <svg width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
                        </svg>
                    </button>
                    <div class="my-2">
                       <a href="" class="wishlist-btn">
                        <i class="bi bi-heart" style="font-size:20px"></i>
                       </a>
                    </div>
                </div>

                <a href="" class="text-decoration-none">

                    <div class="top">
                        <img src="design/image/PM-AD40.png" loading="lazy" alt="PM-AD40">
                    </div>
                    <div class="product-name">
                        <span class="text-dark">P/N : 293D476X0035E2TE3</span>
                    </div>
                    <div class="down">
                        <p class="card-text text-muted mb-1" dir="ltr">
                            Tantalum Capacitors - Solid SMD 47uF 35volts 20% E Case Mold...
                        </p>

                        <div class="final-price-div mb-2">
                        <span class="fw-bold text-dark">104,080 تومان</span>
                        </div>

                        <div class="box">
                            <div class="text-danger Quantity-stock">
                                موجودی: 22 عدد
                            </div>
                            <button class="btnSvg">
                                <svg width="24" height="24" fill="green" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"></path>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-3 product-card">
            <div class="pro position-relative">
                <div class="product-overlay">
                    <button class="btnSvg">
                        <svg width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
                        </svg>
                    </button>
                    <div class="my-2">
                       <a href="" class="wishlist-btn">
                         <i class="bi bi-heart" style="font-size:20px"></i>
                       </a>
                    </div>
                </div>

                <a href="" class="text-decoration-none">

                    <div class="top">
                        <img src="design/image/PM-AD40.png" loading="lazy" alt="PM-AD40">
                    </div>
                    <div class="product-name">
                        <span class="text-dark">P/N : 293D476X0035E2TE3</span>
                    </div>
                    <div class="down">
                        <p class="card-text text-muted mb-1" dir="ltr">
                            Tantalum Capacitors - Solid SMD 47uF 35volts 20% E Case Mold...
                        </p>

                        <div class="final-price-div mb-2">
                        <span class="fw-bold text-dark">104,080 تومان</span>
                        </div>

                        <div class="box">
                            <div class="text-danger Quantity-stock">
                                موجودی: 22 عدد
                            </div>
                            <button class="btnSvg">
                                <svg width="24" height="24" fill="green" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"></path>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end cat nav -->

<!-- start brands slider -->
<section class="container my-5 brands-slider-section">
    <div class="row m-auto">
        <div class="col-12">
            <div class="brands-slider-wrapper">
                <div class="owl-carousel owl-theme w-100">
                    <div class="item">
                        <img src="design/image/barnds/b70276b18114f7f272e4452b40e15a35.png" class="img-fluid" loading="lazy" alt="Brand 1">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/coilcraft-logo-png_seeklogo-221886-removebg-preview.png" class="img-fluid" loading="lazy" alt="Brand 2">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/KEMET_Corporation_wordmark_(whitespace).svg.png" class="img-fluid" loading="lazy" alt="Brand 3">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/Logo_Analog_Devices.svg.png" class="img-fluid" loading="lazy" alt="Brand 4">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/logo_texasinstruments-1024x512.png" class="img-fluid" loading="lazy" alt="Brand 5">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/MACOM_logo.svg.png" class="img-fluid" loading="lazy" alt="Brand 6">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/mouser-reg-logo-trim.webp" class="img-fluid" loading="lazy" alt="Brand 7">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/RFPD_logo.webp" class="img-fluid" loading="lazy" alt="Brand 8">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/wurth_electronics_midcom_logo.jpg" class="img-fluid" loading="lazy" alt="Brand 9">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/Xilinx.svg.png" class="img-fluid" loading="lazy" alt="Brand 10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end brands slider -->

@endsection

@section('script')

@endsection

