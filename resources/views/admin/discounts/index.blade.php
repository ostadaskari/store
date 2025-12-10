@extends('admin.layouts.app')

@section('content')
    <div class="container" dir="rtl">
        <div class="seven mt-3">
            <h1>کمپین ها</h1>
        </div>

        <div class="card mb-2 p-3 d-flex flex-row justify-content-between">
            <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary px-2" style="width: 15%;">
                <svg width="28" height="28" fill="currentColor" class="bi bi-node-plus" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M11 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8M6.025 7.5a5 5 0 1 1 0 1H4A1.5 1.5 0 0 1 2.5 10h-1A1.5 1.5 0 0 1 0 8.5v-1A1.5 1.5 0 0 1 1.5 6h1A1.5 1.5 0 0 1 4 7.5zM11 5a.5.5 0 0 1 .5.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2A.5.5 0 0 1 11 5M1.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                </svg>
                ایجاد کپن جدید</a>

            <div class="position-relative w-25">
                <svg width="20" height="20" fill="#985c01" class="bi bi-search" style="position: absolute;z-index: 99;right: 5%;top: 21%;" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                <input type="text" id="discount-search" value="{{ $q }}" placeholder="جستجو..." class="form-control pe-5" style="height:41px;"/>
            </div>
        </div>

        <div class="card p-3">
           <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr">
            <table class="table table-hover align-middle mb-0 text-center" dir="rtl">
                <thead class="table-blue">
                    <tr>
                        <th style="width:10%;">کد</th>
                        <th style="width:10%;">نام</th>
                        <th style="width:10%;">نوع</th>
                        <th style="width:10%;">مقدار</th>
                        <th style="width:10%;">فعال</th>
                        <th style="width:10%;">انقضاء</th>
                        <th style="width:10%;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discounts as $d)
                        <tr>
                            <td>{{ $d->code }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->value }}</td>
                            <td>{{ $d->status ? 'فعال' : 'غیرفعال' }}</td>
                            <td>{{ $d->expire_at?->format('Y-m-d') ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.discounts.edit', $d) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                <form action="{{ route('admin.discounts.destroy', $d) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete" data-name="{{ $d->name }}">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div> 
        </div>
        
        {{ $discounts->links() }}
    </div>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // -----------------------------
            // 1️⃣ AJAX search
            // -----------------------------
            let input = document.getElementById('discount-search');
            let timeout = null;

            input.addEventListener('keyup', function() {
                clearTimeout(timeout);
                let query = this.value;

                if (query.length < 2) return;

                timeout = setTimeout(() => {
                    fetch("{{ route('admin.discounts.ajaxSearch') }}?q=" + encodeURIComponent(query))
                        .then(res => res.json())
                        .then(data => {
                            if (data.html !== undefined) {
                                document.querySelector('tbody').innerHTML = data.html;

                                // Re-bind SweetAlert for newly loaded rows
                                bindDeleteButtons();
                            }
                        });
                }, 300);
            });

            // -----------------------------
            // 2️⃣ SweetAlert delete
            // -----------------------------
            function bindDeleteButtons() {
                document.querySelectorAll('.btn-delete').forEach(btn => {
                    btn.removeEventListener('click', handleDelete); // remove previous listener
                    btn.addEventListener('click', handleDelete);
                });
            }

            function handleDelete() {
                let form = this.closest('.delete-form');
                let name = this.dataset.name;

                Swal.fire({
                    title: `مطمئنید می‌خواهید "${name}" را حذف کنید؟`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'بله، حذف کن',
                    cancelButtonText: 'لغو'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            // Initial binding on page load
            bindDeleteButtons();

        });
    </script>
@endsection


