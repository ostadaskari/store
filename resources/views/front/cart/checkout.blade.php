@extends('front.layouts.app')
@section('style')
    {{-- Changed to use the correct token blade directive --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="container topPadd mt-4">
        {{-- The entire checkout process is wrapped in a form for AJAX submission --}}
        <form id="checkoutForm" action="{{ route('checkout.place_order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-md-8 p-0">
                    <!-- title -->
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="card-title m-0">شیوه ارسال</h6>
                        <a href="{{ url('/') }}" class="btn btn-link text-decoration-none">بازگشت به فروشگاه</a>
                    </div>
                    <!-- Shipping Section -->
                    <section class="card shadow-sm bg-light mb-4">
                        <div class="card-body px-md-4 py-3">
                            <!-- Shipping options -->
                            <div class="mt-4">
                                @foreach($shippings as $shipping)
                                    <label class="d-flex align-items-start py-3 cursor-pointer border-bottom">
                                        <input type="radio"
                                               name="shipping_slug" {{-- Used for validation in CartController --}}
                                               value="{{ $shipping->slug }}"
                                               class="form-check-input mt-1 me-3"
                                               data-price="{{ $shipping->price }}"
                                               @if($loop->first) checked @endif
                                        >

                                        <div class="d-flex flex-grow-1">
                                            <div class="me-3">
                                                {{-- Add optional icons based on slug --}}
                                            </div>
                                            <div>
                                                <p class="fw-semibold mb-1 text-dark">{{ $shipping->name }}</p>
                                                @if($shipping->delivery_time)
                                                    <p class="text-muted small mb-0">{{ $shipping->delivery_time }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    <h6 class="mb-3">لیست آدرس‌ها</h6>
                    <section class="card shadow-sm mb-4 bg-light">
                        <div class="card-body px-md-4 py-3">
                            <!-- address-section: Now dynamically populated by JS -->
                            <div class="address-list" id="address-section">
                                {{-- Saved addresses will be injected here by loadUserAddresses() --}}
                                <div class="text-center p-3 text-muted" id="address-loading-message">در حال بارگذاری آدرس‌ها...</div>
                            </div>
                            <!-- end address-section -->

                            {{--
                                HIDDEN INPUTS: These fields capture the details of the selected address
                                (either a saved one or the new one saved via JS) and are sent to place_order.
                                They are populated by the JS function `updateHiddenAddressFields()`.
                                Note: first_name, last_name, mobile, email are pre-filled as fallback/defaults.
                            --}}
                            {{--
                                HIDDEN INPUTS: Now simplified to only include fields required for place_order,
                                including the new user_address_id.
                            --}}
                            <input type="hidden" name="user_address_id" id="address_id" value=""> {{-- <<-- جدید: ID آدرس انتخابی --}}
                            <input type="hidden" name="first_name" id="address_first_name" value="{{ Auth::user()->first_name ?? '' }}">
                            <input type="hidden" name="last_name" id="address_last_name" value="{{ Auth::user()->last_name ?? '' }}">
                            <input type="hidden" name="email" id="address_email" value="{{ Auth::user()->email ?? '' }}">

                            {{-- Optional fields for checkout --}}
                            <input type="hidden" name="company_name" id="address_company_name" value="">
                            <textarea class="d-none" name="note" id="order_note"></textarea>
                            {{-- END OF HIDDEN INPUTS --}}

                            {{--
                                FIELDS REMOVED as they are now retrieved via user_address_id on the backend:
                                province, city, address, mobile, post_code, phone
                            --}}

                            <!-- new address -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                {{-- The 'Add Address' button's state is controlled by JS based on the 4-address limit --}}
                                <button type="button" class="btn btn-sm btn-success add-address-btn" id="btnNew-address">+ افزودن آدرس جدید</button>
                            </div>
                            <div class="container mt-2 px-0 d-none" id="new-address">
                                <div class="card border border-warning">
                                    <div class="card-body p-0">
                                        <div id="address-form" class="p-3">
                                            <div class="row g-3 mb-3 d-flex align-items-center">
                                                <div class="col-md-4">
                                                    <label for="province" class="fieldlabels">استان<span class="text-danger">*</span></label>
                                                    <select class="form-select" id="provinceSelect" >
                                                        <option value="" selected disabled>در حال بارگذاری...</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="city" class="fieldlabels">شهر<span class="text-danger">*</span></label>
                                                    <select class="form-select" id="citySelect" disabled >
                                                        <option value="" selected disabled>ابتدا استان را انتخاب کنید</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="new_receiver" class="fieldlabels">نام و نام خانوادگی<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="new_receiver_name" placeholder="نام کامل گیرنده" value="{{ Auth::user()->name ?? '' }} {{ Auth::user()->family ?? '' }}" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="plate" class="fieldlabels">پلاک<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="new_plate" placeholder="مثال: ۱۲" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="postalCode" class="fieldlabels">کد پستی <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="new_postalCode" placeholder="مثال: 1234567890" >
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="mobile" class="fieldlabels">شماره موبایل گیرنده<span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="new_mobile" placeholder="مثال: 09123456789" value="{{ Auth::user()->mobile ?? '' }}" >
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="new_fullAddress" class="fieldlabels">آدرس کامل (بدون پلاک و کد پستی)<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control w-100" id="new_fullAddress" placeholder="مثال: بلوار ولیعصر، کوچه ۳، واحد ۲" >
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="new_phone" class="fieldlabels">تلفن ثابت (اختیاری)</label>
                                                    <input type="tel" class="form-control" id="new_phone" placeholder="مثال: 021xxxxxxx">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="new_companyName" class="fieldlabels">نام شرکت (اختیاری)</label>
                                                    <input type="text" class="form-control" id="new_companyName" placeholder="جهت فاکتور رسمی">
                                                </div>


                                            </div>
                                        </div>
                                        <div id="new-address-error-message" class="text-danger p-3 small d-none"></div>
                                        <div class="text-end p-3">
                                            <button type="button" id="saveAddressBtn" class="btn btn-primary">ثبت و ذخیره آدرس</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end new address -->
                        </div>
                    </section>
                    <!-- NEW: Order Note Section - Independent from Address -->
                    <h6 class="mb-3">توضیحات سفارش (اختیاری)</h6>
                    <section class="card shadow-sm mb-4">
                        <div class="card-body px-md-4 py-3">
                            {{-- This field has the name="note" and is now outside the address saving logic --}}
                            <textarea class="form-control" name="note" id="order_note_input" rows="3" placeholder="در صورت نیاز به توضیحات خاص در مورد زمان ارسال یا بسته‌بندی، اینجا وارد کنید."></textarea>
                        </div>
                    </section>
                    {{-- END NEW: Order Note Section --}}
                </div>

                <div class="col-12 col-md-4">
                    <div class="leftSidePayment p-4 border rounded bg-light shadow-sm" style="margin-top: 54px;position: sticky;top: 24.25%;">
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
                                <span class="shipping-cost">0 تومان</span>
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
                                <button class="btn btn-outline-secondary btn-success px-1 text-light" style="height: 42px;" type="button" id="applyDiscount">ثبت</button>
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

                        <!-- Actions - Submit button now linked to form -->
                        <button type="submit" id="submitOrderBtn" class="btn btn-payment mt-4 w-100 py-2">
                            ثبت نهایی سفارش
                        </button>
                        <div id="orderStatusMessage" class="mt-2 small text-center d-none"></div>
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
                                <input type="radio" name="payment_method" value="credit" class="form-check-input mt-1 me-3" checked>
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

                            <!-- cash on delivery-->
                            <label class="d-flex align-items-start py-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="cash" class="form-check-input mt-1 me-3">
                                <div class="d-flex flex-grow-1">
                                    <div class="me-3">
                                        <svg  width="30" height="30" fill="#788fad" class="bi bi-truck" viewBox="0 0 16 16">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-semibold mb-1 text-dark">پرداخت در محل </p>
                                        <p class="text-muted small mb-0">پرداخت درب منزل یا محل کار شما</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </section>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')

    <script>
        // Using an IIFE (Immediately Invoked Function Expression) for better scope isolation
        (function ($) {
            "use strict";

            // --- Function to safely handle the SweetAlert (for cases where it might not be loaded yet) ---
            function showSweetAlert(title, text, icon, redirectUrl) {
                if (typeof Swal === 'undefined') {
                    // Fallback to simple redirect if SweetAlert is not loaded
                    alert(title + ': ' + text);
                    window.location.href = redirectUrl;
                    return;
                }

                Swal.fire({
                    title: title, // 'موفقیت!' or 'توجه!'
                    text: text,
                    icon: icon, // 'success' or 'error'
                    confirmButtonText: 'تأیید',
                    customClass: {
                        popup: 'swal2-popup-rtl' // RTL class for proper Persian alignment
                    },
                    allowOutsideClick: false,
                    timer: 3500, // Optional: auto-close after 3.5 seconds
                    timerProgressBar: true
                }).then(() => {
                    // Redirect after the alert is dismissed or timed out
                    window.location.href = redirectUrl;
                });
            }

            $(document).ready(function () {

                // --- 1. Global Variables ---
                let IRAN_LOCATIONS = {}; // Stores the province/city data
                let userAddresses = []; // Stores the current list of user addresses

                /**
                 * Fetches Iran's province/city data from the new API route.
                 */
                function fetchIranLocations() {
                    const $provinceSelect = $('#provinceSelect');
                    $provinceSelect.empty().append('<option value="" selected disabled>در حال بارگذاری...</option>');

                    $.ajax({
                        url: "{{ route('api.iran.locations') }}",
                        type: "GET",
                        success: function (res) {
                            if (res.status && res.locations) {
                                IRAN_LOCATIONS = res.locations;
                                loadProvinces(); // Load provinces now that data is available
                            } else {
                                $provinceSelect.empty().append('<option value="" selected disabled>خطا در بارگذاری استان‌ها</option>');
                                console.error('Error: Location data not found in API response.');
                            }
                        },
                        error: function () {
                            $provinceSelect.empty().append('<option value="" selected disabled>خطا در برقراری ارتباط با API</option>');
                            console.error('AJAX Error: Could not fetch Iran locations.');
                        }
                    });
                }


                // --- 2. Dynamic Province/City Logic ---
                function loadProvinces() {
                    const $select = $('#provinceSelect');
                    $select.empty().append('<option value="" selected disabled>استان را انتخاب کنید</option>');

                    // Ensure data is loaded before iterating
                    if (Object.keys(IRAN_LOCATIONS).length === 0) return;

                    Object.keys(IRAN_LOCATIONS).forEach(province => {
                        $select.append(`<option value="${province}">${province}</option>`);
                    });
                }

                function loadCities(provinceName, cityToSelect = null) {
                    const $citySelect = $('#citySelect');
                    $citySelect.empty();

                    if (provinceName && IRAN_LOCATIONS[provinceName]) {
                        IRAN_LOCATIONS[provinceName].forEach(city => {
                            $citySelect.append(`<option value="${city}" ${cityToSelect === city ? 'selected' : ''}>${city}</option>`);
                        });
                        // IMPORTANT: Only set 'required' when the address form is visible, but we rely on JS validation now.
                        $citySelect.prop('disabled', false);
                    } else {
                        $citySelect.append('<option value="" selected disabled>ابتدا استان را انتخاب کنید</option>');
                        $citySelect.prop('disabled', true);
                    }
                }

                // Event listener for province selection
                $('#provinceSelect').on('change', function() {
                    const selectedProvince = $(this).val();
                    loadCities(selectedProvince);
                });


                // --- 3. Address Rendering and Management ---

                /**
                 * Renders the addresses stored in the userAddresses array.
                 */
                function renderAddresses() {
                    const $addressList = $('#address-section');
                    // Find and remove the loading message if it exists
                    $('#address-loading-message').remove();
                    $addressList.empty();

                    if (userAddresses.length === 0) {
                        $addressList.html('<div class="text-center p-3 text-muted">هیچ آدرسی ثبت نشده است. آدرس جدید اضافه کنید.</div>');
                        // Ensure hidden fields are reset or use defaults if no address exists
                        updateHiddenAddressFields(null);
                        return;
                    }

                    // Determine which address should be checked (the first one by default, or the previously selected one)
                    let lastSelectedId = $('.address-radio:checked').val();
                    if (!lastSelectedId || !userAddresses.some(a => a.id == lastSelectedId)) {
                        lastSelectedId = userAddresses[0].id;
                    }

                    userAddresses.forEach((address) => {
                        // Combine required address parts for display
                        const displayAddress = `${address.province}, ${address.city}, ${address.address}`;
                        const receiverInfo = `<strong>گیرنده:</strong> ${address.first_name} ${address.last_name} - ${address.mobile}`;

                        const isChecked = address.id == lastSelectedId;

                        const addressHtml = `
                <div class="mb-3 p-3 shadow-sm d-flex gap-3 align-items-start address-item border rounded ${isChecked ? 'border-primary bg-white' : 'border-light'}"
                    data-province="${address.province}"
                    data-city="${address.city}"
                    data-address="${address.address} - پلاک ${address.plate}"
                    data-mobile="${address.mobile}"
                    data-postcode="${address.post_code}"
                    data-fullname="${address.first_name} ${address.last_name}"
                    data-email="${address.email || ''}"
                    data-phone="${address.phone || ''}"
                    data-company="${address.company_name || ''}"
                    data-id="${address.id}">

                    <input class="form-check-input mt-1 address-radio" type="radio"
                        name="selectedAddress" id="address-${address.id}" value="${address.id}" ${isChecked ? 'checked' : ''}>
                    <label for="address-${address.id}" class="flex-grow-1 cursor-pointer">
                        <div class="d-flex gap-2 align-items-start">
                            <div class="fs-4">📍</div>
                            <div>
                                ${displayAddress} (کد پستی: ${address.post_code})<br>
                                ${receiverInfo}
                            </div>
                        </div>
                    </label>
                </div>
            `;
                        $addressList.append(addressHtml);
                    });

                    // Update the state of the Add New Address button based on the limit
                    const $addBtn = $('#btnNew-address');
                    if (userAddresses.length >= 4) {
                        $addBtn.prop('disabled', true).text('حداکثر 4 آدرس مجاز است');
                    } else {
                        $addBtn.prop('disabled', false).text('+ افزودن آدرس جدید');
                    }

                    // Attach change listener to newly rendered radio buttons
                    $('.address-radio').off('change').on('change', function() {
                        $('.address-item').removeClass('border-primary bg-white').addClass('border-light');
                        $(this).closest('.address-item').addClass('border-primary bg-white').removeClass('border-light');
                        updateHiddenAddressFields();
                    });

                    // Set initial hidden fields based on the selected address
                    updateHiddenAddressFields();
                }

                /**
                 * Fetches user addresses via AJAX.
                 */
                function loadUserAddresses() {
                    // Check for the existing loading message from the blade file and update it
                    let $loadingMsg = $('#address-loading-message');
                    if ($loadingMsg.length === 0) {
                        $loadingMsg = $('<div class="text-center p-3 text-muted" id="address-loading-message"></div>').appendTo('#address-section');
                    }
                    $loadingMsg.text('در حال بارگذاری آدرس‌ها...');


                    $.ajax({
                        url: "{{ route('user.addresses.index') }}",
                        type: "GET",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (res) {
                            if (res.status && res.addresses) {
                                userAddresses = res.addresses;
                                renderAddresses();
                            } else {
                                userAddresses = [];
                                renderAddresses(); // Show empty message
                            }
                            $('#address-loading-message').remove(); // Remove loading message regardless of outcome
                        },
                        error: function () {
                            userAddresses = [];
                            renderAddresses();
                            $('#address-loading-message').text('خطا در برقراری ارتباط با سرور.');
                        }
                    });
                }


                /**
                 * Helper: Update Hidden Address Fields based on selected radio button or provided data
                 * @param {Object} [addressData=null] - Optional address object to force update (e.g., after saving new address)
                 */
                function updateHiddenAddressFields(addressData = null) {
                    let data = {};
                    let selectedAddressId = ''; // Initialize the ID variable

                    if (addressData) {
                        // Case 1: Use explicitly passed data (e.g., the newly saved address)
                        selectedAddressId = addressData.id || ''; // Get the ID
                        data = {
                            firstName: addressData.first_name || '',
                            lastName: addressData.last_name || '',
                            mobile: addressData.mobile || '',
                            email: addressData.email || '',
                            company: addressData.company_name || '',
                        };
                    } else {
                        // Case 2: Read from the currently checked address item
                        const $checkedAddress = $('.address-radio:checked').closest('.address-item');

                        if (!$checkedAddress.length) {
                            // Case 3: No addresses selected/available. Use default user info as fallback.
                            selectedAddressId = ''; // No ID selected
                            data = {
                                firstName: "{{ Auth::user()->first_name ?? '' }}",
                                lastName: "{{ Auth::user()->last_name ?? '' }}",
                                mobile: "{{ Auth::user()->mobile ?? '' }}",
                                email: "{{ Auth::user()->email ?? '' }}",
                                company: ''
                            };
                        } else {
                            // Case 2: Extract data attributes
                            selectedAddressId = $checkedAddress.data('id') || ''; // Get the ID from data attribute
                            const rawFullName = $checkedAddress.data('fullname') || '';
                            const fullNameParts = rawFullName.split(' ').filter(part => part.trim() !== '');

                            data = {
                                firstName: fullNameParts[0] || '',
                                lastName: fullNameParts.slice(1).join(' ') || '',
                                mobile: $checkedAddress.data('mobile') || '',
                                email: $checkedAddress.data('email') || '',
                                company: $checkedAddress.data('company') || '',
                            };
                        }
                    }

                    // Populate hidden form fields
                    $('#address_id').val(selectedAddressId); // <-- IMPORTANT: Set the selected address ID
                    $('#address_first_name').val(data.firstName);
                    $('#address_last_name').val(data.lastName);
                    $('#address_mobile').val(data.mobile);
                    $('#address_email').val(data.email);
                    $('#address_company_name').val(data.company);
                    // NOTE: Removed the line setting $('#order_note').val(data.note);
                }


                // --- 4. Core Total Calculation Function ---
                function updateTotal(newDiscountAmount = null) {
                    // Get current values
                    let $checkedShipping = $('input[name="shipping_slug"]:checked');
                    let rawShippingPrice = $checkedShipping.data('price');

                    // Clean the string by removing commas/non-digits before parsing
                    let shippingPrice = parseInt(String(rawShippingPrice).replace(/[^0-9.]/g, '')) || 0;

                    // Get current values (Ensure Cart::getTotal() is evaluated by Laravel on render)
                    let cartTotal = {{ Cart::getTotal() }};

                    // Determine discount: use the passed argument first, otherwise read from the display span
                    let discount;
                    if (newDiscountAmount !== null) {
                        // Passed argument is prioritized (e.g., after successful coupon application)
                        discount = parseInt(String(newDiscountAmount).replace(/[^0-9]/g, '')) || 0;
                    } else {
                        // Read current discount from the display element
                        let rawDiscountText = $('#discountAmountValue').text();
                        discount = parseInt(rawDiscountText.replace(/[^0-9]/g, '')) || 0;
                    }

                    // Calculate Payable
                    let payable = cartTotal + shippingPrice - discount;
                    if (payable < 0) payable = 0; // Ensure payable is not negative

                    // Update Display Elements
                    $('#payableAmount').text(payable.toLocaleString() + " تومان");
                    $('.shipping-cost').text(shippingPrice.toLocaleString() + " تومان");

                    // Ensure the discount span itself reflects the clean, formatted discount value for consistency
                    $('#discountAmountValue').text(discount.toLocaleString());
                }

                // --- 5. Initial Setup and Handlers ---
                fetchIranLocations(); // Fetch locations via AJAX
                loadUserAddresses(); // Load existing user addresses (AJAX call)
                updateTotal(); // Apply initial totals

                // Shipping Change Handler
                $('input[name="shipping_slug"]').on('change', updateTotal);

                // Note: Discount/Coupon AJAX Handlers should be placed here if they use updateTotal(newDiscountAmount)


                // --- 6. AJAX Handler for Saving New Address ---
                $('#saveAddressBtn').on('click', function() {
                    const $btn = $(this);
                    const $errorMsg = $('#new-address-error-message');
                    $errorMsg.addClass('d-none').removeClass('text-success text-danger').text('');

                    // 1. Gather Data and Basic Validation (client-side quick check)
                    const province = $('#provinceSelect').val();
                    const city = $('#citySelect').val();
                    const receiverName = $('#new_receiver_name').val();
                    const fullAddress = $('#new_fullAddress').val();
                    const plate = $('#new_plate').val();
                    const postCode = $('#new_postalCode').val();
                    const mobile = $('#new_mobile').val();
                    const phone = $('#new_phone').val();
                    const companyName = $('#new_companyName').val();
                    // NOTE: The 'note' field for the address is removed here.

                    if (!province || !city || !receiverName || !fullAddress || !plate || !postCode || !mobile) {
                        $errorMsg.removeClass('d-none').addClass('text-danger').text('لطفاً تمامی فیلدهای الزامی (دارای *) را پر کنید.');
                        return;
                    }

                    // Split receiver name (First word as first name, rest as last name)
                    const fullNameParts = receiverName.split(' ').filter(part => part.trim() !== '');
                    const firstName = fullNameParts.length > 0 ? fullNameParts[0] : '';
                    const lastName = fullNameParts.slice(1).join(' ') || '';

                    const addressData = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        first_name: firstName,
                        last_name: lastName,
                        province: province,
                        city: city,
                        address: fullAddress,
                        plate: plate,
                        post_code: postCode,
                        mobile: mobile,
                        phone: phone,
                        company_name: companyName,
                        // NOTE: Removed the 'note' property from addressData
                        email: "{{ Auth::user()->email ?? '' }}"
                    };

                    $btn.prop('disabled', true).text('در حال ذخیره‌سازی...');

                    // --- ACTUAL AJAX CALL TO LARAVEL ROUTE ---
                    $.ajax({
                        url: "{{ route('user.address.store') }}",
                        type: "POST",
                        data: addressData,
                        success: function (res) {
                            if (res.status && res.address) {
                                // Add the returned address object to the local list and re-render
                                userAddresses.unshift(res.address); // Add new address to the top

                                // Re-render and select the newly added address
                                renderAddresses();

                                // Check the newly added address radio button
                                $(`#address-${res.address.id}`).prop('checked', true).trigger('change');

                                $('#new-address').addClass('d-none');
                                $('#btnNew-address').text('+ افزودن آدرس جدید');
                                $errorMsg.removeClass('d-none text-danger').addClass('text-success').text(res.message);

                                // Reset form fields except pre-filled user data
                                $('#address-form input:not(#new_receiver_name, #new_mobile), #address-form textarea').val('');

                                // Reset province/city dropdowns
                                $('#provinceSelect').val('');
                                loadCities('');

                            } else {
                                $errorMsg.removeClass('d-none').addClass('text-danger').text(res.message || 'خطا در ذخیره آدرس.');
                            }
                        },
                        error: function (xhr) {
                            let errorMsg = 'خطا در ذخیره آدرس. لطفا فیلدها را بررسی کنید.';
                            const errors = xhr.responseJSON?.errors;

                            if (errors) {
                                // Extract first error message for display
                                const firstErrorKey = Object.keys(errors)[0];
                                errorMsg = errors[firstErrorKey][0];
                            } else if (xhr.responseJSON?.message) {
                                errorMsg = xhr.responseJSON.message;
                            }

                            $errorMsg.removeClass('d-none').addClass('text-danger').text(errorMsg);
                        },
                        complete: function() {
                            $btn.prop('disabled', false).text('ثبت و ذخیره آدرس');
                        }
                    });
                });

                // Logic to handle 'افزودن آدرس جدید' button (toggles visibility)
                $('#btnNew-address').on('click', function() {
                    const $newAddressForm = $('#new-address');
                    $newAddressForm.toggleClass('d-none');
                    if ($newAddressForm.hasClass('d-none')) {
                        $(this).text('+ افزودن آدرس جدید');
                        // If closed, clear any previous error message
                        $('#new-address-error-message').addClass('d-none').text('');
                    } else {
                        $(this).text('بستن فرم آدرس جدید');
                    }
                });

                // --- 7. Order Submission Handler (AJAX) ---
                $('#checkoutForm').on('submit', function(e) {
                    e.preventDefault(); // Prevent default browser submission

                    const $form = $(this);
                    const $btn = $('#submitOrderBtn');
                    const $statusMsg = $('#orderStatusMessage');

                    $statusMsg.addClass('d-none').removeClass('text-danger text-success').text('');

                    // Check if an address is selected (ID is populated by updateHiddenAddressFields)
                    const selectedAddressId = $('#address_id').val();
                    if (!selectedAddressId || selectedAddressId === '0') {
                        $statusMsg.removeClass('d-none').addClass('text-danger').text('لطفاً یک آدرس برای ارسال انتخاب کنید.');
                        // Add some visual feedback
                        $('#address-section').css({
                            'border': '2px solid #dc3545',
                            'padding': '1rem'
                        }).delay(3000).queue(function(next) {
                            $(this).css({
                                'border': 'none',
                                'padding': '0'
                            });
                            next();
                        });
                        return;
                    }

                    console.log('Attempting to submit order...');
                    // The new note field (#order_note_input) has name="note" and will be included here:
                    console.log('Data to be sent:', $form.serialize());

                    $btn.prop('disabled', true).text('در حال ثبت سفارش...');
                    $statusMsg.removeClass('d-none').text('در حال ثبت سفارش...');

                    $.ajax({
                        url: $form.attr('action'),
                        type: "POST",
                        data: $form.serialize(), // Serialize all form data (including hidden fields and note textarea)
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (res) {
                            if (res.status && res.redirect) {
                                // --- SWEETALERT LOGIC IS HERE ---
                                $statusMsg.addClass('d-none'); // Hide local status message

                                const message = res.message || 'سفارش شما با موفقیت ثبت شد.';

                                // Display SweetAlert and redirect after confirmation/timeout
                                showSweetAlert('موفقیت!', message, 'success', res.redirect);

                            } else {
                                // Server returned status: false
                                $statusMsg.removeClass('text-success').addClass('text-danger').text(res.message || 'خطا در ثبت سفارش نهایی.');
                                console.error('Server side error (status: false):', res);
                            }
                        },
                        error: function (xhr) {
                            console.error('AJAX Error in checkout submission:', xhr); // Log the full XHR object
                            let errorMsg = 'خطای سرور: لطفاً اطلاعات وارد شده را بررسی کنید.';
                            const res = xhr.responseJSON;

                            if (res && res.errors) {
                                // Display the first validation error
                                const firstErrorKey = Object.keys(res.errors)[0];
                                errorMsg = res.errors[firstErrorKey][0];
                            } else if (res && res.message) {
                                errorMsg = res.message;
                            } else if (xhr.status === 419) {
                                // CSRF token mismatch
                                errorMsg = 'خطای امنیتی: لطفاً صفحه را رفرش کنید.';
                            } else if (xhr.status === 401 || xhr.status === 403) {
                                // Unauthorized/Forbidden
                                errorMsg = 'شما دسترسی لازم برای ثبت سفارش را ندارید.';
                            } else if (xhr.status === 500) {
                                // Internal Server Error
                                errorMsg = 'خطای داخلی سرور رخ داده است. لطفاً با پشتیبانی تماس بگیرید.';
                            }


                            $statusMsg.removeClass('text-success').addClass('text-danger').text(errorMsg);
                        },
                        complete: function() {
                            $btn.prop('disabled', false).text('ثبت نهایی سفارش');
                        }
                    });
                });

            });
        })(jQuery);
    </script>
@endsection
