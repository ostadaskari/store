@extends('front.layouts.app')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="container topPadd mt-4">
        <div class="row">
            <div class="col-12 col-md-8 p-0">
                <!-- title -->
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="card-title m-0">شیوه ارسال</h6>
                    <a href="index.html" class="btn btn-link text-decoration-none">بازگشت به فروشگاه</a>
                </div>
                <!-- Payment Section -->
                <section class="card shadow-sm bg-light mb-4">
                    <div class="card-body px-md-4 py-3">
                        <!-- Payment options -->
                        <div class="mt-4">
                            <!-- Online payment -->
                            <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                                <input type="radio" name="paymentOption" value="credit" class="form-check-input mt-1 me-3" checked="">
                                <div class="d-flex flex-grow-1">
                                    <div class="me-3">
                                        <svg width="30" height="30" fill="#788fad" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-semibold mb-1 text-dark">ارسال با پست</p>
                                        <p class="text-muted small mb-0">ارسال سه تا هفت روز کاری</p>
                                    </div>
                                </div>
                            </label>

                            <!-- wallet -->
                            <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                                <input type="radio" name="paymentOption" value="wallet" class="form-check-input mt-1 me-3">
                                <div class="d-flex flex-grow-1">
                                    <div class="me-3">
                                        <svg width="30" height="30" fill="#788fad" class="bi bi-wallet2" viewBox="0 0 16 16">
                                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-semibold mb-1 text-dark">تیپاکس</p>
                                        <p class="text-muted small mb-0 d-flex align-items-center">
                                            ارسال دو تا هفت روز کاری
                                        </p>
                                    </div>
                                </div>
                            </label>

                            <!-- credit card -->
                            <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                                <input type="radio" name="paymentOption" value="corporate" class="form-check-input mt-1 me-3">
                                <div class="d-flex flex-grow-1">
                                    <div class="me-3">
                                        <svg width="30" height="30" fill="#788fad" class="bi bi-credit-card" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"></path>
                                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-semibold mb-1 text-dark">پیک</p>
                                        <p class="text-muted small mb-0">سریع ترین روش ارسال</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </section>

                <h6 class="mb-3">لیست آدرس‌ها</h6>
                <section class="card shadow-sm mb-4 bg-light">
                    <div class="card-body px-md-4 py-3">
                        <!-- address-section -->
                        <div class="address-list" id="address-section">
                            <div class="mb-3 p-3 shadow-sm d-flex gap-3 align-items-start">
                                <input class="form-check-input mt-1" type="radio" name="selectedAddress" id="address1" value="1">
                                <label for="address1" class="flex-grow-1 cursor-pointer">
                                    <div class="d-flex gap-2 align-items-start">
                                        <div class="fs-4">📍</div>
                                        <div>
                                            تهران، خیابان ولیعصر، کوچه زنبق، پلاک ۱۲، واحد ۵<br>
                                            <strong>گیرنده:</strong> زهرا احمدی - ۰۹۱۲۳۴۵۶۷۸۹
                                        </div>
                                    </div>
                                </label>
                            </div>

                        </div>
                        <!-- end address-section -->

                        <!-- new address -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button class="btn btn-sm btn-success add-address-btn" id="btnNew-address">+ افزودن آدرس جدید</button>
                        </div>
                        <div class="container mt-2 px-0" id="new-address">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div id="address-form">
                                        <div class="row g-3 mb-3 d-flex align-items-center">
                                            <div class="col-md-4">
                                                <label for="province" class="fieldlabels">استان<span class="text-danger">*</span></label>
                                                <select class="form-select" id="provinceSelect">
                                                    <option selected="" disabled="">در حال بارگذاری...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="city" class="fieldlabels">شهر<span class="text-danger">*</span></label>
                                                <select class="form-select" id="citySelect" disabled="">
                                                    <option selected="" disabled="">ابتدا استان را انتخاب کنید</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="receiver" class="fieldlabels">نام گیرنده<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="receiver" placeholder="نام کامل گیرنده" required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="plate" class="fieldlabels">پلاک<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="plate" placeholder="مثال: ۱۲" required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="postalCode" class="fieldlabels">کد پستی <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="postalCode" placeholder="مثال: 1234567890" required="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="mobile" class="fieldlabels">شماره موبایل گیرنده<span class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" id="mobile" placeholder="مثال: 09123456789" required="">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="fullAddress" class="fieldlabels">آدرس کامل<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control w-100" id="fullAddress" placeholder="مثال: بلوار ولیعصر، کوچه ۳، واحد ۲" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end p-3">
                                        <button type="button" id="saveAddressBtn" class="btn btn-primary">ثبت آدرس</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end new address -->
                    </div>
                </section>
            </div>

            <div class="col-12 col-md-4">
                <div class="leftSidePayment p-4 border rounded bg-light shadow-sm" style="position: sticky;top: 24.25%;">
                    <!-- The price of goods -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-normal">قیمت کالاها</span>
                        <span class="fw-normal">{{ Cart::getTotal() }} تومان</span>
                    </div>

                    <!-- dividing line -->
                    <hr class="my-2">

                    <!-- Shipping cost -->
                    <div class="d-flex flex-column mb-3">
                        <div class="d-flex justify-content-between">
                            <span>هزینه ارسال</span>
                            <span>50,000 تومان</span>
                        </div>
                    </div>


                    {{-- discount --}}
                    <div class="d-flex justify-content-end flex-column mb-2">

                        <div class="input-group d-flex align-items-center">
                            <span class="fw-bold fs-6" style="width: 25%;">کد تخفیف</span>

                            <input type="text" id="discountCode" class="form-control py-2"
                                   placeholder="کد تخفیف خود را وارد کنید"
                                   value="{{ session('cart.discount.code') ?? '' }}"
                                {{ session('cart.discount') ? 'disabled' : '' }}>

                            @if(session('cart.discount'))
                                <button class="btn btn-danger px-1" type="button" id="removeDiscount">حذف</button>
                            @else
                                <button class="btn btn-outline-secondary btn-success text-dark px-1" type="button" id="applyDiscount">ثبت</button>
                            @endif
                        </div>

                        <div id="discountMessage" class="mt-2 small text-danger"></div>

                        <div id="discountAmountDisplay"
                             class="mt-2 small text-success {{ session('cart.discount') ? '' : 'd-none' }}">
                            مبلغ تخفیف: <span id="discountAmountValue">{{ session('cart.discount.amount') ?? 0 }}</span> تومان
                        </div>

                    </div>




                    <!-- dividing line -->
                    <hr class="my-2">



                    <!-- dividing line -->
                    <hr class="my-2">

                    <!--Amount payable-->
                    <div class="d-flex justify-content-between align-items-center mt-3 fw-bold">
                        <span>مبلغ قابل پرداخت</span>
                        <span id="payableAmount">{{ Cart::getTotal() - (session('cart.discount.amount') ?? 0) }} تومان</span>
                    </div>

                    <!-- Actions -->
                    <a href="" class="btn btn-payment mt-4 w-100 py-2">
                        ثبت نهایی سفارش
                    </a>
                </div>
            </div>
        </div>

        <!-- Checkout Page -->
        <div class="row">
          <div class="col-12 col-md-8 px-0">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h6 class="card-title m-0">شیوه پرداخت</h6>
            </div>

            <!-- Payment Section -->
            <section class="card shadow-sm mb-4">
              <div class="card-body px-4 py-3">

                <!-- Payment options -->
                <div class="mt-4">
                  <!-- Online payment -->
                  <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                    <input type="radio" name="paymentOption" value="credit" class="form-check-input mt-1 me-3" checked>
                    <div class="d-flex flex-grow-1">
                      <div class="me-3">
                          <svg  width="30" height="30" fill="#788fad" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1"/>
                            </svg>
                      </div>
                      <div>
                        <p class="fw-semibold mb-1 text-dark">پرداخت اینترنتی</p>
                        <p class="text-muted small mb-0">پرداخت آنلاین با تمامی کارت‌های بانکی</p>
                      </div>
                    </div>
                  </label>

                  <!-- wallet -->
                  <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                    <input type="radio" name="paymentOption" value="wallet" class="form-check-input mt-1 me-3">
                    <div class="d-flex flex-grow-1">
                      <div class="me-3">
                          <svg width="30" height="30" fill="#788fad" class="bi bi-wallet2" viewBox="0 0 16 16">
                              <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                            </svg>
                      </div>
                      <div>
                        <p class="fw-semibold mb-1 text-dark">کیف پول </p>
                        <p class="text-muted small mb-0 d-flex align-items-center">
                          موجودی:
                          <span class="ms-2 fw-bold text-dark d-flex align-items-center">
                            ۰
                          </span>
                        </p>
                      </div>
                    </div>
                  </label>

                  <!-- credit card -->
                  <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                    <input type="radio" name="paymentOption" value="corporate" class="form-check-input mt-1 me-3">
                    <div class="d-flex flex-grow-1">
                      <div class="me-3">
                          <svg width="30" height="30" fill="#788fad" class="bi bi-credit-card" viewBox="0 0 16 16">
                              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                              <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                            </svg>
                      </div>
                      <div>
                        <p class="fw-semibold mb-1 text-dark">پرداخت با کارت اعتباری</p>
                        <p class="text-muted small mb-0">ویژه ی سازمان‌ها و شرکت‌ها</p>
                      </div>
                    </div>
                  </label>

                  <!-- credit card -->
                  <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                    <input type="radio" name="paymentOption" value="corporate" class="form-check-input mt-1 me-3">
                    <div class="d-flex flex-grow-1">
                      <div class="me-3">
                        <svg width="30" height="30" fill="#788fad" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                          <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                          <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
                        </svg>
                      </div>
                      <div>
                        <p class="fw-semibold mb-1 text-dark">پرداخت با حواله بانکی</p>
                        <p class="text-muted small mb-0">حواله بانکی یا کارت به کارت</p>
                      </div>
                    </div>
                  </label>

                  <!-- To upload a deposit slip -->
                  <div id="bank-transfer-upload" class="mt-4 d-none d-flex flex-column flex-md-row justify-content-between">
                    <div class="d-flex flex-column justify-content-between">
                      <div class="copy-container mt-2">
                        <label>شماره کارت:</label>
                        <span class="copy-text bg-light p-2" data-copy="6104000011112222">6104000011112222</span>
                      </div>
                      <div class="copy-container mt-3">
                        <label>شماره حساب:</label>
                        <span class="copy-text bg-light p-2" data-copy="457854785">457854785</span>
                      </div>
                      <div class="copy-container mt-3">
                        <label>نام شخص واریز کننده:</label>
                        <input type="text" class="form-control my-1">
                      </div>
                      <div class="copy-container mt-3">
                        <label for="bankSelector">مبدا کارت واریز کننده:</label>
                        <select id="bankSelector" class="form-select my-1">
                          <option value=""></option>
                          <option value="melli">بانک ملی ایران</option>
                          <option value="saderat">بانک صادرات ایران</option>
                          <option value="mellat">بانک ملت</option>
                          <option value="tejarat">بانک تجارت</option>
                          <option value="refah">بانک رفاه کارگران</option>
                          <option value="sepah">بانک سپه</option>
                          <option value="keshavarzi">بانک کشاورزی</option>
                          <option value="maskan">بانک مسکن</option>
                          <option value="saman">بانک سامان</option>
                          <option value="parsian">بانک پارسیان</option>
                          <option value="pasargad">بانک پاسارگاد</option>
                          <option value="karafarin">بانک کارآفرین</option>
                          <option value="sina">بانک سینا</option>
                          <option value="eghtesadnovin">بانک اقتصاد نوین</option>
                          <option value="ayandeh">بانک آینده</option>
                          <option value="shahr">بانک شهر</option>
                          <option value="tourism">بانک گردشگری</option>
                          <option value="resalat">بانک قرض‌الحسنه رسالت</option>
                          <option value="mehr">بانک قرض‌الحسنه مهر ایران</option>
                          <option value="day">بانک دی</option>
                          <option value="iranZamin">بانک ایران زمین</option>
                          <option value="gardeshgari">بانک گردشگری</option>
                        </select>
                      </div>
                    </div>

                  <div class="">
                    <label class="form-label fw-bold">آپلود تصویر رسید:</label>
                    <input type="file" class="form-control" accept="image/*">
                    <small class="text-muted">تصویر رسید پرداخت کارت به کارت یا حواله بانکی را بارگذاری کنید.</small>
                  </div>
                  </div>
                  <!-- end To upload a deposit slip -->
                </div>
              </div>
            </section>
          </div>

        </div>
    </div>



@endsection

@section('script')
<!-- To upload a deposit slip -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const paymentRadios = document.querySelectorAll('input[name="paymentOption"]');
    const uploadDiv = document.getElementById("bank-transfer-upload");

    paymentRadios.forEach(radio => {
      radio.addEventListener("change", function () {
        const labelText = this.closest("label").innerText;
        const isBankTransfer = labelText.includes("حواله بانکی");

        if (isBankTransfer) {
          uploadDiv.classList.remove("d-none");
        } else {
          uploadDiv.classList.add("d-none");
        }
      });
    });
  });

  //###### for copy card number ######
    document.querySelectorAll('.copy-text').forEach(el => {
    el.addEventListener('click', function () {
      const text = this.dataset.copy;
      navigator.clipboard.writeText(text).then(() => {
        // Delete previous message (if any)
        const container = this.parentElement;
        const oldMsg = container.querySelector('.copy-msg');
        if (oldMsg) oldMsg.remove();

     // Create and display a new message
        const msg = document.createElement('div');
        msg.className = 'copy-msg';
        msg.innerText = 'کپی شد!';
        container.appendChild(msg);

       // Delete message after 2 seconds
        setTimeout(() => {
          msg.remove();
        }, 2000);
      });
    });
  });
  //###### end for copy card number ######

  </script>
<!-- end To upload a deposit slip -->

{{--    apply discount --}}
<script>
    $(document).ready(function () {

        // APPLY DISCOUNT
        $('#applyDiscount').on('click', function () {
            let code = $('#discountCode').val();

            $.ajax({
                url: "{{ route('cart.coupon.apply') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    code: code
                },
                success: function (res) {

                    let container = $('#discountCode').closest('.input-group');

                    // Show success message
                    $('#discountMessage')
                        .removeClass('text-danger')
                        .addClass('text-success')
                        .text(res.message);

                    // Show discount amount
                    $('#discountAmountDisplay').removeClass('d-none');
                    $('#discountAmountValue').text(res.discount_amount);

                    // Update totals
                    $('#payableAmount').text(res.payable + " تومان");

                    // Disable input
                    $('#discountCode').prop('disabled', true);

                    // Replace apply button with remove button
                    container.find('#applyDiscount').remove();
                    container.append(`<button class="btn btn-danger px-1" id="removeDiscount">حذف</button>`);
                }
,
                error: function (xhr) {
                    let msg = xhr.responseJSON?.message ?? "خطایی رخ داد.";
                    $('#discountMessage')
                        .removeClass('text-success')
                        .addClass('text-danger')
                        .text(msg);
                }
            });
        });

        // REMOVE DISCOUNT
        $(document).on('click', '#removeDiscount', function () {
            $.ajax({
                url: "{{ route('cart.coupon.remove') }}",
                type: "POST",
                data: {_token: $('meta[name="csrf-token"]').attr('content')},
                success: function (res) {

                    $('#discountAmountDisplay').addClass('d-none');
                    $('#discountAmountValue').text(0);

                    $('#discountMessage').text('');

                    $('#discountCode')
                        .prop('disabled', false)
                        .val('');

                    $('#payableAmount').text(res.total + " تومان");



                    $('#removeDiscount').remove();
                    $('#discountCode').after(`<button class="btn btn-outline-secondary px-1 ms-2" id="applyDiscount">ثبت</button>`);
                }
            });
        });


    });
</script>


@endsection
