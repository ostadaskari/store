@extends('admin.layouts.app')
@section('style')
    {{-- Changed to the specific CDN path used previously, as min.css often has a version in the name --}}
    <link rel="stylesheet" href="{{asset('design/css/persian-datepicker.min.css')}}">
@endsection
@section('content')
    <div class="content-section" dir="rtl">
        <div class="seven mt-3">
            <h1>لیست مشتری ها ({{ $getRecord->total() }})</h1>
        </div>

            {{-- ** FILTER FORM (AJAX) ** --}}
            <div class="row g-3">
                <div class="col-12 col-lg-9">
                    <div class="card mb-4 p-2">
                        @include('admin.layouts._message')

                        {{-- ** AJAX MESSAGE DISPLAY AREA ** --}}
                        <div id="ajaxMessage" class="mb-3"></div>

                        <!-- /.card-header -->
                        <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr">
                            <table class="table table-hover table-striped align-middle mb-0 text-center" dir="rtl" role="table">
                                <thead class="table-blue">
                                <tr>
                                    <th style="width: 3%;">#</th>
                                    <th style="width: 15%;">نام و نام خانوادگی</th>
                                    <th style="width: 30%;">ایمیل</th>
                                    <th style="width: 10%;">وضعیت</th>
                                    <th style="width: 15%;">تاریخ ثبت</th>
                                    <th style="width: 17%;">عملیات</th>
                                </tr>
                                </thead>
                                <tbody id="customerTableBody">
                                @include('admin.customers._customer_table_rows', ['getRecord' => $getRecord])
                                </tbody>
                            </table>
                        </div>

                        {{-- ** PAGINATION LINKS ** --}}
                        <div class="d-flex justify-content-center mt-3" id="paginationLinks">
                            {{ $getRecord->links() }}
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>

                <form id="customerFilterForm" method="GET" class="col-12 col-lg-3 card p-3" dir="rtl">
                    <div class="seven mt-3">
                        <h1>فیلتر مشتری</h1>
                    </div>
                    <div class="col-12">
                        <label for="name" class="form-label">نام یا نام خانوادگی:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $filters['name'] ?? '' }}">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">ایمیل:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $filters['email'] ?? '' }}">
                    </div>
                    <div class="col-12">
                        <label for="mobile" class="form-label">موبایل:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $filters['mobile'] ?? '' }}">
                    </div>
                    <div class="col-12">
                        <label for="status" class="form-label">وضعیت:</label>
                        <select id="status" name="status" class="form-select">
                            <option value="">همه</option>
                            <option value="0" {{ isset($filters['status']) && ($filters['status'] === 0 || $filters['status'] === '0') ? 'selected' : '' }}>فعال</option>
                            <option value="1" {{ isset($filters['status']) && ($filters['status'] === 1 || $filters['status'] === '1') ? 'selected' : '' }}>غیرفعال</option>
                        </select>
                    </div>
                    {{-- ** FIXED DATE INPUTS WITH DATEPICKER CLASS ** --}}
                    <div class="col-12">
                        <label for="from_date" class="form-label">تاریخ ثبت :(از)</label>
                        <input type="text" class="form-control persian-datepicker" id="from_date" name="from_date"
                            placeholder="برای انتخاب کلیک کنید"
                            value="{{ $filters['from_date'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="to_date" class="form-label">تاریخ ثبت :(تا)</label>
                        <input type="text" class="form-control persian-datepicker" id="to_date" name="to_date"
                            placeholder="برای انتخاب کلیک کنید"
                            value="{{ $filters['to_date'] ?? '' }}" readonly>
                    </div>
                    {{-- ** END FIXED DATE INPUTS ** --}}
                    <div class="col-12 d-flex align-items-end justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" id="clearBtn">
                            <i class="fas fa-redo"></i> پاک کردن فیلتر
                        </button>

                        <button type="submit" class="btn btn-primary" id="searchBtn">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                            </svg>
                            جستجو
                        </button>
                    </div>
                </form>
            </div>


    </div>


@endsection

@section('script')
    <script src="{{asset('design/js/jquery-3.7.1.min.js')}}" ></script>

    {{-- Persian Datepicker Dependencies --}}
    <script src="{{asset('design/js/persian-date.min.js')}}"></script>
    <script src="{{asset('design/js/persian-datepicker.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            const tableBody = $('#customerTableBody');
            const paginationLinks = $('#paginationLinks');
            const filterForm = $('#customerFilterForm');
            const searchBtn = $('#searchBtn');
            const listUrl = "{{ route('admin.customers.list') }}";
            const ajaxMessageContainer = $('#ajaxMessage');

            // Helper function to display messages on the page
            function displayMessage(message, type = 'info') {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                ajaxMessageContainer.html(alertHtml).addClass('d-block');
            }

            // Initialize Persian Datepicker for the date fields
            $('.persian-datepicker').persianDatepicker({
                // Note: We keep 'format: YYYY-MM-DD' for display purposes,
                // but we explicitly override the output value to be Gregorian/Latin in onSelect.
                format: 'YYYY-MM-DD',
                observer: true,
                autoClose: true,
                initialValue: false,

                onSelect: function (unix) {
                    // *** GUARANTEED FIX: Convert Unix timestamp to Gregorian date string with Latin numerals ***

                    // 1. Create a standard JS Date object (which is always Gregorian/Latin)
                    // Note: 'unix' timestamp from persian-datepicker is usually in milliseconds.
                    const jsDate = new Date(unix);

                    // 2. Format the standard JS Date object to the required YYYY-MM-DD format (Latin numerals)
                    const year = jsDate.getFullYear();
                    // getMonth() is 0-indexed, so we add 1
                    const month = String(jsDate.getMonth() + 1).padStart(2, '0');
                    const day = String(jsDate.getDate()).padStart(2, '0');

                    const gregorianDate = `${year}-${month}-${day}`;

                    // Update the input field with the pure Gregorian/Latin date string
                    $(this.model.inputElement).val(gregorianDate);

                },
            });

            // Function to perform AJAX filtering
            function fetchCustomers(url) {
                if (tableBody.length === 0 || paginationLinks.length === 0) {
                    console.error('Initialization Error: Required DOM elements not found.');
                    displayMessage('خطای داخلی: عناصر صفحه به‌درستی بارگذاری نشده‌اند.', 'danger');
                    return;
                }

                // Clear existing messages
                ajaxMessageContainer.empty().removeClass('d-block');

                searchBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> در حال جستجو...');

                const formData = filterForm.serialize();
                const baseUrl = listUrl.split('?')[0];
                let dataToSend = formData + '&ajax=1';

                // Extract page number if present in the URL
                const pageMatch = url.match(/page=(\d+)/);
                if (pageMatch) {
                    dataToSend += '&page=' + pageMatch[1];
                }

                $.ajax({
                    url: baseUrl,
                    type: 'GET',
                    data: dataToSend,
                    success: function(response) {
                        if (response.success) {
                            tableBody.html(response.tableRows);
                            paginationLinks.html(response.paginationLinks);
                            bindPaginationLinks();
                        } else {
                            // Server returns 200 but logic failed (success: false)
                            displayMessage('خطا: پاسخ سرور موفقیت آمیز نبود. (Success: false)', 'danger');
                        }
                    },
                    error: function(xhr) {
                        // Standard error handling for HTTP failures (4xx, 5xx, or network issues)
                        let userMessage = 'خطا در برقراری ارتباط با سرور. لطفا اتصال اینترنت خود را بررسی کنید.';
                        let debugDetail = `AJAX Error. Status: ${xhr.status}`;

                        if (xhr.status === 500) {
                            userMessage = 'خطای داخلی سرور (۵۰۰). لطفاً به مدیر سیستم اطلاع دهید.';
                            // We keep a minimal log but avoid logging sensitive responseText to console.
                            console.error(debugDetail, 'Server Error (500) occurred.');
                        } else if (xhr.status === 404) {
                            userMessage = 'آدرس مورد نظر پیدا نشد (۴۰۴).';
                        } else if (xhr.status !== 0) {
                            userMessage = `خطای HTTP با وضعیت ${xhr.status} رخ داد.`;
                        } else {
                            // Status 0 often means network error or request aborted
                            console.error(debugDetail, 'Details: Network failure or request aborted.');
                        }

                        // Display user-friendly message on the page
                        displayMessage(userMessage, 'danger');
                    },
                    complete: function() {
                        searchBtn.prop('disabled', false).html('<i class="fas fa-search"></i> جستجو');
                    }
                });
            }

            // 1. Handle form submission (Search Button)
            filterForm.on('submit', function(e) {
                e.preventDefault();
                fetchCustomers(listUrl);
            });

            // 2. Handle pagination links clicks
            function bindPaginationLinks() {
                paginationLinks.off('click', 'a').on('click', 'a', function(e) {
                    e.preventDefault();
                    const pageUrl = $(this).attr('href');
                    fetchCustomers(pageUrl);
                });
            }

            // Initial binding for first load
            bindPaginationLinks();

            // 3. Handle Clear Search Button
            $('#clearBtn').on('click', function() {
                filterForm.find('input[type=text], input[type=email]').val('');
                filterForm.find('select').val('');
                filterForm.find('.persian-datepicker').val('');

                // Fetch data with cleared filters
                fetchCustomers(listUrl);
            });
        });
    </script>
@endsection
