@extends('admin.layouts.app')

@section('content')
    <div class="container px-0" dir="rtl">
        <div class="seven mt-3">
            <h1>مدیریت قیمت ها</h1>
        </div>

        {{-- Settings Card --}}
        <div class="card mb-2 p-3">
            <div class="d-flex flex-row align-items-center mb-2">
                <i class="bi bi-gear mx-2"></i>
                <h5 class="mb-0" style="font-size:14px;">تنظیمات کلی</h5>
            </div>
            <div class="row g-2">
                <div class="col-md-3">
                    <label class="form-label">نرخ دلار (تومان)</label>
                    <input type="number" id="rate" class="form-control input-ltr" value="{{ $settings->dollar_rate }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">درصد سود (%)</label>
                    <input type="number" id="profit" class="form-control input-ltr" value="{{ $settings->profit_percent }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">درصد هزینه اضافه (%)</label>
                    <input type="number" id="extra" class="form-control input-ltr" value="{{ $settings->extra_percent }}">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success w-100" style="margin-top:30px;" id="save-settings">ثبت تنظیمات</button>
                </div>
            </div>
        </div>

        <div class="card p-2">
            <div class="table-responsive border shadow-sm rounded" style="max-height:66vh; overflow-y: auto;" dir="ltr">
                <table class="table table-hover align-middle mb-0 text-center" dir="rtl">
                    <thead class="table-blue">
                    <tr>
                        <th style="width:20%;">Part Number</th>
                        <th style="width:12%;">قیمت به دلار $</th>
                        <th style="width:12%;">نهایی USD</th>
                        <th style="width:12%;">قیمت به تومان</th>
                        <th style="width:12%;">تخفیف %</th>
                        <th style="color: #f36161;width:12%;">قبل از تخفیف</th>
                        <th style="background:#43897a; color:white;width:12%;">قیمت فروش</th>
                        <th style="width:5%;">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $p)
                        <tr data-part="{{ $p->part_number }}">
                            <td>{{ $p->part_number }}</td>
                            <td><input type="number" class="form-control usd-price input-ltr" value="{{ $p->price->usd_price ?? '' }}"></td>
                            <td class="final-usd-text">{{ $p->price && $p->price->final_usd ? number_format($p->price->final_usd, 2) : '0' }}</td>
                            <td><input type="number" class="form-control toman-price input-ltr" value="{{ $p->price->toman_price ?? '' }}"></td>
                            <td><input type="number" class="form-control discount-percent input-ltr" value="{{ $p->price->discount_percent ?? '0' }}"></td>
                            <td class="original-price-text" style="font-size: 0.9rem;color:#666;">
                                {{ ($p->price && $p->price->original_price > 0) ? number_format($p->price->original_price) : '0' }}
                            </td>
                            <td class="sell-price-text" style="background:#78c7b7d9; font-weight: bold;">
                                {{ $p->price && $p->price->sell_price_toman ? number_format($p->price->sell_price_toman) : '0' }}
                            </td>
                            <td><button class="btn btn-primary btn-save">ثبت</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-2">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Save Settings
            document.getElementById('save-settings').addEventListener('click', () => {
                fetch('{{ route("admin.prices.saveSettings") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        dollar_rate: document.getElementById('rate').value,
                        profit_percent: document.getElementById('profit').value,
                        extra_percent: document.getElementById('extra').value,
                    })
                }).then(r => r.json()).then(d => {
                    Swal.fire({ icon:'success', text:d.message, timer:1500 });
                    setTimeout(() => location.reload(), 1500);
                });
            });

            // Save Single Product
            document.addEventListener('click', e => {
                if (!e.target.classList.contains('btn-save')) return;
                const tr = e.target.closest('tr');

                fetch('{{ route("admin.prices.saveProduct") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        product_part_number: tr.dataset.part,
                        usd_price: tr.querySelector('.usd-price').value,
                        toman_price: tr.querySelector('.toman-price').value,
                        discount_percent: tr.querySelector('.discount-percent').value
                    })
                }).then(r => r.json()).then(d => {
                    if(d.status === 'ok') {
                        Swal.fire({ icon:'success', text:d.message, timer:1000, showConfirmButton:false });
                        const p = d.price;
                        tr.querySelector('.final-usd-text').innerText = p.final_usd ? Number(p.final_usd).toLocaleString(undefined, {minimumFractionDigits:2}) : '0';
                        tr.querySelector('.original-price-text').innerText = p.original_price ? Number(p.original_price).toLocaleString() : '0';
                        tr.querySelector('.sell-price-text').innerText = p.sell_price_toman ? Number(p.sell_price_toman).toLocaleString() : '0';
                    }
                });
            });
        });
    </script>
@endsection
