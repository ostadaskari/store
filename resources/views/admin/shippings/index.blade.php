@extends('admin.layouts.app')

@section('content')
    <div class="container px-0" dir="rtl">
        <div class="seven mt-3">
            <h1>روش های ارسال</h1>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.shippings.index') }}" class="btn btn-secondary">بازنشانی فیلتر</a>
        </div>

        <div class="row">

            <div class="col-md-5">
                {{-- form for create or edit --}}
                <div class="card">
                    <div class="card-body">
                        <div class="seven">
                            <h1>{{ $editing ? 'ویرایش روش ارسال' : 'ایجاد روش ارسال' }}</h1>
                        </div>

                        <form method="POST"
                              action="{{ $editing ? route('admin.shippings.update', $editing) : route('admin.shippings.store') }}">
                            @csrf
                            @if($editing) @method('PUT') @endif

                            <div class="mb-2">
                                <label class="mb-1 px-2">نام:</label>
                                <input name="name" class="form-control mb-3" required value="{{ old('name', $editing->name ?? '') }}">
                            </div>

                            <div class="mb-2">
                                <label class="mb-1 px-2">slug (اختیاری):</label>
                                <input name="slug" class="form-control" value="{{ old('slug', $editing->slug ?? '') }}">
                                <small class="text-danger mb-3">اگر خالی بگذارید از نام ساخته می‌شود</small>
                            </div>

                            <div class="mb-2">
                                <label class="mb-1 px-2">قیمت (تومان):</label>
                                <input name="price" type="number" class="form-control mb-3" required value="{{ old('price', $editing->price ?? 0) }}">
                            </div>

                            <div class="mb-2">
                                <label class="mb-1 px-2">زمان تحویل:</label>
                                <input name="delivery_time" class="form-control mb-3" value="{{ old('delivery_time', $editing->delivery_time ?? '') }}">
                            </div>

                            <div class="mb-2 row">
                                <div class="col">
                                    <label class="mb-1 px-2">حداقل وزن (اختیاری):</label>
                                    <input name="min_weight" type="number" step="0.01" class="form-control mb-3" value="{{ old('min_weight', $editing->min_weight ?? '') }}">
                                </div>
                                <div class="col">
                                    <label class="mb-1 px-2">حداکثر وزن (اختیاری):</label>
                                    <input name="max_weight" type="number" step="0.01" class="form-control mb-3" value="{{ old('max_weight', $editing->max_weight ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="mb-1 px-2">ترتیب نمایش:</label>
                                <input name="sort_order" type="number" class="form-control mb-3" value="{{ old('sort_order', $editing->sort_order ?? 100) }}">
                            </div>

                            <div class="mb-3 form-check">
                                {{-- 🛑 NEW HIDDEN FIELD: Sends '0' if the checkbox is unchecked --}}
                                <input type="hidden" name="status" value="0">
                                <input name="status" type="checkbox" class="form-check-input" id="status" {{ old('status', $editing->status ?? true) ? 'checked' : '' }}>
                                <label class="mb-1 px-2" class="form-check-label" for="status">فعال</label>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success mx-2">{{ $editing ? 'بروزرسانی' : 'ایجاد' }}</button>
                                @if($editing)
                                    <a href="{{ route('admin.shippings.index') }}" class="btn btn-secondary">لغو</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card p-3">
                    {{-- search --}}
                <form class="mb-3" method="GET" action="{{ route('admin.shippings.index') }}">
                    <div class="position-relative">
                        <button class="btn btn-success position-absolute start-0 pb-1" style="padding-top:5.29px;">جستجو</button>
                        <svg width="20" height="20" fill="#985c01" class="bi bi-search position-absolute" style="right: 10px;top: 8px;z-index: 10;" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        <input name="q" class="form-control pe-5" placeholder="جستجو..." value="{{ $q }}">
                    </div>
                </form>

                {{-- list --}}
                <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr" id="seo-table">

                    <table class="table table-hover table-striped align-middle mb-0 text-center" dir="rtl">
                        <thead class="table-blue">
                        <tr>
                            <th>نام</th>
                            <th>قیمت</th>
                            <th>زمان تحویل</th>
                            <th>فعال</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shippings as $s)
                            <tr id="shipping-{{ $s->id }}">
                                <td>{{ $s->name }}</td>
                                <td>{{ number_format($s->price) }} تومان</td>
                                <td>{{ $s->delivery_time ?? '-' }}</td>
                                <td>
                                    <input type="checkbox" class="toggle-status" data-id="{{ $s->id }}" {{ $s->status ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <a href="{{ route('admin.shippings.index', ['edit' => $s->id]) }}" class="btn btn-sm btn-primary">ویرایش</a>

                                    <form action="{{ route('admin.shippings.destroy', $s) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('مطمئن هستید؟')">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $shippings->withQueryString()->links() }}
                </div>   
            </div>

            
        </div>
    </div>
@endsection

@section('script')
    <script>
        // toggle status (ajax)
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-status').forEach(cb => {
                cb.addEventListener('change', function () {
                    let id = this.dataset.id;
                    fetch("{{ url('admin/shippings') }}/" + id + "/toggle-status", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                    })
                        .then(r => r.json())
                        .then(d => {
                            // optional: show toast
                        });
                });
            });
        });
    </script>
@endsection


