@if(!\Cart::isEmpty())
    <ul class="dropdown-menu dropdown-menu-end p-3" id="cart-dropdown-list" style="min-width: 450px; z-index:9999; font-size: 14px;">
        <div class="cart-items mb-3" style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
            @foreach(\Cart::getContent() as $header_cart)
                <li class="mb-3 border-bottom pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Product Info -->
                        <div class="d-flex align-items-center gap-2" style="flex: 1;">
                            <img src="{{ $header_cart->attributes->image ?? '' }}" width="40" height="40" class="rounded object-fit-cover">
                            <div style="max-width: 180px;">
                                <h6 class="mb-0 text-truncate" style="font-size: 13px;" title="{{ $header_cart->name }}">
                                    {{ $header_cart->name }}
                                </h6>
                                <small class="text-success">{{ number_format($header_cart->price) }} تومان</small>
                            </div>
                        </div>

                        <!-- Quantity Controls -->
                        <div class="d-flex align-items-center bg-light rounded-pill px-2 py-1 mx-2">
                            <button type="button" class="btn btn-sm p-0 header-qty-btn" data-id="{{ $header_cart->id }}" data-type="minus">−</button>
                            <span class="mx-2 fw-bold">{{ $header_cart->quantity }}</span>
                            <button type="button" class="btn btn-sm p-0 header-qty-btn" data-id="{{ $header_cart->id }}" data-type="plus">+</button>
                        </div>

                        <!-- Remove Button -->
                        <button class="btn btn-sm text-danger header-remove-btn" data-id="{{ $header_cart->id }}">×</button>
                    </div>
                </li>
            @endforeach
        </div>

        <li class="border-top pt-2">
            <div class="d-flex justify-content-between mb-3 totalCart">
                <span class="fw-bold"> مبلغ کل:</span>
                <span class="text-danger fw-bold fs-5">{{ number_format(\Cart::getSubTotal()) }} تومان</span>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-secondary w-100" href="{{ route('cart.index') }}">مشاهده سبد</a>
                <a class="btn btn-success w-100" href="{{ url('checkout') }}">تسویه حساب</a>
            </div>
        </li>
    </ul>
@else
    <ul class="dropdown-menu dropdown-menu-end p-3 text-center" style="min-width: 250px;">
        <li class="p-4">
            <i class="fa fa-shopping-basket d-block mb-2 text-muted" style="font-size: 30px;"></i>
            سبد خرید شما خالی است.
        </li>
    </ul>
@endif
