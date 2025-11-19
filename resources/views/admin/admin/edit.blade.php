@extends('admin.layouts.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="content-section" dir="rtl">
        <div class="card card-primary card-outline mb-4">

            <div class="card-header"><div class="card-title">ویرایش ادمین</div></div>

            <form action="" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-6 col-sm-4">
                            <label  class="form-label">نام</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $getRecord->name) }}">
                        </div>
                        <div class=" col-6 col-sm-4">
                            <label  class="form-label">ایمیل </label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $getRecord->email) }}">
                            <div style="color:red;">{{ $errors->first('email') }}</div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6 col-sm-4">
                            <label  class="form-label">پسوورد</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-3 col-sm-2 ">
                            <label for="">status</label>
                            <select class="form-control" name="status" id="">
                                <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">فعال</option>
                                <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">غیرفعال</option>
                            </select>
                        </div>
                    </div>



                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">update</button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>


@endsection

@section('script')
@endsection
