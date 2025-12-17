{{-- This partial is loaded via AJAX to display the search results and pagination links.
     It receives $user_orders as a paginated collection. --}}

{{-- Re-define status mapping for the partial, as it's needed here --}}
@php
    $statusClasses = [
        'pending'    => 'badge bg-warning text-dark',
        'processing' => 'badge bg-info text-dark',
        'delivered' => 'badge bg-primary',
        'completed'  => 'badge bg-success',
        'canceled'   => 'badge bg-danger',
    ];

    $statusTexts = [
        'pending'    => 'در انتظار',
        'processing' => 'در حال پردازش',
        'delivered' => 'ارسال شده',
        'completed'  => 'تکمیل شده',
        'canceled'   => 'لغو شده',
    ];
@endphp

<div class="accordion accordion-flush" id="accordionFlushInvoices">
    @forelse($user_orders as $order)
        <!-- item (Order ID: {{ $order->id }}) -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                {{-- Dynamic target for Accordion --}}
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-invoice-{{ $order->id }}" aria-expanded="false" aria-controls="flush-collapse-invoice-{{ $order->id }}">
                    <div class="meta-item"><strong>شماره سفارش:</strong><span> {{ $order->order_number }}</span></div>
                    <div class="meta-item"><strong>تاریخ سفارش:</strong><span> {{ jdate($order->created_at)->format('%d %B %Y') }}</span></div>
                    <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{ number_format($order->total_amount) }} تومان</span></div>
                </button>
            </h2>
            {{-- Dynamic ID for Accordion Content --}}
            <div id="flush-collapse-invoice-{{ $order->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushInvoices">
                <div class="accordion-body p-0">
                    <div class="w-100 my-2 bg-light">
                        <div class="order-meta-grid">
                            <div class="meta-item"><strong>شماره سفارش:</strong><span> {{ $order->order_number }}</span></div>
                            <div class="meta-item"><strong>تاریخ سفارش:</strong><span> {{ jdate($order->created_at)->format('%A, %d %B %y') }}</span></div>
                            <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{ number_format($order->total_amount) }} تومان</span></div>
                            <div class="meta-item"><strong>وضعیت سفارش:</strong>
                                @php
                                    $statusClass = $statusClasses[$order->status] ?? 'badge bg-secondary';
                                    $statusText  = $statusTexts[$order->status] ?? 'نامشخص';
                                @endphp

                                <span class="{{ $statusClass }} px-3 py-2 rounded-pill">
                                    {{ $statusText }}
                                </span>
                            </div>
                            {{-- Note: Tracking code span should contain the actual tracking number --}}
                            <div class="meta-item d-flex align-items-center gap-2">
                                <strong>شماره پیگیری پستی:</strong>
                                <span class="trackingCode">{{ $order->tracking_code ?? 'نامشخص' }}</span>
                                <svg width="16" height="16" fill="currentColor" class="bi bi-copy copy-icon" viewBox="0 0 16 16" role="button" style="cursor: pointer;">
                                    <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                </svg>
                            </div>
                            <div class="meta-item"><strong>ارسال از طریق:</strong><span> {{ $order->shipping->name ?? 'نامشخص' }}</span></div>

                            <div class="meta-item"><strong>مشاهده فاکتور:</strong>
                                {{-- Dynamic target for Modal --}}
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal-{{ $order->id }}" style="font-size: 14px;">
                                    <svg width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Order Progress Bar/Icons (Simplified example) --}}
                        <div class="order-progress-container px-3 pb-3 pt-5 d-flex align-items-center justify-content-between" style="position: relative;">
                            <!-- Progress Bar -->
                            <div class="progress position-absolute w-100" style="height: 8px; top: 15px; left: 0; padding: 0 50px;">
                                {{-- Dynamic width based on status: 10% (Pending), 50% (Processing), 100% (Delivered/Completed) --}}
                                @php
                                    $progressWidth = match($order->status) {
                                        'pending' => 10,
                                        'processing' => 50,
                                        'delivered', 'completed' => 100,
                                        default => 0,
                                    };
                                    $progressBg = match($order->status) {
                                        'pending' => 'bg-warning',
                                        'processing' => 'bg-info',
                                        'delivered', 'completed' => 'bg-success',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <div class="progress-bar {{ $progressBg }} progress-bar-striped" role="progressbar" style="width: {{ $progressWidth }}%;" aria-valuenow="{{ $progressWidth }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- Icons -->
                            <div class="progress-step text-center {{ $progressWidth >= 10 ? 'text-success' : 'text-muted' }}" title="در انتظار">
                                <i class="bi bi-hourglass-split" style="font-size: 1.5rem;"></i><br>
                                <small>در انتظار</small>
                            </div>
                            <div class="progress-step text-center {{ $progressWidth >= 50 ? 'text-success' : 'text-muted' }}" title="در حال پردازش">
                                <i class="bi bi-gear" style="font-size: 1.5rem;"></i><br>
                                <small>پردازش</small>
                            </div>
                            <div class="progress-step text-center {{ $progressWidth >= 100 ? 'text-success' : 'text-muted' }}" title="تحویل داده شده">
                                <i class="bi bi-box-seam" style="font-size: 1.5rem;"></i><br>
                                <small>ارسال شده</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end itme -->


        <!--======== DYNAMIC MODAL FOR INVOICE (Inside the loop) ===============-->
        {{-- You need the full modal HTML here because it must exist on the page to be targeted by data-bs-target --}}
        <div class="modal fade" id="invoiceModal-{{ $order->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel-{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header justify-content-between">
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                        <h5 class="modal-title" id="invoiceModalLabel-{{ $order->id }}">فاکتور سفارش: #{{ $order->order_number }}</h5>
                    </div>
                    <div class="modal-body pt-0">
                        {{-- The rest of your comprehensive invoice details (omitted for brevity, but include your full content here) --}}
                        <p class="text-center text-muted">... محتوای کامل فاکتور برای سفارش {{ $order->order_number }} ...</p>
                        {{-- Re-include the full invoice HTML content here from your original post, which starts with:
                             <div class="container-fluid py-3" dir="rtl">...</div>
                        --}}
                        @include('user.partials.order_detail_content', ['order' => $order]) {{-- Suggestion: Use a sub-partial here --}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        {{-- Add a Print Button for the Modal Content --}}
                        <button type="button" class="btn btn-info text-white" onclick="printModal('invoiceModal-{{ $order->id }}')">
                            <svg width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                            </svg>
                            چاپ فاکتور
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--========= end DYNAMIC modal invoice ============-->
    @empty
        <div class="alert alert-info text-center" role="alert">
            سفارشی با این مشخصات یافت نشد.
        </div>
    @endforelse
</div>

{{-- Pagination Links for AJAX --}}
<div class="d-flex justify-content-center mt-4">
    {{ $user_orders->links('pagination::bootstrap-5') }}
</div>
