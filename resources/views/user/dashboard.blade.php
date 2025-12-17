@extends('user.layouts.app')
@section('style')

@endsection

@section('content')






            <!-- Orders -->
            <div class="col-md-9 px-0" id="user-orders-section">
                <div class="user-orders">
                    <div class="row">
                        <div class="col-md-4 my-1">
                            <div class="order-card order-active p-3 inner-scroll" data-bs-target="current-order-detail" data-order-id="۱۲۳۴۵">
                                <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-box-fill mx-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z"/>
                                </svg>
                                <h6>سفارش ها ({{$orders_count}})</h6>
                            </div>
                        </div>
                        <div class="col-md-4 my-1">
                            <div class="order-card order-delivered p-3 inner-scroll" data-bs-target="delivered-order-detail" data-order-id="۱۲۲۲۲">
                                <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-check2-circle mx-1" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                </svg>
                                <h6>سفارش های دریافت شده ({{ $user_orders_complete_count }})</h6>
                            </div>
                        </div>
                        <div class="col-md-4 my-1">
                            <div class="order-card order-returned p-3 inner-scroll" data-bs-target="returned-order-detail" data-order-id="۱۱۱۱۱">
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
                    <div id="current-order-detail" class="order-detail-content d-none orderActive" style="overflow: hidden;">
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
                                <div class="modal fade" id="invoiceModal-{{ $order->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel-{{ $order->id }}" aria-hidden="true">
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

                                                        {{-- Order Items List Section (moved into the target row) --}}
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
                                                                                <th scope="col" style="width: 15%;">تصویر</th>
                                                                                <th scope="col" style="width: 33%;">محصول (PN-)</th>
                                                                                <th scope="col" style="width: 20%;">قیمت واحد (تومان)</th>
                                                                                <th scope="col" style="width: 5%;">تعداد</th>
                                                                                <th scope="col" style="width: 25%;">مجموع (تومان)</th>
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
                                                                                    <td>{{ number_format($item->price) }}</td>
                                                                                    <td>{{ $item->quantity }}</td>
                                                                                    <td>{{ number_format($item->total_price) }}</td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td colspan="6" class="text-center py-4">این سفارش فاقد اقلام محصول است.</td>
                                                                                </tr>
                                                                            @endforelse
                                                                            </tbody>
                                                                            <tfoot>
                                                                            <tr class="table-secondary">
                                                                                <td colspan="5" class="text-right"><strong>جمع کل اقلام:</strong></td>
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

                    <!--========= Delivered Order Section =========
                    ===========================================-->
                    <div id="delivered-order-detail" class="order-detail-content d-none orderDelivered">
                        <div class="accordion accordion-flush" id="accordionFlushDelivered">
                            @foreach($user_orders_complete as $order)
                            <!-- itme1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <div class="meta-item"><strong>شماره سفارش:</strong><span>{{$order->order_number}}</span></div>
                                            <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                            <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{number_format($order->total_amount)}} تومان</span></div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushDelivered">
                                        <div class="accordion-body">
                                            <div class="order-meta-grid">
                                                <div class="meta-item"><strong>شماره سفارش:</strong><span>{{$order->order_number}}</span></div>
                                                <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                                <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{number_format($order->total_amount)}} تومان</span></div>
{{--                                                <div class="meta-item"><strong>سریال پیگیری:</strong><span>142536695847</span></div>--}}
                                                <div class="meta-item d-flex align-items-center gap-2">
                                                    <strong>شماره پیگیری پستی:</strong>
                                                    <span class="trackingCode">71000123654789001235</span>
                                                    <svg width="16" height="16" fill="currentColor" class="bi bi-copy copy-icon" viewBox="0 0 16 16" role="button" style="cursor: pointer;">
                                                        <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                                    </svg>
                                                </div>
                                                <div class="meta-item"><strong>ارسال از طریق:</strong><span>{{$order->shipping->name}}</span></div>
                                            </div>

                                            <div class="order-progress mt-4">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success progress-bar-striped"
                                                         role="progressbar"
                                                         style="width: 100%;">
                                                        تحویل شده
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3 text-success">
                                                سفارش شماره <span id="delivered-order-id-message"></span> با موفقیت تحویل داده شده است. از خرید شما سپاسگزاریم 🌟
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- end itme1 -->
                            @endforeach
                        </div>
                    </div>
                    <!--========= Returned Order Section =========
                    ===========================================-->
                    <div id="returned-order-detail" class="order-detail-content d-none orderReturned">
                        <div class="accordion accordion-flush" id="accordionFlushReturned">
                            @foreach($user_orders_canceled as $order)
                            <!-- itme1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed alert alert-danger py-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        سفارش شماره <span> {{ $order->order_number }} </span> مرجوع شده است. در صورت نیاز با پشتیبانی تماس بگیرید.
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushReturned">
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
                            <!-- end itme1 -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Orders -->





            <!-- address -->
            <div class="modal fade" id="userAddressesModal" tabindex="-1" aria-labelledby="userAddressesModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title" id="userAddressesModalLabel">آدرس‌های من</h5>
                            <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                        </div>
                        <div class="modal-body">
                            <!-- address-section -->
                            <div id="address-section">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <!-- modal for add address -->
                                    <div id="address-modal" class="address-modal">
                                        <div class="address-modal-content">
                                            <h4>افزودن آدرس جدید</h4>
                                            <textarea class="addAddress" type="text" id="address-input" placeholder="استان، شهر، خیابان ..."></textarea>
                                            <input type="text" id="receiver-input" placeholder="نام گیرنده..." />
                                            <input type="text" id="phone-input" placeholder="شماره تماس..." />
                                            <div class="address-modal-actions">
                                                <button class="address-submit-btn">ثبت</button>
                                                <button class="address-cancel-btn">انصراف</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-success add-address-btn">+ افزودن آدرس جدید</button>
                                </div>
                                <h6 class="mb-3">لیست آدرس‌ها</h6>
                                <div class="address-list">

                                    <div class="mb-3 p-3 border rounded d-flex gap-3 align-items-start">
                                        <input class="form-check-input mt-1" type="radio" name="selectedAddress" id="address1" value="1">
                                        <label for="address1" class="flex-grow-1 cursor-pointer">
                                            <div class="d-flex gap-2 align-items-start">
                                                <div class="fs-4">📍</div>
                                                <div>
                                                    تهران، خیابان ولیعصر، کوچه زنبق، پلاک ۱۲، واحد ۵<br>
                                                    <strong>گیرنده:</strong> زهرا احمدی - ۰۹۱۲۳۴۵۶۷۸۹
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="mb-3 p-3 border rounded d-flex gap-3 align-items-start">
                                        <input class="form-check-input mt-1" type="radio" name="selectedAddress" id="address2" value="2">
                                        <label for="address2" class="flex-grow-1 cursor-pointer">
                                            <div class="d-flex gap-2 align-items-start">
                                                <div class="fs-4">🏠</div>
                                                <div>
                                                    کرج، میدان شهدا، خیابان گلستان، پلاک ۴۲<br>
                                                    <strong>گیرنده:</strong> زهرا احمدی - ۰۹۱۲۳۴۵۶۷۸۹
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end address -->





    <!-- end user account -->
@endsection

@section('script')

    <script>
        $(document).ready(function() {
            // ------------------------------------------
            // 1. AJAX Invoice Loading & Search Logic
            // ------------------------------------------

            const invoiceListContainer = $('#invoice-list');
            const invoiceSearchInput = $('#invoiceSearch');
            let typingTimer; // Timer for debouncing search input
            const doneTypingInterval = 500; // Wait 500ms after user stops typing

            /**
             * Loads order invoices via AJAX with search term and page.
             * @param {string} url - The AJAX URL (can include search/page query params).
             */
            function loadInvoices(url) {
                // Use the current search value if it's a new search or loading the initial page
                const searchVal = invoiceSearchInput.val();
                let ajaxUrl = url || "{{ route('user.dashboard') }}"; // Assuming current route handles AJAX

                // If it's the initial load or a search action (not pagination), append search param
                if (!url || ajaxUrl.indexOf('page=') === -1) {
                    ajaxUrl = updateQueryStringParameter(ajaxUrl, 'search', searchVal);
                }

                // Add loading state
                invoiceListContainer.html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted">در حال بارگذاری فاکتورها...</p></div>');

                $.ajax({
                    url: ajaxUrl,
                    method: 'GET',
                    data: {
                        ajax: true, // Marker for Laravel controller
                    },
                    success: function(response) {
                        invoiceListContainer.html(response);
                        // After loading new content, re-initialize event handlers for new elements
                        setupNewInvoiceEvents();
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        invoiceListContainer.html('<div class="alert alert-danger text-center">خطا در بارگذاری فاکتورها. لطفاً دوباره تلاش کنید.</div>');
                    }
                });
            }

            // Debouncing function to limit API calls during search
            invoiceSearchInput.on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    loadInvoices(); // Load invoices with the new search term
                }, doneTypingInterval);
            });

            invoiceSearchInput.on('keydown', function() {
                clearTimeout(typingTimer);
            });


            // Event listener for pagination links (Delegated event)
            // The links returned by $user_orders->links() will have the class .page-link
            $(document).on('click', '#invoice-list .pagination a', function(e) {
                e.preventDefault();
                // The URL of the clicked pagination link
                const pageUrl = $(this).attr('href');
                loadInvoices(pageUrl);
                // Scroll to the top of the invoice list when changing pages
                $('html, body').animate({
                    scrollTop: $('#user-invoice-section').offset().top - 20
                }, 500);
            });

            // ------------------------------------------
            // 2. Section Toggling (Menu Click)
            // ------------------------------------------

            $('#go-to-invoice').on('click', function() {
                // Get the target ID from data-target
                const targetId = $(this).data('target');
                const targetElement = $('#' + targetId);
                const orderDetailSection = $('#current-order-detail'); // Assuming this is the main orders list

                // 1. Hide the primary orders list
                orderDetailSection.addClass('d-none');

                // 2. Show the invoice section
                targetElement.slideDown(300).css('display', 'block');

                // 3. Load the initial set of invoices (page 1)
                loadInvoices();
            });


            // ------------------------------------------
            // 3. Copy/Print & Other Dynamic Events
            // ------------------------------------------

            // Function to set up events on dynamically loaded content
            function setupNewInvoiceEvents() {
                // Copy Tracking Code functionality (Delegated event)
                $('.copy-icon').off('click').on('click', function(e) {
                    e.stopPropagation();
                    const trackingCode = $(this).prev('.trackingCode').text().trim();

                    // Simple clipboard copy (using temporary input method for wider compatibility)
                    const $tempInput = $('<input>');
                    $('body').append($tempInput);
                    $tempInput.val(trackingCode).select();

                    try {
                        document.execCommand('copy');
                        alert('شماره پیگیری کپی شد: ' + trackingCode); // Use a custom toast/modal in production
                    } catch (err) {
                        alert('خطا در کپی کردن متن'); // Use a custom toast/modal in production
                    }

                    $tempInput.remove();
                });
            }

            // Global Print Modal Function (must be outside of the ready block to be accessible by inline onclick)
            window.printModal = function(modalId) {
                const printContent = document.getElementById(modalId).querySelector('.modal-body').innerHTML;
                const originalBody = document.body.innerHTML;

                // Temporarily replace body content for printing
                document.body.innerHTML = printContent;
                window.print();

                // Restore original body content
                document.body.innerHTML = originalBody;
                location.reload(); // Reload to fully restore event handlers and state (a simple solution)
            };

            // Helper function to update query string parameters
            function updateQueryStringParameter(uri, key, value) {
                const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                const separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }

            // Initial setup for the copy event on the first load orders (if visible)
            setupNewInvoiceEvents();

        });
    </script>
@endsection

