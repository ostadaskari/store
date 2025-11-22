@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>روش‌های ارسال</h3>
            <a href="{{ route('admin.shippings.index') }}" class="btn btn-secondary">بازنشانی فیلتر</a>
        </div>

        <div class="row">
            <div class="col-md-7">
                {{-- search --}}
                <form class="mb-3" method="GET" action="{{ route('admin.shippings.index') }}">
                    <div class="input-group">
                        <input name="q" class="form-control" placeholder="جستجو..." value="{{ $q }}">
                        <button class="btn btn-outline-secondary">جستجو</button>
                    </div>
                </form>

                {{-- list --}}
                <table class="table table-striped">
                    <thead>
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

                {{ $shippings->withQueryString()->links() }}
            </div>

            <div class="col-md-5">
                {{-- form for create or edit --}}
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $editing ? 'ویرایش روش ارسال' : 'ایجاد روش ارسال' }}</h5>

                        <form method="POST"
                              action="{{ $editing ? route('admin.shippings.update', $editing) : route('admin.shippings.store') }}">
                            @csrf
                            @if($editing) @method('PUT') @endif

                            <div class="mb-2">
                                <label>نام</label>
                                <input name="name" class="form-control" required value="{{ old('name', $editing->name ?? '') }}">
                            </div>

                            <div class="mb-2">
                                <label>slug (اختیاری)</label>
                                <input name="slug" class="form-control" value="{{ old('slug', $editing->slug ?? '') }}">
                                <small class="text-muted">اگر خالی بگذارید از نام ساخته می‌شود</small>
                            </div>

                            <div class="mb-2">
                                <label>قیمت (تومان)</label>
                                <input name="price" type="number" class="form-control" required value="{{ old('price', $editing->price ?? 0) }}">
                            </div>

                            <div class="mb-2">
                                <label>زمان تحویل</label>
                                <input name="delivery_time" class="form-control" value="{{ old('delivery_time', $editing->delivery_time ?? '') }}">
                            </div>

                            <div class="mb-2 row">
                                <div class="col">
                                    <label>حداقل وزن (اختیاری)</label>
                                    <input name="min_weight" type="number" step="0.01" class="form-control" value="{{ old('min_weight', $editing->min_weight ?? '') }}">
                                </div>
                                <div class="col">
                                    <label>حداکثر وزن (اختیاری)</label>
                                    <input name="max_weight" type="number" step="0.01" class="form-control" value="{{ old('max_weight', $editing->max_weight ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label>ترتیب نمایش</label>
                                <input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $editing->sort_order ?? 100) }}">
                            </div>

                            <div class="mb-3 form-check">
                                {{-- 🛑 NEW HIDDEN FIELD: Sends '0' if the checkbox is unchecked --}}
                                <input type="hidden" name="status" value="0">
                                <input name="status" type="checkbox" class="form-check-input" id="status" {{ old('status', $editing->status ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">فعال</label>
                            </div>

                            <button class="btn btn-success">{{ $editing ? 'بروزرسانی' : 'ایجاد' }}</button>
                            @if($editing)
                                <a href="{{ route('admin.shippings.index') }}" class="btn btn-secondary">لغو</a>
                            @endif
                        </form>
                    </div>
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


