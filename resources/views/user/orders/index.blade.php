@extends('user.layouts.app')
@section('style')
    <style>
        .original-price-strikethrough { text-decoration: line-through; color: #999; font-size: 0.85em; }
        .badge-discount { background-color: #f8d7da; color: #721c24; padding: 2px 5px; border-radius: 4px; font-size: 0.75rem; font-weight: bold; }
    </style>
@endsection

@section('content')
    <!-- Orders -->
    <div class="col-md-9 px-0" >
        <div class="user-orders">
            <div class="row">
                <div class="col-md-4 my-1">
                    <div class="order-card order-active p-3"
                         data-bs-toggle="collapse"
                         data-bs-target="#current-order-detail"
                         aria-expanded="false"
                         aria-controls="current-order-detail"
                         style="cursor: pointer;">
                        <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-box-fill mx-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z"/>
                        </svg>
                        <h6>سفارش ها ({{$orders_count}})</h6>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="order-card order-delivered p-3 inner-scroll"
                         data-bs-toggle="collapse"
                         data-bs-target="#delivered-order-detail"
                         aria-expanded="false"
                         aria-controls="delivered-order-detail"
                         style="cursor: pointer;">
                        <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-check2-circle mx-1" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                        </svg>
                        <h6>سفارش های دریافت شده ({{ $user_orders_complete_count }})</h6>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="order-card order-returned p-3 inner-scroll"
                         data-bs-toggle="collapse"
                         data-bs-target="#returned-order-detail"
                         aria-expanded="false"
                         aria-controls="returned-order-detail"
                         style="cursor: pointer;">
                        <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z"/>
                            <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466"/>
                        </svg>
                        <h6> سفارش های مرجوع شده ({{ $user_orders_canceled_count }})</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-details mt-2">
            <!--========= Current order section (Updated) =========
             ===========================================-->
            <!-- Target: This element is now a Bootstrap collapse component -->
            <div id="current-order-detail" class="order-detail-content collapse orderActive inner-scroll" style="overflow: hidden;">
                <div class="accordion accordion-flush" id="accordionFlushCurrent">
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

                    @foreach($user_orders as $order)
                        <!-- item (Order ID: {{ $order->id }}) -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                {{-- Dynamic target for Accordion --}}
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $order->id }}" aria-expanded="false" aria-controls="flush-collapse-{{ $order->id }}">
                                    <div class="meta-item"><strong>شماره سفارش:</strong><span> {{ $order->order_number }}</span></div>
                                    <div class="meta-item"><strong>تاریخ سفارش:</strong><span> {{ jdate($order->created_at)->format('%d %B %Y') }}</span></div>
                                    <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{ number_format($order->total_amount) }} تومان</span></div>
                                </button>
                            </h2>
                            {{-- Dynamic ID for Accordion Content --}}
                            <div id="flush-collapse-{{ $order->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushCurrent">
                                <div class="accordion-body p-0">
                                    <div class="w-100 my-2 bg-light">
                                        <div class="order-meta-grid">
                                            <div class="meta-item"><strong>شماره سفارش:</strong><span> {{ $order->order_number }}</span></div>
                                            <div class="meta-item"><strong>تاریخ سفارش:</strong><span> {{ jdate($order->created_at)->format('%A, %d %B %y') }}</span></div>
                                            <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{ number_format($order->total_amount) }} تومان</span></div>
                                            {{-- <div class="meta-item"><strong>سریال پیگیری:</strong><span> </span></div> --}}
                                            <div class="meta-item"><strong>وضعیت سفارش:</strong>
                                                @php
                                                    $statusClass = $statusClasses[$order->status] ?? 'badge bg-secondary';
                                                    $statusText  = $statusTexts[$order->status] ?? 'نامشخص';
                                                @endphp

                                                <span class="{{ $statusClass }} px-3 py-2 rounded-pill">
                                                        {{ $statusText }}
                                                    </span>
                                            </div>
                                            <div class="meta-item d-flex align-items-center gap-2">
                                                <strong>شماره پیگیری پستی:</strong>
                                                {{-- Note: Replace hardcoded tracking code with actual data if available on $order --}}
                                                <span class="trackingCode">71000123654789001235</span>
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

                                        <div class="order-progress" style="position: relative; height: 40px; margin-top: 80px;">
                                            {{-- Progress bar and icons --}}
                                            <div class="car">
                                                <svg width="40" height="40" fill="black" class="bi bi-truck" viewBox="0 0 16 16">
                                                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                                </svg>
                                            </div>
                                            <!-- shoping -->
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
                                                <div class="progress-bar bg-warning text-dark progress-bar-striped" role="progressbar" style="width: 52%;">
                                                </div>
                                            </div>
                                            <!-- home -->
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
                        <!-- end itme -->


                        <!--======== DYNAMIC MODAL FOR INVOICE (Inside the loop) ===============-->

                        <div class="modal fade" id="invoiceModal-{{ $order->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel-{{ $order->id }}" >
                            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header justify-content-between">
                                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                                        <h5 class="modal-title" id="invoiceModalLabel-{{ $order->id }}">فاکتور سفارش: #{{ $order->order_number }}</h5>
                                    </div>
                                    <div class="modal-body pt-0">
                                        <!-- The invoice starts here - Exact replication of Admin Detail View -->
                                        <div class="container-fluid py-3" dir="rtl">

                                            {{-- Replicated Admin View Header for context --}}
                                            <div class="seven mt-3">
                                                <h1>جزئیات سفارش #{{ $order->order_number }}</h1>
                                                <p class="text-muted" style="font-size: 0.9rem;">این اطلاعات برای چاپ فاکتور شما آماده شده است.</p>
                                            </div>

                                            <div class="row">

                                                <!-- General Order Details & Status -->
                                                <div class="col-12 col-lg-4 mb-2 colPrint">
                                                    <div class="card shadow-sm h-100">
                                                        <div class="card-header bg-primary text-white text-right">خلاصه سفارش</div>
                                                        <div class="card-body text-right">
                                                            <p><strong>تاریخ ثبت:</strong> {{ jdate($order->created_at)->format('Y/m/d - H:i') }}</p>
                                                            <p><strong>وضعیت پرداخت:</strong>
                                                                <span class="badge {{ $order->is_payment ? 'bg-success' : 'bg-danger' }}">
                                                                    {{ $order->is_payment ? 'پرداخت شده' : 'پرداخت نشده' }}
                                                                </span>
                                                            </p>
                                                            <p><strong>روش پرداخت:</strong> {{ $order->payment_method == 'credit' ? 'آنلاین' : 'نقدی (COD)' }}</p>
                                                            <p><strong>وضعیت ارسال:</strong>
                                                                @php
                                                                    $statusClass = [
                                                                        'pending' => 'badge bg-warning text-dark',
                                                                        'processing' => 'badge bg-info text-dark',
                                                                        'completed' => 'badge bg-success',
                                                                        'canceled' => 'badge bg-danger',
                                                                    ][$order->status] ?? 'badge bg-secondary';
                                                                    $statusText = [
                                                                        'pending' => 'در انتظار',
                                                                        'processing' => 'در حال پردازش',
                                                                        'completed' => 'ارسال شده',
                                                                        'canceled' => 'لغو شده',
                                                                    ][$order->status] ?? 'نامشخص';
                                                                @endphp
                                                                <span class="{{ $statusClass }}">{{ $statusText }}</span>
                                                            </p>
                                                            <p><strong>توضیحات سفارش:</strong><br>{{ $order->note ?? 'ندارد' }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-8 mb-2 colPrint">
                                                    <div class="card shadow-sm h-100">
                                                        <div class="card-header bg-info text-white text-right">اطلاعات مشتری و آدرس</div>
                                                        <div class="card-body text-right">
                                                            @if ($order->address)
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <h5>اطلاعات گیرنده:</h5>
                                                                        <p><strong>مشتری (ID: {{ $order->user_id }}):</strong> {{ $order->user->name ?? '' }} {{ $order->user->family ?? '' }}</p>
                                                                        <p><strong>نام گیرنده:</strong> {{ $order->address->first_name }} {{ $order->address->last_name }}</p>
                                                                        <p><strong>موبایل:</strong> {{ $order->address->mobile }}</p>
                                                                        <p><strong>تلفن ثابت:</strong> {{ $order->address->phone ?? 'ندارد' }}</p>
                                                                        <p><strong>ایمیل:</strong> {{ $order->address->email ?? 'ندارد' }}</p>
                                                                        <p><strong>شرکت:</strong> {{ $order->address->company_name ?? 'شخصی' }}</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h5>جزئیات آدرس:</h5>
                                                                        <p><strong>استان / شهر:</strong> {{ $order->address->province }} / {{ $order->address->city }}</p>
                                                                        <p><strong>آدرس کامل:</strong> {{ $order->address->address }}</p>
                                                                        <p><strong>پلاک:</strong> {{ $order->address->plate }}</p>
                                                                        <p><strong>کد پستی:</strong> {{ $order->address->post_code }}</p>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="alert alert-danger text-center">آدرس انتخاب شده (ID: {{ $order->user_address_id }}) حذف شده است.</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-2">
                                                    <div class="card shadow-sm">
                                                        <div class="card-header bg-warning text-dark text-right">جزئیات مالی</div>
                                                        <div class="card-body text-right">
                                                            <p><strong>هزینه ارسال ({{ $order->shipping->name ?? 'نامشخص' }}):</strong> {{ number_format($order->shipping_amount) }} تومان</p>
                                                            <p><strong>کد تخفیف:</strong> {{ $order->discount_code ?? 'ندارد' }}</p>
                                                            <p><strong>مبلغ تخفیف:</strong> {{ number_format($order->discount_amount) }} تومان</p>
                                                            <hr>
                                                            <h4><strong>مبلغ نهایی پرداختی:</strong> <span class="text-danger">{{ number_format($order->total_amount) }}</span> تومان</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Order Items List Section --}}
                                                <div id="order-items-section" class="col-12">
                                                    <div class="seven mt-3">
                                                        <h1>اقلام سفارش</h1>
                                                    </div>
                                                    <div class="card shadow-sm p-0">
                                                        <div class="card-body p-0">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-striped align-middle mb-0 text-center printTable" dir="rtl">
                                                                    <thead class="table-blue">
                                                                    <tr>
                                                                        <th scope="col" style="width: 3%;">#</th>
                                                                        <th scope="col" style="width: 10%;">تصویر</th>
                                                                        <th scope="col" style="width: 30%;">محصول (PN-)</th>
                                                                        <th scope="col" style="width: 15%;">قیمت اصلی</th>
                                                                        <th scope="col" style="width: 10%;">تخفیف</th>
                                                                        <th scope="col" style="width: 15%;">قیمت نهایی</th>
                                                                        <th scope="col" style="width: 5%;">تعداد</th>
                                                                        <th scope="col" style="width: 12%;">مجموع (تومان)</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @forelse ($order->items as $item)
                                                                        <tr>
                                                                            <td scope="row">{{ $loop->iteration }}</td>
                                                                            <td>
                                                                                <img src="{{ $item->product->coverImage->url ?? asset('images/50x50.webp') }}"
                                                                                     alt="Product Image" style="border-radius: 4px;" width="50">
                                                                            </td>
                                                                            <td>
                                                                                PN: {{ $item->product->part_number }}
                                                                            </td>
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
                                                                        <tr>
                                                                            <td colspan="8" class="text-center py-4">این سفارش فاقد اقلام محصول است.</td>
                                                                        </tr>
                                                                    @endforelse
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr class="table-secondary">
                                                                        <td colspan="7" class="text-right"><strong>جمع کل اقلام:</strong></td>
                                                                        <td class="font-weight-bold">{{ number_format($order->items->sum('total_price')) }}</td>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Invoice end -->
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
                    @endforeach
                </div>
            </div>


            <!--========= Delivered(COMPLETED) Order Section =========
            ===========================================-->

            <div id="delivered-order-detail" class="order-detail-content collapse orderDelivered inner-scroll" style="overflow: hidden;">
                <div class="accordion accordion-flush" id="accordionFlushDelivered">
                    @foreach($user_orders_complete as $order)
                        <!-- item (Order ID: {{ $order->id }}) -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse-delivered-{{ $order->id }}"
                                        aria-expanded="false"
                                        aria-controls="flush-collapse-delivered-{{ $order->id }}">
                                    <div class="meta-item"><strong>شماره سفارش:</strong><span>{{$order->order_number}}</span></div>
                                    <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                    <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{number_format($order->total_amount)}} تومان</span></div>
                                </button>
                            </h2>

                            <div id="flush-collapse-delivered-{{ $order->id }}"
                                 class="accordion-collapse collapse"
                                 data-bs-parent="#accordionFlushDelivered">
                                <div class="accordion-body">
                                    <div class="order-meta-grid">
                                        <div class="meta-item"><strong>شماره سفارش:</strong><span>{{$order->order_number}}</span></div>
                                        <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                        <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{number_format($order->total_amount)}} تومان</span></div>

                                        <div class="meta-item d-flex align-items-center gap-2">
                                            <strong>شماره پیگیری پستی:</strong>
                                            <span class="trackingCode">{{ $order->tracking_number ?? '۷۱۰۰۰۱۲۳۶۵۴۷۸۹۰۰۱۲۳۵' }}</span>
                                            <svg width="16" height="16" fill="currentColor" class="bi bi-copy copy-icon" viewBox="0 0 16 16" role="button" style="cursor: pointer;" onclick="copyToClipboard('{{ $order->tracking_number ?? '71000123654789001235' }}')">
                                                <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                            </svg>
                                        </div>
                                        <div class="meta-item"><strong>ارسال از طریق:</strong><span>{{$order->shipping->name ?? 'نامشخص'}}</span></div>

                                        <div class="meta-item"><strong>جزییات سفارش و ثبت نظر:</strong>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal-completed-{{ $order->id }}" style="font-size: 14px;">
                                                <svg width="25" height="25" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                    <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                                                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="order-progress mt-4">
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-success progress-bar-striped"
                                                 role="progressbar"
                                                 style="width: 100%;">
                                                تحویل شده
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 text-success">
                                        سفارش شماره <strong>{{ $order->order_number }}</strong> با موفقیت تحویل داده شده است. از خرید شما سپاسگزاریم 🌟
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--======== DYNAMIC MODAL FOR COMPLETED INVOICE ===============-->
                        <div class="modal fade" id="invoiceModal-completed-{{ $order->id }}" tabindex="-1" aria-labelledby="invoiceLabel-completed-{{ $order->id }}" >
                            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-between">
                                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                                        <h5 class="modal-title" id="invoiceLabel-completed-{{ $order->id }}">فاکتور نهایی سفارش: #{{ $order->order_number }}</h5>
                                    </div>
                                    <div class="modal-body pt-0">
                                        <div class="container-fluid py-3" dir="rtl">
                                            <div class="seven mt-3">
                                                <h1>جزئیات فاکتور تحویل شده</h1>
                                                <p class="text-muted" style="font-size: 0.9rem;">این سفارش در تاریخ {{ jdate($order->updated_at)->format('%d %B %Y') }} با موفقیت تکمیل شده است.</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <div class="card shadow-sm h-100">
                                                        <div class="card-header bg-success text-white">خلاصه نهایی</div>
                                                        <div class="card-body">
                                                            <p><strong>تاریخ ثبت:</strong> {{ jdate($order->created_at)->format('Y/m/d') }}</p>
                                                            <p><strong>وضعیت:</strong> <span class="badge bg-success">تکمیل شده</span></p>
                                                            <p><strong>روش پرداخت:</strong> {{ $order->payment_method == 'credit' ? 'آنلاین' : 'نقدی' }}</p>
                                                            <p><strong>مبلغ کل:</strong> {{ number_format($order->total_amount) }} تومان</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-8 mb-2">
                                                    <div class="card shadow-sm h-100">
                                                        <div class="card-header bg-info text-white">اطلاعات تحویل</div>
                                                        <div class="card-body">
                                                            @if($order->address)
                                                                <p><strong>گیرنده:</strong> {{ $order->address->first_name }} {{ $order->address->last_name }}</p>
                                                                <p><strong>آدرس:</strong> {{ $order->address->province }}، {{ $order->address->city }}، {{ $order->address->address }}</p>
                                                                <p><strong>کد پستی:</strong> {{ $order->address->post_code }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered text-center">
                                                            <thead class="table-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>محصول</th>
                                                                <th>قیمت واحد</th>
                                                                <th>تعداد</th>
                                                                <th>تخفیف</th>
                                                                <th>جمع نهایی</th>
                                                                <th>نظرات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($order->items as $item)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $item->product->part_number ?? 'محصول' }}</td>
                                                                    <td>{{ number_format($item->price) }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ $item->discount_percent }}%</td>
                                                                    <td>{{ number_format($item->total_price) }}</td>
                                                                    <td>
                                                                        @php
                                                                            $existingReview = \App\Models\Review::where('user_id', auth()->id())
                                                                                ->where('product_id', $item->product_id)
                                                                                ->where('order_id', $order->id)
                                                                                ->first();
                                                                        @endphp

                                                                        @if(!$existingReview || $existingReview->status == 'pending')
                                                                            <!-- This button now targets the modal outside this div -->
                                                                            <button class="btn btn-sm btn-outline-primary"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#reviewModal-{{ $item->id }}">
                                                                                {{ $existingReview ? 'ویرایش نظر' : 'ثبت نظر' }}
                                                                            </button>
                                                                        @else
                                                                            <span class="badge bg-success">نظر تایید شده</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                            <tr class="fw-bold">
                                                                <td colspan="5" class="text-end">هزینه ارسال:</td>
                                                                <td>{{ number_format($order->shipping_amount) }}</td>
                                                            </tr>
                                                            <tr class="table-primary fw-bold">
                                                                <td colspan="5" class="text-end">مبلغ کل پرداختی:</td>
                                                                <td>{{ number_format($order->total_amount) }} تومان</td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                        <button type="button" class="btn btn-info text-white" onclick="printModal('invoiceModal-completed-{{ $order->id }}')">
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

                        <!--======== REVIEW MODALS MOVED HERE (OUTSIDE INVOICE MODAL) ===============-->
                        @foreach($order->items as $item)
                            @php
                                $existingReview = \App\Models\Review::where('user_id', auth()->id())
                                    ->where('product_id', $item->product_id)
                                    ->where('order_id', $order->id)
                                    ->first();
                            @endphp

                            <div class="modal fade " id="reviewModal-{{ $item->id }}" tabindex="-1" aria-hidden="true" style="z-index: 1060;" dir="rtl">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-lg border-0">
                                        <form action="{{ route('user.reviews.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                                            <div class="modal-header bg-light">
                                                <h6 class="modal-title">ثبت نظر برای {{ $item->product->part_number }}</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">متن نظر:</label>
                                                    <textarea name="comment" class="form-control" rows="4"
                                                              placeholder="تجربه خرید خود را بنویسید..." required>{{ $existingReview->comment ?? '' }}</textarea>
                                                </div>

                                                @if($existingReview)
                                                    <div class="alert {{ $existingReview->status == 'pending' ? 'alert-warning' : 'alert-success' }} py-2 mb-0" style="font-size: 12px;">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        وضعیت:
                                                        {{ $existingReview->status == 'pending' ? 'در انتظار تایید مدیریت' : 'تایید شده و در حال نمایش' }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="modal-footer justify-content-between bg-light">
                                                <div>
                                                    {{-- Only show delete button if review exists and is still pending --}}
                                                    @if($existingReview && $existingReview->status == 'pending')
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                onclick="if(confirm('آیا از حذف این نظر اطمینان دارید؟')) document.getElementById('delete-review-{{ $existingReview->id }}').submit();">
                                                            <i class="fas fa-trash-alt me-1"></i> حذف نظر
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">انصراف</button>
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        {{ $existingReview ? 'ویرایش نظر' : 'ثبت نظر' }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        {{-- Hidden Delete Form --}}
                                        @if($existingReview && $existingReview->status == 'pending')
                                            <form id="delete-review-{{ $existingReview->id }}"
                                                  action="{{ route('user.reviews.destroy', $existingReview->id) }}"
                                                  method="POST"
                                                  class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>


            </div>


            <!--========= Returned Order Section =========
            ===========================================-->
            <div id="returned-order-detail" class="order-detail-content collapse orderReturned inner-scroll" style="overflow: hidden;">
                <div class="accordion accordion-flush" id="accordionFlushReturned">
                    @foreach($user_orders_canceled as $order)
                        <!-- item (Order ID: {{ $order->id }}) -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                {{-- Dynamic target for Accordion --}}
                                <button class="accordion-button collapsed alert alert-danger py-4"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse-returned-{{ $order->id }}"
                                        aria-expanded="false"
                                        aria-controls="flush-collapse-returned-{{ $order->id }}">
                                    سفارش شماره <span> {{ $order->order_number }} </span> مرجوع شده است. در صورت نیاز با پشتیبانی تماس بگیرید.
                                </button>
                            </h2>
                            {{-- Dynamic ID for Accordion Content (FIXED ID to be unique per loop) --}}
                            <div id="flush-collapse-returned-{{ $order->id }}"
                                 class="accordion-collapse collapse"
                                 data-bs-parent="#accordionFlushReturned">
                                <div class="accordion-body">
                                    <div class="order-meta-grid">
                                        <div class="meta-item"><strong>شماره سفارش:</strong><span> {{$order->order_number}}</span></div>
                                        <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                        <div class="meta-item"><strong>مبلغ سفارش:</strong><span>{{number_format($order->total_amount)}} تومان</span></div>
                                        {{--                                            <div class="meta-item"><strong>سریال پیگیری:</strong><span>741852963</span></div>--}}
                                        <div class="meta-item"><strong>شماره پیگیری پستی:</strong><span>7125900025896547</span></div>
                                        <div class="meta-item"><strong>ارسال از طریق:</strong><span> {{$order->shipping->name}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end itme -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- end Orders -->
@endsection

@section('script')
    {{-- Add a simple JS function to handle modal printing --}}
    <script>
        function printModal(modalId) {
            var modalContent = document.getElementById(modalId).querySelector('.modal-content').innerHTML;
            var printWindow = window.open('', '', 'height=900,width=1200');
            printWindow.document.write('<html><head><title>فاکتور سفارش</title>');
            // Include your necessary CSS/Bootstrap styles for printing
            printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">');
            // Hide modal-specific elements and prevent unnecessary height/padding in print
            printWindow.document.write('<style>@media print {.modal-header, .modal-footer { display: none !important; } .container-fluid { padding: 0 !important; margin: 0 !important;} }</style>');
            printWindow.document.write('</head><body dir="rtl">');
            printWindow.document.write('<div class="container-fluid">' + modalContent + '</div>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            // Give it a moment to load styles before printing
            setTimeout(function(){
                printWindow.print();
                printWindow.close();
            }, 500);
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all detail panels
            const detailPanels = document.querySelectorAll('.order-detail-content');

            // Attach a listener to each panel for when it starts to show
            detailPanels.forEach(panel => {
                panel.addEventListener('show.bs.collapse', function() {
                    const currentPanelId = this.id;

                    // Loop through all detail panels
                    detailPanels.forEach(otherPanel => {
                        // Check if the other panel is not the one currently opening AND it is currently open
                        if (otherPanel.id !== currentPanelId && otherPanel.classList.contains('show')) {

                            // Use Bootstrap's collapse method to hide the open panels gracefully
                            try {
                                // Get or create the collapse instance and hide it
                                const bsCollapse = bootstrap.Collapse.getInstance(otherPanel);
                                if (bsCollapse) {
                                    bsCollapse.hide();
                                } else {
                                    // Fallback: Create a new instance and hide immediately
                                    new bootstrap.Collapse(otherPanel, { toggle: false }).hide();
                                }
                            } catch (e) {
                                console.error('Error closing panel dynamically. Ensure Bootstrap is loaded before this script.', e);
                            }
                        }
                    });
                });
            });
        });
    </script>
    <script>
        // Helper function for printing modals
        function printModal(modalId) {
            var modalContent = document.getElementById(modalId).querySelector('.modal-body').innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = "<div dir='rtl'>" + modalContent + "</div>";
            window.print();
            document.body.innerHTML = originalContent;
            window.location.reload(); // Reload to restore JS listeners
        }
    </script>
    <script>
        // JS Fix for nested modals scrolling issue
        document.addEventListener('hidden.bs.modal', function (event) {
            if (document.querySelectorAll('.modal.show').length > 0) {
                document.body.classList.add('modal-open');
            }
        });
    </script>
@endsection

