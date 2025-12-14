@extends('user.layouts.app')
@section('style')

@endsection

@section('content')

    <!-- user account -->
    <div class="container user-account" style="padding-top:70px;">
        <div class="row" style="height: 100%;" >
            <!-- user profile-->
            <div class="col-md-3 mb-4" style="overflow: visible;position: relative;">
                <div class="user-profile">
                    <div class="avatar-div d-flex align-items-center flex-column">
                        <picture>
                            <img id="avatarPreview" class="avatar-img img-fluid" src="{{ asset('design/image/avatar.jpg') }}" alt="آواتار">
                            <svg width="28" height="28" fill="" class="bi bi-star-fill goldRank" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </picture>
                        <button class="change-avatar-btn d-flex align-items-center" onclick="document.getElementById('avatarInput').click()" title="تغییر آواتار">
                            <svg class="mx-1" width="22" height="22" fill="#2e91be" class="bi bi-camera" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M4.318 1a1 1 0 0 0-.894.553L2.382 3H1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-1.382l-1.042-1.447A1 1 0 0 0 11.682 1H4.318zM14 4v9H2V4h2.118l1.106-1.447A.5.5 0 0 1 5.618 2h4.764a.5.5 0 0 1 .394.197L11.882 4H14z"/>
                            </svg>
                        </button>
                        <input type="file" id="avatarInput" accept="image/*" onchange="previewAvatar(event)">
                    </div>

                    <div class="user-info-item d-flex flex-column justify-content-between align-items-center">
                        <b>{{ Auth::user()->name ?? 'نام' }} {{ Auth::user()->family ?? 'نام خانوادگی' }}</b>
                        <b>{{ Auth::user()->mobile ?? 'شماره موبایل ثبت نشده' }}</b>
                    </div>

                    <div class="user-info-item go-scroll" id="go-to-Wallet" data-target="user-Wallet-section">
                        <svg width="20" height="20" fill="#2e91be" class="bi bi-wallet mx-2" viewBox="0 0 16 16">
                            <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1"/>
                        </svg>
                        کیف پول من
                    </div>
                    <div class="user-info-item go-scroll" id="go-to-orders" data-target="user-orders-section">
                        <svg width="20" height="20" fill="#2e91be" class="bi bi-boxes mx-2" viewBox="0 0 16 16">
                            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
                        </svg>
                        سفارش های من
                    </div>
                    <div class="user-info-item go-scroll" id="go-to-invoice" data-target="user-invoice-section">
                        <svg width="20" height="20" fill="#2e91be" class="bi bi-receipt mx-2" viewBox="0 0 16 16">
                            <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                        </svg>
                        فاکتور های من
                    </div>

                    <div class="user-info-item go-scroll" id="go-to-settings" data-target="edit-profile-section" style="border-bottom: none;">
                        <svg width="20" height="20" fill="#2e91be" class="bi bi-gear mx-2" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                        </svg>
                        تنظیمات پروفایل من
                    </div>
                </div>
            </div>
            <!-- end user profile-->

            <!-- edit user info -->
            <div class="col-md-9" id="edit-profile-section" style="display: none;">
                <h2 class="text-title d-flex flex-row align-items-center">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-pencil-square mx-2" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    ویرایش اطلاعات کاربری
                </h2>
                <form class="row g-3 my-1 borderBg" dir="rtl">

                    <div class="col-md-4 mt-0">
                        <label class="form-label">نام و نام خانوادگی:</label>
                        <input type="text" class="form-control" placeholder="زهرا احمدی">
                    </div>
                    <div class="col-md-4 mt-0">
                        <label class="form-label">حوزه کاری شما:</label>
                        <select name="education" class="form-select" style="padding: 9px 0;">
                            <option value=""></option>
                            <option value="analog-designer">طراح آنالوگ</option>
                            <option value="digital-designer">طراح دیجیتال</option>
                            <option value="hardware-designer">طراح سخت‌افزار</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-0">
                        <label class="form-label">شماره تماس:</label>
                        <input type="text" class="form-control input-ltr" placeholder="0912xxxxxxx">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">تاریخ تولد:</label>
                        <div class="d-flex gap-2">
                            <div class="d-flex align-items-center">
                                <label for="birthDay" class="form-label mx-1 mb-0">روز</label>
                                <select class="form-select" id="birthDay"><option value=""></option></select>
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="birthMonth" class="form-label mx-1 mb-0">ماه</label>
                                <select class="form-select" id="birthMonth"><option value=""></option></select>
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="birthYear" class="form-label mx-1 mb-0">سال</label>
                                <select class="form-select" id="birthYear"><option value=""></option></select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">ایمیل:</label>
                        <input type="email" class="form-control" placeholder="zahra@email.com">
                    </div>

                    <div class="col-md-12">
                        <div class="user-info-item go-scroll justify-content-center bg-light py-1" id="go-to-address" data-bs-toggle="modal" data-bs-target="#userAddressesModal">
                            <svg width="20" height="20" fill="rgb(46, 145, 190)" class="bi bi-pin-map mx-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z"/>
                                <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                            </svg>
                            آدرس های من
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-1">
                        <button type="submit" class="btn btn-success" id="mainSaveBtn">ذخیره</button>
                    </div>

                </form>

                <h2 class="text-title d-flex flex-row align-items-center">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-cash-coin mx-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                    </svg>
                    اطلاعات بانکی
                </h2>
                <form id="bankInfoForm" class="row g-3 my-1 borderBg" dir="rtl">

                    <div class="col-12 col-md-4 mt-0">
                        <div class="mb-3 mx-1">
                            <label for="accountNumber" class="form-label">شماره حساب:</label>
                            <input type="text" class="form-control input-ltr" id="accountNumber" name="accountNumber" inputmode="numeric" pattern="[0-9]*" maxlength="10" placeholder="مثلاً 1234567890" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mt-0" style="position: relative;">
                        <label for="cardNumber" class="form-label">شماره کارت:</label>
                        <img id="bankLogo" src="" alt="" style="height: 24px; margin-left: 8px;" />
                        <input type="text" class="form-control input-ltr" id="cardNumber" name="cardNumber" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="مثلاً 60379971..." required>
                    </div>

                    <div class="col-12 col-md-4 mt-0">
                        <label for="shabaNumber" class="form-label">شماره شبا:</label>
                        <div class="input-group">
                            <input type="text" class="form-control input-ltr" id="shabaNumber" name="shabaNumber" inputmode="numeric" pattern="[0-9]{24}" maxlength="24" placeholder="xxxxxxxxxxxxxxxxxxxxxxxx" required>
                            <span class="input-group-text">IR</span>
                        </div>
                        <div class="form-text text-danger d-none" id="shabaError">شماره شبا باید دقیقاً ۲۴ رقم باشد</div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-0">
                        <button type="submit" class="btn btn-success" id="bankSaveBtn">ذخیره</button>
                    </div>
                </form>

                <h2 class="text-title d-flex flex-row align-items-center">
                    <svg width="22" height="22" fill="currentColor" class="bi bi-unlock2-fill mx-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0c1.07 0 2.041.42 2.759 1.104l.14.14.062.08a.5.5 0 0 1-.71.675l-.076-.066-.216-.205A3 3 0 0 0 5 4v2h6.5A2.5 2.5 0 0 1 14 8.5v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4"/>
                    </svg>
                    تغییر رمز عبور
                </h2>
                <form id="changePasswordForm" class="my-1 borderBg" dir="rtl">

                    <div class="row">
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">رمز عبور فعلی <span class="text-danger">*</span></label>
                            <input type="password" class="form-control required" id="currentPassword" placeholder="رمز فعلی">
                            <small class="text-danger d-none" id="currentPasswordError">این فیلد الزامی است</small>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">رمز عبور جدید <span class="text-danger">*</span></label>
                            <input type="password" class="form-control required" id="newPassword" placeholder="حداقل ۸ کاراکتر با حروف کوچک، بزرگ و کاراکتر خاص">
                            <small class="form-text mb-2">رمز عبور باید دارای موارد زیر باشد:</small>
                            <small class="text-danger d-none" id="newPasswordError">رمز عبور جدید با تکرار آن مطابقت ندارد</small>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="form-label">تکرار رمز عبور جدید <span class="text-danger">*</span></label>
                            <input type="password" class="form-control required" id="confirmPassword" placeholder="تکرار رمز عبور جدید">
                            <small class="text-danger d-none" id="confirmPasswordError">رمز عبورها یکسان نیستند</small>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label">الزامات رمز عبور:</label>
                            <ul class="list-unstyled mb-0" id="passwordRules">
                                <li id="rule-length" class="text-danger">⬤ حداقل ۸ کاراکتر</li>
                                <li id="rule-lower" class="text-danger">⬤ حروف کوچک (a-z)</li>
                                <li id="rule-upper" class="text-danger">⬤ حروف بزرگ (A-Z)</li>
                                <li id="rule-symbol" class="text-danger">⬤ یک کاراکتر خاص (مثل @#$!)</li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" id="changePassSaveBtn">ذخیره</button>
                    </div>
                </form>
            </div>
            <!-- end edit user info -->

            <!-- Orders -->
            <div class="col-md-9 px-0" id="user-orders-section">
                <div class="user-orders">
                    <div class="row">
                        <div class="col-md-4 my-1">
                            <div class="order-card order-active p-3 inner-scroll" data-bs-target="current-order-detail" data-order-id="۱۲۳۴۵">
                                <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-box-fill mx-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z"/>
                                </svg>
                                <h6>سفارش ها ({{$orders_count}})</h6>
                            </div>
                        </div>
                        <div class="col-md-4 my-1">
                            <div class="order-card order-delivered p-3 inner-scroll" data-bs-target="delivered-order-detail" data-order-id="۱۲۲۲۲">
                                <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-check2-circle mx-1" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                </svg>
                                <h6>سفارش های دریافت شده ({{ $user_orders_complete_count }})</h6>
                            </div>
                        </div>
                        <div class="col-md-4 my-1">
                            <div class="order-card order-returned p-3 inner-scroll" data-bs-target="returned-order-detail" data-order-id="۱۱۱۱۱">
                                <svg width="45" height="45" fill="rgb(219, 247, 248)" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466"/>
                                </svg>
                                <h6> سفارش های مرجوع شده ({{ $user_orders_canceled_count }})</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-details mt-2">
                    <!--========= Current order section =========
                    ===========================================-->
                    <div id="current-order-detail" class="order-detail-content d-none orderActive" style="overflow: hidden;">
                        <div class="accordion accordion-flush" id="accordionFlushCurrent">
                            @php
                                $statusClasses = [
                                    'pending'    => 'badge bg-warning text-dark',
                                    'processing' => 'badge bg-info text-dark',
                                    'delivered' => 'badge bg-primary',
                                    'completed'  => 'badge bg-success',
                                    'canceled'   => 'badge bg-danger',
                                ];

                                $statusTexts = [
                                    'pending'    => 'در انتظار',
                                    'processing' => 'در حال پردازش',
                                    'delivered' => 'ارسال شده',
                                    'completed'  => 'تکمیل شده',
                                    'canceled'   => 'لغو شده',
                                ];
                            @endphp

                            @foreach($user_orders as $order)
                                <!-- item -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <div class="meta-item"><strong>شماره سفارش:</strong><span> {{ $order->order_number }}</span></div>
                                                <div class="meta-item"><strong>تاریخ سفارش:</strong><span> {{ jdate($order->created_at)->format('%d %B %Y') }}</span></div>
                                                <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{ $order->total_amount }} تومان</span></div>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushCurrent">
                                            <div class="accordion-body p-0">
                                                <div class="w-100 my-2 bg-light">
                                                    <div class="order-meta-grid">
                                                        <div class="meta-item"><strong>شماره سفارش:</strong><span> {{ $order->order_number }}</span></div>
                                                        <div class="meta-item"><strong>تاریخ سفارش:</strong><span> {{ jdate($order->created_at)->format('%A, %d %B %y') }}</span></div>
                                                        <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{ $order->total_amount }} تومان</span></div>
{{--                                                        <div class="meta-item"><strong>سریال پیگیری:</strong><span> </span></div>--}}
                                                        <div class="meta-item"><strong>وضعیت سفارش:</strong>
                                                            @php
                                                                $statusClass = $statusClasses[$order->status] ?? 'badge bg-secondary';
                                                                $statusText  = $statusTexts[$order->status] ?? 'نامشخص';
                                                            @endphp

                                                            <span class="{{ $statusClass }} px-3 py-2 rounded-pill">
                                                                {{ $statusText }}
                                                            </span>
                                                        </div>
                                                        <div class="meta-item d-flex align-items-center gap-2">
                                                            <strong>شماره پیگیری پستی:</strong>
                                                            <span class="trackingCode">71000123654789001235</span>
                                                            <svg width="16" height="16" fill="currentColor" class="bi bi-copy copy-icon" viewBox="0 0 16 16" role="button" style="cursor: pointer;">
                                                                <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                                            </svg>
                                                        </div>
                                                        <div class="meta-item"><strong>ارسال از طریق:</strong><span> {{$order->shipping->name}}</span></div>

                                                        <div class="meta-item"><strong>مشاهده فاکتور:</strong>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal" style="font-size: 14px;">
                                                                <svg width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="order-progress" style="position: relative; height: 40px; margin-top: 80px;">
                                                        <div class="car">
                                                            <svg width="40" height="40" fill="black" class="bi bi-truck" viewBox="0 0 16 16">
                                                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                                            </svg>
                                                        </div>
                                                        <!-- shoping -->
                                                        <svg width="35" height="35" viewBox="0 0 16 16" class="bi bi-shop-icon">
                                                            <defs>
                                                                <linearGradient id="coffeeGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                                    <stop offset="0%" stop-color="#7B3F00" />
                                                                    <stop offset="50%" stop-color="#A0522D" />
                                                                    <stop offset="100%" stop-color="#D2B48C" />
                                                                </linearGradient>
                                                            </defs>
                                                            <path fill="url(#coffeeGradient)" d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                                                        </svg>


                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar bg-warning text-dark progress-bar-striped" role="progressbar" style="width: 52%;">
                                                            </div>
                                                        </div>
                                                        <!-- home -->
                                                        <svg width="40" height="40" viewBox="0 0 16 16" class="bi bi-house-heart-fill house-icon">
                                                            <defs>
                                                                <linearGradient id="fancyGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                                    <stop offset="0%" stop-color="#ff6f91"/>
                                                                    <stop offset="50%" stop-color="#ff9671"/>
                                                                    <stop offset="100%" stop-color="#ffc75f"/>
                                                                </linearGradient>
                                                            </defs>
                                                            <path fill="url(#fancyGradient)" d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
                                                            <path fill="url(#fancyGradient)" d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <!-- end itme -->
                            @endforeach
                        </div>
                    </div>
                    <!--========= Delivered Order Section =========
                    ===========================================-->
                    <div id="delivered-order-detail" class="order-detail-content d-none orderDelivered">
                        <div class="accordion accordion-flush" id="accordionFlushDelivered">
                            @foreach($user_orders_complete as $order)
                            <!-- itme1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <div class="meta-item"><strong>شماره سفارش:</strong><span>{{$order->order_number}}</span></div>
                                            <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                            <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{number_format($order->total_amount)}} تومان</span></div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushDelivered">
                                        <div class="accordion-body">
                                            <div class="order-meta-grid">
                                                <div class="meta-item"><strong>شماره سفارش:</strong><span>{{$order->order_number}}</span></div>
                                                <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                                <div class="meta-item"><strong>مبلغ سفارش:</strong><span> {{number_format($order->total_amount)}} تومان</span></div>
{{--                                                <div class="meta-item"><strong>سریال پیگیری:</strong><span>142536695847</span></div>--}}
                                                <div class="meta-item d-flex align-items-center gap-2">
                                                    <strong>شماره پیگیری پستی:</strong>
                                                    <span class="trackingCode">71000123654789001235</span>
                                                    <svg width="16" height="16" fill="currentColor" class="bi bi-copy copy-icon" viewBox="0 0 16 16" role="button" style="cursor: pointer;">
                                                        <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                                    </svg>
                                                </div>
                                                <div class="meta-item"><strong>ارسال از طریق:</strong><span>{{$order->shipping->name}}</span></div>
                                            </div>

                                            <div class="order-progress mt-4">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success progress-bar-striped"
                                                         role="progressbar"
                                                         style="width: 100%;">
                                                        تحویل شده
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3 text-success">
                                                سفارش شماره <span id="delivered-order-id-message"></span> با موفقیت تحویل داده شده است. از خرید شما سپاسگزاریم 🌟
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- end itme1 -->
                            @endforeach
                        </div>
                    </div>
                    <!--========= Returned Order Section =========
                    ===========================================-->
                    <div id="returned-order-detail" class="order-detail-content d-none orderReturned">
                        <div class="accordion accordion-flush" id="accordionFlushReturned">
                            @foreach($user_orders_canceled as $order)
                            <!-- itme1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed alert alert-danger py-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        سفارش شماره <span> {{ $order->order_number }} </span> مرجوع شده است. در صورت نیاز با پشتیبانی تماس بگیرید.
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushReturned">
                                    <div class="accordion-body">
                                        <div class="order-meta-grid">
                                            <div class="meta-item"><strong>شماره سفارش:</strong><span> {{$order->order_number}}</span></div>
                                            <div class="meta-item"><strong>تاریخ سفارش:</strong><span>{{ jdate($order->created_at)->format('%A، %d %B %Y') }}</span></div>
                                            <div class="meta-item"><strong>مبلغ سفارش:</strong><span>{{number_format($order->total_amount)}} تومان</span></div>
{{--                                            <div class="meta-item"><strong>سریال پیگیری:</strong><span>741852963</span></div>--}}
                                            <div class="meta-item"><strong>شماره پیگیری پستی:</strong><span>7125900025896547</span></div>
                                            <div class="meta-item"><strong>ارسال از طریق:</strong><span> {{$order->shipping->name}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end itme1 -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Orders -->

            <!--======== modal for invoice ===============
            ===========================================-->
            <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between">
                            <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                            <h5 class="modal-title" id="invoiceModalLabel">جزئیات فاکتور</h5>
                        </div>
                        <div class="modal-body pt-0">
                            <!-- The invoice starts here -->
                            <div style="display: block;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">شیرازچیپ</p>
                                        <p class="mb-0">To: {{ Auth::user()->name }} {{ Auth::user()->family }}</p>
                                    </div>
                                    <div class="logo">
                                        <img class="img-fluid" src="design/image/logo.png">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>

                            <!-- Invoice end -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--========= end modal invoice ============
            =========================================-->



            <!-- address -->
            <div class="modal fade" id="userAddressesModal" tabindex="-1" aria-labelledby="userAddressesModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title" id="userAddressesModalLabel">آدرس‌های من</h5>
                            <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                        </div>
                        <div class="modal-body">
                            <!-- address-section -->
                            <div id="address-section">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <!-- modal for add address -->
                                    <div id="address-modal" class="address-modal">
                                        <div class="address-modal-content">
                                            <h4>افزودن آدرس جدید</h4>
                                            <textarea class="addAddress" type="text" id="address-input" placeholder="استان، شهر، خیابان ..."></textarea>
                                            <input type="text" id="receiver-input" placeholder="نام گیرنده..." />
                                            <input type="text" id="phone-input" placeholder="شماره تماس..." />
                                            <div class="address-modal-actions">
                                                <button class="address-submit-btn">ثبت</button>
                                                <button class="address-cancel-btn">انصراف</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-success add-address-btn">+ افزودن آدرس جدید</button>
                                </div>
                                <h6 class="mb-3">لیست آدرس‌ها</h6>
                                <div class="address-list">

                                    <div class="mb-3 p-3 border rounded d-flex gap-3 align-items-start">
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

                                    <div class="mb-3 p-3 border rounded d-flex gap-3 align-items-start">
                                        <input class="form-check-input mt-1" type="radio" name="selectedAddress" id="address2" value="2">
                                        <label for="address2" class="flex-grow-1 cursor-pointer">
                                            <div class="d-flex gap-2 align-items-start">
                                                <div class="fs-4">🏠</div>
                                                <div>
                                                    کرج، میدان شهدا، خیابان گلستان، پلاک ۴۲<br>
                                                    <strong>گیرنده:</strong> زهرا احمدی - ۰۹۱۲۳۴۵۶۷۸۹
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end address -->

            <!-- invoice -->
            <div class="col-md-9" id="user-invoice-section" style="display: none;">
                <!-- searchbar in invoice -->
                <div class="d-flex justify-content-center align-items-center mb-4">
                    <div class="input-group searchbarInvoice">
                        <input type="text" id="invoiceSearch" class="form-control" placeholder="جستجو بر اساس تاریخ یا شماره سفارش..." style="direction: rtl;" inputmode="numeric">
                        <span class="input-group-text">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                      </span>
                    </div>
                </div>
                <!-- end searchbar in invoice -->

                <div id="invoice-section">
                    <div id="invoice-list">
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337350</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۵/۱۱/۲</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-1" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-1')">
                                <svg  width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice  -->
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337200</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۰/۱/۲۵</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-2"  style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-2')">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice  -->
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش  #PKC-14337550</span>-
                                    <span class="mx-1">تاریخ: ۱۴۰۱/۲/۲۰</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-3"  style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-3')">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice  -->
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337350</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۵/۱۱/۲</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-1" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-1')">
                                <svg  width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice  -->
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337200</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۰/۱/۲۵</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-2"  style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-2')">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice  -->
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش  #PKC-14337550</span>-
                                    <span class="mx-1">تاریخ: ۱۴۰۱/۲/۲۰</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-3"  style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-3')">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice  -->
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337350</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۵/۱۱/۲</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-1" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-1')">
                                <svg  width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice  -->
                        <!-- invoice  -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337200</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۰/۱/۲۵</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-2"  style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-2')">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice -->
                        <!-- invoice -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش  #PKC-14337550</span>-
                                    <span class="mx-1">تاریخ: ۱۴۰۱/۲/۲۰</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-3"  style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-3')">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice -->
                        <!-- invoice -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337350</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۵/۱۱/۲</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-1" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-1')">
                                <svg  width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice -->
                        <!-- invoice -->
                        <div class="accordion-item border mb-3">
                            <button class="accordion-header-invoice w-100 text-start btn btn-accordion d-flex justify-content-between align-items-center p-3" type="button">
                                <div class="">
                                    <span class="mx-1">سفارش #PKC-14337200</span>-
                                    <span class="mx-1">تاریخ: ۱۳۹۰/۱/۲۵</span>
                                </div>
                                <span class="toggle-icon">+</span>
                            </button>
                            <div class="accordion-body-invoice p-3 invoice" id="invoice-2"  style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0">نوا شاپ</p>
                                        <p class="mb-0">To: زهرا احمدی</p>
                                    </div>
                                    <div>
                                        <img src="./design/image/Pepsi-Cola.svg" alt="نوا شاپ" class="logo">
                                    </div>
                                </div>

                                <h5 class="text-center mb-2">سفارش کالا و خدمات</h5>

                                <div class="info-box d-flex flex-wrap gap-1">
                                    <div class="col-12 headerInvoice p-2"><span>تاریخ:</span> ۱۳۹۵/۱۱/۱۸</div>
                                    <div class="col-12 headerInvoice p-2"><span>شماره پیگیری:</span> PKC-14337200</div>
                                    <div class="col-12 headerInvoice p-2"><span>کد مشتری:</span> 893</div>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کد کالا</th>
                                            <th>شرح کالا</th>
                                            <th>توضیحات</th>
                                            <th>مبلغ واحد</th>
                                            <th>مبلغ کل</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ پس از تخفیف</th>
                                            <th>مالیات</th>
                                            <th>جمع مبلغ کل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-1001</td>
                                            <td>خرید ترانسمیتر آنالوگ</td>
                                            <td>مدل 4-20mA | نصب تابلوئی</td>
                                            <td>8,000,000</td>
                                            <td>8,000,000</td>
                                            <td>500,000</td>
                                            <td>7,500,000</td>
                                            <td>750,000</td>
                                            <td>8,250,000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-1002</td>
                                            <td>نمایشگر توزین دیجیتال</td>
                                            <td>LED صنعتی | 5 رقم</td>
                                            <td>12,000,000</td>
                                            <td>12,000,000</td>
                                            <td>1,000,000</td>
                                            <td>11,000,000</td>
                                            <td>1,100,000</td>
                                            <td>12,100,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary-box mt-2">
                                    <div class="summary-item">
                                        <span>مجموع تخفیف‌ها:</span>
                                        <span class="text-danger">۱,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>سود شما از این خرید:</span>
                                        <span class="text-success">۲,۵۰۰,۰۰۰</span>
                                    </div>
                                    <div class="summary-item fw-bold">
                                        <span>جمع مبلغ کل پس از تخفیف و مالیات:</span>
                                        <span class="highlight">۲۰,۳۵۰,۰۰۰</span>
                                    </div>
                                    <p  class="text-danger">تمامی مبالغ به ریال می باشند.</p>
                                </div>
                            </div>
                            <button class="btn " onclick="downloadInvoiceAsPDF('invoice-2')">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                                </svg>
                            </button>
                        </div>
                        <!-- end invoice -->

                    </div>
                </div>
            </div>
            <!-- edn invoice -->

            <!-- wallet -->
            <div class="col-md-9" id="user-Wallet-section" style="display: none;">
                <!-- tabs -->
                <ul class="nav nav-tabs mb-3" id="walletTab" role="tablist" dir="rtl">
                    <li class="col-12 col-md-2 nav-item" role="presentation">
                        <button class="nav-link active" id="wallet-tab" data-bs-toggle="tab" data-bs-target="#walletTabContent"
                                type="button" role="tab">
                            <svg width="24" height="24" fill="#699ece" class="bi bi-wallet" viewBox="0 0 16 16">
                                <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1"/>
                            </svg>
                            شارژ کیف پول</button>
                    </li>
                    <li class="col-12 col-md-2 nav-item" role="presentation">
                        <button class="nav-link" id="gift-tab" data-bs-toggle="tab" data-bs-target="#giftTabContent"
                                type="button" role="tab">
                            <svg width="24" height="24" fill="#699ece" class="bi bi-gift" viewBox="0 0 16 16">
                                <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z"/>
                            </svg>
                            ایجاد کارت هدیه</button>
                    </li>
                    <li class="col-12 col-md-2 nav-item" role="presentation">
                        <button class="nav-link" id="points-tab" data-bs-toggle="tab" data-bs-target="#pointsTabContent"
                                type="button" role="tab">
                            <svg width="24" height="24" fill="#699ece" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                            </svg>
                            امتیازات</button>
                    </li>
                </ul>

                <!-- Tabs content -->
                <div class="tab-content" id="walletTabContentWrapper" dir="rtl">
                    <!-- Recharge wallet -->
                    <div class="tab-pane fade show active" id="walletTabContent" role="tabpanel" aria-labelledby="wallet-tab">
                        <!-- step1 -->
                        <div class="wallet-step" id="walletStep1">
                            <p class="wallet-balance">اعتبار شما: ۵۰۰,۰۰۰ ریال</p>
                            <p class="wallet-info">
                                با شارژ حساب خود، در هر بار سفارش نیازی به وارد کردن اطلاعات بانکی نخواهید داشت.
                            </p>
                            <img class="img-wallet-step" src="./design/image/bg-wallet.png">
                            <button class="wallet-btn" onclick="goToNextStep()">افزایش اعتبار</button>
                            <img class="img2-wallet-step" src="./design/image/bg-wallet2.png">
                        </div>
                        <!-- step2 -->
                        <div class="wallet-step d-none" id="walletStep2">
                            <label for="amountInput" class="form-label">مبلغ مورد نظر (ریال):</label>
                            <div class="currency-input-wrapper">
                                <input type="text" id="amountInput" class="form-control" placeholder="مبلغ مورد نظر">
                                <span class="currency-unit">ریال</span>
                            </div>
                            <img class="img-wallet-step" src="./design/image/bg-wallet.png">
                            <img class="img2-wallet-step" src="./design/image/bg-wallet2.png">
                            <button class="wallet-btn" onclick="goBack()">بازگشت</button>
                            <button class="wallet-btn" style="left: 150px;" onclick="submitCharge()">پرداخت</button>
                        </div>
                        <!-- Transaction list -->
                        <h5 class="text-center bg-light py-2 mt-2" style="border-top: 2px dashed #ccc;">تاریخچه تراکنش‌ها</h5>
                        <div class="wallet-stepTransaction" id="TransactionList">
                            <div class="transaction-item border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="mx-2"><strong>شماره سفارش:</strong>  12345</div>
                                    <div class="mx-2"><strong>تاریخ:</strong> 1404/03/12 - 14:35</div>
                                    <div class="mx-2"><strong>درگاه:</strong> زرین‌پال</div>
                                </div>
                                <div class="transaction-icon fs-3">
                                    <svg width="25" height="25" fill="#2e91be" class="bi bi-receipt" viewBox="0 0 16 16">
                                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"></path>
                                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="transaction-item border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div class="d-flex ">
                                    <div class="mx-2"><strong>شماره سفارش:</strong>  12345</div>
                                    <div class="mx-2"><strong>تاریخ:</strong> 1404/03/12 - 14:35</div>
                                    <div class="mx-2"><strong>درگاه:</strong> زرین‌پال</div>
                                </div>
                                <div class="transaction-icon fs-3">
                                    <svg width="25" height="25" fill="#2e91be" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="transaction-item border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div class="d-flex ">
                                    <div class="mx-2"><strong>شماره سفارش:</strong>  12345</div>
                                    <div class="mx-2"><strong>تاریخ:</strong> 1404/03/12 - 14:35</div>
                                    <div class="mx-2"><strong>درگاه:</strong> زرین‌پال</div>
                                </div>
                                <div class="transaction-icon fs-3">
                                    <svg width="25" height="25" fill="#2e91be" class="bi bi-receipt" viewBox="0 0 16 16">
                                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"></path>
                                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="transaction-item border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div class="d-flex ">
                                    <div class="mx-2"><strong>شماره سفارش:</strong>  12345</div>
                                    <div class="mx-2"><strong>تاریخ:</strong> 1404/03/12 - 14:35</div>
                                    <div class="mx-2"><strong>درگاه:</strong> زرین‌پال</div>
                                </div>
                                <div class="transaction-icon fs-3">
                                    <svg width="25" height="25" fill="#2e91be" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- gift card -->
                    <div class="tab-pane fade" id="giftTabContent" role="tabpanel" aria-labelledby="gift-tab">
                        <div class="container p-0">
                            <div class="row d-flex justify-content-between mt-5">
                                <div class="col-12 col-md-6 gift-card-box">
                                    <p class="wallet-balance text-center mb-5">اعتبار شما: ۵۰۰,۰۰۰ ریال</p>
                                    <div class="my-2">
                                        <label for="giftCardAmount" class="form-label">مبلغ کارت هدیه (ریال):</label>
                                        <div class="currency-input-wrapper">
                                            <input type="text" id="giftCardAmount" class="form-control w-100 number-format" placeholder="مبلغ مورد نظر را وارد کنید">
                                            <span class="currency-unit">ریال</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mt-md-0 mt-5 gift-card-box" style="overflow: hidden;">
                                    <div class="" >
                                        <img class="img-gift" src="./design/image/preview.png">
                                        <div class=" d-flex flex-column justify-content-between align-items-center" style="height: 115px;">
                                            <div class="gift-card-header">
                                                <span class="gift-card-title">کارت هدیه</span>
                                                <img src="./design/image/shaparak.png" alt="لوگو" style="width:80px; " class="img-fluid gift-card-logo">
                                            </div>
                                            <div class="gift-card-serial d-flex justify-content-between align-items-center">
                                                <button class="copy-btn" onclick="copyGiftSerial()" title="کپی شماره سریال">
                                                    <svg width="20" height="20" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                                    </svg>
                                                </button>
                                                <span id="giftSerial"> 1234567890 123456</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Privileges -->
                    <div class="tab-pane fade" id="pointsTabContent" role="tabpanel" aria-labelledby="points-tab" dir="ltr">
                        <div class="row g-4" dir="rtl">
                            <!-- Points now -->
                            <div class="col-md-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-title fw-bold">امتیازات در حال حاضر</h5>
                                        <div class="display-5 fw-bold text-success mt-3">۷۵۰</div>
                                        <p class="text-muted mt-2">مجموع امتیازهای قابل استفاده شما</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Convert points into shopping vouchers -->
                            <div class="col-md-6">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-title fw-bold">تبدیل به بن خرید</h5>
                                        <p class="mt-3">با تبدیل امتیاز می‌توانید بن‌های تخفیف دریافت کنید.</p>
                                        <input type="number" class="form-control my-2 text-center" placeholder="مثلاً 100 امتیاز">
                                        <button class="btn btn-outline-success w-100 mt-2">تبدیل به بن</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Rank -->
                            <div class="col-md-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-title fw-bold">رتبه فروشگاه ما</h5>
                                        <div class="display-5 fw-bold text-gold mt-3">طلایی</div>
                                        <p class="text-muted mt-2">شما در رتبه مشتری های طلایی ما قرار گرفته اید.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Score history -->
                            <div class="col-12">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-title fw-bold text-center">تاریخچه امتیازات</h5>
                                        <div class="ScoreHistory-table mt-3">
                                            <table class="table table-bordered text-center align-middle mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th scope="col">امتیاز</th>
                                                    <th scope="col">علت دریافت</th>
                                                    <th scope="col">تاریخ</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="text-success fw-bold">+۲۰</td>
                                                    <td>نظرسنجی رضایت</td>
                                                    <td class="text-muted">۱۴۰۴/۰۲/۰۱</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-success fw-bold">+۱۵</td>
                                                    <td>ثبت سفارش</td>
                                                    <td class="text-muted">۱۴۰۴/۰۲/۱۵</td>
                                                </tr>
                                                <tr><td class="text-success fw-bold">+۱۰</td><td>عضویت</td><td class="text-muted">۱۴۰۴/۰۱/۱۰</td></tr>
                                                <tr><td class="text-success fw-bold">+۵</td><td>دعوت از دوست</td><td class="text-muted">۱۴۰۴/۰۱/۱۲</td></tr>
                                                <tr><td class="text-success fw-bold">+۳۰</td><td>خرید محصول</td><td class="text-muted">۱۴۰۴/۰۱/۱۵</td></tr>
                                                <tr><td class="text-success fw-bold">+۱۰</td><td>نظر مثبت</td><td class="text-muted">۱۴۰۴/۰۱/۱۸</td></tr>
                                                <tr><td class="text-success fw-bold">-۲۰</td><td>لغو سفارش</td><td class="text-muted">۱۴۰۴/۰۱/۲۰</td></tr>
                                                <tr><td class="text-success fw-bold">+۴۰</td><td>تکمیل پروفایل</td><td class="text-muted">۱۴۰۴/۰۱/۲۵</td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- end wallet -->
        </div>
    </div>
    <!-- end user account -->
@endsection

@section('script')

@endsection

