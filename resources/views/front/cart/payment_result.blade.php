@extends('front.layouts.app')

@section('content')

    {{-- کارت اصلی نتیجه تراکنش --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden text-center">

        {{-- نوار رنگی بالایی بر اساس وضعیت --}}
        <div class="{{ $status === 'success' ? 'bg-success' : 'bg-danger' }}" style="height: 6px;"></div>

        <div class="card-body p-4 p-md-5">

            <!-- STREAMING_CHUNK: Rendering payment status icon and headline... -->
            @if($status === 'success')
                {{-- آیکون پرداخت موفق --}}
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle" style="width: 80px; height: 80px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l5.002-6.502a.75.75 0 0 0-.022-1.08z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="fw-bold text-success mb-2">پرداخت با موفقیت انجام شد</h3>
                <p class="text-muted fs-6 mb-4">سفارش شما با موفقیت ثبت شد و در حال پردازش می‌باشد.</p>
            @else
                {{-- آیکون پرداخت ناموفق --}}
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle" style="width: 80px; height: 80px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="fw-bold text-danger mb-2">پرداخت ناموفق بود</h3>
                <p class="text-muted fs-6 mb-4">متأسفانه فرآیند پرداخت انجام نشد یا توسط کاربر لغو گردید.</p>
            @endif

            <!-- STREAMING_CHUNK: Displaying message box from backend/bank... -->
            @if(!empty($message))
                <div class="alert {{ $status === 'success' ? 'alert-success' : 'alert-danger' }} border-0 rounded-3 text-start small mb-4">
                    <i class="bi bi-info-circle-fill me-1"></i> {{ $message }}
                </div>
            @endif

            <!-- STREAMING_CHUNK: Rendering order summary details... -->
            @if($order)
                <div class="bg-body-tertiary p-3 p-md-4 rounded-4 mb-4 text-start">
                    <h6 class="fw-bold mb-3 border-bottom pb-2 text-secondary fs-7 text-uppercase">اطلاعات سفارش</h6>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">شماره سفارش:</span>
                        <span class="fw-bold text-dark dir-ltr">#{{ $order->order_number }}</span>
                    </div>

                    @if(!empty($saleReferenceId))
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">کد مرجع (کد پیگیری بانک):</span>
                            <span class="fw-bold text-primary dir-ltr">{{ $saleReferenceId }}</span>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">تاریخ ثبت سفارش:</span>
                        <span class="text-dark dir-ltr">{{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d - H:i') }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <span class="fw-bold text-dark">مبلغ کل پرداخت شده:</span>
                        <strong class="fs-5 text-success">{{ number_format($order->total_amount) }} <small class="fs-7 text-muted">تومان</small></strong>
                    </div>
                </div>
            @endif

            <!-- STREAMING_CHUNK: Adding action buttons for retry or returning home... -->
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    صفحه اصلی
                </a>

                @if($status === 'success')
                    <a href="{{ route('cart.checkout') }}" class="btn btn-success rounded-pill px-4 py-2">
                        مشاهده فاکتور سفارش
                    </a>
                @else
                    <a href="{{ route('cart.checkout') }}" class="btn btn-danger rounded-pill px-4 py-2">
                        تلاش مجدد برای پرداخت
                    </a>
                @endif
            </div>

        </div>
    </div>

    </div>
    </div>


@endsection
