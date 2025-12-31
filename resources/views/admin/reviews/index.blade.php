@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" dir="rtl">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">مدیریت نظرات کاربران</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>تاریخ</th>
                            <th>کاربر</th>
                            <th>محصول</th>
                            <th>شماره سفارش</th>
                            <th>وضعیت</th>
                            <th>پاسخ مدیر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $review)
                            <tr id="review-row-{{ $review->id }}">
                                <td class="small">{{ $review->created_at->format('Y/m/d H:i') }}</td>
                                <td>{{ $review->user->name ?? 'ناشناس' }}</td>
                                <td class="small">{{ $review->product->part_number ?? '-' }}</td>
                                <td class="small">{{ $review->order->order_number ?? '-' }}</td>
                                <td>
                                    <select class="form-select form-select-sm status-toggle" data-id="{{ $review->id }}">
                                        <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>در انتظار</option>
                                        <option value="approved" {{ $review->status == 'approved' ? 'selected' : '' }}>تایید شده</option>
                                        <option value="rejected" {{ $review->status == 'rejected' ? 'selected' : '' }}>رد شده</option>
                                    </select>
                                </td>
                                <td>
                                    @if($review->admin_reply)
                                        <span class="badge bg-success">پاسخ داده شده</span>
                                    @else
                                        <span class="badge bg-secondary">بدون پاسخ</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-primary btn-sm px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $review->id }}">
                                            مشاهده
                                        </button>

                                        <button class="btn btn-outline-info btn-sm px-3 open-reply-modal"
                                                data-id="{{ $review->id }}"
                                                data-reply="{{ $review->admin_reply }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#replyModal">
                                            پاسخ مدیر
                                        </button>

                                        <button class="btn btn-outline-danger btn-sm px-3 delete-review"
                                                data-id="{{ $review->id }}">
                                            حذف
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $review->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title">متن نظر - {{ $review->user->name }}</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="p-3 bg-light rounded mb-3">
                                                <strong>نظر کاربر:</strong>
                                                <p class="mt-2 mb-0">{{ $review->comment }}</p>
                                            </div>
                                            @if($review->admin_reply)
                                                <div class="p-3 border-start border-4 border-info rounded">
                                                    <strong>پاسخ شما:</strong>
                                                    <p class="mt-2 mb-0">{{ $review->admin_reply }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- بخش صفحه‌بندی -->
                <div class="card-footer bg-white border-0 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-muted small">
                        نمایش {{ $reviews->firstItem() }} تا {{ $reviews->lastItem() }} از مجموع {{ $reviews->total() }} نظر
                    </div>
                    <div dir="ltr">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Universal Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">مدیریت پاسخ مدیر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="replyForm">
                        <input type="hidden" id="reply_review_id">
                        <div class="mb-3">
                            <label for="admin_reply_text" class="form-label">متن پاسخ شما:</label>
                            <textarea class="form-control" id="admin_reply_text" rows="5" placeholder="پاسخ خود را اینجا بنویسید..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-danger" id="deleteReplyBtn" style="display: none;">حذف پاسخ</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                        <button type="button" class="btn btn-primary" id="submitReply">ذخیره پاسخ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
            });

            // 1. Handle Reply Modal Data
            $('.open-reply-modal').on('click', function() {
                const id = $(this).data('id');
                const existingReply = $(this).data('reply');

                $('#reply_review_id').val(id);
                $('#admin_reply_text').val(existingReply);

                // Show/Hide Delete Reply Button
                if(existingReply && existingReply.toString().trim() !== '') {
                    $('#deleteReplyBtn').show();
                } else {
                    $('#deleteReplyBtn').hide();
                }
            });

            // 2. Submit Reply via AJAX
            $('#submitReply').on('click', function() {
                const reviewId = $('#reply_review_id').val();
                const replyText = $('#admin_reply_text').val();
                const btn = $(this);

                if(!replyText.trim()) {
                    Swal.fire('خطا', 'لطفاً متن پاسخ را وارد کنید', 'error');
                    return;
                }

                btn.prop('disabled', true).text('در حال ارسال...');

                $.ajax({
                    url: "{{ route('admin.reviews.reply') }}",
                    type: "POST",
                    data: { review_id: reviewId, reply: replyText },
                    success: function(response) {
                        if(response.success) {
                            $('#replyModal').modal('hide');
                            Swal.fire({ icon: 'success', title: 'موفق', text: 'پاسخ ثبت شد', timer: 1500, showConfirmButton: false }).then(() => location.reload());
                        }
                    },
                    error: function() { Swal.fire('خطا', 'مشکلی رخ داد', 'error'); },
                    complete: function() { btn.prop('disabled', false).text('ذخیره پاسخ'); }
                });
            });

            // 3. Delete Reply ONLY
            $('#deleteReplyBtn').on('click', function() {
                const id = $('#reply_review_id').val();

                Swal.fire({
                    title: 'حذف پاسخ مدیر؟',
                    text: "متن پاسخ شما حذف خواهد شد اما نظر کاربر باقی می‌ماند.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله، حذف پاسخ',
                    cancelButtonText: 'لغو'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/reviews/" + id + "/reply",
                            type: "DELETE",
                            success: function(res) {
                                if(res.success) {
                                    $('#replyModal').modal('hide');
                                    Swal.fire('حذف شد', 'پاسخ شما حذف گردید', 'success').then(() => location.reload());
                                }
                            }
                        });
                    }
                });
            });

            // 4. Status Change
            $('.status-toggle').on('change', function() {
                const id = $(this).data('id');
                const status = $(this).val();
                $.post("{{ route('admin.reviews.updateStatus') }}", { review_id: id, status: status }, function(res) {
                    if(res.success) {
                        Swal.fire({ icon: 'success', title: 'بروزرسانی شد', timer: 1000, toast: true, position: 'top-end', showConfirmButton: false });
                    }
                });
            });

            // 5. Delete Full Review
            $('.delete-review').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: "این نظر به طور کامل حذف خواهد شد.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله، حذف شود',
                    cancelButtonText: 'لغو'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/reviews/" + id,
                            type: "DELETE",
                            success: function() {
                                $('#review-row-' + id).fadeOut();
                                Swal.fire('حذف شد', '', 'success');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
