@php
    $isWishlisted = auth()->check()
    && auth()->user()
    ->wishlists()
    ->where('product_id', $product->id)
    ->exists();

    $image = $product->coverImage ? $product->coverImage->url : asset('images/300x300.webp');
    $display = $product->display_price_toman;
    $priceModel = $product->price;


@endphp

<div class="col-12 col-md-3 px-1 product-card mb-3">
    <div class="pro position-relative"> {{-- Container for everything --}}

        {{-- 1. Wishlist Heart (OUTSIDE the main link to avoid nesting) --}}
        <div class="position-absolute top-0 end-0 m-2" style="z-index: 50;">
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

        {{-- 2. Main Product Link --}}
        <a href="{{ route('front.product.show', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="text-decoration-none">

            {{-- Discount Badge --}}
            @if($priceModel && $priceModel->discount_percent > 0)
                <div class="position-absolute top-0 start-0 m-2 badge bg-danger text-white shadow-sm"
                     style="z-index: 10; border-radius: 50px; padding: 5px 10px;">
                    {{ round($priceModel->discount_percent) }}%
                </div>
            @endif

            {{-- Image --}}
            <div class="top">
                <img src="{{ $image }}" alt="{{ $product->name }}">
            </div>

            {{-- Product Name --}}
            <div class="product-name">
                <span class="text-dark">P/N : {{ $product->part_number }}</span>
            </div>

            {{-- Bottom Content --}}
            <div class="down">
                <p class="card-text text-muted" dir="ltr">
                    {{ Str::limit($product->company_cmt, 60) }}
                </p>

                <div class="final-price-div mb-2">
                    @if($display)
                        @if($priceModel && $priceModel->discount_percent > 0)
                            @php $oldPrice = $display / (1 - ($priceModel->discount_percent / 100)); @endphp
                            <small class="text-muted text-decoration-line-through d-block">
                                {{ number_format($oldPrice) }}
                            </small>
                        @endif
                        <span class="fw-bold text-dark">{{ number_format($display) }} تومان</span>
                    @else
                        <span class="text-muted">قیمت ثبت نشده</span>
                    @endif
                </div>

                <div class="box">
                    <div class="text-danger">
                        {{ $product->available_qty ? 'موجودی: '.$product->available_qty.' عدد' : 'ناموجود' }}
                    </div>
                    <button class="addtocart">خرید</button>
                </div>
            </div>

            {{-- Hover Overlay --}}
            <div class="product-overlay">
                <button class="btn btn-danger">جزئیات بیشتر</button>
            </div>
        </a>
    </div>


</div>
