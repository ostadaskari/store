@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>لیست سفارشات <span style="color: #b9d5f0">( {{ $orders->total() }} )</span></h3>
        </div>
        <!-- Search Form -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">فیلتر و جستجوی پیشرفته</h5>
                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#searchFormCollapse" aria-expanded="false" aria-controls="searchFormCollapse">
                    نمایش/پنهان کردن فیلترها
                </button>
            </div>
            <div class="collapse {{ request()->except('page') ? 'show' : '' }}" id="searchFormCollapse">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.orders.list') }}">
                        <div class="row g-3 text-right">

                            <!-- Section 1: Order Details -->
                            <div class="col-12"><h6 class="border-bottom pb-2">فیلترهای سفارش</h6></div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">وضعیت سفارش</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">همه وضعیت‌ها</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>در انتظار پرداخت</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>در حال پردازش</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>لغو شده</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="payment_method" class="form-label">روش پرداخت</label>
                                <select name="payment_method" id="payment_method" class="form-select">
                                    <option value="">همه روش‌ها</option>
                                    <option value="credit" {{ request('payment_method') == 'credit' ? 'selected' : '' }}>آنلاین</option>
                                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>نقدی (COD)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="discount_code" class="form-label">کد تخفیف</label>
                                <input type="text" name="discount_code" id="discount_code" class="form-control" value="{{ request('discount_code') }}" placeholder="جستجو بر اساس کد تخفیف">
                            </div>

                            <!-- Date Range -->
                            <div class="col-md-3">
                                <label for="from_date" class="form-label">از تاریخ ثبت</label>
                                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="to_date" class="form-label">تا تاریخ ثبت</label>
                                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                            </div>


                            <!-- Section 2: User Details -->
                            <div class="col-12"><h6 class="border-bottom pb-2 mt-3">فیلترهای کاربر (ثبت کننده)</h6></div>
                            <div class="col-md-3">
                                <label for="user_name" class="form-label">نام و نام خانوادگی کاربر</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" value="{{ request('user_name') }}" placeholder="نام یا نام خانوادگی">
                            </div>
                            <div class="col-md-3">
                                <label for="user_mobile" class="form-label">موبایل کاربر</label>
                                <input type="text" name="user_mobile" id="user_mobile" class="form-control" value="{{ request('user_mobile') }}" placeholder="09xxxxxxxxx">
                            </div>
                            <div class="col-md-3">
                                <label for="user_email" class="form-label">ایمیل کاربر</label>
                                <input type="email" name="user_email" id="user_email" class="form-control" value="{{ request('user_email') }}" placeholder="example@domain.com">
                            </div>

                            <!-- Section 3: Shipping Address Details -->
                            <div class="col-12"><h6 class="border-bottom pb-2 mt-3">فیلترهای آدرس گیرنده</h6></div>

                            <div class="col-md-3">
                                <label for="address_first_name" class="form-label">نام گیرنده</label>
                                <input type="text" name="address_first_name" id="address_first_name" class="form-control" value="{{ request('address_first_name') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="address_mobile" class="form-label">موبایل گیرنده</label>
                                <input type="text" name="address_mobile" id="address_mobile" class="form-control" value="{{ request('address_mobile') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="address_province" class="form-label">استان</label>
                                <input type="text" name="address_province" id="address_province" class="form-control" value="{{ request('address_province') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="address_city" class="form-label">شهر</label>
                                <input type="text" name="address_city" id="address_city" class="form-control" value="{{ request('address_city') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="address_post_code" class="form-label">کد پستی</label>
                                <input type="text" name="address_post_code" id="address_post_code" class="form-control" value="{{ request('address_post_code') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="address_company_name" class="form-label">نام شرکت</label>
                                <input type="text" name="address_company_name" id="address_company_name" class="form-control" value="{{ request('address_company_name') }}">
                            </div>


                            <!-- Action Buttons -->
                            <div class="col-12 mt-4 text-left">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search"></i> جستجو
                                </button>
                                <a href="{{ route('admin.orders.list') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> پاک کردن فیلترها
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Search Form -->

        <div class="card shadow-sm">
            <div class="card-body">
                @if(request()->except('page'))
                    <p class="alert alert-info text-center">نتایج بر اساس فیلترهای اعمال شده نمایش داده شده‌اند.</p>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped text-right" dir="rtl">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">کد سفارش</th>
                            <th scope="col">مشتری</th>
                            <th scope="col">مبلغ کل (تومان)</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col">تاریخ ثبت</th>
                            <th scope="col">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</th>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'نامشخص' }} {{ $order->user->family ?? '' }} (ID: {{ $order->user_id }})</td>
                                <td>{{ number_format($order->total_amount) }}</td>
                                <td>
                                    @php
                                        // Simple status badge logic
                                        $statusClass = [
                                            'pending' => 'badge bg-warning text-dark',
                                            'processing' => 'badge bg-info text-dark',
                                            'completed' => 'badge bg-success',
                                            'canceled' => 'badge bg-danger',
                                        ][$order->status] ?? 'badge bg-secondary';
                                        $statusText = [
                                            'pending' => 'در انتظار پرداخت',
                                            'processing' => 'در حال پردازش',
                                            'completed' => 'تکمیل شده',
                                            'canceled' => 'لغو شده',
                                        ][$order->status] ?? 'نامشخص';
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ $statusText }}</span>
                                </td>
                                <td>{{ jdate($order->created_at)->format('Y/m/d H:i') }}</td> {{-- Assuming jdate for Jalali date --}}
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">جزئیات</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">هیچ سفارشی با این مشخصات یافت نشد.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>



    </div>
@endsection

@section('script')

@endsection


