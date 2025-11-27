@extends('front.layouts.app')

@section('content')
    <div class="container topPadd">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5 text-center" dir="rtl">
                        <h4 class="card-title fw-bold mb-4">تایید شماره موبایل</h4>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger" dir="rtl">
                                <ul class="mb-0 p-0" style="list-style: none;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <p class="text-muted small mb-4">کد ۴ رقمی ارسال شده به شماره زیر را وارد نمایید:</p>
                        <p class="fs-5 fw-bold text-dark">{{ $mobile }}</p>

                        <form method="POST" action="{{ route('client.verify.code') }}">
                            @csrf
                            <input type="hidden" name="mobile" value="{{ $mobile }}">

                            <div class="mb-4">
                                <label for="code" class="form-label visually-hidden">کد تایید</label>
                                <input type="text" class="form-control form-control-lg text-center" id="code" name="code" placeholder="----" maxlength="4" required autofocus>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success py-2">تایید و ادامه</button>
                            </div>
                        </form>

                        <p class="text-center mt-4 mb-0 small text-muted">
                            کدی دریافت نکرده‌اید؟
                        </p>
                        <form method="POST" action="{{ route('client.verify.resend') }}">
                            @csrf
                            <input type="hidden" name="mobile" value="{{ $mobile }}">
                            <button type="submit" class="btn btn-link text-decoration-none mt-1 p-0 small">ارسال مجدد کد</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
