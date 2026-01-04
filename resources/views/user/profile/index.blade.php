@extends('user.layouts.app')

@section('style')

    <style>

        #ajax-feedback {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            display: none;
        }
        .password-valid { color: green !important; }
    </style>
    <link rel="stylesheet" href="{{asset('design/css/persian-datepicker.min.css')}}">
@endsection

@section('content')
    @php
        use Morilog\Jalali\Jalalian;

        $jalaliBirthDate = $user->birth_date
            ? Jalalian::fromDateTime($user->birth_date)->format('Y/m/d')
            : null;
    @endphp

    <div class="col-md-9" id="user-profile-editor">

        <!-- AJAX Feedback Message -->
        <div id="ajax-feedback" class="alert alert-dismissible fade show" role="alert">
            <span id="feedback-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="container">
            <div class="row">
                <!-- 1. Edit User Info -->
                <div class="col-12 col-md-8 px-0">
                    <h2 class="text-title d-flex flex-row align-items-center mb-0">
                        <svg width="22" height="22" fill="currentColor" class="bi bi-pencil-square mx-2" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                        ویرایش اطلاعات کاربری
                    </h2>
                    <form class="row g-3 mb-1 borderBg" dir="rtl" style="min-height: 276px;">

                        <div class="col-md-4 mt-0 px-0">
                            <label class="form-label">نام:</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }} " placeholder="زهرا " required>
                            <small class="text-danger name-error"></small>
                        </div>

                        <div class="col-md-4 mt-0 px-2">
                            <label class="form-label"> نام خانوادگی:</label>
                            <input type="text" class="form-control" name="family" value="{{ $user->family ?? '' }}" placeholder=" احمدی" required>
                            <small class="text-danger family-error"></small>
                        </div>

                        <div class="col-md-4 mt-0 px-0">
                            <label class="form-label">تاریخ تولد:</label>

                            {{-- Jalali visible input --}}
                            <input
                                type="text"
                                class="form-control input-ltr"
                                id="birth_date_picker"
                                placeholder="انتخاب تاریخ تولد"
                                autocomplete="off"
                            >

                            {{-- Gregorian value sent to backend --}}
                            <input
                                type="hidden"
                                id="birth_date"
                                name="birth_date"
                                value="{{ $user->birth_date }}"
                            >

                            <small class="text-danger birth_date-error"></small>
                        </div>

                        <div class="col-md-4 px-0 mt-2">
                            <label class="form-label">شماره تماس:</label>
                            <input type="text" class="form-control input-ltr bg-light" value="{{ $user->mobile }}" disabled >
                            {{-- keep mobile for backend but prevent editing --}}
                            <input type="hidden" name="mobile" value="{{ $user->mobile }}">
                            <small class="text-muted">شماره موبایل قابل ویرایش نیست</small>
                        </div>

                        <div class="col-md-4 px-0 mt-2 px-2">
                            <label class="form-label">ایمیل:</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" placeholder="zahra@email.com" required>
                            <small class="text-danger email-error"></small>
                        </div>

                        <div class="col-md-4 mt-2 px-0">
                            <label class="form-label">حوزه کاری شما:</label>
                            <select name="job" class=" form-select" >
                                <option value="">انتخاب کنید</option>
                                @php $jobs = ['طراح آنالوگ', 'طراح دیجیتال', 'طراح سخت‌افزار', 'سایر']; @endphp
                                @foreach ($jobs as $job)
                                    <option value="{{ $job }}" {{ ($user->job ?? '') == $job ? 'selected' : '' }}>{{ $job }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger job-error"></small>
                        </div>

                        <div class="col-12 d-flex justify-content-end align-items-end px-0" style="height: 38px;margin-top: 62px;">
                            <button type="submit" class="btn btn-success" id="mainSaveBtn">ذخیره</button>
                        </div>

                    </form>
                </div>
                <!-- End Edit User Info -->

                <!-- 2. Bank Info -->
                <div class="col-12 col-md-4 pe-0">
                    <h2 class="text-title d-flex flex-row align-items-center mb-0">
                        <svg width="22" height="22" fill="currentColor" class="bi bi-cash-coin mx-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                        </svg>
                        اطلاعات بانکی
                    </h2>
                    <form id="bankInfoForm" class="row g-3 mb-1 borderBg" dir="rtl">

                        <div class="col-12 mt-0 px-0">
                        <div class="mb-3 mx-1">
                            <label for="accountNumber" class="form-label">شماره حساب:</label>
                            <input type="text" class="form-control input-ltr" id="accountNumber" name="account_number" value="{{ $user->account_number ?? '' }}" inputmode="numeric" placeholder="مثلاً 1234567890">
                            <small class="text-danger account_number-error"></small>
                        </div>
                        </div>

                        <div class="col-12 mt-0 px-0" style="position: relative;">
                        <label for="cardNumber" class="form-label">شماره کارت:</label>
                        <img id="bankLogo" src="" alt="" style="height: 24px; margin-left: 8px; display: none;" />
                        <input type="text" class="form-control input-ltr" id="cardNumber" name="card_number" value="{{ $user->card_number ?? '' }}" inputmode="numeric" maxlength="16" placeholder="مثلاً 60379971...">
                        <small class="text-danger card_number-error"></small>
                        </div>

                        <div class="col-12 mt-0 px-0">
                        <label for="shabaNumber" class="form-label">شماره شبا:</label>
                        <div class="input-group">
                            <span class="input-group-text">IR</span>
                            <input type="text" class="form-control input-ltr" id="shabaNumber" name="shaba_number" value="{{ $user->shaba_number ?? '' }}" inputmode="numeric" maxlength="24" placeholder="xxxxxxxxxxxxxxxxxxxxxxxx">
                        </div>
                        <small class="form-text text-danger d-none" id="shabaError">شماره شبا باید دقیقاً ۲۴ رقم باشد</small>
                        <small class="text-danger shaba_number-error"></small>
                        </div>

                        <div class="col-12 d-flex justify-content-end mt-2 px-0">
                        <button type="submit" class="btn btn-success" id="bankSaveBtn">ذخیره</button>
                        </div>
                    </form>
                </div>
                <!-- End Bank Info -->
            </div>

            <!-- 3. Address Management (Accordion Style) - NEW SECTION -->
            <div class="row">
                <!--  Address Management (Accordion Style) - NEW SECTION -->
                <h2 class="text-title d-flex flex-row align-items-center mt-4">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-pin-map mx-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z"/>
                        <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                    </svg>
                    مدیریت آدرس‌ها
                </h2>
                <div id="addressesAccordionContainer" class="my-1 borderBg p-3" dir="rtl">

                    <!-- Address List will be rendered here by JS -->
                    <div id="address-section" class="mb-4">
                        <div class="text-center p-3 text-muted" id="address-loading-message">در حال بارگذاری آدرس‌ها...</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 pt-3 border-top">
                        <button id="btnNew-address" class="btn btn-primary btn-sm"
                                type="button"  data-bs-target="#new-address-form-container"
                                aria-expanded="false" aria-controls="new-address-form-container">
                            + افزودن آدرس جدید
                        </button>
                        <small id="address-limit-text" class="text-muted">شما میتوانید تا ۴ آدرس را ثبت کنید.</small>
                    </div>


                            <!-- New Address Form (The collapsible part) -->
                            <div class="collapse" id="new-address-form-container">
                                <div class="card card-body p-3 border-0">
                                    <h5 id="addressFormTitle" class="mb-3 border-bottom pb-2">افزودن آدرس جدید</h5>
                                    <form id="address-form" class="row g-3">
                                        @csrf
                                        <!-- The ID field for editing -->
                                        <input type="hidden" name="id" id="editAddressId" value="">
                                        <input type="hidden" name="full_name" id="full_name">

                                        <div class="col-md-6">
                                            <label>نام گیرنده</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="first_name"
                                                id="first_name"
                                                placeholder="نام"
                                            >
                                            <small class="text-danger first_name-error d-none"></small>
                                        </div>

                                        <div class="col-md-6">
                                            <label>نام خانوادگی گیرنده</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="last_name"
                                                id="last_name"
                                                placeholder="نام خانوادگی"
                                            >
                                            <small class="text-danger last_name-error d-none"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="new_mobile" class="form-label">شماره موبایل گیرنده <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control input-ltr" id="new_mobile" name="mobile" required inputmode="numeric">
                                            <small class="text-danger address-mobile-error d-none"></small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="provinceSelect" class="form-label">استان <span class="text-danger">*</span></label>
                                            <select class="form-select" id="provinceSelect" name="province" required>
                                                <option value="" selected disabled>انتخاب کنید</option>
                                            </select>
                                            <small class="text-danger address-province-error d-none"></small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="citySelect" class="form-label">شهر <span class="text-danger">*</span></label>
                                            <select class="form-select" id="citySelect" name="city" disabled required>
                                                <option value="" selected disabled>ابتدا استان را انتخاب کنید</option>
                                            </select>
                                            <small class="text-danger address-city-error d-none"></small>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="new_fullAddress" class="form-label">آدرس کامل <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="new_fullAddress" name="address" rows="2" required></textarea>
                                            <small class="text-danger address-address-error d-none"></small>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="new_plate" class="form-label">پلاک <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control input-ltr" id="new_plate" name="plate" required inputmode="numeric">
                                            <small class="text-danger address-plate-error d-none"></small>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="new_postalCode" class="form-label">کد پستی <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control input-ltr" id="new_postalCode" name="post_code" required inputmode="numeric" maxlength="10">
                                            <small class="text-danger address-post_code-error d-none"></small>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="new_phone" class="form-label">تلفن ثابت (اختیاری)</label>
                                            <input type="text" class="form-control input-ltr" id="new_phone" name="phone" inputmode="numeric">
                                            <small class="text-danger address-phone-error d-none"></small>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="new_companyName" class="form-label">نام شرکت (اختیاری)</label>
                                            <input type="text" class="form-control" id="new_companyName" name="company_name">
                                            <small class="text-danger address-company_name-error d-none"></small>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end mt-4">
                                            <button type="button" class="btn btn-secondary mx-2" id="cancelAddressBtn">لغو</button>
                                            <button type="submit" class="btn btn-success" id="saveAddressBtn">ثبت و ذخیره آدرس</button>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <div id="new-address-error-message" class="alert alert-danger d-none" role="alert"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
            <!-- End Address Management -->


            <!-- 4. Change Password -->
            <div class="row">
                <h2 class="text-title d-flex flex-row align-items-center mt-4">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-unlock2-fill mx-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0c1.07 0 2.041.42 2.759 1.104l.14.14.062.08a.5.5 0 0 1-.71.675l-.076-.066-.216-.205A3 3 0 0 0 5 4v2h6.5A2.5 2.5 0 0 1 14 8.5v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4"/>
                    </svg>
                    تغییر رمز عبور
                </h2>
                <form id="changePasswordForm" class="my-1 borderBg" dir="rtl">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">رمز عبور فعلی <span class="text-danger">*</span></label>
                            <input type="password" class="form-control required" id="currentPassword" name="current_password" placeholder="رمز فعلی">
                            <small class="text-danger current_password-error"></small>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">رمز عبور جدید <span class="text-danger">*</span></label>
                            <input type="password" class="form-control required" id="newPassword" name="new_password" placeholder="حداقل ۸ کاراکتر با حروف کوچک، بزرگ و کاراکتر خاص">
                            <small class="text-danger new_password-error"></small>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">تکرار رمز عبور جدید <span class="text-danger">*</span></label>
                            <input type="password" class="form-control required" id="confirmPassword" name="new_password_confirmation" placeholder="تکرار رمز عبور جدید">
                            <small class="text-danger confirmPasswordError"></small>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label">الزامات رمز عبور:</label>
                            <ul class="list-unstyled mb-0" id="passwordRules">
                                <li id="rule-length" class="text-danger">⬤ حداقل ۸ کاراکتر</li>
                                <li id="rule-lower" class="text-danger">⬤ حروف کوچک (a-z)</li>
                                <li id="rule-upper" class="text-danger">⬤ حروف بزرگ (A-Z)</li>
                                <li id="rule-number" class="text-danger">⬤ حداقل یک عدد (0-9)"</li>
                                <li id="rule-symbol" class="text-danger">⬤ یک کاراکتر خاص (مثل @#$!)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" id="changePassSaveBtn">ذخیره</button>
                    </div>
                </form>
            </div>
            <!-- End Change Password -->
        </div>


    </div>




@endsection

@section('script')

    {{-- Persian Datepicker Dependencies --}}
    <script src="{{asset('design/js/persian-date.min.js')}}"></script>
    <script src="{{asset('design/js/persian-datepicker.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            let IRAN_LOCATIONS = {};
            let userAddresses = [];
            let currentEditId = null;


            // --- Swal Toast Config ---
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // CSRF Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /* =========================
               HELPERS
            ========================= */
            function showFeedback(message, type = 'success') {
                Toast.fire({
                    icon: type === 'danger' ? 'error' : type,
                    title: message,
                    direction: 'rtl'
                });
            }

            function clearFormErrors(form) {
                form.find('.text-danger').text('').addClass('d-none');
                form.find('input, select, textarea').removeClass('is-invalid');
            }

            function displayErrors(form, errors) {
                clearFormErrors(form);
                $.each(errors, function (key, value) {
                    // Find error element by class (e.g., .address-mobile-error)
                    const errorEl = form.find(`.address-${key}-error, .${key}-error`);
                    if (errorEl.length) {
                        errorEl.text(value[0]).removeClass('d-none').show();
                    }
                    const inputEl = form.find(`[name="${key}"]`);
                    if (inputEl.length) {
                        inputEl.addClass('is-invalid');
                    }
                });
            }

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            /* =========================
               1. PROFILE INFO (AJAX SUBMIT)
            ========================= */
            $('#profileInfoForm').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const btn = $('#mainSaveBtn');
                const emailVal = form.find('input[name="email"]').val();

                // Client-side Validation
                if (!isValidEmail(emailVal)) {
                    showFeedback('ایمیل وارد شده معتبر نیست', 'danger');
                    form.find('input[name="email"]').addClass('is-invalid');
                    return;
                }

                btn.prop('disabled', true).text('در حال ذخیره...');
                clearFormErrors(form);

                $.post("{{ route('user.profile.updateProfile') }}", form.serialize())
                    .done(res => {
                        showFeedback(res.message || 'اطلاعات با موفقیت ذخیره شد', 'success');
                    })
                    .fail(xhr => {
                        if (xhr.status === 422) {
                            displayErrors(form, xhr.responseJSON.errors);
                            showFeedback('خطا در اطلاعات وارد شده', 'danger');
                        } else {
                            showFeedback('خطای سرور در ذخیره اطلاعات', 'danger');
                        }
                    })
                    .always(() => {
                        btn.prop('disabled', false).text('ذخیره اطلاعات');
                    });
            });

            /* =========================
               BIRTHDATE PICKER
            ========================= */
            $('#birth_date_picker').pDatepicker({
                format: 'YYYY/MM/DD',
                autoClose: true,
                observer: true,
                calendar: { persian: { leapYearMode: 'algorithmic' } },
                onSelect: function (unix) {
                    const gDate = new Date(unix);
                    const yyyy = gDate.getFullYear();
                    const mm = String(gDate.getMonth() + 1).padStart(2, '0');
                    const dd = String(gDate.getDate()).padStart(2, '0');
                    $('#birth_date').val(`${yyyy}-${mm}-${dd}`);
                }
            });
            @if($jalaliBirthDate)
            $('#birth_date_picker').val('{{ $jalaliBirthDate }}');
            @endif

            /* =========================
               2. BANK INFO
            ========================= */
            $('#bankInfoForm').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const btn = $('#bankSaveBtn');

                btn.prop('disabled', true).text('در حال ذخیره...');
                clearFormErrors(form);

                $.post("{{ route('user.profile.updateBankInfo') }}", form.serialize())
                    .done(res => showFeedback(res.message, 'success'))
                    .fail(xhr => {
                        if (xhr.status === 422) {
                            displayErrors(form, xhr.responseJSON.errors);
                            showFeedback('خطا در اطلاعات بانکی', 'danger');
                        } else {
                            showFeedback('خطای سرور', 'danger');
                        }
                    })
                    .always(() => btn.prop('disabled', false).text('ذخیره'));
            });

            /* =========================
               3. PASSWORD MANAGEMENT
            ========================= */

            // The logic for visual updates
            function updateRule(elementId, condition, text) {
                const el = document.getElementById(elementId);
                if (!el) return;

                if (condition) {
                    el.classList.remove("text-muted", "text-danger");
                    el.classList.add("text-success");
                    el.innerHTML = "✔ " + text;
                } else {
                    el.classList.remove("text-success");
                    el.classList.add("text-danger");
                    el.innerHTML = "⬤ " + text;
                }
            }

            // The function you requested
            function validatePasswordRules(value) {
                updateRule("rule-length", value.length >= 8, "حداقل ۸ کاراکتر");
                updateRule("rule-lower", /[a-z]/.test(value), "حروف کوچک (a-z)");
                updateRule("rule-upper", /[A-Z]/.test(value), "حروف بزرگ (A-Z)");
                updateRule("rule-number", /[0-9]/.test(value), "حداقل یک عدد (0-9)");
                updateRule("rule-symbol", /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(value), "یک کاراکتر خاص (مثل @#$!)");
            }

            // Event listener for the new password field
            const newInput = document.getElementById("newPassword");
            if (newInput) {
                newInput.addEventListener("input", function() {
                    validatePasswordRules(this.value);
                });
            }

            $('#changePasswordForm').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const btn = $('#changePassSaveBtn');

                btn.prop('disabled', true).text('در حال تغییر...');
                $.post("{{ route('user.profile.updatePassword') }}", form.serialize())
                    .done(res => {
                        showFeedback(res.message, 'success');
                        form[0].reset();
                        // Reset rules to muted after success
                        $('.rule-item').removeClass('text-success text-danger').addClass('text-muted');
                    })
                    .fail(xhr => {
                        if (xhr.status === 422) displayErrors(form, xhr.responseJSON.errors);
                        showFeedback('خطا در تغییر رمز عبور', 'danger');
                    })
                    .always(() => btn.prop('disabled', false).text('ذخیره'));
            });

            /* =========================
               ADDRESS MANAGEMENT
            ========================= */
            // --- 1. Global Variables ---

            function fetchIranLocations(selectedProvince = null, selectedCity = null) {
                const $provinceSelect = $('#provinceSelect');
                $provinceSelect.empty().append('<option value="" selected disabled>در حال بارگذاری...</option>');

                $.ajax({
                    url: "{{ route('api.iran.locations') }}",
                    type: "GET",
                    success: function (res) {
                        if (res.status && res.locations) {
                            IRAN_LOCATIONS = res.locations;
                            loadProvinces(selectedProvince, selectedCity);
                        } else {
                            $provinceSelect.empty().append('<option value="" selected disabled>خطا در بارگذاری</option>');
                        }
                    },
                    error: function () {
                        $provinceSelect.empty().append('<option value="" selected disabled>خطا در ارتباط</option>');
                    }
                });
            }

            function loadProvinces(selectedProvince = null, selectedCity = null) {
                const $provinceSelect = $('#provinceSelect');
                $provinceSelect.empty().append('<option value="" selected disabled>انتخاب کنید</option>');

                Object.keys(IRAN_LOCATIONS).forEach(province => {
                    const isSelected = (province === selectedProvince) ? 'selected' : '';
                    $provinceSelect.append(`<option value="${province}" ${isSelected}>${province}</option>`);
                });

                if (selectedProvince) {
                    loadCities(selectedProvince, selectedCity);
                }
            }

            function loadCities(provinceName, selectedCity = null) {
                const $citySelect = $('#citySelect');
                $citySelect.empty().prop('disabled', false);

                if (IRAN_LOCATIONS[provinceName]) {
                    $citySelect.append('<option value="" selected disabled>انتخاب شهر</option>');
                    IRAN_LOCATIONS[provinceName].forEach(city => {
                        const isSelected = (city === selectedCity) ? 'selected' : '';
                        $citySelect.append(`<option value="${city}" ${isSelected}>${city}</option>`);
                    });
                } else {
                    $citySelect.prop('disabled', true).append('<option value="">ابتدا استان را انتخاب کنید</option>');
                }
            }

            $('#provinceSelect').on('change', function () {
                loadCities($(this).val());
            });


            const addAddressBtn = $('#btnNew-address');
            const saveAddressBtn = $('#saveAddressBtn');
            const formContainer = $('#new-address-form-container');
            const addressForm = $('#address-form');

            // FIX: Use .off() to clear any previous listeners and stop propagation
            addAddressBtn.off('click').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevents Bootstrap from triggering its own toggle logic

                if (formContainer.is(':visible')) {
                    closeAddressForm();
                } else {
                    openAddressForm();
                }
            });

            function openAddressForm(isEdit = false) {
                // Force show using jQuery to override any CSS conflicts
                formContainer.stop(true, true).slideDown(300, function() {
                    $(this).addClass('show');
                });

                addAddressBtn.text(isEdit ? 'لغو ویرایش' : '- لغو');

                if(!isEdit) {
                    addressForm[0].reset();
                    $('#addressFormTitle').text('افزودن آدرس جدید');
                    $('#editAddressId').val('');
                    currentEditId = null;
                    // Reset location selects
                    loadProvinces();
                    $('#citySelect').prop('disabled', true).empty().append('<option value="">ابتدا استان را انتخاب کنید</option>');
                }
            }

            function closeAddressForm() {
                formContainer.stop(true, true).slideUp(300, function() {
                    $(this).removeClass('show');
                });

                addAddressBtn.text('+ افزودن آدرس جدید');
                addressForm[0].reset();
                clearFormErrors(addressForm);
                currentEditId = null;
            }

            // Ensure the specific cancel button also works
            $('#cancelAddressBtn').off('click').on('click', function(e) {
                e.preventDefault();
                closeAddressForm();
            });

            function loadUserAddresses() {
                const $section = $('#address-section');
                $section.html('<div class="text-center p-3 text-muted">در حال بارگذاری...</div>');

                $.get("{{ route('user.addresses.index') }}")
                    .done(res => {
                        userAddresses = res.addresses || [];
                        renderAddresses();
                    })
                    .fail(() => {
                        $section.html('<div class="text-center p-3 text-danger">خطا در بارگذاری آدرس‌ها</div>');
                    });
            }

            function renderAddresses() {
                const container = $('#address-section');
                container.empty();
                if (!userAddresses.length) {
                    container.html('<div class="text-muted p-3">آدرسی ثبت نشده است</div>');
                    return;
                }
                userAddresses.forEach(address => {
                    container.append(`
                <div class="card mb-2 border-0 shadow-sm borderBg">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1"><strong>${address.first_name} ${address.last_name}</strong></h6>
                            <p class="small text-muted mb-0">
                                ${address.province}، ${address.city} - ${address.address} (پلاک: ${address.plate})
                            </p>
                            <p class="small text-muted mb-0">کد پستی: ${address.post_code} | موبایل: ${address.mobile}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-info edit-address-btn" data-id="${address.id}">ویرایش</button>
                            <button class="btn btn-sm btn-outline-danger delete-address-btn" data-id="${address.id}">حذف</button>
                        </div>
                    </div>
                </div>
            `);
                });
            }

            // FIX: Event Delegation for dynamic buttons (Edit/Delete)
            // Edit Logic
            $(document).on('click', '.edit-address-btn', function () {
                const id = $(this).data('id');
                const addr = userAddresses.find(a => a.id == id);
                if (addr) {
                    currentEditId = id;
                    $('#addressFormTitle').text('ویرایش آدرس');
                    $('#editAddressId').val(addr.id);
                    $('#first_name').val(addr.first_name);
                    $('#last_name').val(addr.last_name);
                    $('#new_mobile').val(addr.mobile);
                    $('#new_fullAddress').val(addr.address);
                    $('#new_plate').val(addr.plate);
                    $('#new_postalCode').val(addr.post_code);
                    $('#new_phone').val(addr.phone);
                    $('#new_companyName').val(addr.company_name);

                    // Re-fetch locations and set selections
                    fetchIranLocations(addr.province, addr.city);

                    openAddressForm(true);
                    $('html, body').animate({ scrollTop: formContainer.offset().top - 100 }, 500);
                }
            });

            $(document).on('click', '.delete-address-btn', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: "این آدرس برای همیشه حذف خواهد شد.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'بله، حذف شود',
                    cancelButtonText: 'انصراف',
                    direction: 'rtl'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/user/addresses/${id}`, // Update this to your actual DELETE route
                            type: 'DELETE',
                            success: function(res) {
                                showFeedback(res.message || 'آدرس حذف شد');
                                loadUserAddresses();
                            },
                            error: function() {
                                showFeedback('خطا در حذف آدرس', 'danger');
                            }
                        });
                    }
                });
            });

            // Save/Update Address
            // Submit Logic
            addressForm.on('submit', function (e) {
                e.preventDefault();
                const btn = $('#saveAddressBtn');
                btn.prop('disabled', true).text('در حال ذخیره...');

                const url = currentEditId ? `/user/addresses/${currentEditId}` : "{{ route('user.address.store') }}";
                const method = currentEditId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: $(this).serialize(),
                    success: function (res) {
                        showFeedback(res.message || 'عملیات موفقیت‌آمیز بود');
                        closeAddressForm();
                        loadUserAddresses();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) displayErrors(addressForm, xhr.responseJSON.errors);
                        else showFeedback('خطای سرور', 'danger');
                    },
                    complete: function () {
                        btn.prop('disabled', false).text('ثبت و ذخیره آدرس');
                    }
                });
            });

            // Initial Load
            fetchIranLocations();
            loadUserAddresses();
        });
    </script>
@endsection
