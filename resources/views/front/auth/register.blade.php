<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام | احراز هویت</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* CSS Variables */
        :root {
            --darkBlu-color:#143246;
            --main-color: #FE7743;
            --primary-blue: rgb(82, 152, 218);
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
            background-color: var(--darkBlu-color);
            font-family: 'Tahoma', sans-serif !important;
        }

        #bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            pointer-events: none;
            background: radial-gradient(circle at 20% 30%, #000000, #143246 70%);
        }

        .registration-box {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 450px;
            max-width: 90%;
            padding: 30px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
        }

        .logoContainer {
            width: 65%;
            height: auto;
            margin: 0 auto 20px auto;
            text-align: center;
        }

        .verify-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--darkBlu-color);
            margin-bottom: 10px;
            text-align: center;
        }

        .create-description {
            font-size: 13px;
            color: #777;
            text-align: center;
            margin-bottom: 25px;
            line-height: 1.8;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .login-input-icon {
            position: absolute;
            right: 15px;
            color: #ccc;
            font-size: 16px;
            z-index: 10;
        }

        .form-control {
            width: 100%;
            padding: 12px 40px 12px 15px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fcfcfc;
            direction: rtl;
            text-align: right;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(82, 152, 218, 0.2);
            outline: none;
        }

        .input-ltr {
            direction: ltr !important;
            text-align: left !important;
            padding: 12px 15px 12px 40px;
        }

        .password-toggle {
            position: absolute;
            left: 15px;
            cursor: pointer;
            color: #888;
            z-index: 10;
        }

        .btn-primary {
            width: 100%;
            background-color: var(--primary-blue);
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            color: #fff;
            margin-top: 20px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #4a91e5;
        }

        .message-box {
            background-color: #ffeaea;
            color: #d63031;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: right;
            font-size: 13px;
            width: 100%;
            border: 1px solid #ffcece;
        }
        .message-box ul {
            margin: 0;
            padding-right: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .create-terms-section {
            margin-top: 15px;
            text-align: center;
        }
        .create-terms-section p {
            font-size: 12px;
            color: #7f8c8d;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .text-danger { color: #dc3545; }

        /* Styles specific to OTP Input (UPDATED) */
        .otp-container {
            display: flex;
            justify-content: center;
            gap: 10px; /* Space between inputs */
            direction: ltr;
            margin-bottom: 20px;
        }
        .otp-input {
            width: 50px !important;
            height: 50px;
            text-align: center;
            font-size: 20px;
            padding: 0;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fcfcfc;
            /* Override focus style */
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .otp-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(82, 152, 218, 0.2);
            outline: none;
        }
        .change-mobile-link {
            font-size: 13px;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        /* Custom Modal/Message Box Styles (New) */
        .custom-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none; /* Hidden by default */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .custom-modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 350px;
            width: 90%;
            text-align: center;
        }
        .custom-modal-content h4 {
            font-size: 18px;
            font-weight: 700;
            color: var(--darkBlu-color);
            margin-bottom: 15px;
        }
        .custom-modal-content p {
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }
        .modal-button {
            background-color: var(--primary-blue);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .modal-button:hover {
            background-color: #4a91e5;
        }
    </style>
</head>
<body>

<canvas id="bg"></canvas>

<div class="registration-box">

    <div class="w-100">
        <div class="logoContainer">
            <!-- Replace with your actual logo path -->
            <img src="{{asset('design/image/logo (4)-assets/logo (4).png')}}" alt="Logo" style="max-height: 50px;">
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
