@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>لیست سفارشات <span style="color: #b9d5f0">( {{ $orders->total() }} )</span></h3>
        </div>
        <!-- Search Form -->
        <div class="card shadow-sm mb-4" dir="rtl">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-danger">فیلتر و جستجوی پیشرفته</h5>
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

                            <!-- ADDED: Order Number Filter -->
                            <div class="col-md-3">
                                <label for="order_number" class="form-label">شماره سفارش</label>
                                <input type="text" name="order_number" id="order_number" class="form-control" value="{{ request('order_number') }}" placeholder="جستجو بر اساس شماره سفارش">
                            </div>
                            <!-- END ADDED -->

                            <div class="col-md-3">
                                <label for="status" class="form-label">وضعیت سفارش</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">همه وضعیت‌ها</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>در انتظار پرداخت</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>در حال پردازش</option>
                                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>تحویل داده شده</option>
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
                        @php
                            $statuses = [
                                'pending'    => ['text' => 'در انتظار پرداخت', 'class' => 'bg-warning text-dark'],
                                'processing' => ['text' => 'در حال پردازش', 'class' => 'bg-info text-dark'],
                                'delivered'  => ['text' => 'تحویل داده شده', 'class' => 'bg-primary'],
                                'completed'  => ['text' => 'تکمیل شده', 'class' => 'bg-success'],
                                'canceled'   => ['text' => 'لغو شده', 'class' => 'bg-danger'],
                            ];
                        @endphp
                        @forelse ($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</th>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->name ?? 'نامشخص' }} {{ $order->user->family ?? 'نامشخص' }} (ID: {{ $order->user_id }})</td>
                                <td>{{ number_format($order->total_amount) }}</td>
                                <td>
                                    <!-- Status Select Box -->
                                    <select
                                        class="form-select form-select-sm order-status-select"
                                        data-order-id="{{ $order->id }}"
                                        data-order-number="{{ $order->order_number }}"
                                        data-current-status="{{ $order->status }}"
                                        style="min-width: 150px; background-color: var(--bs-{{ $statuses[$order->status]['class'] ?? 'secondary' }}); color: {{ $order->status === 'pending' || $order->status === 'processing' ? 'black' : 'white' }}; border: 1px solid #ccc;"
                                        onchange="updateOrderStatus(this)"
                                    >
                                        @foreach($statuses as $value => $data)
                                            <option
                                                value="{{ $value }}"
                                                @if($order->status == $value) selected @endif
                                                style="background-color: white; color: black;"
                                            >
                                                {{ $data['text'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="status-indicator" data-order-id="{{ $order->id }}"></span>
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
    <script>
        // Define the status color and text mapping for client-side styling
        const statusColorClasses = {
            pending: { class: 'bg-warning', textColor: 'text-dark' },
            processing: { class: 'bg-info', textColor: 'text-dark' },
            delivered: { class: 'bg-primary', textColor: 'text-white' },
            completed: { class: 'bg-success', textColor: 'text-white' },
            canceled: { class: 'bg-danger', textColor: 'text-white' },
        };

        /**
         * Shows a SweetAlert notification.
         * @param {string} title - The title of the alert.
         * @param {string} message - The message body.
         * @param {string} icon - 'success', 'error', 'warning', 'info', or 'question'.
         */
        function showNotification(title, message, icon) {
            Swal.fire({
                title: title,
                html: message,
                icon: icon,
                confirmButtonText: 'تایید',
                customClass: {
                    // Ensure RTL compatibility if needed, though SweetAlert handles most RTL.
                    popup: 'text-right'
                }
            });
        }

        /**
         * Sends an AJAX request to update the order status.
         * @param {HTMLSelectElement} selectElement - The select box that triggered the change.
         */
        async function updateOrderStatus(selectElement) {
            const orderId = selectElement.dataset.orderId;
            const orderNumber = selectElement.dataset.orderNumber;
            const newStatus = selectElement.value;
            const currentStatus = selectElement.dataset.currentStatus;

            if (newStatus === currentStatus) return; // Prevent unnecessary calls

            // 1. Show confirmation dialog using SweetAlert
            const confirmationResult = await Swal.fire({
                title: 'تغییر وضعیت سفارش',
                text: `آیا مطمئن هستید که می‌خواهید وضعیت سفارش ${orderNumber} را به "${selectElement.options[selectElement.selectedIndex].text}" تغییر دهید؟`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله، تغییر بده',
                cancelButtonText: 'لغو',
                reverseButtons: true, // For RTL
            });

            if (!confirmationResult.isConfirmed) {
                // Revert the select box value if user cancels
                selectElement.value = currentStatus;
                return;
            }

            // 2. Show loading state (SweetAlert)
            Swal.fire({
                title: 'در حال به‌روزرسانی...',
                html: 'لطفاً صبر کنید، وضعیت در حال ثبت است.',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const response = await fetch("{{ route('admin.orders.update.status') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        status: newStatus
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Remove existing color classes
                    Object.values(statusColorClasses).forEach(data => {
                        selectElement.classList.remove(data.class, data.textColor);
                    });

                    // Add new color classes
                    const colorData = statusColorClasses[newStatus];
                    selectElement.classList.add(colorData.class, colorData.textColor);

                    // Update the current status dataset
                    selectElement.dataset.currentStatus = newStatus;

                    // Show success notification
                    Swal.close();
                    showNotification('موفقیت‌آمیز', result.message, 'success');
                    // Reload the page to fetch the updated data from the database
                    window.location.reload();

                } else {
                    // Revert to old status and show error
                    selectElement.value = currentStatus;
                    Swal.close();
                    showNotification('خطا', result.message || 'خطای ناشناخته در سرور.', 'error');
                }

            } catch (error) {
                // Revert to old status and show generic error
                selectElement.value = currentStatus;
                Swal.close();
                showNotification('خطا در ارتباط', 'خطا در برقراری ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی کنید.', 'error');

            }
        }
    </script>
@endsection


