@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid" dir="rtl">
        <div class="seven mt-3">
            <h1>مدیریت پیام‌های تماس</h1>
        </div>



        <div class="card shadow-sm border-0">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center text-nowrap">
                        <thead class="table-blue" style="background-color: #f8f9fa;">
                        <tr>
                            <th style="width:5%;">#</th>
                            <th style="width:15%;">تاریخ</th>
                            <th style="width:15%;">نام فرستنده</th>
                            <th style="width:15%;">شماره تماس</th>
                            <th style="width:10%;">وضعیت</th>
                            <th style="width:20%;">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($messages as $message)
                            <tr id="row-{{ $message->id }}">
                                <td>{{ $loop->iteration + ($messages->currentPage() - 1) * $messages->perPage() }}</td>
                                <td class=" small">{{ jdate($message->created_at)->format('Y/m/d H:i') }}</td>
                                <td class="fw-bold">{{ $message->name }}</td>
                                <td class="ltr">{{ $message->phone }}</td>
                                <td>
                                    <span id="badge-{{ $message->id }}" class="badge {{ $message->is_read ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3">
                                        {{ $message->is_read ? 'خوانده شده' : 'جدید' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary show-message-btn"
                                                data-id="{{ $message->id }}"
                                                data-name="{{ $message->name }}"
                                                data-phone="{{ $message->phone }}"
                                                data-email="{{ $message->email ?? 'ثبت نشده' }}"
                                                data-message="{{ $message->message }}"
                                                data-url="{{ route('admin.messages.show', $message->id) }}">
                                            <i class="bi bi-eye"></i> مشاهده
                                        </button>

                                        <!-- delete form -->
                                        <form id="delete-form-{{ $message->id }}" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $message->id }}">
                                                <i class="bi bi-trash"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4">هیچ پیامی یافت نشد.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4" dir="ltr">
            {{ $messages->links() }}
        </div>
    </div>

    <!-- Modal مشاهده پیام -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modalTextColor">
                    <button type="button" class="btn-close mx-0" data-bs-dismiss="modal" aria-label="Close" style="margin-right: auto; margin-left: 0;"></button>
                    <h5 class="modal-title">جزئیات پیام</h5>
                </div>
                <div class="modal-body text-end modalTextColor" dir="rtl">
                    <div class="mb-2">
                        <label class="fw-bold text-primary">فرستنده:</label>
                        <span id="modal-sender-name"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-primary">تماس:</label>
                        <span id="modal-sender-contact" class="ltr d-inline-block"></span>
                    </div>
                    <hr>
                    <div class="mb-2">
                        <label class="fw-bold text-primary d-block mb-2">متن پیام:</label>
                        <div id="modal-message-body" class="p-3 bg-light rounded" style="white-space: pre-wrap; min-height: 100px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // show modal
            const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            document.querySelectorAll('.show-message-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById('modal-sender-name').textContent = this.getAttribute('data-name');
                    document.getElementById('modal-sender-contact').textContent = this.getAttribute('data-phone') + ' / ' + this.getAttribute('data-email');
                    document.getElementById('modal-message-body').textContent = this.getAttribute('data-message');
                    messageModal.show();

                    fetch(this.getAttribute('data-url'), {
                        method: 'GET',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    }).then(response => {
                        if (response.ok) {
                            const badge = document.getElementById('badge-' + id);
                            badge.textContent = 'خوانده شده';
                            badge.className = 'badge bg-success-subtle text-success px-3';
                        }
                    });
                });
            });

            // delete part
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    const messageId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'آیا مطمئن هستید؟',
                        text: "این پیام برای همیشه حذف خواهد شد!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'بله، حذف شود',
                        cancelButtonText: 'انصراف',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //send delte form
                            document.getElementById('delete-form-' + messageId).submit();
                        }
                    });
                });
            });
        });
    </script>

@endsection
