@extends('front.layouts.app')

@section('content')
    <div class="container topPadd">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5" dir="rtl">
                        <h4 class="card-title text-center mb-4 fw-bold">بازیابی رمز عبور</h4>

                        @if(session('status'))
                            <div class="alert alert-info">{{ session('status') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
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

                        <p class="text-muted small mb-4">لطفاً شماره موبایل خود را وارد کنید تا کد تایید برای شما ارسال شود.</p>

                        <form method="POST" action="{{ route('client.password.email') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="mobile" class="form-label">شماره موبایل</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="مثال: 09123456789" required autofocus>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success py-2">ارسال کد بازیابی</button>
                            </div>
                        </form>

                        <p class="text-center mt-4 mb-0 small text-muted">
                            <a href="{{ route('client.login') }}" class="text-decoration-none">بازگشت به صفحه ورود</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
