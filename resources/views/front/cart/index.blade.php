@extends('front.layouts.app')

@section('content')
    <div class="container row" style="padding-top:200px;">
        <h3>سبد خرید</h3>

       <div class="col-12 col-md-8">
           <table class="table">
               <thead>
               <tr>
                   <th>محصول</th>
                   <th>قیمت</th>
                   <th>تعداد</th>
                   <th>مجموع (تومان)</th>
                   <th>حذف</th>
               </tr>
               </thead>

               <tbody id="cart-body">

               @forelse ($cart as $item)
                   <tr id="item-{{ $item->id }}">

                       <td>
                           <img src="{{ $item->attributes->image }}" width="50">
                           {{ $item->name }}
                       </td>

                       <td>{{ number_format($item->price) }} تومان</td>

                       <td>
                           <div class="d-flex align-items-center">

                               <button class="btn btn-sm btn-light qty-btn" data-id="{{ $item->id }}" data-type="minus">−</button>

                               <input
                                   type="number"
                                   id="qty-{{ $item->id }}"
                                   class="form-control mx-2 text-center"
                                   value="{{ $item->quantity }}"
                                   min="1"
                                   style="width:70px"
                               >

                               <button class="btn btn-sm btn-light qty-btn" data-id="{{ $item->id }}" data-type="plus">+</button>

                           </div>
                       </td>

                       <td id="line-total-{{ $item->id }}">
                           {{ number_format($item->price * $item->quantity) }}
                       </td>

                       <td>
                           <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-danger">×</a>
                       </td>

                   </tr>
               @empty
                   <tr><td colspan="5">سبد خرید خالی است</td></tr>
               @endforelse

               </tbody>
           </table>

           <h3>جمع کل: <span id="grand-total">{{ number_format($total) }}</span> تومان</h3>

       </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0" style="position: sticky;height: 300px;top:15%;">
                <div class="card-body p-4">
                    <!-- Cart total -->
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background-color: rgba(223, 233, 222, 0.932);">
                        <div class="d-flex flex-row align-items-center">
                            <svg width="25" height="25" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5"></path>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"></path>
                            </svg>
                            <span class="text-muted px-2">جمع سبد خرید شما</span>
                        </div>
                        <strong id="summary-total">{{ number_format($total) }} تومان </strong>
                    </div>
                    <hr>
                    <!-- Shipping cost -->
                    <div class="d-flex flex-column my-2" style="font-size: 12px;">
                        <h5 class="mb-0">هزینه ارسال</h5>
                        <p class="mb-0 text-success">هزینه ارسال بر اساس آدرس، وزن و حجم مرسوله شما محاسبه میگردد.</p>
                    </div>
                    <!-- Action buttons -->
                    <div class="d-flex gap-2 justify-content-center mt-5">
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary w-50" >
                            <i class="fa fa-shopping-cart me-1"></i> ادامه خرید
                        </a>
                        <a class="btn btn-success w-50" href="{{ url('checkout') }}">
                            ثبت سفارش <i class="fa fa-play ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ... (Your existing code for .qty-btn click listeners) ...

            // AJAX function to update cart
            function updateCart(id, qty) {
                fetch("{{ url('/cart/ajax/update') }}/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ qty: qty })
                })
                    .then(response => response.json())
                    .then(data => {

                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        // Use Intl.NumberFormat to format the number
                        const formattedTotal = new Intl.NumberFormat().format(data.grand_total);

                        // 1. Update line total
                        document.querySelector("#line-total-" + id).innerText = new Intl.NumberFormat().format(data.line_total);

                        // 2. Update grand total in the main column
                        document.querySelector("#grand-total").innerText = formattedTotal;

                        //   Update grand total in the summary card
                        document.querySelector("#summary-total").innerText = formattedTotal + " تومان";
                    });
            }

            // ... (Your existing code for + and - buttons) ...
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    let id = this.dataset.id;
                    let type = this.dataset.type;
                    let input = document.querySelector('#qty-' + id);
                    let qty = parseInt(input.value);

                    if (type === "plus") qty++;
                    if (type === "minus" && qty > 1) qty--;

                    input.value = qty;
                    updateCart(id, qty);
                });
            });

        });
    </script>
@endsection
