@extends('front.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('design/css/zoomy.css') }}">
    <link rel="stylesheet" href="{{ asset('design/css/style.css') }}">

    <style>
        .mylist-product-single {
            max-height: 280px;
            overflow-y: auto;
            padding-right: 8px;
        }
        .mylist-product-single::-webkit-scrollbar {
            width: 6px;
        }
        .mylist-product-single::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .mylist-product-single::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        .mylist-product-single::-webkit-scrollbar-thumb:hover {
            background: #999;
        }
    </style>


@endsection

{{-- 🌟 قرار دادن اسکیما به صورت پشته‌ای (Push) تا مستقیم برود داخل هد لایوت اصلی --}}
@section('seo')
    @php
        if (isset($product) && $product->rating_count > 0) {
            $schemaData = [
                "@context" => "https://schema.org/",
                "@type" => "Product",
                "name" => $product->part_number ?? 'Product',
                "aggregateRating" => [
                    "@type" => "AggregateRating",
                    "ratingValue" => $product->rating_avg,
                    "reviewCount" => $product->rating_count
                ]
            ];
            echo '<script type="application/ld+json">' . json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
        }
    @endphp
@endsection

@section('content')
    <!-- start product details -->
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

    <div class="container px-0 border-bottom">
        <div class="row">
            <!-- ACTION COLUMN -->
            <div class="col-12 col-md-1 col-lg-1 action-column px-0">
                <div class="actionDiv">
                    @php
                        $isWishlisted = auth()->check()
                            && auth()->user()
                                ->wishlists()
                                ->where('product_id', $product->id)
                                ->exists();
                    @endphp
                    <div class="action-item" title="لایک">
                        @auth
                            <a href="javascript:void(0)"
                               class="wishlist-btn"
                               data-product="{{ $product->id }}"
                               data-url="{{ route('wishlist.toggle') }}">
                                <i class="bi {{ $isWishlisted ? 'bi-heart-fill text-danger' : 'bi-heart' }}"
                                   style="font-size:24px"></i>
                            </a>
                        @else
                            <a href="{{ url('login') }}">
                                <i class="bi bi-heart" style="font-size:24px"></i>
                            </a>
                        @endauth
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
            <div class="col-12 col-md-6 col-lg-3 d-flex align-items-center flex-column p-3" id="el">
                <img class="img-fluid custom-img-fluid"
                     src="{{ $product->coverImage->url ?? asset('images/300x300.webp') }}"
                     alt="{{ $product->company_cmt }}">
            </div>

            <!-- PRODUCT FEATURES -->
            <div class="col-12 col-md-6 col-lg-4 d-flex flex-column mt-3 mt-md-0 p-3">
                <p class="partNumber">{{ $product->information->title ?? ($product->part_number ?? '') }}</p>
                <p class="title-mylist-product-single">ویژگی‌ها</p>
                <ul class="mylist-product-single" dir="ltr">
                    <li> <strong style="color: sienna">Manufacturer: </strong> {{ $product->mfg ?? '' }}</li>
                    @forelse ($product->featureValues as $fv)
                        @php
                            $data = $fv->value;
                            $feature = $fv->feature;
                            $name = $feature->name ?? '---';
                            $output = '';

                            if (isset($data['value']) && isset($data['unit'])) {
                                $output = $data['value'] . ' ' . $data['unit'];
                            }
                            elseif (isset($data['value'])) {
                                $output = is_bool($data['value'])
                                    ? ($data['value'] ? 'Yes' : 'No')
                                    : $data['value'];
                            }
                            elseif (isset($data['values'])) {
                                $output = implode(', ', $data['values']);
                            }
                            elseif (isset($data['min']) || isset($data['max'])) {
                                $output = ($data['min'] ?? '') . ' - ' . ($data['max'] ?? '');
                                $output .= isset($data['unit']) ? ' ' . $data['unit'] : '';
                            }
                            else {
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
                                    <a href="{{ asset($pdf->url) }}" target="_blank" rel="noopener noreferrer" download>
                                        دانلود دیتاشیت ({{ $pdf->file_name }})
                                    </a>
                                </p>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- RIGHT COLUMN (PRICE + INFO) -->
            <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center justify-content-between flex-column mt-5 mt-md-0 bg-leftSideSingle p-3">
                <div class="d-flex align-items-center w-100">
                    <i class="bi bi-shop-window" style="font-size:24px;"></i>
                    <h1 class="h1-product-single m-0">{{ $product->title }}</h1>
                </div>

                <div class="score-product-single d-flex border-bottom w-100">
                    <p class="border-left my-0"><span>90%</span> رضایت از کالا</p>
                    <p class="my-0">عملکرد <span>بسیار خوب</span></p>
                </div>

                <div class="guarantee d-flex align-items-center border-bottom p-1 w-100">
                    <i class="bi bi-award-fill text-warning" style="font-size:24px;"></i>
                    <h1 class="m-0">گارانتی اصالت و سلامت فیزیکی</h1>
                </div>

                <div class="title-sub-nav-product-single d-flex flex-row align-items-center jus border-bottom w-100">
                    <svg width="20" height="20" fill="green" class="bi bi-bag-check mx-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>
                    {{ $product->available_qty ? 'موجودی : '.$product->available_qty.' عدد' : 'ناموجود' }}
                </div>

                @php
                    $display = $product->display_price_toman;
                    $priceModel = $product->price;
                    $hasDiscount = $display && $display > 0 && $priceModel && $priceModel->discount_percent > 0;
                @endphp

                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center w-100 my-4">
                    <div class="offer-price-product-single d-flex flex-row justify-content-between w-100 position-relative">
                        @if($hasDiscount)
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="right: -10px; top: 0;">
                                {{ round($priceModel->discount_percent) }}% -
                            </span>
                            @php
                                $oldPrice = $display / (1 - ($priceModel->discount_percent / 100));
                            @endphp
                            <s class="me-2 text-muted">{{ number_format($oldPrice) }} تومان</s>
                        @endif

                        @if($display && $display > 0)
                            <p class="m-0 fw-bold" style="font-size: 1.25rem;">{{ number_format($display) }} تومان</p>
                        @else
                            <span class="text-muted fw-bold">قیمت ثبت نشده</span>
                        @endif
                    </div>
                </div>

                @if($product->available_qty > 0 && $display && $display > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="formAddToCart w-100">
                        @csrf
                        <div class="qty-wrapper" style="display: none;">
                            <input type="number" name="qty" min="1" max="{{ $product->available_qty }}" value="{{ $currentCartQty }}" autocomplete="off" class="product-qty-input-js">
                        </div>

                        <div class="cart-control d-flex justify-content-center align-items-center gap-2 mx-0">
                            <button type="button" class="increase-btn btn btn-sm btn-outline-secondary qty-plus-js">+</button>
                            <span class="quantity fs-6 fw-bold qty-display-js">{{ $currentCartQty }}</span>
                            <button type="button" class="decrease-btn btn btn-sm btn-outline-secondary qty-minus-js">
                                <svg width="16" height="16" fill="currentColor" class="bi bi-dash icon-minus-js" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                                <svg width="16" height="16" fill="rgb(206, 33, 33)" class="bi bi-trash icon-trash-js" style="display:none;" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                                </svg>
                            </button>
                        </div>

                        <button type="submit" class="addToCart-js addtocartProduct">
                            <svg width="22" height="22" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1z"/>
                            </svg>
                            افزودن به سبد خرید
                        </button>
                    </form>
                @else
                    <div class="alert alert-secondary text-center w-100 my-3" role="alert">
                        @if(!$display || $display <= 0)
                            <i class="bi bi-exclamation-circle me-1"></i> امکان سفارش این محصول به علت عدم ثبت قیمت وجود ندارد.
                        @else
                            <i class="bi bi-slash-circle me-1"></i> این محصول در حال حاضر ناموجود است.
                        @endif
                    </div>
                @endif
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
            <div class="row mt-2">
                @foreach($relatedProducts as $relatedProduct)
                    @include('front.components.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        @endif
    </div>

    <!-- start shipping -->
    <div class="container mt-md-5 border-custom">
        <div class="row pt-3">
            <div class="col-sm-4 d-flex justify-content-center">
                <div class="shipping d-flex p-2">
                    <a href="#"><img class="img-fluid pt-2" alt="ارسال به سراسر کشور" src="{{ asset('design/image/shipping00.png') }}"></a>
                    <p class="pl-2 pt-2">ارسال به سراسر کشور</p>
                </div>
            </div>
            <div class="col-sm-4 d-flex justify-content-center">
                <div class="shipping d-flex p-2">
                    <a href="#"><img class="img-fluid pt-2" alt="ارسال سریع" src="{{ asset('design/image/shipping000.png') }}"></a>
                    <p class="pl-2 pt-2">ارسال سریع با پیک</p>
                </div>
            </div>
            <div class="col-sm-4 d-flex justify-content-center">
                <div class="shipping d-flex p-2">
                    <a href="#"><img class="img-fluid pt-2" alt="ارسال امن" src="{{ asset('design/image/shipping00000.png') }}"></a>
                    <p class="pl-2 pt-2">ارسال امن و مطمئن</p>
                </div>
            </div>
        </div>
    </div>

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
                            توضیحات
                        </a>
                    </li>
                    <li class="nav-item nav-product">
                        <a class="nav-link d-flex" id="Specifications-tab" data-bs-toggle="tab" href="#Specifications" role="tab" aria-controls="Specifications" aria-selected="false">
                            <svg class="mx-2" width="20" height="20" fill="#0099ff" viewBox="0 0 16 16">
                                <path d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm5 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1z"/>
                            </svg>
                            مشخصات
                        </a>
                    </li>
                    <li class="nav-item nav-product">
                        <a class="nav-link d-flex" id="opinions-tab" data-bs-toggle="tab" href="#opinions" role="tab" aria-controls="opinions" aria-selected="false">
                            <svg class="mx-2" width="16" height="16" fill="#0099ff" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1z"/>
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
                                    @if(!empty($product->information->description))
                                        <p>{!! $product->information->description !!}</p>
                                    @else
                                        <p class="card-title mb-4">بررسی و نقدی هنوز صورت نگرفته است..</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="tab-pane fade" id="Specifications" role="tabpanel" aria-labelledby="Specifications-tab">
                        <div class="container bg-aliceblue">
                            <div class="row p-3">
                                <p class="title-mylist-product-single">ویژگی‌ها</p>
                                <ul class="mylist-product-single" dir="ltr">
                                    @forelse ($product->featureValues as $fv)
                                        @php
                                            $data = $fv->value;
                                            $feature = $fv->feature;
                                            $name = $feature->name ?? '---';
                                            $output = '';

                                            if (isset($data['value']) && isset($data['unit'])) {
                                                $output = $data['value'] . ' ' . $data['unit'];
                                            }
                                            elseif (isset($data['value'])) {
                                                $output = is_bool($data['value'])
                                                    ? ($data['value'] ? 'Yes' : 'No')
                                                    : $data['value'];
                                            }
                                            elseif (isset($data['values'])) {
                                                $output = implode(', ', $data['values']);
                                            }
                                            elseif (isset($data['min']) || isset($data['max'])) {
                                                $output = ($data['min'] ?? '') . ' - ' . ($data['max'] ?? '');
                                                $output .= isset($data['unit']) ? ' ' . $data['unit'] : '';
                                            }
                                            else {
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

                    <!-- User-opinion -->
                    <div class="tab-pane fade" id="opinions" role="tabpanel" aria-labelledby="opinions-tab">
                        <div class="container px-4 py-3" style="background-color: #ffffff;">
                            <div class="row">
                                <!-- بخش خلاصه امتیاز و آمار محصول -->
                                <div class="col-12 mb-4 pb-3 border-bottom">
                                    <h2 class="title-User-opinion h5 fw-bold">امتیاز و دیدگاه کاربران</h2>
                                    <div class="bar mb-3"></div>

                                    <div class="d-flex flex-column">
                    <span class="Score-User-opinion d-flex align-items-baseline mb-1">
                        <h4 class="mb-0 ms-1 fw-bold">{{ number_format($product->rating_avg, 1) }}</h4>
                        <p class="mb-0 text-muted small">از 5</p>
                    </span>

                                        <div class="d-flex pb-2 align-items-center">
                                            <div class="star-User-opinion" style="color: #ffc107;">
                                                @php $avg = $product->rating_avg; @endphp
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= floor($avg))
                                                        <i class="fa-solid fa-star"></i>
                                                    @elseif(($i - $avg) < 1 && ($i - $avg) > 0)
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    @else
                                                        <i class="fa-regular fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="mb-0 me-2 small text-muted">از مجموع {{ $product->rating_count }} امتیاز</p>
                                        </div>

                                        <p class="text-User-opinion small text-muted mb-2">شما هم درباره این کالا امتیاز یا دیدگاه ثبت کنید.</p>
                                    </div>
                                </div>

                                <!-- بخش فرم ثبت دیدگاه و انتخاب ستاره (آزاد برای همه) -->
                                <div class="col-12 mb-4">
                                    <div class="card border-0 bg-light p-3 p-md-4 rounded-3">
                                        <h5 class="mb-3 fw-bold">امتیاز و دیدگاه شما</h5>

                                        <form id="reviewForm" action="{{ route('product.review.store', $product->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label d-block fw-bold">امتیاز شما به این محصول: <span class="text-danger">*</span></label>
                                                <div class="star-rating-input d-inline-flex gap-1" style="font-size: 1.8rem; cursor: pointer; color: #ffc107;">
                                                    <i class="fa-solid fa-star star-select" data-value="1"></i>
                                                    <i class="fa-solid fa-star star-select" data-value="2"></i>
                                                    <i class="fa-solid fa-star star-select" data-value="3"></i>
                                                    <i class="fa-solid fa-star star-select" data-value="4"></i>
                                                    <i class="fa-solid fa-star star-select" data-value="5"></i>
                                                </div>
                                                <input type="hidden" name="rating" id="ratingValue" value="5">
                                                <small class="text-muted d-block mt-1" id="ratingText">عالی (۵ از ۵)</small>
                                            </div>

                                            <!-- متن دیدگاه (اختیاری) -->
                                            <div class="mb-3">
                                                <label for="reviewComment" class="form-label fw-bold">متن دیدگاه شما: <span class="text-muted small">(اختیاری - اگر خواستید نظر بنویسید)</span></label>
                                                <textarea class="form-control" name="comment" id="reviewComment" rows="4" placeholder="تجربه خود را از خرید و استفاده این قطعه بنویسید..."></textarea>
                                            </div>

                                            <x-captcha key="product_review" />

                                            <button type="submit" id="submitReviewBtn" class="btn btn-success px-4">
                                                ثبت دیدگاه متنی
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- بخش لیست دیدگاه‌های تایید شده (فقط نظرات دارای متن) -->
                                <div class="col-12">
                                    <h5 class="mb-3 fw-bold">دیدگاه‌های کاربران ({{ $approvedReviews->count() }})</h5>
                                    @forelse($approvedReviews as $review)
                                        <div class="review-item p-3 mb-3 border rounded-3 bg-white shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="user-info d-flex align-items-center">
                                                    <i class="bi bi-person-circle ms-2 text-secondary fs-5"></i>
                                                    <strong>{{ $review->user->full_name ?? $review->user->name ?? 'کاربر مهمان' }}</strong>
                                                </div>
                                                <small class="text-muted">{{ jdate($review->created_at)->format('%d %B %Y') }}</small>
                                            </div>

                                            <div class="star-rating text-warning mb-2" style="font-size: 0.9rem;">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="fa-solid fa-star"></i>
                                                    @else
                                                        <i class="fa-regular fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>

                                            <p class="mb-0 text-dark" style="line-height: 1.8;">{{ $review->comment }}</p>

                                            @if($review->admin_reply)
                                                <div class="admin-reply mt-3 p-3 bg-light rounded-3 border-start border-4 border-info">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="bi bi-reply-all-fill ms-2 text-info"></i>
                                                        <strong class="text-info small">پاسخ مدیریت:</strong>
                                                    </div>
                                                    <p class="mb-0 small text-secondary" style="line-height: 1.7;">
                                                        {{ $review->admin_reply }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-center py-4">
                                            <p class="text-muted">هنوز دیدگاهی برای این محصول ثبت نشده است. اولین نفر باشید!</p>
                                            <div class="img-send-messege mt-3">
                                                <img class="img-fluid" style="max-width: 140px; opacity: 0.6;" src="{{ asset('design/image/review.svg') }}" alt="بدون نظر">
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('design/js/zoomy.js') }}"></script>
    <script src="{{ asset('design/js/owl.carousel.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var urls = [];
            var seenImages = new Set();

            @if($product->coverImage)
            var coverUrl = @json(asset($product->coverImage->url));
            urls.push(coverUrl);
            seenImages.add(coverUrl);
            @endif

            @foreach($product->images as $image)
            var imageUrl = @json(asset($image->url));
            if (!seenImages.has(imageUrl)) {
                urls.push(imageUrl);
                seenImages.add(imageUrl);
            }
            @endforeach

            var hasMultipleImages = urls.length > 1;
            var options = { thumbHide: !hasMultipleImages };

            if (urls.length > 0) {
                $('#el').zoomy(urls, options);
            } else {
                $('#el').html('<p class="text-muted">تصویری موجود نیست.</p>');
            }
        });

        // Share link
        document.addEventListener("DOMContentLoaded", function () {
            const shareBtn = document.querySelector(".share-btn");
            const modal = document.querySelector(".share-modal");
            const closeBtn = document.querySelector(".share-close");
            const linkInput = document.querySelector(".share-link");
            const copyBtn = document.querySelector(".share-copy-btn");
            const copyMsg = document.querySelector(".share-copy-msg");

            if(shareBtn && modal) {
                shareBtn.addEventListener("click", () => {
                    linkInput.value = window.location.href;
                    modal.style.display = "flex";
                    copyMsg.style.display = "none";
                });
                closeBtn.addEventListener("click", () => { modal.style.display = "none"; });
                copyBtn.addEventListener("click", () => {
                    linkInput.select();
                    document.execCommand("copy");
                    copyMsg.style.display = "block";
                });
                window.addEventListener("click", (e) => {
                    if (e.target === modal) { modal.style.display = "none"; }
                });
            }
        });

        // Notify
        document.addEventListener("DOMContentLoaded", function () {
            const notifyBtn = document.querySelector(".notify-btn");
            const notifyModal = document.querySelector(".notify-modal");
            const notifyClose = document.querySelector(".notify-close");
            const notifyInput = document.querySelector(".notify-input");
            const notifySubmitBtn = document.querySelector(".notify-submit-btn");
            const notifyConfirmMsg = document.querySelector(".notify-confirm-msg");

            if(notifyBtn && notifyModal) {
                notifyBtn.addEventListener("click", () => {
                    notifyInput.value = "";
                    notifyConfirmMsg.style.display = "none";
                    notifyModal.style.display = "flex";
                });
                notifyClose.addEventListener("click", () => { notifyModal.style.display = "none"; });
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
                    if (e.target === notifyModal) { notifyModal.style.display = "none"; }
                });
            }
        });

        // Add to cart +/- & Ajax
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.formAddToCart');
            if (!form) return;

            const qtyInput = form.querySelector('.product-qty-input-js');
            const qtyDisplay = form.querySelector('.qty-display-js');
            const plusBtn = form.querySelector('.qty-plus-js');
            const minusBtn = form.querySelector('.qty-minus-js');
            const submitBtn = form.querySelector('.addToCart-js');
            const iconMinus = form.querySelector('.icon-minus-js');
            const iconTrash = form.querySelector('.icon-trash-js');

            const minQty = parseInt(qtyInput.min) || 1;
            const maxQty = parseInt(qtyInput.max) || Infinity;

            function updateUI() {
                const val = parseInt(qtyInput.value);
                if(qtyDisplay) qtyDisplay.textContent = val;
                if (val <= 1) {
                    if(iconMinus) iconMinus.style.display = 'none';
                    if(iconTrash) iconTrash.style.display = 'block';
                } else {
                    if(iconMinus) iconMinus.style.display = 'block';
                    if(iconTrash) iconTrash.style.display = 'none';
                }
            }

            updateUI();

            if(plusBtn) {
                plusBtn.addEventListener('click', function() {
                    let currentQty = parseInt(qtyInput.value);
                    if (currentQty < maxQty) {
                        qtyInput.value = currentQty + 1;
                        updateUI();
                    }
                });
            }

            if(minusBtn) {
                minusBtn.addEventListener('click', function() {
                    let currentQty = parseInt(qtyInput.value);
                    if (currentQty > 1) {
                        qtyInput.value = currentQty - 1;
                    }
                    updateUI();
                });
            }

            $(form).on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const url = $form.attr('action');
                const formData = $form.serialize();
                const originalBtnHtml = $(submitBtn).html();

                submitBtn.disabled = true;
                $(submitBtn).html('در حال بروزرسانی...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        showCartMessage(response.message, 'success');
                        if (response.count_html) $('#header-cart-count-container').html(response.count_html);
                        if (response.list_html) $('#header-cart-list-container').html(response.list_html);
                        $(submitBtn).html('<i class="bi bi-check-all"></i> بروزرسانی شد');
                    },
                    error: function(xhr) {
                        let errorMsg = 'خطایی رخ داد.';
                        if (xhr.responseJSON && xhr.responseJSON.message) errorMsg = xhr.responseJSON.message;
                        showCartMessage(errorMsg, 'danger');
                        $(submitBtn).html(originalBtnHtml);
                    },
                    complete: function() {
                        submitBtn.disabled = false;
                        setTimeout(() => {
                            $(submitBtn).html(originalBtnHtml);
                        }, 2000);
                    }
                });
            });

            function showCartMessage(text, type) {
                $('.cart-ajax-alert').remove();
                const alertHtml = `<div class="cart-ajax-alert alert alert-${type} shadow-sm" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; min-width: 250px; direction: rtl;">${text}</div>`;
                $('body').append(alertHtml);
                setTimeout(() => { $('.cart-ajax-alert').fadeOut(500, function() { $(this).remove(); }); }, 3000);
            }
        });

        // Star Rating & Review AJAX submission
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star-select');
            const ratingInput = document.getElementById('ratingValue');
            const ratingText = document.getElementById('ratingText');
            const labels = {
                1: 'خیلی بد (۱ از ۵)',
                2: 'بد (۲ از ۵)',
                3: 'معمولی (۳ از ۵)',
                4: 'خوب (۴ از ۵)',
                5: 'عالی (۵ از ۵)'
            };

            function highlightStars(val) {
                stars.forEach(s => {
                    const sVal = parseInt(s.getAttribute('data-value'));
                    if (sVal <= val) {
                        s.classList.remove('fa-regular');
                        s.classList.add('fa-solid');
                    } else {
                        s.classList.remove('fa-solid');
                        s.classList.add('fa-regular');
                    }
                });
            }

            if (stars.length > 0 && ratingInput) {
                stars.forEach(star => {
                    // هاور کردن روی ستاره‌ها برای تجربه کاربری بهتر
                    star.addEventListener('mouseenter', function () {
                        const val = parseInt(this.getAttribute('data-value'));
                        highlightStars(val);
                    });

                    star.closest('.star-rating-input')?.addEventListener('mouseleave', function () {
                        let currentVal = parseInt(ratingInput.value) || 5;
                        highlightStars(currentVal);
                    });

                    // 🌟 کلیک روی ستاره = ثبت آنی امتیاز (بدون نیاز به زدن دکمه)
                    star.addEventListener('click', function () {
                        const val = parseInt(this.getAttribute('data-value'));
                        ratingInput.value = val;
                        if (ratingText) ratingText.textContent = labels[val] || '';
                        highlightStars(val);

                        // ارسال خودکار امتیاز خالص با AJAX
                        const formAction = document.getElementById('reviewForm')?.action || window.location.href;

                        $.ajax({
                            url: formAction,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val(),
                                rating: val,
                                comment: '' // چون فقط ستاره داده شده، متن خالی است
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    if (typeof Swal !== 'undefined') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'موفق',
                                            text: response.message,
                                            timer: 1500,
                                            showConfirmButton: false
                                        }).then(() => {
                                            location.reload(); // رفرش صفحه برای آپدیت میانگین ستاره‌ها
                                        });
                                    } else {
                                        alert(response.message);
                                        location.reload();
                                    }
                                }
                            },
                            error: function (xhr) {
                                let msg = 'خطایی در ثبت امتیاز رخ داد.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    msg = xhr.responseJSON.message;
                                }
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire('خطا', msg, 'error');
                                } else {
                                    alert(msg);
                                }
                            }
                        });
                    });
                });
            }

            // ارسال فرم دیدگاه متنی (اگر کاربر خواست نظر بنویسد)
            const reviewForm = document.getElementById('reviewForm');
            if (reviewForm) {
                $(reviewForm).on('submit', function (e) {
                    e.preventDefault();

                    const $form = $(this);
                    const submitBtn = document.getElementById('submitReviewBtn');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'در حال ارسال...';

                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: $form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'موفق',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    alert(response.message);
                                }

                                $form[0].reset();
                                ratingInput.value = 5;
                                highlightStars(5);
                                if (ratingText) ratingText.textContent = labels[5];
                            }

                            // 🌟 رفرش کپچا پس از ثبت موفقیت‌آمیز نظر متنی
                            $('#reviewForm .refresh-captcha-btn').trigger('click');
                        },
                        error: function (xhr) {
                            let msg = 'خطایی در ثبت دیدگاه رخ داد.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            if (typeof Swal !== 'undefined') {
                                Swal.fire('خطا', msg, 'error');
                            } else {
                                alert(msg);
                            }

                            // 🌟 رفرش کپچا در صورت بروز خطا (مثلاً اشتباه وارد کردن کد امنیتی)
                            $('#reviewForm .refresh-captcha-btn').trigger('click');
                        },
                        complete: function () {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        }
                    });
                });
            }
        });
    </script>
@endsection
