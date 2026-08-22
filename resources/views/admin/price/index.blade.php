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
                        type="number"
                        id="rate"
                        class="form-control input-ltr"
                        value="{{ $settings->dollar_rate }}"
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
                        درصد هزینه اضافه (%)
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

            /*
            |--------------------------------------------------------------------------
            | Elements
            |--------------------------------------------------------------------------
            */

            const saveSettingsButton =
                document.getElementById('save-settings');


            /*
            |--------------------------------------------------------------------------
            | Save Settings
            |--------------------------------------------------------------------------
            */

            if (saveSettingsButton) {

                saveSettingsButton.addEventListener(
                    'click',
                    async function () {

                        const button = this;

                        button.disabled = true;

                        button.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-1"></span>' +
                            ' در حال ذخیره...';

                        try {

                            const response = await fetch(
                                '{{ route("admin.prices.saveSettings") }}',
                                {
                                    method: 'POST',

                                    headers: {
                                        'X-CSRF-TOKEN':
                                            '{{ csrf_token() }}',

                                        'Content-Type':
                                            'application/json',

                                        'Accept':
                                            'application/json'
                                    },

                                    body: JSON.stringify({

                                        dollar_rate:
                                        document.getElementById(
                                            'rate'
                                        ).value,

                                        profit_percent:
                                        document.getElementById(
                                            'profit'
                                        ).value,

                                        extra_percent:
                                        document.getElementById(
                                            'extra'
                                        ).value

                                    })
                                }
                            );

                            const data = await response.json();

                            if (!response.ok) {
                                throw new Error(
                                    data.message ||
                                    'خطا در ذخیره تنظیمات'
                                );
                            }

                            Swal.fire({
                                icon: 'success',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            setTimeout(
                                function () {
                                    location.reload();
                                },
                                1500
                            );

                        } catch (error) {

                            console.error(error);

                            Swal.fire({
                                icon: 'error',
                                title: 'خطا',
                                text:
                                    error.message ||
                                    'ذخیره تنظیمات انجام نشد.',
                                confirmButtonText: 'باشه'
                            });

                        } finally {

                            button.disabled = false;

                            button.innerHTML = 'ثبت تنظیمات';

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Save Single Product
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'click',
                async function (event) {

                    const button =
                        event.target.closest(
                            '.btn-save'
                        );

                    if (!button) {
                        return;
                    }

                    const tr =
                        button.closest('tr');

                    if (!tr) {
                        return;
                    }

                    const originalText =
                        button.innerHTML;

                    button.disabled = true;

                    button.innerHTML =
                        '<span class="spinner-border spinner-border-sm"></span>';

                    try {

                        const response =
                            await fetch(
                                '{{ route("admin.prices.saveProduct") }}',
                                {
                                    method: 'POST',

                                    headers: {

                                        'X-CSRF-TOKEN':
                                            '{{ csrf_token() }}',

                                        'Content-Type':
                                            'application/json',

                                        'Accept':
                                            'application/json'

                                    },

                                    body: JSON.stringify({

                                        product_part_number:
                                        tr.dataset.part,

                                        usd_price:
                                        tr.querySelector(
                                            '.usd-price'
                                        ).value,

                                        toman_price:
                                        tr.querySelector(
                                            '.toman-price'
                                        ).value,

                                        discount_percent:
                                        tr.querySelector(
                                            '.discount-percent'
                                        ).value

                                    })
                                }
                            );

                        const data = await response.json();

                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'خطا در ذخیره قیمت'
                            );

                        }

                        if (data.status === 'ok') {

                            const p = data.price;

                            tr.querySelector(
                                '.final-usd-text'
                            ).innerText =
                                p.final_usd
                                    ? Number(
                                        p.final_usd
                                    ).toLocaleString(
                                        undefined,
                                        {
                                            minimumFractionDigits: 2
                                        }
                                    )
                                    : '0';

                            tr.querySelector(
                                '.original-price-text'
                            ).innerText =
                                p.original_price
                                    ? Number(
                                        p.original_price
                                    ).toLocaleString()
                                    : '0';

                            tr.querySelector(
                                '.sell-price-text'
                            ).innerText =
                                p.sell_price_toman
                                    ? Number(
                                        p.sell_price_toman
                                    ).toLocaleString()
                                    : '0';

                            Swal.fire({
                                icon: 'success',
                                text:
                                    data.message ||
                                    'قیمت ذخیره شد.',
                                timer: 1000,
                                showConfirmButton: false
                            });

                        }

                    } catch (error) {

                        console.error(error);

                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text:
                                error.message ||
                                'ذخیره قیمت انجام نشد.',
                            confirmButtonText: 'باشه'
                        });

                    } finally {

                        button.disabled = false;

                        button.innerHTML = originalText;

                    }

                }
            );

        });

    </script>

@endsection
