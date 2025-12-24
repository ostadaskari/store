@extends('front.layouts.app')

@section('content')

    <div class="container mt-4 topPadd">
        <div class="row">
            {{-- Breadcrumb --}}
            @include('front.partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        </div>

        <div class="row">

            {{-- Sidebar --}}
            <div class="col-md-3">
                <div class="card cardCategoris">
                    <h5 class="mb-3 cardH5">دسته‌ بندی‌ ها</h5>
                    @include('front.partials.sidebar_categories', [
                        'categories' => $allCategories,
                        'currentCategory' => $category
                    ])
                </div>
            </div>

            {{-- Main content --}}
            <div class="col-md-9 px-0" style="background-color: #fff;">


                {{-- Subcategories --}}
                @if ($subcategories->count())

                    <div class="row mb-4">
                        <h5 class="cardH5">زیر‌ دسته‌ ها</h5>
                        @foreach ($subcategories as $sub)
                            <div class="col-md-3 my-2 px-1">
                                <a href="{{ route('category.show', $sub->slug) }}" class="text-decoration-none">
                                    <div class="card text-center shadow-sm p-1 subCategoryCard" style="font-size: 14px;">
                                        {{ $sub->name }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Products --}}
                <div class="row py-2">
                    @forelse ($products as $product)
                        <div class="col-12 col-md-3 px-1 product-card">

                            <div class="pro position-relative"> {{-- Added position-relative --}}
                                <a href="{{ route('front.product.show', [
                                'category' => $product->category->slug,
                                'product'  => $product->slug
                            ]) }}">

                                    {{-- Discount Badge --}}
                                    @if($product->price && $product->price->discount_percent > 0)
                                        <div class="position-absolute top-0 start-0 m-2 badge bg-danger text-white shadow-sm"
                                             style="z-index: 10; border-radius: 50px; padding: 5px 10px; font-weight: bold; direction: ltr;">
                                            {{ round($product->price->discount_percent) }}%
                                        </div>
                                    @endif

                                    <span class="badge badge-star">
                                    <p class="">3.4</p>
                                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                </span>
                                    <div class="top">
                                        @php
                                            $image = $product->coverImage ? $product->coverImage->url : asset('images/300x300.webp');
                                        @endphp
                                        <img src="{{ $image }}"  alt="{{ $product->name }}">
                                    </div>

                                    <div class="product-name">
                                        <span>P/N : {{ $product->part_number }} </span>
                                    </div>

                                    <div class="down">
                                        <p class="card-text text-muted" dir="ltr">{{ $product->company_cmt }}</p>

                                        @php
                                            $display = $product->display_price_toman;
                                            $priceModel = $product->price;
                                        @endphp

                                        <div class="final-price-div mb-2">
                                            @if($display)
                                                {{-- Show strike-through price if discount exists --}}
                                                @if($priceModel && $priceModel->discount_percent > 0)
                                                    @php
                                                        $oldPrice = $display / (1 - ($priceModel->discount_percent / 100));
                                                    @endphp
                                                    <small class="text-muted text-decoration-line-through d-block" style="font-size: 0.8rem;">
                                                        {{ number_format($oldPrice) }}
                                                    </small>
                                                @endif

                                                <span class="fw-bold text-dark">
                                                {{ number_format($display) }} تومان
                                            </span>
                                            @else
                                                <span class="text-muted">قیمت ثبت نشده</span>
                                            @endif
                                        </div>

                                        <div class="box">
                                            <div class="text-danger">
                                                <span class="Quantity-stock">{{ $product->available_qty ? 'موجودی: '.$product->available_qty.' عدد ' : 'ناموجود' }} </span>
                                            </div>
                                            <button class="addtocart">
                                                خرید
                                            </button>
                                        </div>
                                    </div>
                                    <!-- ⚠ Overlay  -->
                                    <div class="product-overlay">
                                        <button class="btn btn-danger">جزئیات بیشتر</button>
                                    </div>
                            </div>
                            </a>
                        </div>
                    @empty
                        <p>محصولی در این دسته وجود ندارد.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

@endsection
