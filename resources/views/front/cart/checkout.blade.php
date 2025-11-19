@extends('front.layouts.app')


@section('content')

    <div class="container my-5 Checkout" style="padding-top:180px;">
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
                <div class="leftSidePayment p-4 border rounded bg-light shadow-sm" style="position: sticky;height: 300px;top: 21.5%;">
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

                    {{--    discount--}}
                    <div class="d-flex flex-column mb-3">
                        <div class="d-flex justify-content-between">
                            <span>کد تخفیف:</span>
                            <span> <input type="text" class="w-50 "> <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-arrow-bar-left"></i></button></span>
                            <span>0 تومان</span>
                        </div>
                    </div>

                    <!-- dividing line -->
                    <hr class="my-2">

                    <!-- total sum -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">جمع کل</span>
                        <span class="fw-bold">1,250,000 تومان</span>
                    </div>

                    <!-- dividing line -->
                    <hr class="my-2">

                    <!--Amount payable-->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="fw-bold fs-6">مبلغ قابل پرداخت</span>
                        <span class="fw-bold fs-6">1,250,000 تومان</span>
                    </div>

                    <!-- Actions -->
                    <a href="./checkout.html" class="btn btn-payment mt-4 w-100 py-2">
                        ثبت نهایی سفارش
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
