@extends('front.layouts.app')
@section('style')

@endsection
@section('content')


    <!-- start banner -->
    <div id="bannerCarousel" class="container carousel slide m-auto px-3" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            @foreach ($banners as $index => $banner)
                <a class="carousel-item {{ $index === 0 ? 'active' : '' }}" href="#">
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

<!-- start baner1 section -->
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
                            <img class="d-none d-md-block mt-5" src="./design/image/favicon.png" width="80" height="80" alt="شگفت انگیز" title="" style="object-fit: contain;">
                            <h2 class="title-header-owl pt-2 px-1 m-0">تخفیف روز</h2>
                        </div>
                        <div class="owl-carousel product-card">

                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">120,000,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                                <div class="triangle-badge">
                                    <span class="sale">تخفیف</span>
                                </div>
                                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="box">
                                        <div class="orginal">985,000 تومان</div>
                                        <div class="off">34%</div>
                                    </div>
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>

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
            <section class="container owl-products owl-2">
                <div class="row m-auto">
                    <div class="col-sm-12 p-0 position-relative" style="background-color:rgb(255, 179, 1);">
                        <div class="bg-header-owl">
                            <img class="d-none d-md-block mt-5" src="./design/image/favicon.png" width="80" height="80" alt="شگفت انگیز" title="" style="object-fit: contain;">
                            <h2 class="title-header-owl pt-2 px-1 m-0">پرفروش ترین ها</h2>
                        </div>
                        <div class="owl-carousel product-card">
                            <div class="pro">
                    <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
                            <div class="pro">
                      <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>

                                </div>
                            </div>
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
        <div class="col-md-3 col-12">
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
        <div class="col-md-3 col-12">
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
        <div class="col-md-3 col-12">
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
        <div class="col-md-3 col-12">
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
                                        <img class="first-img img-fluid" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">

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
                                        <img class="first-img img-fluid" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/2018_95112.jpg" alt="">
                                        <img class="second-img img-fluid" src="design/image/ماژول-نمایشگر-وزن-سنسور-hx711-3.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" src="design/image/PM-CT13.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" src="design/image/PM-CT13.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" src="design/image/PM-CT13.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" src="design/image/PM-CT13.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" src="design/image/PM-CT13.jpg" alt="">
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
                                        <img class="first-img img-fluid" src="design/image/PM-AD40.png" alt="">
                                        <img class="second-img img-fluid" src="design/image/PM-CT13.jpg" alt="">
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
            <section class="container owl-products owl-3 position-relative">
                <div class="row m-auto">
                    <div class="col-sm-12 p-0">
                        <div class="bg-header-owl">
                            <img class="d-none d-md-block mt-5" src="./design/image/favicon.png" width="80" height="80" alt="شگفت انگیز" title="" style="object-fit: contain;">
                            <h2 class="title-header-owl pt-2 px-1 m-0">جدیدترین ها</h2>
                        </div>
                        <div class="owl-carousel product-card">
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro">
                        <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="custom-owl-controls text-center my-4 position-absolute owl-3">
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
<!-- end The latest owl products offers nav -->

<!-- start cat nav -->
<section class="container mt-60 offer-section" id="offerSectionDown">
    <p class="offer-section-title">
        <img src="./design/image/enlargement.png" style="width: 30px;" alt="محصولات">
        محصولات</p>
    <div class="row m-auto my-3">
        <div class="col-12 col-md-3 product-card">
            <div class="pro my-0">
                <div class="triangle-badge">
                    <span class="sale">تخفیف</span>
                </div>
                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                <p class="">3.4</p>
                <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
              </span>
                <div class="top">
                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                </div>
                <div class="product-name">
                    ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40
                </div>
                <div class="down">
                    <div class="box">
                        <div class="orginal">985,000 تومان</div>
                        <div class="off">34%</div>
                    </div>
                    <div class="final-price-div">
                        <div class="mx-1">540,000</div>
                        <div>تومان</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 product-card">
            <div class="pro my-0">
                <div class="triangle-badge">
                    <span class="sale">تخفیف</span>
                </div>
                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                <p class="">3.4</p>
                <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
              </span>
                <div class="top">
                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                </div>
                <div class="product-name">
                    ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40
                </div>
                <div class="down">
                    <div class="box">
                        <div class="orginal">985,000 تومان</div>
                        <div class="off">34%</div>
                    </div>
                    <div class="final-price-div">
                        <div class="mx-1">540,000</div>
                        <div>تومان</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 product-card">
            <div class="pro my-0">
                <div class="triangle-badge">
                    <span class="sale">تخفیف</span>
                </div>
                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                <p class="">3.4</p>
                <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
              </span>
                <div class="top">
                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                </div>
                <div class="product-name">
                    ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40
                </div>
                <div class="down">
                    <div class="box">
                        <div class="orginal">985,000 تومان</div>
                        <div class="off">34%</div>
                    </div>
                    <div class="final-price-div">
                        <div class="mx-1">540,000</div>
                        <div>تومان</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 product-card">
            <div class="pro my-0">
                <div class="triangle-badge">
                    <span class="sale">تخفیف</span>
                </div>
                <span class="position-absolute translate-middle badge badge-star d-flex flex-row align-items-center">
                <p class="">3.4</p>
                <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
              </span>
                <div class="top">
                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                </div>
                <div class="product-name">
                    ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40
                </div>
                <div class="down">
                    <div class="box">
                        <div class="orginal">985,000 تومان</div>
                        <div class="off">34%</div>
                    </div>
                    <div class="final-price-div">
                        <div class="mx-1">540,000</div>
                        <div>تومان</div>
                    </div>
                </div>
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
                        <img src="design/image/barnds/b70276b18114f7f272e4452b40e15a35.png" class="img-fluid" alt="Brand 1">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/coilcraft-logo-png_seeklogo-221886-removebg-preview.png" class="img-fluid" alt="Brand 2">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/KEMET_Corporation_wordmark_(whitespace).svg.png" class="img-fluid" alt="Brand 3">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/Logo_Analog_Devices.svg.png" class="img-fluid" alt="Brand 4">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/logo_texasinstruments-1024x512.png" class="img-fluid" alt="Brand 5">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/MACOM_logo.svg.png" class="img-fluid" alt="Brand 6">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/mouser-reg-logo-trim.webp" class="img-fluid" alt="Brand 7">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/RFPD_logo.webp" class="img-fluid" alt="Brand 8">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/wurth_electronics_midcom_logo.jpg" class="img-fluid" alt="Brand 9">
                    </div>
                    <div class="item">
                        <img src="design/image/barnds/Xilinx.svg.png" class="img-fluid" alt="Brand 10">
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

