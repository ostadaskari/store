@extends('front.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('design/css/zoomy.css') }}">
    <link rel="stylesheet" href="{{ asset('design/css/style.css') }}">
@endsection


@section('content')
    <!-- start product details -->
    <!-- ============================
           BREADCRUMB
    ============================= -->
    <div class="container mb-2 mt-4 topPadd">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-product-single">

                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">خانه</a>
                        </li>

                        @foreach ($breadcrumbs as $cat)
                            <li class="breadcrumb-item">
                                <a href="{{ route('category.show', $cat->slug) }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach

                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $product->title ?? $product->part_number }}
                        </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- ============================
           PRODUCT DETAILS
    ============================= -->

    <div class="container px-0 border-bottom">
        <div class="row">

            <!-- ACTION COLUMN -->
            <div class="col-12 col-md-1 action-column">
                <div class="actionDiv">

                    <div class="action-item" title="لایک" id="like-button">
                        <i class="bi bi-heart m-0" style="font-size: 24px;"></i>
                    </div>

                    <div class="action-item share-btn" title="اشتراک‌گذاری">
                        <i class="bi bi-share m-0"></i>
                    </div>

                    <div class="share-modal">
                        <div class="share-modal-content">
                            <span class="share-close">&times;</span>
                            <p class="share-title">لینک این صفحه:</p>
                            <input type="text" class="share-link" readonly value="{{ url()->current() }}">
                            <button class="share-copy-btn">کپی لینک</button>
                            <span class="share-copy-msg">کپی شد ✅</span>
                        </div>
                    </div>

                    <div class="action-item notify-btn" title="اطلاع‌رسانی موجودی">
                        <i class="bi bi-bell m-0"></i>
                    </div>

                    <div class="notify-modal">
                        <div class="notify-modal-content">
                            <span class="notify-close">&times;</span>
                            <p class="notify-title">اگر کالا موجود شد چطور به شما اطلاع دهیم؟</p>
                            <input type="text" class="notify-input"
                                   placeholder="شماره موبایل خود را وارد کنید" pattern="09\d{9}" maxlength="11" />
                            <button class="notify-submit-btn">ثبت</button>
                            <span class="notify-confirm-msg">شماره شما ثبت شد ✅</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- PRODUCT IMAGE -->
            {{-- 2. IMAGE GALLERY --}}
            {{-- Note: We only need the primary div for the zoomy plugin to attach to --}}
            <div class="col-sm-12 col-md-3 d-flex align-items-center flex-column justify-content-between p-4" id="el">
                {{-- The JS will inject the images here. Using the cover image as a fallback. --}}
                <img class="img-fluid custom-img-fluid"
                     src="{{ $product->coverImage->url ?? asset('images/300x300.webp') }}"
                     alt="{{ $product->company_cmt }}">
            </div>

            <!-- PRODUCT FEATURES -->
            <div class="col-sm-12 col-md-4 d-flex flex-column mt-3 mt-md-0 p-4">

                <p class="partNumber">{{ $product->part_number }}</p>

                <p class="title-mylist-product-single">ویژگی‌ها</p>
                <ul class="mylist-product-single" dir="ltr">
                    <li>Manufacturer: {{ $product->mfg ?? '' }}</li>
                    @forelse ($product->featureValues as $fv)

                        @php
                            $data = $fv->value;                     // decoded JSON (handled in model)
                            $feature = $fv->feature;                // relation to features table
                            $name = $feature->name ?? '---';        // feature name

                            $output = '';

                            if (isset($data['value']) && isset($data['unit'])) {
                                // value + unit
                                $output = $data['value'] . ' ' . $data['unit'];
                            }
                            elseif (isset($data['value'])) {
                                // simple or boolean
                                $output = is_bool($data['value'])
                                    ? ($data['value'] ? 'Yes' : 'No')
                                    : $data['value'];
                            }
                            elseif (isset($data['values'])) {
                                // multi-select
                                $output = implode(', ', $data['values']);
                            }
                            elseif (isset($data['min']) || isset($data['max'])) {
                                // range
                                $output = ($data['min'] ?? '') . ' - ' . ($data['max'] ?? '');
                                $output .= isset($data['unit']) ? ' ' . $data['unit'] : '';
                            }
                            else {
                                // fallback
                                $output = json_encode($data);
                            }
                        @endphp

                        <li>
                            <strong>{{ $name }}:</strong>
                            <span>{{ $output }}</span>
                        </li>

                    @empty

                        <li>ویژگی ثبت نشده</li>

                    @endforelse

                </ul>

                @if ($product->pdfs->count() > 0)
                    <div class="dataSheet">

                        <i class="bi bi-filetype-pdf" style="color:red;"></i>

                        <div class="px-2">

                            @foreach ($product->pdfs as $pdf)
                                <p class="my-1">
                                    <a href="{{ asset($pdf->url) }}" download>
                                        دانلود دیتاشیت
                                        ({{ $pdf->file_name }})
                                    </a>
                                </p>
                            @endforeach

                        </div>

                    </div>
                @endif


            </div>

            <!-- RIGHT COLUMN (PRICE + INFO) -->
            <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-between flex-column mt-5 mt-md-0 bg-leftSideSingle p-3">

                <div class="d-flex align-items-center w-100">
                    <i class="bi bi-shop-window" style="font-size:24px;"></i>
                    <h1 class="h1-product-single m-0">{{ $product->title }}</h1>
                </div>

                <div class="score-product-single d-flex border-bottom w-100">
                    <p class="border-left"><span>90%</span> رضایت از کالا</p>
                    <p>عملکرد <span>بسیار خوب</span></p>
                </div>

                <div class="guarantee d-flex align-items-center border-bottom p-1 w-100">
                    <i class="bi bi-award-fill text-warning" style="font-size:24px;"></i>
                    <h1 class="m-0">گارانتی اصالت و سلامت فیزیکی</h1>
                </div>

                <div class="title-sub-nav-product-single d-flex flex-row align-items-center border-bottom w-100">
                    <svg width="20" height="20" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                        </svg>
                    {{ $product->available_qty ? 'موجودی :  '.$product->available_qty.' عدد' : 'ناموجود' }}
                </div>

                <!-- PRICE -->
                    <div class="offer-price-product-single d-flex flex-column mt-2 w-100">

                    @php $display = $product->display_price_toman; @endphp

                        @if($display)
                            <p class="m-0">{{ number_format($product->display_price_toman) }} تومان</p>
                        @else
                            <span class="text-muted">قیمت ثبت نشده</span>
                        @endif

                    </div>


                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf

                    <div class="qty-wrapper">
                        <input type="number" name="qty" min="1" max="{{ $product->available_qty }}" value="1" autocomplete="off">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        افزودن به سبد
                    </button>
                </form>


            </div>

        </div>
    </div>
    <!-- end product details -->

    <!-- Suggest related products -->
    <div class="container mt-60">
        <div class="row">
            <div class="col-12">
                <p class="offer-section-title">کالا های مشابه</p>
            </div>
        </div>
        @if($relatedProducts->count() > 0)
            <div class="row mt-5">

                @foreach($relatedProducts as $item)
                    <div class="col-6 col-md-3 product-card">
                        <div class="pro">
                            <div class="top">
                                <img src="{{$product->coverImage->url ?? asset('images/300x300.webp') }}" alt="{{ $item->company_cmt }}">
                            </div>

                            <div class="product-name">
                                <span>{{ $item->company_cmt}}</span>
                            </div>

                            <div class="down">

                                @if($item->display_price_toman)
                                    <div class="final-price-div">
                                        <div class="mx-1 number-format">
                                            {{ number_format($item->display_price_toman) }}
                                        </div>
                                        <div>تومان</div>
                                    </div>
                                @endif

                                <div class="box">
                                    @if($item->available_qty > 0)
                                        <div class="text-success">
                                            <span class="Quantity-stock">موجود در انبار</span>
                                        </div>
                                    @else
                                        <div class="text-danger">
                                            <span class="Quantity-stock">ناموجود</span>
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        @endif

    </div>
    <!-- End Suggest other products -->

    <!-- start shipping -->
    <div class="container mt-md-5 border-custom">
        <div class="row pt-3">
            <div class="col-sm-4 d-flex justify-content-center">
                <div class="shipping d-flex p-2">
                    <a href="#"><img class="img-fluid pt-2" src="{{ asset('design/image/shipping00.png') }}"></a>
                    <p class="pl-2 pt-2">ارسال  به سراسر کشور</p>
                </div>
            </div>
            <div class="col-sm-4 d-flex justify-content-center">
                <div class="shipping d-flex p-2">
                    <a href="#"><img class="img-fluid pt-2" src="{{ asset('design/image/shipping000.png') }}"></a>
                    <p class="pl-2 pt-2">ارسال سریع با پیک</p>
                </div>
            </div>
            <div class="col-sm-4 d-flex justify-content-center">
                <div class="shipping d-flex p-2">
                    <a href="#"><img class="img-fluid pt-2" src="{{ asset('design/image/shipping00000.png') }}"></a>
                    <p class="pl-2 pt-2">ارسال امن و مطمئن</p>
                </div>
            </div>

        </div>
    </div>
    <!-- end shipping -->

    <!-- start navbar product details -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item nav-product">
                        <a class="nav-link active d-flex" id="Review-tab" data-bs-toggle="tab" href="#Review" role="tab" aria-controls="Review" aria-selected="true">
                            <svg class="mx-2" width="16" height="16" fill="#0099ff" viewBox="0 0 16 16">
                                <path d="M14 4.5V9h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v7H2V2a2 2 0 0 1 2-2h5.5zM13 12h1v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2h1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1z"/>
                            </svg>
                            نقد و بررسی
                        </a>
                    </li>
                    <li class="nav-item nav-product">
                        <a class="nav-link d-flex" id="Specifications-tab" data-bs-toggle="tab" href="#Specifications" role="tab" aria-controls="Specifications" aria-selected="false">
                            <svg class="mx-2" width="20" height="20" fill="#0099ff" viewBox="0 0 16 16">
                                <path d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm5 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1z"/>
                                <path d="M3.524 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562q-.165.31-.164.692 0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282q.036-.305.123-.498a1.4 1.4 0 0 1 .252-.37 2 2 0 0 1 .346-.298zm2.168 0q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562q-.165.31-.164.692 0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282a1.8 1.8 0 0 1 .118-.492q.087-.194.257-.375a2 2 0 0 1 .346-.3z"/>
                            </svg>
                            مشخصات
                        </a>
                    </li>
                    <li class="nav-item nav-product">
                        <a class="nav-link d-flex" id="opinions-tab" data-bs-toggle="tab" href="#opinions" role="tab" aria-controls="opinions" aria-selected="false">
                            <svg class="mx-2" width="16" height="16" fill="#0099ff" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1z"/>
                                <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                            </svg>
                            نظرات
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <!-- Review -->
                    <div class="tab-pane fade show active" id="Review" role="tabpanel" aria-labelledby="Review-tab">
                        <div class="container p-2 bg-aliceblue">
                            <div class="border-0 p-5">
                                <div class="card-body">
                                    <h2 class="card-title mb-4">بررسی و نقدی هنوز صورت نگرفته است..</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Review -->

                    <!-- Specifications -->
                    <div class="tab-pane fade" id="Specifications" role="tabpanel" aria-labelledby="Specifications-tab">
                        <div class="container bg-aliceblue">
                            <div class="row p-3">

                                <p class="title-mylist-product-single">ویژگی‌ها</p>
                                <ul class="mylist-product-single" dir="ltr">

                                    @forelse ($product->featureValues as $fv)

                                        @php
                                            $data = $fv->value;                     // decoded JSON (handled in model)
                                            $feature = $fv->feature;                // relation to features table
                                            $name = $feature->name ?? '---';        // feature name

                                            $output = '';

                                            if (isset($data['value']) && isset($data['unit'])) {
                                                // value + unit
                                                $output = $data['value'] . ' ' . $data['unit'];
                                            }
                                            elseif (isset($data['value'])) {
                                                // simple or boolean
                                                $output = is_bool($data['value'])
                                                    ? ($data['value'] ? 'Yes' : 'No')
                                                    : $data['value'];
                                            }
                                            elseif (isset($data['values'])) {
                                                // multi-select
                                                $output = implode(', ', $data['values']);
                                            }
                                            elseif (isset($data['min']) || isset($data['max'])) {
                                                // range
                                                $output = ($data['min'] ?? '') . ' - ' . ($data['max'] ?? '');
                                                $output .= isset($data['unit']) ? ' ' . $data['unit'] : '';
                                            }
                                            else {
                                                // fallback
                                                $output = json_encode($data);
                                            }
                                        @endphp

                                        <li>
                                            <strong>{{ $name }}:</strong>
                                            <span>{{ $output }}</span>
                                        </li>

                                    @empty

                                        <li>ویژگی ثبت نشده</li>

                                    @endforelse

                                </ul>

                            </div>
                        </div>
                    </div>
                    <!-- end Specifications -->

                    <!-- User-opinion -->
                    <div class="tab-pane fade" id="opinions" role="tabpanel" aria-labelledby="opinions-tab">
                        <div class="container px-4 py-2" style="background-color: #ffffff;">
                            <div class="row">
                                <div class="col-12">
                                    <section class="container px-0">
                                        <div class="">
                                            <div class="img-send-messege border-bottom">
                                                <img class="img-fluid" src="./design/image/review.svg" alt="">
                                            </div>
                                            <div class="card-body my-4">
                                                <form>
                                                    <div class="d-flex flex-row">
                                                        <div class="m-3 w-50">
                                                            <label for="name" class="form-label">نام و نام خانوادگی :<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="name" placeholder="نام خود را وارد کنید">
                                                        </div>
                                                        <div class="m-3 w-50">
                                                            <label for="email" class="form-label">ایمیل :<span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control input-ltr" id="email" placeholder="ایمیل خود را وارد کنید" required>
                                                        </div>
                                                    </div>
                                                    <div class="m-3">
                                                        <label for="content" class="form-label">محتوا :<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="content" rows="5" placeholder="پیام خود را بنویسید..." required></textarea>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-success px-4">ارسال پیام</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <h1 class="title-User-opinion">امتیاز و دیدگاه کاربران</h1>
                                <div class="bar mb-3 mb-md-4"></div>

                                <div class="col-12 d-flex flex-column">
                        <span class="Score-User-opinion d-flex p-2">
                          <h5>4.5</h5>
                          <p>از 5</p>
                        </span>
                                    <div class="d-flex pb-2">
                                        <div class="star-User-opinion mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <p>از مجموع 2 امتیاز</p>
                                    </div>
                                    <p class="text-User-opinion">شما هم درباره این کالا دیدگاه ثبت کنید.</p>
                                    <button type="button" class="btn border border-text-color w-25">ثبت دیدگاه</button>
                                    <div class="d-flex">
                        <span class="material-symbols-outlined pt-3 pr-2 pl-0 text-User-opinion">
                          adjust
                          </span>
                                        <p class="text-User-opinion pt-3">5 امتیاز PK کلاب</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end User-opinion -->
                </div>
            </div>
        </div>
    </div>
    <!-- end navbar product details -->
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('design/js/zoomy.js') }}"></script>

    <script src="https://unpkg.com/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // 1. DYNAMIC IMAGE URLS FOR ZOOMY
            var urls = [

                    @foreach($product->images as $image)
                    '{{ asset( $image->url) }}',
                @endforeach
            ];

            var options = {
                // thumbLeft:true,
                // thumbRight:true,
                // thumbHide:true,
                // width:300,
                // height:500,
            };

            // Only initialize zoomy if there are images
            if (urls.length > 0) {
                $('#el').zoomy(urls, options);
            } else {
                // Fallback if no images are found
                $('#el').html('<p class="text-muted">تصویری موجود نیست.</p>');
            }


            // 2. ACTION COLUMN LOGIC (UNCHANGED)
            // heart click
            const likeBtn = document.getElementById("like-button");
            const icon = likeBtn.querySelector("i");

            likeBtn.addEventListener("click", function () {
                icon.classList.toggle("bi-heart");
                icon.classList.toggle("bi-heart-fill");
                icon.style.color = icon.classList.contains("bi-heart-fill") ? "red" : "inherit";
                // TODO: Add AJAX call here to save to favorites
            });

            // ... (You would keep your existing share and notify modal JavaScript here) ...

        });
        // heart click
        // share link
        document.addEventListener("DOMContentLoaded", function () {
            const shareBtn = document.querySelector(".share-btn");
            const modal = document.querySelector(".share-modal");
            const closeBtn = document.querySelector(".share-close");
            const linkInput = document.querySelector(".share-link");
            const copyBtn = document.querySelector(".share-copy-btn");
            const copyMsg = document.querySelector(".share-copy-msg");

            shareBtn.addEventListener("click", () => {
                linkInput.value = window.location.href;
                modal.style.display = "flex";
                copyMsg.style.display = "none";
            });

            closeBtn.addEventListener("click", () => {
                modal.style.display = "none";
            });

            copyBtn.addEventListener("click", () => {
                linkInput.select();
                document.execCommand("copy");
                copyMsg.style.display = "block";
            });

            window.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
        // end share link
        // notify
        document.addEventListener("DOMContentLoaded", function () {
            const notifyBtn = document.querySelector(".notify-btn");
            const notifyModal = document.querySelector(".notify-modal");
            const notifyClose = document.querySelector(".notify-close");
            const notifyInput = document.querySelector(".notify-input");
            const notifySubmitBtn = document.querySelector(".notify-submit-btn");
            const notifyConfirmMsg = document.querySelector(".notify-confirm-msg");

            notifyBtn.addEventListener("click", () => {
                notifyInput.value = "";
                notifyConfirmMsg.style.display = "none";
                notifyModal.style.display = "flex";
            });

            notifyClose.addEventListener("click", () => {
                notifyModal.style.display = "none";
            });

            notifySubmitBtn.addEventListener("click", () => {
                const mobile = notifyInput.value.trim();
                if (/^09\d{9}$/.test(mobile)) {
                    notifyConfirmMsg.textContent = "شماره شما با موفقیت ثبت شد ✅";
                    notifyConfirmMsg.style.color = "green";
                    notifyConfirmMsg.style.display = "block";
                } else {
                    notifyConfirmMsg.textContent = "شماره موبایل معتبر نیست!";
                    notifyConfirmMsg.style.color = "red";
                    notifyConfirmMsg.style.display = "block";
                }
            });

            window.addEventListener("click", (e) => {
                if (e.target === notifyModal) {
                    notifyModal.style.display = "none";
                }
            });
        });
        // end notify

        // ###### end action-column ######

    </script>

@endsection
