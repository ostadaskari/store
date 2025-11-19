@extends('admin.layouts.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="content-section" dir="rtl">
        <div class="card card-primary card-outline mb-4">

            <div class="card-header"><div class="card-title">اضافه کردن ادمین</div></div>

            <form action="" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class=" col-4">
                            <label  class="form-label">نام</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" autocomplete="off">
                        </div>
                        <div class=" col-4">
                            <label  class="form-label">ایمیل </label>
                            <input type="email" name="email" value="{{ old('email') }}"  class="form-control" autocomplete="off">
                            <div style="color:red;">{{ $errors->first('email') }}</div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-3">
                            <label  class="form-label">پسوورد</label>
                            <input type="password" name="password" class="form-control" autocomplete="off">
                        </div>
                        <div class="col-2 col-sm-3">
                            <label for="">status</label>
                            <select class="form-control" name="status" id="">
                                <option {{ old('status') == 0 ? 'selected' : '' }} value="0">فعال</option>
                                <option {{ old('status') == 1 ? 'selected' : '' }} value="1">غیرفعال</option>
                            </select>
                        </div>
                    </div>



                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>


@endsection

@section('script')
@endsection
