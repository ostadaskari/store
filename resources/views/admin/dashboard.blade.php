@extends('admin.layouts.app')
@section('style')

@endsection
@section('content')

    <div class="main" dir="rtl">
        <!--=============================
                Content Container
        =================================-->
        <div class="container px-0 py-3">
            <!--***************
                Dashboard
            ******************-->
            <div id="dashboard-section" class="content-section">
                <div class="container px-0">
                    @if($low_credit)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            موجودی پیامک شما کمتر از 100 عدد است.
                            <strong>اکانت SMS.ir را شارژ کنید.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="row g-3">

                        <div class="col-md-3">
                            <div class="card" style="height: 100px;">
                                <div class="card-body d-flex align-items-center justify-content-around">
                                    <div class="icon-glass icon-yellow">
                                        <i class='bx bxs-calendar-check bx-lg'></i>
                                    </div>
                                    <div class="pe-3">
                                        <h5 class="card-title">{{ number_format($orders_taday) }}</h5>
                                        <p class="card-text"> تعداد سفارشات امروز</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="height: 100px;">
                                <div class="card-body d-flex align-items-center justify-content-around">
                                    <div class="icon-glass icon-yellow">
                                        <i class='bx bxs-calendar-check bx-lg'></i>
                                    </div>
                                    <div class="pe-3">
                                        <h5 class="card-title">{{ number_format($orders_taday_amount) }}</h5>
                                        <p class="card-text">مقدار سفارشات امروز</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="height: 100px;">
                                <div class="card-body d-flex align-items-center justify-content-around">
                                    <div class="icon-glass icon-green">
                                        <i class='bx bxs-group bx-lg'></i>
                                    </div>
                                    <div class="pe-3">
                                        <h5 class="card-title">{{ number_format($clients_count) }}</h5>
                                        <p class="card-text">تعداد کل کاربران</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="height: 100px;">
                                <div class="card-body d-flex align-items-center justify-content-around">
                                    <div class="icon-glass icon-green">
                                        <i class='bx bxs-group bx-lg'></i>
                                    </div>
                                    <div class="pe-3">
                                        <h5 class="card-title">{{ number_format($clients_today) }}</h5>
                                        <p class="card-text">تعداد امروز کاربران</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="height: 100px;">
                                <div class="card-body d-flex align-items-center justify-content-around">
                                    <div class="icon-glass icon-yellow">
                                        <i class='bx bxs-calendar-check bx-lg'></i>
                                    </div>
                                    <div class="pe-3">
                                        <h5 class="card-title">{{ number_format($orders_count) }}</h5>
                                        <p class="card-text">تعداد کل سفارشات</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="height: 100px;">
                                <div class="card-body d-flex align-items-center justify-content-around">
                                    <div class="icon-glass icon-blue">
                                        <i class='bx bxs-dollar-circle bx-lg'></i>
                                    </div>
                                    <div class="pe-3">
                                        <h5 class="card-title">{{ number_format($sales_total) }} تومان</h5>
                                        <p class="card-text">کل فروش</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="height: 100px;">
                                <div class="card-body d-flex align-items-center justify-content-around">
                                    <div class="icon-glass icon-orange">
                                       <i class="bi bi-stack-overflow px-2" style="font-size: 2.05rem !important;"></i>
                                    </div>
                                    <div class="pe-3">
                                        <h5
                                            class="card-title"
                                            title="{{ $low_credit ? 'موجودی کم! لطفاً شارژ کنید.' : 'موجودی پیامک کافی است.' }}"
                                            style="cursor:pointer; color: {{ $sms_credit < 100 ? '#e53935' : '#2e7d32' }};">
                                            {{ number_format($sms_credit) }} پیامک
                                        </h5>

                                        <p class="card-text">مانده اعتبار پیامکی</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Orders Table & Todos -->

                        <!-- Orders Table -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header d-flex align-items-center">
                                    <svg class="mx-2" width="18" height="18" fill="#fff" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                        <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8z"/>
                                    </svg>
                                    <h5 class="mb-0">آخرین سفارشات</h5>
                                </div>

                                <div class="card-body">
                                    <table class="table table-hover align-middle border-panel">
                                        <thead>
                                        <tr>
                                            <th>شماره سفارش</th>
                                            <th>تاریخ سفارش</th>
                                            <th>وضعیت</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        @php
                                            $statuses = [
                                                'pending'    => ['text' => 'در انتظار پرداخت', 'class' => 'bg-warning text-dark'],
                                                'processing' => ['text' => 'در حال پردازش', 'class' => 'bg-info text-dark'],
                                                'delivered'  => ['text' => 'تحویل داده شده', 'class' => 'bg-primary'],
                                                'completed'  => ['text' => 'تکمیل شده', 'class' => 'bg-success'],
                                                'canceled'   => ['text' => 'لغو شده', 'class' => 'bg-danger'],
                                            ];
                                        @endphp
                                        <tbody>
                                        @foreach($latest_orders as $latest)
                                        <tr>
                                            <td>#{{ $latest->order_number }}</td>
                                            <td>{{ jdate($latest->created_at) }}</td>
                                            <td>
                                                <span class="badge {{ $statuses[$latest->status]['class'] ?? 'bg-secondary' }}">
                                                    {{ $statuses[$latest->status]['text'] ?? $latest->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $latest->id) }}" class="btn btn-sm btn-outline-primary">جزئیات</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- CHART A: Orders + Customers --}}
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">آمار تعداد سفارشات و مشتریان</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartCounts" height="120"></canvas>
                            </div>
                        </div>

                        {{-- CHART B: Sales --}}
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">نمودار فروش سالانه (تومان)</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartSales" height="120"></canvas>
                            </div>
                        </div>


                        <!-- Todos / Reminders -->
                        <div class="col-lg-4" >
                            <div class="card shadow-sm">
                                <div class="card-header d-flex align-items-center">
                                    <svg width="20" height="20" fill="currentColor" class="bi bi-journal-check mx-2" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                    </svg>
                                    <h5 class="mb-0">یادآوری ها</h5>
                                </div>

                                <div class="card-body">
                                    <ul class="list-group bg-panel border-panel">
                                        <li class="list-group-item d-flex justify-content-between align-items-center bg-panel">
                                            <div>
                                                <strong>بررسی سفارشات جدید</strong><br>
                                                <small class="">۲۰۲۳/۰۴/۰۵</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">امروز</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center bg-panel">
                                            <div>
                                                <strong>بررسی ایمیل ها</strong><br>
                                                <small class="">۲۰۲۳/۰۴/۰۶</small>
                                            </div>
                                            <span class="badge bg-warning rounded-pill">فردا</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center bg-panel">
                                            <div>
                                                <strong>جلسه با تامین کننده</strong><br>
                                                <small class="">۲۰۲۳/۰۴/۰۸</small>
                                            </div>
                                            <span class="badge bg-danger rounded-pill">در 3 روز</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>





        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('design/js/chart.js') }}"></script>

    <script>
        const months = @json($chart_months);
        const orders = @json($chart_orders);
        const customers = @json($chart_customers);
        const sales = @json($chart_sales);

        /* -----------------------
           CHART A — Counts
        -------------------------- */
        new Chart(document.getElementById('chartCounts'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'تعداد سفارشات',
                        data: orders,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        borderRadius: 12,
                        borderSkipped: false
                    },
                    {
                        label: 'تعداد مشتریان',
                        data: customers,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        borderRadius: 12,
                        borderSkipped: false
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    x: { ticks: { font: { family: "Shabnam" } } },
                    y: { beginAtZero: true }
                }
            }
        });

        /* -----------------------
           CHART B — Sales
        -------------------------- */
        new Chart(document.getElementById('chartSales'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'میزان فروش (تومان)',
                        data: sales,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 2,
                        borderRadius: 12,
                        borderSkipped: false
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    x: { ticks: { font: { family: "Shabnam" } } },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (val) => val.toLocaleString() + " تومان"
                        }
                    }
                }
            }
        });
    </script>
@endsection
