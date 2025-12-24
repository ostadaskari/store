{{-- This partial contains the detailed invoice view, intended to be included inside the modal body.
     It expects a $order variable to be passed from the parent view. --}}

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
