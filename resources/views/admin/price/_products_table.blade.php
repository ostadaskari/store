@forelse($products as $p)

    <tr data-part="{{ $p->part_number }}">

        {{-- Part Number --}}
        <td>
        <span class="part-number-text">
            {{ $p->part_number }}
        </span>
        </td>


        {{-- USD Price --}}
        <td>
            <input
                type="number"
                step="any"
                class="form-control usd-price input-ltr"
                value="{{ $p->price->usd_price ?? '' }}"
            >
        </td>


        {{-- Final USD --}}
        <td class="final-usd-text">
            {{
                $p->price &&$p->price->final_usd
                    ? number_format($p->price->final_usd, 2)
                    : '0'
            }}
        </td>


        {{-- Toman Price --}}
        <td>
            <input
                type="number"
                step="any"
                class="form-control toman-price input-ltr"
                value="{{ $p->price->toman_price ?? '' }}"
            >
        </td>


        {{-- Discount --}}
        <td>
            <input
                type="number"
                step="any"
                min="0"
                max="100"
                class="form-control discount-percent input-ltr"
                value="{{ $p->price->discount_percent ?? '0' }}"
            >
        </td>


        {{-- Original Price --}}
        <td
            class="original-price-text"
            style="font-size:0.9rem;color:#666;"
        >
            {{
                ($p->price &&$p->price->original_price > 0)
                    ? number_format($p->price->original_price)
                    : '0'
            }}
        </td>


        {{-- Sell Price --}}
        <td
            class="sell-price-text"
            style="
            background:#78c7b7d9;
            font-weight:bold;
        "
        >
            {{
                $p->price &&$p->price->sell_price_toman
                    ? number_format($p->price->sell_price_toman)
                    : '0'
            }}
        </td>


        {{-- Save --}}
        <td>
            <button
                type="button"
                class="btn btn-primary btn-save"
            >
                ثبت
            </button>
        </td>

    </tr>


@empty

    <tr>
        <td colspan="8">

            <div class="text-center py-5">

                <i
                    class="bi bi-search"
                    style="font-size:40px;opacity:.35;"
                ></i>

                <div class="mt-2 text-muted">
                    محصولی با این Part Number پیدا نشد.
                </div>

            </div>

        </td>
    </tr>


@endforelse
