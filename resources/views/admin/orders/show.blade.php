@extends('admin.layouts.app')
@section('style')
    {{-- Custom Print Styles to force A4 layout, hide UI, and control page breaks --}}
    <style>
        @media print {
        /* --- FIX: Force White Background and Black Text for Print --- */
        body, html {
            background-color: white !important;
            color: black !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
            min-height: 0 !important;
        }

        /* 1. Force the removal of all sidebars, headers, and UI elements from the parent template */
        .d-print-none,
        header,
        nav,
        .sidebar,
        .main-header,
        .main-sidebar,
        .breadcrumb,
        .content-header,
        /* Target the top button bar (Print/Back buttons) */
        .wrapper > .d-flex,
        .container > .d-flex.justify-content-between.align-items-center,
        .card > .d-flex.flex-row.justify-content-between.align-items-center.rounded
        {
            display: none !important;
        }

        /* --- NEW: Hide all content *outside* the target div.row in the main container --- */
        body > * {
            display: none !important;
        }
        .panel{
            background-color:#fff;
        }

        /* Show the main container and the target row */
        .container,
        .container .row {
            display: block !important;
        }
        /* Explicitly show the target row's content */
        .container .row > * {
            display: block !important;
        }

        /* 2. Force full width and desktop look */
        .container {
            max-width: 100% !important;
        }

        /* 3. Column Fixes: Ensure layout remains fixed (4/8 split) */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        .col-4, .col-8, .col-12, .col-md-4, .col-md-8 {
            float: left;
        }

        .col-lg-4.colPrint {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            display: block !important;
        }
        .col-lg-8.colPrint {
            width: 66.666667% !important;
            flex: 0 0 66.666667% !important;
            display: block !important;
        }

        .col-12 { width: 100% !important; flex: 0 0 100% !important; }

        .mb-4, .mb-2 { margin-bottom: 0.5rem !important; }

        /* Remove the large top margin on the main row (if exists) */
        .container > .row {
            margin-top: 0 !important;
        }

        /* 4. Ensure colors and borders are printed */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* 5. Clean up cards for print */
        .card {
            border: 1px solid #ccc;
            background-color:#fff!important;
            color: #000!important;
            box-shadow: none !important;
            page-break-inside: avoid;
            margin-bottom: 0.5rem !important;
            height: auto !important;
        }
        .card-header {
            background-color: #eee !important;
            color: #000 !important;
            border-bottom: 1px solid #ccc !important;
        }

        .card-body p, .card-body h5 {
            margin-bottom: 0.25rem !important;
            line-height: 1.2;
            font-size: 0.9rem;
        }
        .card-body h4 {
            margin-top: 0.5rem !important;
            margin-bottom: 0 !important;
            font-size: 1.1rem;
        }

        /* --- Page Break Control --- */
        /* REMOVED: Force the "Order Items List" section to start on a new page (Page 2) */
        /* Since you want all content on one page, this rule must be removed or disabled. */
        #order-items-section {
            page-break-before: auto !important;
            margin-top:4px !important;
        }
        .my-3 { margin-top: 0.5rem !important; margin-bottom: 0.5rem !important; }
        #order-items-section h2 { display:none; }

        /* Table fixes for borders and spacing */
        .printTable{
            --bs-table-bg:#fff!important;
        }
        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-color-type:  #030303 !important;
            --bs-table-bg-type: var(--bs-table-striped-bg);
        }
        .table-bordered th, .table-bordered td {
            border-color: #000 !important;
            font-size: 0.85rem;
        }
        .table-responsive { overflow: visible !important; }
        .table tfoot td { font-size:16px; }
         }
    </style>
@endsection
    @section('content')
        <div class="container" style="padding-bottom:50px;" dir="rtl">

            {{-- H1 and Buttons Section (d-print-none will hide this) --}}
            <div class="seven mt-3">
                <h1>جزئیات سفارش #{{ $order->order_number }}</h1>
            </div>
            <div class="card p-2 mb-2 d-flex flex-row justify-content-between align-items-center rounded">
                <a href="{{ route('admin.orders.list') }}" class="btnBack m-0" title="بازگشت">
                    <svg width="24" height="24" fill="currentColor" class="bi bi-arrow-right-circle icon-transition" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"></path>
                    </svg>
                </a>

                <button onclick="window.print()" title="چاپ جزییات سفارش" class="btn btn-light text-white p-1">
                    <svg width="24" height="24" fill="initial" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                    </svg>
                </button>
            </div>


            {{-- **TARGET ROW** - This content will be shown and all other elements hidden --}}
            <div class="row">

            <!-- General Order Details & Status -->
            {{-- Using col-4 to force 33% width everywhere, including print --}}

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
    @endsection
