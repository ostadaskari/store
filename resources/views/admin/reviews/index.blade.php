@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" dir="rtl">
         <div class="seven mt-3">
            <h1>مدیریت نظرات کاربران</h1>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-blue">
                        <tr>
                            <th style="width:10%;">تاریخ</th>
                            <th style="width:10%;">کاربر</th>
                            <th style="width:10%;">محصول</th>
                            <th style="width:10%;">شماره سفارش</th>
                            <th style="width:10%;">وضعیت</th>
                            <th style="width:10%;">پاسخ مدیر</th>
                            <th style="width:10%;">عملیات</th>
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
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-outline-primary btn-sm "
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $review->id }}" title="مشاهده نظر">
                                           <svg width="18" height="18" fill="#0d6efd" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                            </svg>
                                        </button>

                                        <button class="btn btn-outline-info btn-sm open-reply-modal"
                                                data-id="{{ $review->id }}"
                                                data-reply="{{ $review->admin_reply }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#replyModal" title="پاسخ مدیر">
                                            پاسخ مدیر
                                        </button>

                                        <button class="btn btn-outline-danger btn-sm delete-review"
                                                data-id="{{ $review->id }}" title="حذف">
                                           <svg width="18" height="18" fill="#dc3545" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $review->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title modalTextColor">متن نظر - {{ $review->user->name }}</h6>
                                            <button type="button" class="btn-close m-0" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body modalTextColor">
                                            <div class="p-3 bg-light border rounded mb-3">
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
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true" dir="rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modalTextColor" id="replyModalLabel">مدیریت پاسخ مدیر</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="replyForm">
                        <input type="hidden" id="reply_review_id">
                        <div class="mb-3">
                            <label for="admin_reply_text" class="modalTextColor" class="form-label">متن پاسخ شما:</label>
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
