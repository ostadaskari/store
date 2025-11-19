@extends('admin.layouts.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
<div class="content-section" dir="rtl">
    <div class="card mb-4">
        <div class="card-header row justify-between-end">
            <h3 class="card-title col-sm-6">لیست ادمین ها:</h3>
            <div class="col-sm-6" style="text-align: end;">
                <a href="{{ url('admin/admin/add') }}" class="btn btn-primary" >اضافه کردن ادمین</a>
            </div>

        </div>
        @include('admin.layouts._message')
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped" role="table">
                <thead>
                <tr>
                    <th >#</th>
                    <th >نام</th>
                    <th >ایمیل</th>
                    <th >وضعیت</th>
                    <th >عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($getRecord as $value)
                    <tr class="align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ url('admin/admin/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>


@endsection

@section('script')
@endsection
