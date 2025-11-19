@extends('admin.layouts.app')

@section('content')
    <div class="container" dir="rtl">
        <h3>مدیریت قیمت‌ها</h3>

        {{-- GLOBAL SETTINGS --}}
        <div class="card mb-4 p-3">
            <h5 class="mb-3">
                تنظیمات کلی قیمت
                <i class="bi bi-info-circle text-primary"
                   title="مثال:
- نرخ دلار: فقط عدد مثل 113500
- درصد سود: مثلا 5 یعنی 5%
- درصد هزینه اضافی: مثلا 5 یعنی 5%"
                   style="cursor:pointer;">
                </i>
            </h5>

            <div class="row g-3">

                <div class="col-md-3">
                    <label class="form-label">نرخ دلار (تومان)</label>
                    <input type="number" id="rate" class="form-control"
                           placeholder="مثال: 113500"
                           value="{{ $settings->dollar_rate }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">درصد سود (%)</label>
                    <input type="number" id="profit" class="form-control"
                           placeholder="مثال: 5"
                           value="{{ $settings->profit_percent }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">درصد هزینه اضافه (%)</label>
                    <input type="number" id="extra" class="form-control"
                           placeholder="مثال: 5"
                           value="{{ $settings->extra_percent }}">
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-success w-100" id="save-settings">
                        ثبت تنظیمات
                    </button>
                </div>

            </div>
        </div>


        {{-- PRODUCT PRICES --}}
        <div class="card p-3">

            <table class="table table-bordered text-center align-middle">
                <thead>
                <tr>
                    <th>Part Number</th>
                    <th> قیمت به دلار $</th>
                    <th>نهایی USD</th>
                    <th>قیمت به تومان</th>
                    <th style="background:#7861e4;">
                        قیمت فروش
                        <i class="bi bi-info-circle text-primary"
                           title="اولویت با قیمت دلاری. اگر قیمت دلاری پاک شود و قیمت به تومان نوشته شود، قیمت فروش بر حسب قیمت تومانی محاسبه میشود"
                           style="cursor:pointer;">
                        </i>
                    </th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $p)
                    @php
                        $price = $p->price;   // null if not exist
                    @endphp

                    <tr data-part="{{ $p->part_number }}">

                        <td>{{ $p->part_number }}</td>

                        <td>
                            <input type="number"
                                   class="form-control usd-price"
                                   value="{{ $price->usd_price ?? '' }}"
                                   placeholder="USD قیمت">
                        </td>

                        {{-- Final USD --}}
                        <td>
                            {{ $price && $price->final_usd
                                ? number_format($price->final_usd, 2)
                                : '0' }}
                        </td>

                        {{-- Manual Toman --}}
                        <td>
                            <input type="number"
                                   class="form-control toman-price"
                                   value="{{ $price->toman_price ?? '' }}"
                                   placeholder="تومان (دلخواه)">
                        </td>

                        {{-- Final Sell Toman (rounded — already saved in DB) --}}
                        <td style="background:#8773e1;">
                            {{ $price && $price->sell_price_toman
                                ? number_format($price->sell_price_toman)
                                : '0' }}
                        </td>

                        <td>
                            <button class="btn btn-primary btn-save">ثبت</button>
                        </td>

                    </tr>

                @endforeach
                </tbody>
            </table>

            <div>{{ $products->links() }}</div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        // Function to format numbers with commas (for better readability)
        const formatNumber = (num, decimals = 0) => {
            if (num === 0 || isNaN(num)) return '0';
            return parseFloat(num).toLocaleString('en-US', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            });
        };

        // Main Calculation Function
        const calculatePrices = (usd, toman) => {
            // 1. Get Global Settings from the inputs
            const rate = parseFloat(document.getElementById('rate').value) || 0;
            const profit = parseFloat(document.getElementById('profit').value) || 0;
            const extra = parseFloat(document.getElementById('extra').value) || 0;
            const totalPercent = (profit + extra) / 100;

            let final_usd = 0;
            let final_toman = 0;

            // 2. Calculate Final USD
            if (usd > 0) {
                final_usd = usd * (1 + totalPercent);
            }

            // 3. Calculate Final Toman
            if (final_usd > 0) {
                // If USD price is set, use it to calculate Toman
                final_toman = final_usd * rate;
            } else if (toman > 0) {
                // If only Toman (Manual) price is set, calculate final Toman from it
                final_toman = toman * (1 + totalPercent);
            }

            // 4. Return the calculated values
            return {
                final_usd: final_usd,
                final_toman: final_toman
            };
        };


        document.addEventListener('DOMContentLoaded', () => {

            // SAVE GLOBAL SETTINGS (No change needed here, it triggers a page reload/refresh of all)
            document.getElementById('save-settings').addEventListener('click', () => {
                // ... (existing code for saving settings) ...
                Swal.fire({
                    title: 'آیا مطمئنید؟',
                    text: "تنظیمات ذخیره شود؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر'
                }).then(result => {

                    if (!result.isConfirmed) return;

                    fetch('{{ route("admin.prices.saveSettings") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            dollar_rate: document.getElementById('rate').value,
                            profit_percent: document.getElementById('profit').value,
                            extra_percent: document.getElementById('extra').value,
                        })
                    })
                        .then(r => r.json())
                        // NOTE: If global settings change, ideally you should recalculate ALL product prices.
                        // For simplicity now, we just show success and rely on a page refresh for ALL products.
                        .then(d => {
                            Swal.fire({
                                icon:'success',
                                text:d.message,
                                timer:1200,
                                showConfirmButton:false
                            });

                            // 🔥 Refresh page after settings saved
                            setTimeout(() => location.reload(), 1200);
                        })
                        .catch(() => Swal.fire({icon:'error', text:'خطا در ذخیره'}));
                });
            });


            // SAVE PER-PRODUCT PRICE (Updated to include local calculation)
            document.addEventListener('click', e => {
                if (!e.target.classList.contains('btn-save')) return;

                const tr = e.target.closest('tr');
                const part = tr.dataset.part;

                // Get the input values as numbers (or 0)
                const usd = parseFloat(tr.querySelector('.usd-price').value) || 0;
                const toman = parseFloat(tr.querySelector('.toman-price').value) || 0;

                // Send the data to the server
                fetch('{{ route("admin.prices.saveProduct") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        product_part_number: part,
                        usd_price: usd,
                        toman_price: toman
                    })
                })
                    .then(r => r.json())
                    .then(d => {
                        // Success toast
                        Swal.fire({icon:'success', text:d.message, timer:1200, showConfirmButton:false});

                        // Update final usd and final toman from returned price object
                        const resPrice = d.price;
                        const p = d.price;

// final USD column (index 2)
                        tr.children[2].innerText =
                            p.final_usd ? Number(p.final_usd).toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) : '0';

// final Toman column (index 4)
                        tr.children[4].innerText =
                            p.sell_price_toman ? Number(p.sell_price_toman).toLocaleString('en-US') : '0';

                    })
                    .catch(() => Swal.fire({icon:'error', text:'خطا در ذخیره'}));

            });

        });
    </script>
@endsection
