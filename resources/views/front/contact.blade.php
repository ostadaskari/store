@extends('front.layouts.app')

@section('style')
    <style>
        .main-content {
            position: relative;
            margin-top:40px;
            margin-bottom: 456px;
            background: #507596;
            background: radial-gradient(circle, rgba(80, 117, 150, 1) 0%, rgba(0, 49, 83, 1) 100%);
            min-height: 459px;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .contactContainer {
            width: 80%;
            position: absolute;
            top: 23vh;
            right:0;
            left: 0;
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px 20px 0 0;
            color: #333;
        }
        .topPadd { padding-top: 163px; }
        .icon-circle {
            background-color: #dbeafe;
            color: #2563eb;
            width: 48px; height: 48px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 0.5rem; font-size: 1.25rem;
        }
        .btn-primary { background-color: #2563eb; border: none; padding: 10px 20px; }
        .text-contact { color:rgb(24 24 24); }
        .imgFollow { width: 180px; position: absolute; left: -18px; top: -14vh; }

        /* Captcha Styles */
        .captcha-container {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.5);
            padding: 5px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .captcha-img { border-radius: 5px; cursor: pointer; }

        @media (max-width: 768px) {
            .main-content { padding-top:33px; }
            .contactContainer { top: 10vh; width: 90%; }
        }
    </style>
@endsection

@section('content')
    <main class="main-content container-fluid topPadd">
        <div class="container py-2 contactContainer">
            <div class="mt-3">
                <p class="lh-lg text-center m-0" style="color:#021010;">
                    برای مراجعه حضوری یا تماس تلفنی می‌توانید از اطلاعات زیر استفاده کنید. همکاران ما در ساعات اداری پاسخگوی شما هستند.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="px-4" style="border-left: 1px solid #9db1c563;">
                        <form id="contactForm">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label text-contact">نام و نام خانوادگی:</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="نام خود را وارد کنید" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label text-contact fw-medium">شماره تماس:</label>
                                    <input type="tel" class="form-control input-ltr" name="phone" id="phone" placeholder="0912..." dir="ltr" required>
                                </div>
                            </div>

                            <div class="mb-3 px-2">
                                <label for="email" class="form-label text-contact fw-medium">ایمیل:</label>
                                <input type="email" class="form-control input-ltr" name="email" id="email" placeholder="example@domain.com" dir="ltr" required>
                            </div>

                            <div class="mb-2 px-2">
                                <label for="message" class="form-label text-contact fw-medium">پیام شما:</label>
                                <textarea class="form-control" name="message" id="message" rows="4" placeholder="متن پیام خود را بنویسید..." style="resize: none;" required></textarea>
                            </div>

                            <!-- Captcha Section -->
                            <div class="mb-3 px-2">
                                <label class="form-label text-contact fw-medium">کد امنیتی:</label>
                                <div class="captcha-container">
                                    <img src="{{ route('captcha.image') }}" alt="captcha" class="captcha-img" id="captchaImg">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="refreshCaptcha()">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                    <input type="text" class="form-control" name="captcha" placeholder="پاسخ؟" style="width: 80px;" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end pb-3">
                                <button type="submit" id="submitBtn" class="btn btn-primary btn-submit d-flex align-items-center justify-content-center gap-2">
                                    <span>ارسال پیام</span>
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 pt-5 position-relative">
                    <img class="imgFollow" src="{{ asset('design/image/iconFollow.png') }}" alt="follow us">
                    <div class="ps-lg-4">
                        <!-- Contact Info Blocks (Same as your original) -->
                        <div class="d-flex flex-column gap-3 mb-5">
                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-circle flex-shrink-0"><i class="bi bi-geo-alt-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">آدرس دفتر مرکزی</h6>
                                    <p class="text-contact mb-0 lh-base">شیراز، چهارراه پارامونت، خیابان قصرالدشت ،کوچه 2 , ساختمان داور</p>
                                </div>
                            </div>
                            <!-- ... rest of your info blocks ... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')

    <script>
        function refreshCaptcha() {
            const captcha = document.getElementById('captchaImg');
            captcha.src = "{{ route('captcha.image') }}?" + Math.random();
        }

        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const btn = document.getElementById('submitBtn');
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = 'در حال ارسال...';

            const formData = new FormData(this);

            try {
                const response = await fetch("{{ route('contact.send') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'موفقیت',
                        text: result.message,
                        confirmButtonText: 'باشه'
                    });
                    this.reset();
                    refreshCaptcha();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: result.message || 'خطایی در اعتبارسنجی رخ داد',
                        confirmButtonText: 'تلاش مجدد'
                    });
                    if(result.status === 'error') refreshCaptcha();
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    text: 'ارتباط با سرور برقرار نشد.',
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        });
    </script>
@endsection
