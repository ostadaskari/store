@extends('admin.layouts.app')


@section('content')
    <div class="content-section" dir="rtl">
        <div class="seven mt-3">
            <h1>اضافه کردن ادمین</h1>
        </div>
        <div class="card card-primary card-outline mb-4">
            <a href="" class="btnBack" title="بازگشت">
                <svg width="24" height="24" fill="currentColor" class="bi bi-arrow-right-circle icon-transition" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                </svg>
            </a>  
            <form action="" method="post" class="formStyle">
                @csrf
                <div class="card-body px-4 pt-4">
                   
                    {{-- name --}}
                    <div class="mb-4 row form-row-aligned">
                        <div class="col-12 col-md-3 px-0">
                            <label class="form-label form-label-horizontal required">🏷️ نام و نام خانوادگی:</label>
                        </div>
                        <div class="col-12 col-md-7">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-modern" autocomplete="off" placeholder="نام و نام خانوادگی">
                        </div>
                    </div>

                    {{-- email --}}
                    <div class="mb-4 row form-row-aligned">
                        <div class="col-12 col-md-3 px-0">
                            <label class="form-label form-label-horizontal required">📧 ایمیل:</label>
                        </div>
                        <div class="col-12 col-md-7">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-modern ltr-input" autocomplete="off" placeholder="example@domain.com">
                            <div class="form-error-message mt-1">{{ $errors->first('email') }}</div>
                        </div>
                    </div> 
                   
                    {{-- password --}}
                    <div class="mb-4 row form-row-aligned">
                        <div class="col-12 col-md-3 px-0">
                            <label class="form-label form-label-horizontal required">🔑 پسوورد:</label>
                        </div>
                        <div class="col-12 col-md-7">
                            <input type="password" name="password" class="form-control form-control-modern" autocomplete="off" placeholder="حداقل 8 کاراکتر">
                        </div>
                    </div>

                    {{-- status --}}
                    <div class="mb-4 row form-row-aligned">
                        <div class="col-12 col-md-3 px-0">
                            <label class="form-label form-label-horizontal">🚦 وضعیت:</label>
                        </div>
                        <div class="col-12 col-md-7">
                            <select class="form-control form-control-modern select-modern" name="status">
                                <option {{ old('status') == 0 ? 'selected' : '' }} value="0">فعال</option>
                                <option {{ old('status') == 1 ? 'selected' : '' }} value="1">غیرفعال</option>
                            </select>
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer d-flex justify-content-end pb-4 border-top-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-submit-modern">ثبت اطلاعات</button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>


@endsection

@section('script')
@endsection
