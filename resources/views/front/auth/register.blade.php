<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام | احراز هویت</title>

    <!-- bootstrap -->
    <link href="{{asset('design/css/bootstrap.rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('/design/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('/design/css/userlogin.css')}}" rel="stylesheet">

</head>
<body>

<canvas id="bg"></canvas>

<div class="registration-box">

    <div class="w-100">
        <div class="logoContainer">
            <!-- Replace with your actual logo path -->
            <img src="{{asset('design/image/logo (4).png')}}" alt="Logo" style="max-height: 80px;">
        </div>

        <!-- Error Handling -->
        @if ($errors->any())
            <div class="message-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- STEP 1: MOBILE NUMBER INPUT -->
        @if ($step == 1)
            <div class="verify-header">
                <h3 class="verify-title">احراز هویت</h3>
                <div class="create-description">لطفاً شماره موبایل خود را وارد کنید تا کد تایید برای شما ارسال شود.</div>
            </div>

            <form action="{{ route('client.register.send.code') }}" method="POST" class="verify-form-container">
                @csrf

                <div class="form-group">
                    <label for="mobile_step1" class="form-label">شماره موبایل</label>
                    <div class="input-wrapper">
                        <i class="fa fa-mobile-alt login-input-icon"></i>
                        <input type="tel"
                               class="form-control input-ltr @error('mobile') is-invalid @enderror"
                               name="mobile"
                               id="mobile_step1"
                               value="{{ old('mobile') }}"
                               placeholder="مثال: 09123456789"
                               required autofocus>
                    </div>
                </div>

                <button class="btn-primary" type="submit">ارسال کد تایید</button>

                <div class="create-terms-section">
                    <p>قبلاً ثبت نام کرده‌اید؟
                        <a href="{{ route('client.login.mobile.form') }}" style="color: var(--primary-blue); text-decoration: none; font-weight: bold;">ورود</a>
                    </p>
                </div>
            </form>

            <!-- STEP 2: OTP VERIFICATION (UPDATED MODERN VIEW) -->
        @elseif ($step == 2)
            <div class="verify-header">
                <h3 class="verify-title">تایید کد</h3>
                <div class="create-description">کد ۴ رقمی به شماره <span dir="ltr">{{ $mobile }}</span> ارسال شد. لطفاً آن را وارد کنید.</div>
            </div>

            <form action="{{ route('client.register.verify.code') }}" method="POST" class="verify-form-container" id="otp-form">
                @csrf
                <input type="hidden" name="mobile" value="{{ $mobile }}">

                <!-- Hidden field to send the combined 4-digit code to the backend -->
                <input type="hidden" name="code" id="hidden-otp-code">

                <div class="otp-container">
                    <input type="text" class="otp-input" id="otp-input-1" maxlength="1" inputmode="numeric" required autofocus>
                    <input type="text" class="otp-input" id="otp-input-2" maxlength="1" inputmode="numeric" required>
                    <input type="text" class="otp-input" id="otp-input-3" maxlength="1" inputmode="numeric" required>
                    <input type="text" class="otp-input" id="otp-input-4" maxlength="1" inputmode="numeric" required>
                </div>

                <div class="change-mobile-link">
                    <a href="{{ route('client.register.reset.mobile') }}"
                       id="reset-mobile-link"
                       style="color: var(--primary-blue); text-decoration: none;">تغییر شماره موبایل</a>
                </div>

                <button class="btn-primary" type="submit">تایید و ادامه</button>

            </form>

            <!-- STEP 3: FINAL REGISTRATION FORM -->
        @elseif ($step == 3)
            <div class="verify-header">
                <h3 class="verify-title">تکمیل ثبت نام</h3>
                <div class="create-description">لطفاً مشخصات خود را جهت ایجاد حساب کاربری کامل وارد نمایید.</div>
            </div>

            <form action="{{ route('client.register') }}" method="POST" class="verify-form-container">
                @csrf

                <!-- Mobile (Disabled/Hidden) -->
                <div class="form-group">
                    <label for="mobile_step3" class="form-label">شماره موبایل (تایید شده)</label>
                    <div class="input-wrapper">
                        <i class="fa fa-mobile-alt login-input-icon"></i>
                        <input type="text"
                               class="form-control input-ltr"
                               name="mobile_display"
                               id="mobile_step3"
                               value="{{ $mobile }}"
                               disabled
                               required>
                        <input type="hidden" name="mobile" value="{{ $mobile }}">
                    </div>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">نام</label>
                    <div class="input-wrapper">
                        <i class="fa fa-user login-input-icon"></i>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') }}"
                               id="name"
                               required>
                    </div>
                </div>

                <!-- Family -->
                <div class="form-group">
                    <label for="family" class="form-label">نام خانوادگی</label>
                    <div class="input-wrapper">
                        <i class="fa fa-user login-input-icon"></i>
                        <input type="text"
                               class="form-control @error('family') is-invalid @enderror"
                               name="family"
                               value="{{ old('family') }}"
                               id="family"
                               required>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">ایمیل (اختیاری)</label>
                    <div class="input-wrapper">
                        <i class="fa fa-envelope login-input-icon"></i>
                        <input type="email"
                               class="form-control input-ltr @error('email') is-invalid @enderror"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               placeholder="example@mail.com">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="passwordInput" class="form-label">رمز عبور</label>
                    <div class="input-wrapper">
                        <i class="fa fa-lock login-input-icon"></i>
                        <input type="password"
                               class="form-control input-ltr @error('password') is-invalid @enderror"
                               id="passwordInput"
                               name="password"
                               required>
                        <span class="password-toggle" onclick="togglePassword('passwordInput', this)">
                                <i class="fa fa-eye-slash"></i>
                            </span>
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div class="form-group">
                    <label for="passwordConfirmInput" class="form-label">تکرار رمز عبور</label>
                    <div class="input-wrapper">
                        <i class="fa fa-lock login-input-icon"></i>
                        <input type="password"
                               class="form-control input-ltr"
                               id="passwordConfirmInput"
                               name="password_confirmation"
                               required>
                    </div>
                </div>

                <button class="btn-primary" type="submit">ثبت نام و ورود</button>

            </form>
        @endif

    </div>
</div>

<!-- Custom Modal/Message Box (New) -->
<div class="custom-modal-backdrop" id="custom-modal-backdrop">
    <div class="custom-modal-content">
        <h4>خطای ورودی</h4>
        <p id="modal-message">لطفاً کد ۴ رقمی را به طور کامل وارد کنید.</p>
        <button class="modal-button" onclick="closeCustomModal()">باشه</button>
    </div>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePassword(inputId, el) {
        const input = document.getElementById(inputId);
        const icon = el.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    // Custom Modal Functions (New)
    const modalBackdrop = document.getElementById('custom-modal-backdrop');
    const modalMessage = document.getElementById('modal-message');

    function showCustomModal(message) {
        modalMessage.textContent = message;
        modalBackdrop.style.display = 'flex';
    }

    function closeCustomModal() {
        modalBackdrop.style.display = 'none';
    }


</script>

<!-- OTP Handling Script (Updated) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = [
            document.getElementById('otp-input-1'),
            document.getElementById('otp-input-2'),
            document.getElementById('otp-input-3'),
            document.getElementById('otp-input-4'),
        ];
        const hiddenInput = document.getElementById('hidden-otp-code');
        const otpForm = document.getElementById('otp-form');

        // Function to combine OTP inputs and set the hidden field value
        const updateHiddenCode = () => {
            const code = inputs.map(input => input.value).join('');
            hiddenInput.value = code;
        };

        // Event listeners for input changes and movement
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                // Force input to be only one digit
                if (e.target.value.length > 1) {
                    e.target.value = e.target.value.slice(0, 1);
                }

                // Move to the next input automatically
                if (e.target.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                updateHiddenCode();
            });

            input.addEventListener('keydown', (e) => {
                // Handle backspace to move to the previous input
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Ensure the hidden field is updated before submission
        otpForm?.addEventListener('submit', (e) => {
            updateHiddenCode();
            // Check if all fields are filled before submitting
            if (hiddenInput.value.length !== 4) {
                e.preventDefault();
                // *** FIX: Replaced alert() with showCustomModal() ***
                showCustomModal('لطفاً کد ۴ رقمی را به طور کامل وارد کنید.');
            }
        });
    });
</script>

<!-- Three.js Background Script -->
<script type="module">
    import * as THREE from "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js";

    function setupThreeJS() {
        const canvas = document.getElementById("bg");
        if (!canvas) return;

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
        camera.position.z = 5;

        const renderer = new THREE.WebGLRenderer({
            canvas: canvas,
            alpha: true,
            antialias: true
        });
        renderer.setClearColor(0x000000, 0);
        renderer.setSize(window.innerWidth, window.innerHeight);

        // Stars
        const starsCount = 2000;
        const positions = new Float32Array(starsCount * 3);
        const colors = new Float32Array(starsCount * 3);

        for(let i = 0; i < starsCount * 3; i += 3) {
            positions[i] = (Math.random() - 0.5) * 100;
            positions[i+1] = (Math.random() - 0.5) * 100;
            positions[i+2] = (Math.random() - 0.5) * 100;

            colors[i] = Math.random() * 0.5 + 0.5;
            colors[i+1] = Math.random() * 0.5 + 0.5;
            colors[i+2] = Math.random() * 0.5 + 0.5;
        }

        const starsGeometry = new THREE.BufferGeometry();
        starsGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        starsGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        const starsMaterial = new THREE.PointsMaterial({
            size: 0.1,
            vertexColors: true,
            transparent: true,
            opacity: 0.8
        });

        const stars = new THREE.Points(starsGeometry, starsMaterial);
        scene.add(stars);

        // Nebula
        const nebulaGeometry = new THREE.SphereGeometry(50, 32, 32);
        const nebulaMaterial = new THREE.MeshBasicMaterial({
            color: 0x222244,
            side: THREE.BackSide,
            transparent: true,
            opacity: 0.2
        });
        const nebula = new THREE.Mesh(nebulaGeometry, nebulaMaterial);
        scene.add(nebula);

        function animate() {
            requestAnimationFrame(animate);
            stars.rotation.y += 0.0005;
            stars.rotation.x += 0.0002;
            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener("resize", () => {
            renderer.setSize(window.innerWidth, window.innerHeight);
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
        });
    }
    document.addEventListener('DOMContentLoaded', setupThreeJS);
</script>
</body>
</html>
