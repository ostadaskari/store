@extends('admin.layouts.app')

@section('content')
    <div class="container px-0" dir="rtl">
        <div class="seven mt-3">
            <h1>مدیریت قیمت ها</h1>
        </div>

        {{-- Settings --}}
        <div class="card mb-2 p-3">
            <div class="d-flex flex-row align-items-center mb-2">
                <svg width="18" height="18" fill="currentColor" class="bi bi-gear mx-2" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                </svg>
                <h5 class="mb-0" style="font-size:14px;">تنظیمات کلی</h5>
                <i class="bi bi-info-circle text-primary mx-1"
                   title="مثال:
                    - نرخ دلار: فقط عدد مثل 113500
                    - درصد سود: مثلا 5 یعنی 5%
                    - درصد هزینه اضافی: مثلا 5 یعنی 5%"
                   style="cursor:pointer;">
                </i>
            </div>
            <div class="row g-2">
                <div class="col-md-3">
                    <label class="form-label">نرخ دلار (تومان)</label>
                    <input type="number" id="rate" class="form-control input-ltr" placeholder="نرخ دلار" value="{{ $settings->dollar_rate }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">درصد سود (%)</label>
                    <input type="number" id="profit" class="form-control input-ltr" placeholder="درصد سود" value="{{ $settings->profit_percent }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">درصد هزینه اضافه (%)</label>
                    <input type="number" id="extra" class="form-control input-ltr" placeholder="درصد هزینه اضافی" value="{{ $settings->extra_percent }}">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success w-100" style="margin-top:30px;" id="save-settings">ثبت تنظیمات</button>
                </div>
            </div>
        </div>

        <div class="card p-3">
            {{-- Products Table --}}
            <div class="table-responsive border shadow-sm rounded bg-white" style="max-height:66vh; overflow-y: auto;" dir="ltr">
                <table class="table table-hover align-middle mb-0 text-center" dir="rtl">
                <thead class="table-blue">
                    <tr>
                        <th>Part Number</th>
                        <th> قیمت به دلار $</th>
                        <th>نهایی USD</th>
                        <th>قیمت به تومان</th>
                        <th>تخفیف %</th>
                        <th style="color: #666; font-size: 0.85rem;">قبل از تخفیف</th>
                        <th style="background:#43897a;">
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
                            $price = $p->price;
                          // Pre-calculate display "before discount" logic for initial load
                          $rate = $settings->dollar_rate;
                          $costMult = 1 + (($settings->profit_percent + $settings->extra_percent) / 100);
                          $beforeDiscount = 0;
                          if($price && $price->usd_price > 0) {
                              $beforeDiscount = ($price->usd_price * $costMult) * $rate;
                          } elseif($price && $price->toman_price > 0) {
                              $beforeDiscount = $price->toman_price * $costMult;
                          }
                         @endphp

                        <tr data-part="{{ $p->part_number }}">
                            <td style="font-weight: 200;font-size: 16px;">{{ $p->part_number }}</td>
                            <td><input type="number" class="form-control usd-price input-ltr" value="{{ $price->usd_price ?? '' }}" placeholder="USD قیمت"></td>
                            <td> {{ $price && $price->final_usd
                                ? number_format($price->final_usd, 2)
                                : '0' }}</td>

                            <td>
                                <input type="number" class="form-control toman-price input-ltr"
                                    value="{{ $price->toman_price ?? '' }}"
                                   placeholder="تومان (دلخواه)">
                            </td>
                            <td><input type="number" class="form-control discount-percent input-ltr" value="{{ $price->discount_percent ?? '0' }}"></td>

                            <td  style="font-size: 0.9rem;color:#666;">
                                {{ $beforeDiscount > 0 ? number_format($beforeDiscount) : '0' }}
                            </td>

                            <td style="background:#78c7b7d9; font-weight: bold;">
                                {{ $price && $price->sell_price_toman ? number_format($price->sell_price_toman) : '0' }}
                            </td>


                            <td><button class="btn btn-primary btn-save">ثبت</button></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>{{ $products->links() }}</div>
            </div>
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
                const usd = tr.querySelector('.usd-price').value;
                const toman = tr.querySelector('.toman-price').value;
                const discount = tr.querySelector('.discount-percent').value;

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
                        toman_price: toman,
                        discount_percent: discount
                    })
                })
                    .then(r => r.json())
                    .then(d => {
                        Swal.fire({icon:'success', text:d.message, timer:1200, showConfirmButton:false});
                        const p = d.price;
                        // Final USD (Index 2)
                        tr.children[2].innerText = p.final_usd ? Number(p.final_usd).toLocaleString('en-US', {minimumFractionDigits: 2}) : '0';
                        // Final Toman (Index 5)
                        tr.children[5].innerText = p.sell_price_toman ? Number(p.sell_price_toman).toLocaleString('en-US') : '0';
                    })
                    .catch(() => Swal.fire({icon:'error', text:'خطا در ذخیره'}));
            });

        });
    </script>
@endsection
