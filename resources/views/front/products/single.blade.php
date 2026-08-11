@extends('front.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('design/css/zoomy.css') }}">
    <link rel="stylesheet" href="{{ asset('design/css/style.css') }}">

    <style>
        .mylist-product-single {
            max-height: 280px;          /* Adjust height to fit your layout */
            overflow-y: auto;           /* Enable vertical scrollbar */
            padding-right: 8px;         /* Prevent content clipping */
        }

        /* Modern thin scrollbar styling */
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
            {{-- 2. IMAGE GALLERY --}}
            {{-- Note: We only need the primary div for the zoomy plugin to attach to --}}
            <div class="col-12 col-md-6 col-lg-3 d-flex align-items-center flex-column p-3" id="el">
                {{-- The JS will inject the images here. Using the cover image as a fallback. --}}
                <img class="img-fluid custom-img-fluid"
                     src="{{ $product->coverImage->url ?? asset('images/300x300.webp') }}"
                     alt="{{ $product->company_cmt }}">
            </div>

            <!-- PRODUCT FEATURES -->
            <div class="col-12 col-md-6 col-lg-4 d-flex flex-column mt-3 mt-md-0 p-3">

                <p class="partNumber">{{ $product->information->title ?? ($product->part_number ?? '') }}</p>

                <p class="title-mylist-product-single">ویژگی‌ها</p>
                <ul class="mylist-product-single" dir="ltr">
                    <li>Manufacturer: {{ $product->mfg ?? '' }}</li>
                    @forelse ($product->featureValues as $fv)

                        @php
                            $data = $fv->value;
                            $feature = $fv->feature;
                            $name = $feature->name ?? '---';

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
                    {{ $product->available_qty ? 'موجودی :  '.$product->available_qty.' عدد' : 'ناموجود' }}
                </div>

                <!-- PRICE -->

                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center w-100 my-4 ">
                    <div class="offer-price-product-single d-flex flex-row justify-content-between w-100 position-relative">

                        @php
                            $display = $product->display_price_toman;
                            $priceModel = $product->price;
                            $hasDiscount = $priceModel && $priceModel->discount_percent > 0;
                        @endphp

                        @if($hasDiscount)
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="right: -10px; top: 0;">
                {{ round($priceModel->discount_percent) }}% -
            </span>

                            @php
                                $oldPrice = $display / (1 - ($priceModel->discount_percent / 100));
                            @endphp
                            <s class="me-2 text-muted">{{ number_format($oldPrice) }} تومان</s>
                        @endif

                        @if($display)
                            <p class="m-0 fw-bold" style="font-size: 1.25rem;">{{ number_format($display) }} تومان</p>
                        @else
                            <span class="text-muted">قیمت ثبت نشده</span>
                        @endif

                    </div>
                </div>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="formAddToCart">
                    @csrf

                    {{-- Hidden input field to hold the actual quantity value for form submission.
                        This value is dynamically updated by the visible quantity control buttons (JS). --}}
                    <div class="qty-wrapper" style="display: none;">
                        <input type="number"
                               name="qty"
                               min="1"
                               max="{{ $product->available_qty }}"
                               value="{{ $currentCartQty }}"
                               autocomplete="off"
                               class="product-qty-input-js">
                    </div>

                    {{-- Visible Quantity Control Interface: Uses two buttons and a display span. --}}
                    <div class="cart-control d-flex justify-content-center align-items-center gap-2 mx-0">

                        {{-- Increase Quantity Button --}}
                        <button type="button" class="increase-btn btn btn-sm btn-outline-secondary qty-plus-js">+</button>

                        {{-- Quantity Display Span: Shows the current quantity to the user. --}}
                        <span class="quantity fs-6 fw-bold qty-display-js">{{ $currentCartQty }}</span>

                        {{-- Decrease/Remove Button: Switches between Minus (-) and Trash icons based on qty (JS controlled). --}}
                        <button type="button" class="decrease-btn btn btn-sm btn-outline-secondary qty-minus-js">

                            {{-- Minus icon: Visible when quantity is > 1 --}}
                            <svg width="16" height="16" fill="currentColor" class="bi bi-dash icon-minus-js" viewBox="0 0 16 16">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>

                            {{-- Trash icon: Visible when quantity is 1 (signals removal from cart logic) --}}
                            <svg width="16" height="16" fill="rgb(206, 33, 33)" class="bi bi-trash icon-trash-js" style="display:none;" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                            </svg>
                        </button>

                    </div>

                    {{-- Main Submit Button: Adds the product (with the hidden qty value) to the cart. --}}
                    <button type="submit" class="addToCart-js addtocartProduct">
                        <svg width="22" height="22" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1z"/>
                        </svg>
                        افزودن به سبد خرید
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
            <div class="row mt-2">
                @foreach($relatedProducts as $product)
                    @include('front.components.product-card', ['product' => $product])
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
                    <a href="#"><img class="img-fluid pt-2" alt="ارسال به سراسر کشور" src="{{ asset('design/image/shipping00.png') }}"></a>
                    <p class="pl-2 pt-2">ارسال  به سراسر کشور</p>
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
                            توضیحات
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
                                    @if(!empty($product->information->description))
                                        <p>{!! $product->information->description !!}</p>
                                        @else
                                    <p class="card-title mb-4">بررسی و نقدی هنوز صورت نگرفته است..</p>
                                    @endif
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
                                            @forelse($product->approvedReviews as $review)
                                                <div class="review-item p-3 mb-2 border-bottom">
                                                    <!-- اطلاعات کاربر و تاریخ -->
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="user-info">
                                                            <i class="bi bi-person-circle me-1 text-secondary"></i>
                                                            <strong>{{ $review->user->full_name ?? 'کاربر مهمان' }}</strong>
                                                        </div>
                                                        <small class="text-muted">{{ jdate($review->created_at)->format('%d %B %Y') }}</small>
                                                    </div>

                                                    <!-- متن نظر کاربر -->
                                                    <div class="user-comment mt-2">
                                                        <p class="mb-0 text-dark" style="line-height: 1.8;">{{ $review->comment }}</p>
                                                    </div>

                                                    <!-- بخش پاسخ مدیر (فقط در صورت وجود نمایش داده می‌شود) -->
                                                    @if($review->admin_reply)
                                                        <div class="admin-reply mt-3 p-3 bg-light rounded-3 border-start border-4 border-info">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="bi bi-reply-all-fill me-2 text-info"></i>
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
                                                    <p class="text-muted">هنوز نظری برای این محصول ثبت نشده است.</p>
                                                    <div class="img-send-messege mt-3">
                                                        <img class="img-fluid" style="max-width: 150px; opacity: 0.6;" src="{{ asset('design/image/review.svg') }}" alt="بدون نظر">
                                                    </div>
                                                </div>
                                            @endforelse
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
    <script src="{{ asset('design/js/zoomy.js') }}"></script>

    <script src="{{asset('design/js/owl.carousel.min.js')}}"></script>

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


        // ***************** js for input add to cart +/- *****************
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

            // --- UI Update Logic ---
            function updateUI() {
                const val = parseInt(qtyInput.value);
                qtyDisplay.textContent = val;

                // Toggle between Trash and Minus icons
                if (val <= 1) {
                    iconMinus.style.display = 'none';
                    iconTrash.style.display = 'block';
                } else {
                    iconMinus.style.display = 'block';
                    iconTrash.style.display = 'none';
                }
            }

            // Initialize UI on load
            updateUI();

            plusBtn.addEventListener('click', function() {
                let currentQty = parseInt(qtyInput.value);
                if (currentQty < maxQty) {
                    qtyInput.value = currentQty + 1;
                    updateUI();
                }
            });

            minusBtn.addEventListener('click', function() {
                let currentQty = parseInt(qtyInput.value);
                if (currentQty > 1) {
                    qtyInput.value = currentQty - 1;
                } else {
                    // Optional: You could trigger a 'remove' AJAX here if you want
                    // the minus button to act as a delete when qty is 1
                    console.log("Already at minimum");
                }
                updateUI();
            });

            // --- AJAX Add/Update Logic ---
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

                        // 1. Update Global Header Info
                        if (response.count_html) $('#header-cart-count-container').html(response.count_html);
                        if (response.list_html) $('#header-cart-list-container').html(response.list_html);

                        // 2. Change button text to indicate it's updated
                        $(submitBtn).html('<i class="bi bi-check-all"></i> بروزرسانی شد');

                        // 3. Re-init Bootstrap Dropdowns
                        if (typeof bootstrap !== 'undefined') {
                            const cartBtn = document.getElementById('cartBtn');
                            if (cartBtn) {
                                const existingInstance = bootstrap.Dropdown.getInstance(cartBtn);
                                if (existingInstance) existingInstance.dispose();
                                new bootstrap.Dropdown(cartBtn);
                            }
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = 'خطایی رخ داد.';
                        if (xhr.responseJSON && xhr.responseJSON.message) errorMsg = xhr.responseJSON.message;
                        showCartMessage(errorMsg, 'danger');
                        $(submitBtn).html(originalBtnHtml);
                    },
                    complete: function() {
                        submitBtn.disabled = false;
                        // Return to "Update" or "Add" state after a delay
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
    // ***************** end js for input add to cart +/- *****************

    </script>

@endsection
