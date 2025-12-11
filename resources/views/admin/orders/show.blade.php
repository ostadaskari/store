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
            /* Target the top button bar if exists (Keep this to hide the Print/Back buttons) */
            .wrapper > .d-flex,
            .container > .d-flex.justify-content-between.align-items-center {
                display: none !important;
            }

            /* --- NEW: Hide all content *outside* the target div.row in the main container --- */
            /* Hide everything in the body, then selectively show the target row. */
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
                /* Reset display for the container and row */
            }
            /* Explicitly show the target row's content */
            .container .row > * {
                display: block !important;
            }

            /* 2. Force full width and desktop look */
            .container {
                /* Reduced vertical margin for single-page printing */
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
                padding-left: 0.25rem !important; /* Reduced column padding */
                padding-right: 0.25rem !important; /* Reduced column padding */
            }
            .col-4 { width: 33.333333% !important; flex: 0 0 33.333333% !important; }
            .col-8 { width: 66.666667% !important; flex: 0 0 66.666667% !important; }
            .col-12 { width: 100% !important; flex: 0 0 100% !important; }
            .mb-4 { margin-bottom: 0.5rem !important; } /* Reduced bottom margin for cards */
            
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
                margin-bottom: 0.5rem !important; /* Reduced spacing */
                height: auto !important; /* Prevent flex height issues */
            }
            .card-header {
                background-color: #eee !important;
                color: #000 !important;
                border-bottom: 1px solid #ccc !important;
                padding: 0.5rem 1rem !important; /* Reduced padding */
            }
           
            .card-body p, .card-body h5 {
                margin-bottom: 0.25rem !important; /* Reduced space between paragraphs */
                line-height: 1.2; /* Tighter line height */
                font-size: 0.9rem; /* Slightly smaller font for compactness */
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
                page-break-before: auto !important; /* Changed to auto to keep on the same page */
                margin-top:4px !important; /* Maintain some minimal margin */
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
                /* padding: 0.3rem 0.5rem !important; Reduced table padding */
                font-size: 0.85rem; /* Smaller table font */
            }
            .table-responsive { overflow: visible !important; }
            .table tfoot td { font-size:16px; } /* Adjusted font for total */
        }
    </style>
@endsection
    @section('content')
        <div class="container my-5" dir="rtl">
            {{-- H1 and Buttons Section (d-print-none will hide this) --}}
            <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
                <h1 class="text-right">جزئیات سفارش #{{ $order->order_number }}</h1>
                <div class="d-flex">
                    <button onclick="window.print()" class="btn btn-info text-white me-2">
                        <i class="fas fa-print"></i> چاپ صفحه (فاکتور)
                    </button>
                    <a href="{{ route('admin.orders.list') }}" class="btn btn-secondary">بازگشت به لیست سفارشات</a>
                </div>
            </div>

            {{-- **TARGET ROW** - This content will be shown and all other elements hidden --}}
            <div class="row">

                <div class="col-4 mb-4">
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

                <div class="col-8 mb-4">
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

                <div class="col-12 mb-4">
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
                    <h2 class="text-right my-3">اقلام سفارش</h2>
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