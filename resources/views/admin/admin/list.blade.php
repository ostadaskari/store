@extends('admin.layouts.app')

@section('content')
<div class="content-section" dir="rtl">
     <div class="seven mt-3">
        <h1>لیست ادمین ها</h1>
    </div>
    <div class="card mb-4 p-3">
        <div class="card-header row justify-between-end">
            
            <div class="col-12 px-0">
                <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">
                    <svg width="20" height="20" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                    </svg>
                    اضافه کردن ادمین</a>
            </div>

        </div>
        @include('admin.layouts._message')
        <!-- /.card-header -->
        <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr">
            <table class="table table-hover table-striped align-middle mb-0 text-center" dir="rtl" role="table">
              <thead class="table-blue">
                <tr>
                    <th style="width: 3%;">#</th>
                    <th style="width: 20%;">نام</th>
                    <th style="width: 40%;">ایمیل</th>
                    <th style="width: 10%;">وضعیت</th>
                    <th style="width: 10%;">عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($getRecord as $value)
                    <tr class="align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                        <td class="d-flex flex-row">
                            <a href="{{ url('admin/admin/edit/'.$value->id) }}" class="btn btn-sm btn-primary mx-1">Edit</a>
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
