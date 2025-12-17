<!--======== DYNAMIC MODAL FOR INVOICE (Inside the loop) ===============-->

<div class="modal fade" id="invoiceModal-{{ $order->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel-{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                <h5 class="modal-title" id="invoiceModalLabel-{{ $order->id }}">فاکتور سفارش: #{{ $order->order_number }}</h5>
            </div>
            <div class="modal-body pt-0">
                <!-- The invoice starts here -->
                <div class="container-fluid py-3" dir="rtl">

                    <div class="seven mt-3 text-center">
                        <h1 style="font-size: 1.8rem; border-bottom: 2px solid #0d6efd; display: inline-block; padding-bottom: 5px;">جزئیات سفارش #{{ $order->order_number }}</h1>
                        <p class="text-muted" style="font-size: 0.9rem;">این اطلاعات برای چاپ فاکتور شما آماده شده است.</p>
                    </div>

                    <div class="row">

                        <!-- General Order Details & Status -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="card shadow-sm h-100 border-primary">
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
                                            $statusClass = $statusClasses[$order->status] ?? 'badge bg-secondary';
                                            $statusText  = $statusTexts[$order->status] ?? 'نامشخص';
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ $statusText }}</span>
                                    </p>
                                    <p><strong>توضیحات سفارش:</strong><br>{{ $order->note ?? 'ندارد' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8 mb-3">
                            <div class="card shadow-sm h-100 border-info">
                                <div class="card-header bg-info text-white text-right">اطلاعات مشتری و آدرس</div>
                                <div class="card-body text-right">
                                    @if ($order->address)
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>اطلاعات گیرنده:</h5>
                                                <p><strong>مشتری:</strong> {{ $order->user->name ?? '' }} {{ $order->user->family ?? '' }}</p>
                                                <p><strong>نام گیرنده:</strong> {{ $order->address->first_name }} {{ $order->address->last_name }}</p>
                                                <p><strong>موبایل:</strong> {{ $order->address->mobile }}</p>
                                                <p><strong>تلفن ثابت:</strong> {{ $order->address->phone ?? 'ندارد' }}</p>
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
                                        <div class="alert alert-danger text-center">آدرس انتخاب شده حذف شده است.</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="card shadow-sm border-warning">
                                <div class="card-header bg-warning text-dark text-right">جزئیات مالی</div>
                                <div class="card-body text-right">
                                    <p><strong>هزینه ارسال ({{ $order->shipping->name ?? 'نامشخص' }}):</strong> <span class="text-info">{{ number_format($order->shipping_amount) }} تومان</span></p>
                                    <p><strong>کد تخفیف:</strong> {{ $order->discount_code ?? 'ندارد' }}</p>
                                    <p><strong>مبلغ تخفیف:</strong> <span class="text-danger">{{ number_format($order->discount_amount) }} تومان</span></p>
                                    <hr>
                                    <h4><strong>مبلغ نهایی پرداختی:</strong> <span class="text-success">{{ number_format($order->total_amount) }}</span> تومان</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Order Items List Section --}}
                        <div id="order-items-section" class="col-12">
                            <div class="seven mt-3 text-center">
                                <h1 style="font-size: 1.5rem;">اقلام سفارش</h1>
                            </div>
                            <div class="card shadow-sm p-0">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped align-middle mb-0 text-center printTable" dir="rtl">
                                            <thead class="table-primary text-white">
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
                                                        {{-- Assuming the coverImage relationship is loaded --}}
                                                        <img src="{{ $item->product->coverImage->url ?? asset('images/50x50.webp') }}"
                                                             alt="Product Image" style="border-radius: 4px;" width="50">
                                                    </td>
                                                    <td>
                                                        <a href="#">{{ $item->product->name ?? 'محصول نامشخص' }}</a>
                                                        <br>PN: {{ $item->product->part_number ?? 'N/A' }}
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
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-info text-white" onclick="window.printModal('invoiceModal-{{ $order->id }}')">
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
