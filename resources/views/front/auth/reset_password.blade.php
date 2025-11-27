@extends('front.layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5" dir="rtl">
                        <h4 class="card-title text-center fw-bold mb-4">تغییر رمز عبور</h4>

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

                        <p class="text-muted small mb-4">کد تایید را وارد کرده و رمز عبور جدید خود را انتخاب نمایید.
                            <span class="fw-bold d-block mt-2">شماره موبایل: {{ $mobile }}</span>
                        </p>

                        <form method="POST" action="{{ route('client.password.update') }}">
                            @csrf
                            <input type="hidden" name="mobile" value="{{ $mobile }}">

                            <div class="mb-3">
                                <label for="code" class="form-label">کد تایید (۴ رقمی)</label>
                                <input type="text" class="form-control text-center" id="code" name="code" maxlength="4" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">رمز عبور جدید</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">تکرار رمز عبور جدید</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-2">تغییر رمز عبور</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
