@extends('admin.layouts.app')
{{-- Assuming this view extends a layout --}}

@section('content')
    <div class="content-section" dir="rtl">
        <div class="seven mt-3">
            <h1>آدرس‌های مشتری: {{ $customer->name }} {{ $customer->family }} (ID: {{ $customer->id }})</h1>
        </div>
        
        <div class="card p-2 px-3 d-flex flex-row justify-content-between rounded">
            <a href="{{ route('admin.customers.list') }}" class="btnBack m-0" title="بازگشت">
                <svg width="24" height="24" fill="currentColor" class="bi bi-arrow-right-circle icon-transition" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"></path>
                </svg>
            </a>

            <p class="lead mb-0">ایمیل: {{ $customer->email }}</p>
        </div>


        @if($addresses->isEmpty())
            <div class="alert alert-warning text-center mt-4">
                این مشتری هیچ آدرس ثبت شده‌ای ندارد.
            </div>
        @else
            <div class="row g-4 mt-2">
                @foreach($addresses as $address)
                    <div class="col-lg-6 col-xl-4 mt-1">
                        <div class="card shadow-sm h-100 border-primary">
                            <div class="card-header bg-primary text-white d-flex justify-content-between">
                                <h5 class="mb-0">آدرس #{{ $loop->iteration }}</h5>
                                <small>ثبت شده در: {{ jdate($address->created_at)->format('Y/m/d') }}</small>
                            </div>
                            <div class="card-body">
                                <p class="card-title fw-bold border-bottom pb-2">گیرنده: {{ $address->first_name }} {{ $address->last_name }}</p>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">استان/شهر:</span>
                                        <span>{{ $address->province }} / {{ $address->city }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fw-bold">آدرس کامل:</span>
                                        <div class="text-wrap mt-1">{{ $address->address }} (پلاک: {{ $address->plate }})</div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">کد پستی:</span>
                                        <span>{{ $address->post_code }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">موبایل:</span>
                                        <span dir="ltr">{{ $address->mobile }}</span>
                                    </li>
                                    @if($address->phone)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-bold">تلفن ثابت:</span>
                                            <span dir="ltr">{{ $address->phone }}</span>
                                        </li>
                                    @endif
                                    @if($address->company_name)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-bold">نام شرکت:</span>
                                            <span>{{ $address->company_name }}</span>
                                        </li>
                                    @endif
                                    @if($address->email)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-bold">ایمیل (آدرس):</span>
                                            <span dir="ltr">{{ $address->email }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
