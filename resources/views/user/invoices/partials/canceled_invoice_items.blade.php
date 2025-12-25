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

<div class="accordion accordion-flush" id="accordionFlushCanceled">
    @forelse($user_invoices as $invoice)
        <!-- item (Invoice ID: {{ $invoice->id }}) -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-red-50 text-gray-800 font-semibold flex flex-row items-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $invoice->id }}" aria-expanded="false" aria-controls="flush-collapse-{{ $invoice->id }}">
                    <div class="meta-item"><strong>شماره فاکتور:</strong><span> {{ $invoice->order_number }}</span></div>
                    <div class="meta-item"><strong>تاریخ فاکتور:</strong><span> {{ jdate($invoice->created_at)->format('%d %B %Y') }}</span></div>
                    <div class="meta-item text-danger"><strong>مبلغ فاکتور:</strong><span> {{ number_format($invoice->total_amount) }} تومان</span></div>
                </button>
            </h2>
            <div id="flush-collapse-{{ $invoice->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushCanceled">
                <div class="accordion-body p-0">
                    <div class="w-100 my-2 bg-light">
                        <div class="order-meta-grid">
                            <div class="meta-item"><strong>شماره فاکتور:</strong><span> {{ $invoice->order_number }}</span></div>
                            <div class="meta-item"><strong>تاریخ فاکتور:</strong><span> {{ jdate($invoice->created_at)->format('%A, %d %B %y') }}</span></div>
                            <div class="meta-item"><strong>مبلغ فاکتور:</strong><span> {{ number_format($invoice->total_amount) }} تومان</span></div>
                            <div class="meta-item"><strong>وضعیت فاکتور:</strong>
                                @php
                                    $statusKey = 'canceled';
                                    $statusClass = $statusClasses[$statusKey] ?? 'badge bg-secondary';
                                    $statusText  = $statusTexts[$statusKey] ?? 'نامشخص';
                                @endphp
                                <span class="{{ $statusClass }} px-3 py-2 rounded-pill">
{{ $statusText }}
</span>
                            </div>
                            <div class="meta-item d-flex align-items-center gap-2">
                                <strong>شماره پیگیری:</strong>
                                <span class="trackingCode">{{ $invoice->tracking_code ?? 'لغو شده' }}</span>
                                <svg width="16" height="16" fill="currentColor" class="bi bi-copy copy-icon text-danger" viewBox="0 0 16 16" role="button" style="cursor: pointer;">
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

                        <div class="w-100 my-4 p-3 text-center alert alert-danger">
                            این فاکتور لغو شده و مراحل پردازش یا ارسال آن متوقف شده است.
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
                        <h5 class="modal-title" id="invoiceModalLabel-{{ $invoice->id }}">فاکتور لغو شده: #{{ $invoice->order_number }}</h5>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="container-fluid py-3" dir="rtl">
                            <div class="seven mt-3">
                                <h1>جزئیات فاکتور لغو شده #{{ $invoice->order_number }}</h1>
                                <p class="text-muted" style="font-size: 0.9rem;">این فاکتور به درخواست کاربر یا توسط سیستم لغو شده است.</p>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4 mb-2 colPrint">
                                    <div class="card shadow-sm h-100 border-danger">
                                        <div class="card-header bg-danger text-white text-right">خلاصه وضعیت</div>
                                        <div class="card-body text-right">
                                            <p><strong>تاریخ ثبت:</strong> {{ jdate($invoice->created_at)->format('Y/m/d - H:i') }}</p>
                                            <p><strong>وضعیت پرداخت:</strong>
                                                <span class="badge {{ $invoice->is_payment ? 'bg-success' : 'bg-danger' }}">
                                                {{ $invoice->is_payment ? 'پرداخت شده' : 'پرداخت نشده' }}
                                            </span>
                                            </p>
                                            <p><strong>وضعیت نهایی:</strong> <span class="badge bg-danger">لغو شده</span></p>
                                            <p><strong>علت لغو/توضیحات:</strong><br>{{ $invoice->note ?? 'توضیحاتی ثبت نشده است.' }}</p>
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
                                                        <p><strong>نام گیرنده:</strong> {{ $invoice->address->first_name }} {{ $invoice->address->last_name }}</p>
                                                        <p><strong>موبایل:</strong> {{ $invoice->address->mobile }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5>جزئیات آدرس:</h5>
                                                        <p><strong>استان / شهر:</strong> {{ $invoice->address->province }} / {{ $invoice->address->city }}</p>
                                                        <p><strong>آدرس:</strong> {{ $invoice->address->address }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-warning text-dark text-right">جزئیات مالی (قبل از لغو)</div>
                                        <div class="card-body text-right">
                                            <p><strong>هزینه ارسال:</strong> {{ number_format($invoice->shipping_amount) }} تومان</p>
                                            <p><strong>مبلغ تخفیف:</strong> {{ number_format($invoice->discount_amount) }} تومان</p>
                                            <hr>
                                            <h4><strong>مبلغ فاکتور:</strong> <span class="text-danger">{{ number_format($invoice->total_amount) }}</span> تومان</h4>
                                        </div>
                                    </div>
                                </div>

                                <div id="order-items-section" class="col-12">
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
                                                        <tr><td colspan="8" class="text-center py-4">این فاکتور فاقد اقلام است.</td></tr>
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
        <div class="alert alert-info text-center">فاکتور لغو شده‌ای یافت نشد.</div>
    @endforelse


</div>
