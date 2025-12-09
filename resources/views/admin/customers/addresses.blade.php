@extends('admin.layouts.app')
{{-- Assuming this view extends a layout --}}

@section('content')
    <div class="content-section" dir="rtl">
        <div class="seven mt-3 d-flex justify-content-between align-items-center">
            <h1>آدرس‌های مشتری: {{ $customer->name }} (ID: {{ $customer->id }})</h1>
            <a href="{{ route('admin.customers.list') }}" class="btn btn-secondary">بازگشت به لیست مشتریان</a>
        </div>

        <p class="lead">ایمیل: {{ $customer->email }}</p>

        @if($addresses->isEmpty())
            <div class="alert alert-warning text-center mt-4">
                این مشتری هیچ آدرس ثبت شده‌ای ندارد.
            </div>
        @else
            <div class="row g-4 mt-2">
                @foreach($addresses as $address)
                    <div class="col-lg-6 col-xl-4">
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
