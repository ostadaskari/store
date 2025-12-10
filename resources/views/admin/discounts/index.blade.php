@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h3>کپن‌ها</h3>
        <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary mb-2">ایجاد کپن جدید</a>

        <div class="mb-3">
            <input type="text" id="discount-search" value="{{ $q }}" placeholder="جستجو..." class="form-control" />
        </div>

        <table class="table">
            <thead><tr><th>کد</th><th>نام</th><th>نوع</th><th>مقدار</th><th>فعال</th><th>انقضاء</th><th>عملیات</th></tr></thead>
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


