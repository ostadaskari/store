@extends('front.layouts.app')

@section('content')
    <div class="container topPadd">
        <h4 class="mt-3 mb-2">❤️ علاقه‌مندی‌های من</h4>

        @if($products->isEmpty())
            <p class="text-muted">لیست علاقه‌مندی خالی است.</p>
        @else
            {{-- Reuse SAME layout as categories --}}
            <div class="row py-2">
                @foreach ($products as $product)
                    <div class="col-12 col-md-3 px-1 product-card">

                        <div class="pro position-relative">
                            <a href="{{ route('front.product.show', [
                            'category' => $product->category->slug,
                            'product'  => $product->slug
                        ]) }}">

                                {{-- Discount badge --}}
                                @if($product->price && $product->price->discount_percent > 0)
                                    <div class="position-absolute top-0 start-0 m-2 badge bg-danger text-white shadow-sm"
                                         style="z-index: 10; border-radius: 50px; padding: 5px 10px;">
                                        {{ round($product->price->discount_percent) }}%
                                    </div>
                                @endif

                                {{-- Image --}}
                                @php
                                    $image = $product->coverImage
                                        ? $product->coverImage->url
                                        : asset('images/300x300.webp');
                                @endphp

                                <div class="top">
                                    <img src="{{ $image }}" alt="{{ $product->name }}">
                                </div>

                                {{-- Part number --}}
                                <div class="product-name">
                                    <span>P/N : {{ $product->part_number }}</span>
                                </div>

                                {{-- Bottom --}}
                                <div class="down">
                                    <p class="card-text text-muted" dir="ltr">
                                        {{ $product->company_cmt }}
                                    </p>

                                    {{-- Price --}}
                                    @php
                                        $display = $product->display_price_toman;
                                        $priceModel = $product->price;
                                    @endphp

                                    <div class="final-price-div mb-2">
                                        @if($display)
                                            @if($priceModel && $priceModel->discount_percent > 0)
                                                @php
                                                    $oldPrice = $display / (1 - ($priceModel->discount_percent / 100));
                                                @endphp
                                                <small class="text-muted text-decoration-line-through d-block">
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

                                    {{-- Stock --}}
                                    <div class="box">
                                        <div class="text-danger">
                                            {{ $product->available_qty
                                                ? 'موجودی: '.$product->available_qty.' عدد'
                                                : 'ناموجود' }}
                                        </div>
                                        <button class="addtocart">خرید</button>
                                    </div>
                                </div>

                                {{-- Overlay --}}
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>

                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
