@extends('front.layouts.app')

@section('content')
    <div class="container topPadd mt-4 px-3">
       <div class="row">
            <div class="col-12 col-md-8">
             <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="card-title m-0">سبد خرید شما</h6>
             </div>   
            <div id="cart-items-container">
                @forelse ($cart as $item)
                    <div class="styles_CartItem__grid__rZXPE border-bottom pb-4 mb-4" id="item-{{ $item->id }}">
                        
                        <div class="d-flex flex-column align-items-center justify-content-between">
                            <a class="relative" href="#">
                                <div style="width: 145px; height: 145px; line-height: 0;">
                                    <img class="w-full inline-block" 
                                        src="{{ $item->attributes->image }}" 
                                        alt="{{ $item->name }}" 
                                        style="object-fit: contain; width: 140px; height: 140px;">
                                </div>
                            </a>
                            
                            <div class="mt-1 d-flex align-items-center justify-content-between px-2 rounded border item-quantity_ItemQuantity__box__5r4FJ">
                                <button class="btn btn-link p-0 qty-btn" data-id="{{ $item->id }}" data-type="plus">
                                    <i class="fas fa-plus" style="font-size: 14px; color: var(--bs-primary);"></i>
                                </button>

                                <span class="d-flex flex-column align-items-center justify-content-between mx-3">
                                    <span class="text-h5" id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                                </span>

                                <button class="btn btn-link p-0 qty-btn" data-id="{{ $item->id }}" data-type="minus">
                                        <i class="fas fa-minus" style="font-size: 14px; color: var(--bs-primary);"></i>
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-hidden">
                            <div>
                                <h3 class="text-neutral-800 text-body1-strong mb-2" style="font-size: 1.1rem; font-weight: bold; color:#23254e;">
                                    {{ $item->name }}
                                </h3>
                                
                                <div class="d-flex align-items-center text-muted mb-1" style="font-size:12px;color:#62666d;">
                                    <i class="fas fa-shield-alt me-2"></i>
                                    <span>گارانتی اصالت و سلامت فیزیکی</span>
                                </div>
                                
                                <div class="d-flex align-items-center text-muted mb-2" style="font-size:12px;color:#62666d;">
                                    <i class="fas fa-store me-2"></i>
                                    <span>موجود در انبار</span>
                                </div>

                                <div class="text-muted mb-3" style="font-size: 12px;color:#62666d;">
                                    <i class="bi bi-tag-fill me-2"></i>
                                    <span>{{ number_format($item->price) }} تومان</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mt-5">
                                    <div class="d-flex flex-column align-items-end">
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="bi bi-substack"></i>
                                            <span class="text-h4 fw-bold" id="line-total-{{ $item->id }}">
                                                {{ number_format($item->price * $item->quantity) }}
                                            </span>
                                            <span style="font-size: 0.8rem; margin-right: 4px;">تومان</span>
                                        </div>
                                        
                                        @if($item->quantity > 1)
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                مجموع برای {{ $item->quantity }} عدد
                                            </small>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm text-danger cart-remove-page" data-id="{{ $item->id }}">
                                        <i class="fas fa-trash-alt ml-1"></i> حذف
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <p>سبد خرید شما خالی است</p>
                    </div>
                @endforelse
        </div>



       </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0" style="position: sticky;height: 300px;top:15%;">
                <div class="card-body p-4">
                    <!-- Cart total -->
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background-color: rgba(223, 233, 222, 0.932);">
                        <div class="d-flex flex-row align-items-center">
                            <svg width="25" height="25" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5"></path>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"></path>
                            </svg>
                            <span class="text-muted px-2">جمع سبد خرید شما</span>
                        </div>
                        <strong id="summary-total">{{ number_format($total) }} تومان </strong>
                    </div>
                    <hr>
                    <!-- Shipping cost -->
                    <div class="d-flex flex-column my-2" style="font-size: 12px;">
                        <h5 class="mb-0">هزینه ارسال</h5>
                        <p class="mb-0 text-success">هزینه ارسال بر اساس آدرس، وزن و حجم مرسوله شما محاسبه میگردد.</p>
                    </div>
                    <!-- Action buttons -->
                    <div class="d-flex gap-2 justify-content-center mt-5">
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary w-50" >
                            <i class="fa fa-shopping-cart me-1"></i> ادامه خرید
                        </a>
                        <a class="btn btn-success w-50" href="{{ url('checkout') }}">
                            ثبت سفارش <i class="fa fa-play ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ... (Your existing code for .qty-btn click listeners) ...

            // --- SweetAlert Flash Message Display Logic ---
            // Get flash messages from Laravel session and trim any whitespace
            const successMessage = "{{ session('success') }}".trim();
            const errorMessage = "{{ session('error') }}".trim();

            if (successMessage.length > 0) {
                Swal.fire({
                    title: 'موفقیت!',
                    text: successMessage,
                    icon: 'success',
                    confirmButtonText: 'تأیید',
                    customClass: {
                        popup: 'swal2-popup-rtl' // For proper RTL alignment
                    }
                });
            } else if (errorMessage.length > 0) {
                Swal.fire({
                    title: 'خطا!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'تأیید',
                    customClass: {
                        popup: 'swal2-popup-rtl'
                    }
                });
            }
            // --- End SweetAlert Flash Message Display Logic ---





        });
    </script>
@endsection
