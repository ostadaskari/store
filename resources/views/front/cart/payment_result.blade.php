@extends('front.layouts.app')

@section('content')

    {{-- آیکون و تیتر وضعیت پرداخت --}}
    @if($status === 'success')
        <div class="mb-3 text-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l5.002-6.502a.75.75 0 0 0-.022-1.08z"/>
            </svg>
        </div>
        <h4 class="fw-bold text-success mb-2">پرداخت با موفقیت انجام شد</h4>
    @else
        <div class="mb-3 text-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </div>
        <h4 class="fw-bold text-danger mb-2">پرداخت ناموفق بود</h4>
    @endif

    {{-- پیام دریافتی از کنترلر/بانک --}}
    @if(!empty($message))
        <p class="text-muted mb-4 fs-6">{{ $message }}</p>
    @endif

    {{-- باکس اطلاعات سفارش --}}
    @if($order)
        <div class="bg-light p-3 rounded-3 mb-4 text-start d-inline-block w-100">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-secondary">شماره سفارش:</span>
                <strong class="text-dark">{{ $order->order_number }}</strong>
            </div>
            @if(!empty($saleReferenceId))
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-secondary">کد مرجع (کد پیگیری بانک):</span>
                    <strong class="text-dark">{{ $saleReferenceId }}</strong>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <span class="text-secondary">مبلغ کل:</span>
                <strong class="text-dark">{{ number_format($order->total_amount) }} تومان</strong>
            </div>
        </div>
    @endif

    {{-- دکمه‌های عملیاتی --}}
    <div class="d-flex justify-content-center gap-2 flex-wrap">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4">بازگشت به صفحه اصلی</a>
        @if($status === 'error')
            <a href="{{ route('cart.index') }}" class="btn btn-danger px-4">بازگشت به سبد خرید</a>
        @endif
    </div>

    </div>
    </div>
    </div>
