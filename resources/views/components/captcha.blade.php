@props(['key' => 'default'])

<div class="custom-captcha-wrapper mb-3" data-captcha-key="{{ $key }}">
    <label class="form-label fw-bold small">کد امنیتی را وارد کنید: <span class="text-danger">*</span></label>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <!-- باکس نمایش تصویر SVG -->
        <div class="captcha-image-box d-flex align-items-center" style="cursor: pointer;" title="برای تغییر کد کلیک کنید">
            {!! \App\Services\CaptchaService::generate($key) !!}
        </div>

        <!-- دکمه رفرش مدرن -->
        <button type="button" class="btn btn-outline-secondary btn-sm refresh-captcha-btn d-flex align-items-center justify-content-center" style="height: 46px; width: 42px; border-radius: 8px;" title="کد جدید">
            <i class="fa-solid fa-arrows-rotate"></i>
        </button>

        <!-- فیلد ورودی کد -->
        <input type="text"
               name="captcha"
               class="form-control text-center fw-bold"
               style="max-width: 140px; height: 46px; border-radius: 8px; letter-spacing: 3px; text-transform: uppercase;"
               placeholder="کد امنیتی"
               maxlength="5"
               autocomplete="off"
               required>
    </div>
</div>
