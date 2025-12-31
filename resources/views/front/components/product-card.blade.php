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
<audio id="hoverSound"
        src="{{asset('design/sound/2568-preview.mp3') }}"
        preload="auto">
    </audio>
<div class="col-12 col-md-3 px-2 product-card my-2">
    
    <div class="pro position-relative hover-card"> {{-- Container for everything --}}

        {{-- 1. Wishlist Heart (OUTSIDE the main link to avoid nesting) --}}
         {{-- Hover Overlay --}}
            <div class="product-overlay">
                <button class="btnSvg">
                    <svg width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
                    </svg>
                </button>
                <div class="my-2">
                    @auth
                        <a href="javascript:void(0)"
                        class="wishlist-btn"
                        data-product="{{ $product->id }}"
                        data-url="{{ route('wishlist.toggle') }}">
                            <i class="bi {{ $isWishlisted ? 'bi-heart-fill text-danger' : 'bi-heart' }}"
                            style="font-size:20px"></i>
                        </a>
                    @else
                        <a href="{{ url('login') }}">
                            <i class="bi bi-heart" style="font-size:24px"></i>
                        </a>
                    @endauth
                </div>
            </div>
        
        {{-- 2. Main Product Link --}}
        <a href="{{ route('front.product.show', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="text-decoration-none">

            

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
                <p class="card-text text-muted mb-1" dir="ltr">
                    {{ Str::limit($product->company_cmt, 60) }}
                </p>

                <div class="final-price-div mb-2">

                    @if($display)

                        {{-- Row: final price + discount badge --}}
                        <div class="d-flex align-items-center justify-content-between gap-2 w-100">

                            <span class="fw-bold text-dark" style="font-size: 14px;">
                                {{ number_format($display) }}
                                <span>تومان</span>
                            </span>

                            @if($priceModel && $priceModel->discount_percent > 0)
                                <span class="badge bg-danger text-white shadow-sm"
                                    style="border-radius: 50px; padding: 5px 10px;">
                                    {{ round($priceModel->discount_percent) }}%
                                </span>
                            @endif

                        </div>

                        {{-- Old price (under row) --}}
                        @if($priceModel && $priceModel->discount_percent > 0)
                            @php
                                $oldPrice = $display / (1 - ($priceModel->discount_percent / 100));
                            @endphp
                            <div class="text-muted text-decoration-line-through"
                                style="font-size:13px;">
                                {{ number_format($oldPrice) }} تومان
                            </div>
                        @endif

                    @else
                        <span class="text-muted">قیمت ثبت نشده</span>
                    @endif

                </div>


                <div class="box">
                    <div class="text-danger Quantity-stock">
                        {{ $product->available_qty ? 'موجودی: '.$product->available_qty.' عدد' : 'ناموجود' }}
                    </div>
                    <button class="btnSvg">
                        <svg width="24" height="24" fill="green" class="bi bi-cart-plus" viewBox="0 0 16 16">
                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                        </svg>
                    </button>
                </div>
            </div>

           
        </a>
    </div>


</div>

