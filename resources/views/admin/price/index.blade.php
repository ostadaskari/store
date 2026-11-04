@extends('admin.layouts.app')

@section('content')

    <div class="container px-0" dir="rtl">

        {{-- Page Title --}}
        <div class="seven mt-3">
            <h1>مدیریت قیمت ها</h1>
        </div>

        {{-- Settings Card --}}
        <div class="card mb-2 p-3">

            <div class="d-flex flex-row align-items-center mb-2">

                <i class="bi bi-gear mx-2"></i>

                <h5
                    class="mb-0"
                    style="font-size:14px;"
                >
                    تنظیمات کلی
                </h5>

            </div>


            <div class="row g-2">

                <div class="col-md-3">
                    <label class="form-label">
                        نرخ دلار (تومان)
                    </label>

                    <input
                        type="text"
                        id="rate"
                        class="form-control input-ltr"
                        value="{{ $settings->dollar_rate }}"
                        inputmode="decimal"
                        autocomplete="off"
                    >
                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        درصد سود (%)
                    </label>

                    <input
                        type="number"
                        id="profit"
                        class="form-control input-ltr"
                        value="{{ $settings->profit_percent }}"
                    >

                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        درصد هزینه حمل و نقل و ترخیص (%)
                    </label>

                    <input
                        type="number"
                        id="extra"
                        class="form-control input-ltr"
                        value="{{ $settings->extra_percent }}"
                    >

                </div>


                <div class="col-md-3">

                    <button
                        class="btn btn-success w-100"
                        style="margin-top:30px;"
                        id="save-settings"
                        type="button"
                    >
                        ثبت تنظیمات
                    </button>

                </div>

            </div>

        </div>



        {{-- Products Card --}}
        <div class="card p-2">

            {{-- بخش دکمه‌های اکسل (Export و Import) --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-0 text-secondary" style="font-size: 15px;">مدیریت قیمت‌ها و مقایسه</h5>
                </div>

                <div class="d-flex gap-2">
                    {{-- دکمه Export Excel --}}
                    <form action="{{ route('admin.prices.export') }}" method="GET" class="d-flex align-items-center gap-2">
                        {{-- فیلد وارد کردن نرخ تبدیل یوان به دلار توسط اپراتور --}}
                        <div class="input-group input-group-sm" style="width: 220px;">
                            <span class="input-group-text bg-light" style="font-size: 12px;">نرخ دلار به یوان:</span>
                            <input type="number" step="any" name="cny_usd_rate" class="form-control input-ltr" value="7.2" required title="نرخ تبدیل یوان به دلار را وارد کنید">
                        </div>

                        {{-- دکمه خروجی اکسل با آیکون SVG --}}
                        <button type="submit" class="btn btn-success btn-sm d-flex align-items-center gap-2 shadow-sm" style="background-color: #107c41; border-color: #107c41;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                            </svg>
                            <span>خروجی اکسل</span>
                        </button>
                    </form>

                    {{-- فرم مخفی برای انتخاب و آپدیت فایل اکسل --}}
                    <input type="file" id="excel-file-input" name="excel_file" accept=".xlsx, .xls, .csv" style="display: none;">

                    {{-- دکمه Import Excel --}}
                    <button type="button" class="btn btn-outline-success btn-sm d-flex align-items-center gap-2 shadow-sm" id="btn-import-trigger" style="border-color: #107c41; color: #107c41;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/>
                        </svg>
                        <span>ایمپورت اکسل</span>
                    </button>
                </div>
            </div>


            {{-- Search Form --}}
            <div class="mb-3">

                <form method="GET" action="{{ url()->current() }}" id="search-form">

                    <label
                        for="part-number-search"
                        class="form-label mb-1"
                    >
                        جستجوی Part Number
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            id="part-number-search"
                            class="form-control input-ltr"
                            placeholder="Part Number را وارد کنید..."
                            value="{{ $search ?? '' }}"
                            autocomplete="off"
                        >

                        @if(!empty($search))
                            <a
                                href="{{ url()->current() }}"
                                class="btn btn-outline-secondary"
                                id="clear-part-search"
                                title="پاک کردن جستجو"
                            >
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-search me-1"></i>
                            جستجو
                        </button>

                    </div>

                </form>

                {{-- Search Info --}}
                <div
                    id="search-info"
                    class="small text-muted mt-1"
                >
                    @if(!empty($search))
                        نتایج جستجو برای:
                        <strong>{{ $search }}</strong>
                        —
                        {{ $products->total() }} محصول
                    @else
                        برای جستجو، بخشی از Part Number را وارد کنید و روی دکمه جستجو کلیک کنید.
                    @endif
                </div>

            </div>



            {{-- Table --}}
            <div
                class="table-responsive border shadow-sm rounded"
                style="
                max-height:66vh;
                overflow-y:auto;
            "
                dir="ltr"
            >

                <table
                    class="table table-hover align-middle mb-0 text-center"
                    dir="rtl"
                >

                    <thead class="table-blue">

                    <tr>
                        <th style="width:5%;">#</th>

                        <th style="width:20%;">
                            Part Number
                        </th>

                        <th style="width:12%;">
                            قیمت به دلار $
                        </th>

                        <th style="width:12%;">
                            نهایی USD
                        </th>

                        <th style="width:12%;">
                            قیمت به تومان
                        </th>

                        <th style="width:12%;">
                            تخفیف %
                        </th>
                        <th style="width:12%;">
                            سود خاص %
                        </th>

                        <th
                            style="
                            color:#f36161;
                            width:12%;
                        "
                        >
                            قبل از تخفیف
                        </th>

                        <th
                            style="
                            background:#43897a;
                            color:white;
                            width:12%;
                        "
                        >
                            قیمت فروش
                        </th>

                        <th style="width:5%;">
                            عملیات
                        </th>

                    </tr>

                    </thead>

                    @include(
                        'admin.price._products_table',
                        ['products' => $products]
                    )

                </table>

            </div>

            {{-- Pagination Container --}}
            <div
                id="products-pagination"
                class="d-flex justify-content-center mt-3"
            >
                {{ $products->links() }}
            </div>

        </div>

    </div>

@endsection



@section('script')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const saveSettingsButton = document.getElementById('save-settings');
            const rateInput = document.getElementById('rate');

            /*
            |--------------------------------------------------------------------------
            | Dollar Rate Formatting
            |--------------------------------------------------------------------------
            */
            function formatRate(value) {
                value = value.replace(/,/g, '').replace(/[^\d.]/g, '');
                const parts = value.split('.');
                const integerPart = parts[0];
                const decimalPart = parts.slice(1).join('').slice(0, 2);
                const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                return parts.length > 1 ? formattedInteger + '.' + decimalPart : formattedInteger;
            }

            if (rateInput) {
                rateInput.value = formatRate(rateInput.value);
                rateInput.addEventListener('input', function () {
                    const cursor = this.selectionStart;
                    const beforeCursor = this.value.slice(0, cursor);
                    const digitsBeforeCursor = beforeCursor.replace(/,/g, '').length;
                    this.value = formatRate(this.value);
                    let position = 0;
                    let digitsFound = 0;
                    while (position < this.value.length && digitsFound < digitsBeforeCursor) {
                        if (this.value[position] !== ',') { digitsFound++; }
                        position++;
                    }
                    this.setSelectionRange(position, position);
                });
            }

            /*
            |--------------------------------------------------------------------------
            | USD / Toman Price Mutual Exclusion
            |--------------------------------------------------------------------------
            */
            function updatePriceInputs(tr) {
                const usdInput = tr.querySelector('.usd-price');
                const tomanInput = tr.querySelector('.toman-price');
                if (!usdInput || !tomanInput) return;

                const hasUsd = usdInput.value.trim() !== '';
                const hasToman = tomanInput.value.trim() !== '';

                tomanInput.disabled = hasUsd;
                tomanInput.classList.toggle('price-locked', hasUsd);

                usdInput.disabled = hasToman;
                usdInput.classList.toggle('price-locked', hasToman);
            }

            document.querySelectorAll('tr[data-part]').forEach(function (tr) {
                updatePriceInputs(tr);
            });

            document.addEventListener('input', function (event) {
                if (!event.target.matches('.usd-price, .toman-price')) return;
                const tr = event.target.closest('tr[data-part]');
                if (tr) { updatePriceInputs(tr); }
            });

            /*
            |--------------------------------------------------------------------------
            | Save Settings
            |--------------------------------------------------------------------------
            */
            if (saveSettingsButton) {
                saveSettingsButton.addEventListener('click', async function () {
                    const button = this;
                    button.disabled = true;
                    button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> در حال ذخیره...';

                    try {
                        const response = await fetch('{{ route("admin.prices.saveSettings") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                dollar_rate: document.getElementById('rate').value.replace(/,/g, ''),
                                profit_percent: document.getElementById('profit').value,
                                extra_percent: document.getElementById('extra').value
                            })
                        });

                        const data = await response.json();
                        if (!response.ok) throw new Error(data.message || 'خطا در ذخیره تنظیمات');

                        Swal.fire({ icon: 'success', text: data.message, timer: 1500, showConfirmButton: false });
                        setTimeout(() => { location.reload(); }, 1500);

                    } catch (error) {
                        console.error(error);
                        Swal.fire({ icon: 'error', title: 'خطا', text: error.message || 'ذخیره تنظیمات انجام نشد.', confirmButtonText: 'باشه' });
                    } finally {
                        button.disabled = false;
                        button.innerHTML = 'ثبت تنظیمات';
                    }
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Save Single Product
            |--------------------------------------------------------------------------
            */
            document.addEventListener('click', async function (event) {
                const button = event.target.closest('.btn-save');
                if (!button) return;

                const tr = button.closest('tr');
                if (!tr) return;

                const originalText = button.innerHTML;
                button.disabled = true;
                button.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

                try {
                    const usdInput = tr.querySelector('.usd-price');
                    const tomanInput = tr.querySelector('.toman-price');

                    const response = await fetch('{{ route("admin.prices.saveProduct") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            product_part_number: tr.dataset.part,
                            usd_price: usdInput.value.trim(),
                            toman_price: tomanInput.value.trim(),
                            discount_percent: tr.querySelector('.discount-percent').value,
                            special_profit_percent: tr.querySelector('.special-profit-percent').value
                        })
                    });

                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'خطا در ذخیره قیمت');

                    if (data.status === 'ok') {
                        const p = data.price;
                        tr.querySelector('.final-usd-text').innerText = (p && p.final_usd) ? Number(p.final_usd).toLocaleString(undefined, { minimumFractionDigits: 2 }) : '0';
                        tr.querySelector('.original-price-text').innerText = (p && p.original_price) ? Number(p.original_price).toLocaleString() : '0';
                        tr.querySelector('.sell-price-text').innerText = (p && p.sell_price_toman) ? Number(p.sell_price_toman).toLocaleString() : '0';

                        if (!p) {
                            usdInput.value = '';
                            tomanInput.value = '';
                            tr.querySelector('.discount-percent').value = '0';
                            tr.querySelector('.special-profit-percent').value = '0';
                        } else {
                            tr.querySelector('.special-profit-percent').value = p.special_profit_percent ?? '0';
                        }

                        updatePriceInputs(tr);
                        Swal.fire({ icon: 'success', text: data.message || 'قیمت محصول ذخیره شد.', timer: 1000, showConfirmButton: false });
                    }

                } catch (error) {
                    console.error(error);
                    Swal.fire({ icon: 'error', title: 'خطا', text: error.message || 'ذخیره قیمت انجام نشد.', confirmButtonText: 'باشه' });
                } finally {
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            });

            /*
            |--------------------------------------------------------------------------
            | Excel Import Logic (Vanilla JS)
            |--------------------------------------------------------------------------
            */
            const importTrigger = document.getElementById('btn-import-trigger');
            const fileInput = document.getElementById('excel-file-input');

            if (importTrigger && fileInput) {
                importTrigger.addEventListener('click', function() {
                    fileInput.value = '';
                    fileInput.click();
                });

                fileInput.addEventListener('change', function(e) {
                    let file = e.target.files[0];
                    if (!file) return;

                    let formData = new FormData();
                    formData.append('excel_file', file);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    Swal.fire({
                        title: 'در حال بررسی فایل اکسل...',
                        text: 'لطفاً کمی صبر کنید تا تغییرات مقایسه شوند.',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    fetch("{{ route('admin.prices.import.preview') }}", {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                        .then(async response => {
                            Swal.close();
                            let data = await response.json();
                            if (!response.ok) throw new Error(data.message || 'خطایی در پردازش فایل اکسل رخ داد.');
                            return data;
                        })
                        .then(data => {
                            if (data.status === 'ok') {
                                if (data.changed_count === 0) {
                                    Swal.fire('توجه', 'هیچ تغییری در فایل اکسل نسبت به اطلاعات فعلی دیتابیس یافت نشد.', 'info');
                                    return;
                                }

                                // ساخت لیست HTML پارت‌نامبرها برای نمایش داخل اسکرول‌پارت
                                let listHtml = `<div style="max-height: 200px; overflow-y: auto; text-align: right; border: 1px solid #ddd; padding: 10px; border-radius: 5px; margin-top: 10px; background: #f9f9f9;">
                        <table style="width: 100%; font-size: 13px; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 1px solid #ccc; background: #eee;">
                                    <th style="padding: 5px;">Part Number</th>
                                    <th style="padding: 5px;">قیمت قبل ($)</th>
                                    <th style="padding: 5px;">قیمت جدید ($)</th>
                                </tr>
                            </thead>
                            <tbody>`;

                                data.changed_parts.forEach(item => {
                                    listHtml += `<tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 5px; font-family: monospace;"><b>${item.part_number}</b></td>
                            <td style="padding: 5px; color: #666;">${item.old_usd}</td>
                            <td style="padding: 5px; color: #107c41; font-weight: bold;">${item.new_usd}</td>
                        </tr>`;
                                });

                                listHtml += `</tbody></table></div>`;

                                // نمایش پاپ‌آپ همراه با لیست اسکرول‌دار
                                Swal.fire({
                                    title: 'تایید بروزرسانی قیمت‌ها',
                                    html: `تعداد <b>${data.changed_count}</b> پارت‌نامبر تغییر قیمت داشته‌اند:<br>${listHtml}<br><span style="font-size: 13px; color: #555;">آیا از اعمال این تغییرات اطمینان دارید؟</span>`,
                                    icon: 'question',
                                    width: '600px',
                                    showCancelButton: true,
                                    confirmButtonColor: '#107c41',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'بله، بروزرسانی شود',
                                    cancelButtonText: 'انصراف'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        confirmImportExecution(data.cache_key);
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            Swal.close();
                            Swal.fire('خطا!', error.message || 'خطایی رخ داد.', 'error');
                        });
                });
            }

        });

        // مرحله ۲: تایید نهایی برای اعمال در دیتابیس
        function confirmImportExecution(cacheKey) {
            Swal.fire({
                title: 'در حال اعمال تغییرات...',
                text: 'لطفاً صبر کنید تا قیمت‌های نهایی محاسبه و ذخیره شوند.',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            fetch("{{ route('admin.prices.import.confirm') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ cache_key: cacheKey })
            })
                .then(async response => {
                    let data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'خطایی در ذخیره‌سازی اطلاعات رخ داد.');
                    return data;
                })
                .then(data => {
                    Swal.fire({
                        title: 'موفقیت‌آمیز!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'باشه'
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire('خطا!', error.message || 'خطایی رخ داد.', 'error');
                });
        }
    </script>



@endsection

