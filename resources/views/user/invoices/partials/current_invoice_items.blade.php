@php
    // Define status mappings for consistency
    $statusClasses = [
    'pending'    => 'badge bg-warning text-dark',
    'processing' => 'badge bg-info text-dark',
    'delivered'  => 'badge bg-primary',
    'completed'  => 'badge bg-success',
    'canceled'   => 'badge bg-danger',
    ];

    $statusTexts = [
        'pending'    => 'در انتظار',
        'processing' => 'در حال پردازش',
        'delivered'  => 'ارسال شده',
        'completed'  => 'تکمیل شده',
        'canceled'   => 'لغو شده',
    ];


@endphp

<div class="accordion accordion-flush" id="accordionFlushCurrent">
    @forelse($user_invoices as $invoice)
        <!-- item (Invoice ID: {{ $invoice->id }}) -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $invoice->id }}" aria-expanded="false" aria-controls="flush-collapse-{{ $invoice->id }}">
                    <div class="meta-item"><strong>شماره فاکتور:</strong><span> {{ $invoice->order_number }}</span></div>
                    <div class="meta-item"><strong>تاریخ فاکتور:</strong><span> {{ jdate($invoice->created_at)->format('%d %B %Y') }}</span></div>
                    <div class="meta-item"><strong>مبلغ فاکتور:</strong><span> {{ number_format($invoice->total_amount) }} تومان</span></div>
                </button>
            </h2>
            <div id="flush-collapse-{{ $invoice->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushCurrent">
                <div class="accordion-body p-0">
                    <div class="w-100 my-2 bg-light">
                        <div class="order-meta-grid">
                            <div class="meta-item"><strong>شماره فاکتور:</strong><span> {{ $invoice->order_number }}</span></div>
                            <div class="meta-item"><strong>تاریخ فاکتور:</strong><span> {{ jdate($invoice->created_at)->format('%A, %d %B %y') }}</span></div>
                            <div class="meta-item"><strong>مبلغ فاکتور:</strong><span> {{ number_format($invoice->total_amount) }} تومان</span></div>
                            <div class="meta-item"><strong>وضعیت فاکتور:</strong>
                                @php
                                    $statusKey = $invoice->status ?? 'unknown';
                                    $statusClass = $statusClasses[$statusKey] ?? 'badge bg-secondary';
                                    $statusText  = $statusTexts[$statusKey] ?? 'نامشخص';
                                @endphp
                                <span class="{{ $statusClass }} px-3 py-2 rounded-pill">
{{ $statusText }}
</span>
                            </div>
                            <div class="meta-item d-flex align-items-center gap-2">
                                <strong>شماره پیگیری پستی:</strong>
                                <span class="trackingCode">{{ $invoice->tracking_code ?? 'نامشخص' }}</span>
                                <svg width="16" height="16" fill="currentColor" class="bi bi-copy copy-icon" viewBox="0 0 16 16" role="button" style="cursor: pointer;">
                                    <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                </svg>
                            </div>
                            <div class="meta-item"><strong>ارسال از طریق:</strong><span> {{ $invoice->shipping->name ?? 'نامشخص' }}</span></div>

                            <div class="meta-item"><strong>مشاهده فاکتور:</strong>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal-{{ $invoice->id }}" style="font-size: 14px;">
                                    <svg width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="order-progress" style="position: relative; height: 40px; margin-top: 80px;">
                            <div class="car">
                                <svg width="40" height="40" fill="black" class="bi bi-truck" viewBox="0 0 16 16">
                                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                </svg>
                            </div>
                            <svg width="35" height="35" viewBox="0 0 16 16" class="bi bi-shop-icon">
                                <defs>
                                    <linearGradient id="coffeeGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#7B3F00" />
                                        <stop offset="50%" stop-color="#A0522D" />
                                        <stop offset="100%" stop-color="#D2B48C" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#coffeeGradient)" d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                            </svg>
                            <div class="progress" style="height: 10px;">
                                @php
                                    $progressWidth = match($statusKey) {
                                        'pending' => '10%',
                                        'processing' => '50%',
                                        'delivered' => '80%',
                                        'completed' => '100%',
                                        default => '0%',
                                    };
                                @endphp
                                <div class="progress-bar bg-warning text-dark progress-bar-striped" role="progressbar" style="width: {{ $progressWidth }};">
                                </div>
                            </div>
                            <svg width="40" height="40" viewBox="0 0 16 16" class="bi bi-house-heart-fill house-icon">
                                <defs>
                                    <linearGradient id="fancyGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#ff6f91"/>
                                        <stop offset="50%" stop-color="#ff9671"/>
                                        <stop offset="100%" stop-color="#ffc75f"/>
                                    </linearGradient>
                                </defs>
                                <path fill="url(#fancyGradient)" d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
                                <path fill="url(#fancyGradient)" d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--======== DYNAMIC MODAL FOR INVOICE (Inside the loop) ===============-->
        <div class="modal fade" id="invoiceModal-{{ $invoice->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel-{{ $invoice->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <style>
                        .original-price-strikethrough { text-decoration: line-through; color: #999; font-size: 0.85em; }
                        .badge-discount { background-color: #f8d7da; color: #721c24; padding: 2px 5px; border-radius: 4px; font-size: 0.75rem; font-weight: bold; }
                    </style>
                    <div class="modal-header justify-content-between">
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                        <h5 class="modal-title" id="invoiceModalLabel-{{ $invoice->id }}">فاکتور سفارش: #{{ $invoice->order_number }}</h5>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="container-fluid py-3" dir="rtl">
                            <div class="seven mt-3">
                                <h1>جزئیات فاکتور #{{ $invoice->order_number }}</h1>
                                <p class="text-muted" style="font-size: 0.9rem;">این اطلاعات برای چاپ فاکتور شما آماده شده است.</p>
                            </div>

                            <div class="row">
                                <!-- General Invoice Details -->
                                <div class="col-12 col-lg-4 mb-2 colPrint">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-header bg-primary text-white text-right">خلاصه فاکتور</div>
                                        <div class="card-body text-right">
                                            <p><strong>تاریخ ثبت:</strong> {{ jdate($invoice->created_at)->format('Y/m/d - H:i') }}</p>
                                            <p><strong>وضعیت پرداخت:</strong>
                                                <span class="badge {{ $invoice->is_payment ? 'bg-success' : 'bg-danger' }}">
                                                {{ $invoice->is_payment ? 'پرداخت شده' : 'پرداخت نشده' }}
                                            </span>
                                            </p>
                                            <p><strong>روش پرداخت:</strong> {{ $invoice->payment_method == 'credit' ? 'آنلاین' : 'نقدی (COD)' }}</p>
                                            <p><strong>وضعیت ارسال:</strong> <span class="{{ $statusClass }}">{{ $statusText }}</span></p>
                                            <p><strong>توضیحات فاکتور:</strong><br>{{ $invoice->note ?? 'ندارد' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8 mb-2 colPrint">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-header bg-info text-white text-right">اطلاعات مشتری و آدرس</div>
                                        <div class="card-body text-right">
                                            @if ($invoice->address)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>اطلاعات گیرنده:</h5>
                                                        <p><strong>مشتری:</strong> {{ $invoice->user->name ?? '' }} {{ $invoice->user->family ?? '' }}</p>
                                                        <p><strong>گیرنده:</strong> {{ $invoice->address->first_name }} {{ $invoice->address->last_name }}</p>
                                                        <p><strong>موبایل:</strong> {{ $invoice->address->mobile }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5>جزئیات آدرس:</h5>
                                                        <p><strong>استان / شهر:</strong> {{ $invoice->address->province }} / {{ $invoice->address->city }}</p>
                                                        <p><strong>آدرس:</strong> {{ $invoice->address->address }}</p>
                                                        <p><strong>کد پستی:</strong> {{ $invoice->address->post_code }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="alert alert-danger text-center">آدرس انتخاب شده حذف شده است.</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-warning text-dark text-right">جزئیات مالی</div>
                                        <div class="card-body text-right">
                                            <p><strong>هزینه ارسال:</strong> {{ number_format($invoice->shipping_amount) }} تومان</p>
                                            <p><strong>مبلغ تخفیف:</strong> {{ number_format($invoice->discount_amount) }} تومان</p>
                                            <hr>
                                            <h4><strong>مبلغ نهایی پرداختی:</strong> <span class="text-danger">{{ number_format($invoice->total_amount) }}</span> تومان</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Invoice Items --}}
                                <div class="col-12">
                                    <div class="seven mt-3"><h1>اقلام فاکتور</h1></div>
                                    <div class="card shadow-sm p-0">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped align-middle mb-0 text-center printTable" dir="rtl">
                                                    <thead class="table-blue">
                                                    <tr>
                                                        <th style="width: 3%;">#</th>
                                                        <th style="width: 10%;">تصویر</th>
                                                        <th style="width: 30%;">محصول (PN)</th>
                                                        <th style="width: 15%;">قیمت اصلی</th>
                                                        <th style="width: 10%;">تخفیف</th>
                                                        <th style="width: 15%;">قیمت نهایی</th>
                                                        <th style="width: 5%;">تعداد</th>
                                                        <th style="width: 12%;">مجموع</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse ($invoice->items as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><img src="{{ $item->product->coverImage->url ?? asset('images/50x50.webp') }}" width="50" style="border-radius: 4px;"></td>
                                                            <td>PN: {{ $item->product->part_number }}</td>
                                                            <td>
                                                                @if($item->discount_percent > 0)
                                                                    <span class="original-price-strikethrough">{{ number_format($item->original_price) }}</span>
                                                                @else
                                                                    {{ number_format($item->price) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($item->discount_percent > 0)
                                                                    <span class="badge-discount">{{ $item->discount_percent }}%</span>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-primary font-weight-bold">{{ number_format($item->price) }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ number_format($item->total_price) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="8" class="py-4">فاکتور فاقد اقلام است.</td></tr>
                                                    @endforelse
                                                    </tbody>
                                                    <tfoot>
                                                    <tr class="table-secondary">
                                                        <td colspan="7" class="text-right"><strong>جمع کل اقلام:</strong></td>
                                                        <td class="font-weight-bold">{{ number_format($invoice->items->sum('total_price')) }}</td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        <button type="button" class="btn btn-info text-white" onclick="printModal('invoiceModal-{{ $invoice->id }}')">
                            <svg width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16"><path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/><path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/></svg>
                            چاپ فاکتور
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">فاکتوری برای نمایش وجود ندارد.</div>
    @endforelse


</div>
