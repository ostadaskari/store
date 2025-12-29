<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود | احراز هویت</title>

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
            font-family: 'Shabnam' !important;
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
            h
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

        /* Password Toggle */
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-toggle {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ccc;
            z-index: 11;
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

        .btn-google {
            width: 100%;
            background-color: #dc3545; /* Bootstrap danger red for Google */
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }
        .btn-google:hover {
            background-color: #c82333;
            color: #fff;
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
            list-style-type: none; /* Hide default list style */
        }
        .message-box ul li {
            position: relative;
            padding-right: 15px;
        }
        .message-box ul li:before {
            content: "\f057"; /* fa-times-circle */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: 0;
            top: 2px;
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

        /* Styles specific to Tabbed Interface */
        .tab-menu {
            display: flex;
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 1px solid #e0e0e0;
        }
        .tab-menu button {
            flex-grow: 1;
            padding: 12px 10px;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 600;
            color: #95a5a6;
            border-bottom: 3px solid transparent;
        }
        .tab-menu button.active {
            color: var(--primary-blue);
            border-bottom: 3px solid var(--primary-blue);
        }
        .tab-pane {
            display: none;
            width: 100%;
        }
        .tab-pane.active {
            display: block;
        }

        /* Styles specific to OTP Input */
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

        /* Custom Modal/Message Box Styles */
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

<div class="registration-box" id="mainLoginContainer">

    <div class="w-100">
        <div class="logoContainer">
            <!-- Replace with your actual logo path -->
            <img src="{{asset('design/image/logo (4)-assets/logo (4).png')}}" alt="Logo" style="max-height: 50px;">
        </div>

        <!-- Tab Menu -->
        <div class="tab-menu">
            <button id="tab-mobile" data-tab="mobile" class="{{ ($errors->has('email') || $errors->has('password')) ? '' : 'active' }}">ورود با شماره موبایل</button>
            <button id="tab-email" data-tab="email" class="{{ ($errors->has('email') || $errors->has('password')) ? 'active' : '' }}">ورود با ایمیل</button>
        </div>

        <!-- Tab Content -->

        <!-- MOBILE TAB -->
        <div id="mobile-tab" class="tab-pane {{ ($errors->has('email') || $errors->has('password')) ? '' : 'active' }}">

            <!-- Error Handling for Mobile/OTP -->
            @if ($errors->has('mobile') || $errors->has('code'))
                <div class="message-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            @if ($error != 'The email field is required.' && $error != 'The password field is required.')
                                <li>{{ $error }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mobile Steps (Step 1 and Step 2) -->
            @if ($step == 1)
                <!-- STEP 1: MOBILE NUMBER INPUT (Login) -->
                <div id="mobile-step-1" class="verify-form-container">
                    <div class="verify-header">
                        <h3 class="verify-title">ورود به حساب کاربری</h3>
                        <div class="create-description">لطفاً شماره موبایل خود را وارد کنید تا کد تایید برای شما ارسال و وارد شوید.</div>
                    </div>

                    <form action="{{ route('client.login.send.code') }}" method="POST">
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
                            @error('mobile')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                        </div>

                        <button class="btn-primary" type="submit">ارسال کد تایید و ورود</button>

                        <div class="create-terms-section">
                            <p>هنوز ثبت نام نکرده‌اید؟
                                <a href="{{ route('client.register.mobile.form') }}" style="color: var(--primary-blue); text-decoration: none; font-weight: bold;">ثبت نام</a>
                            </p>
                        </div>
                    </form>
                </div>

            @elseif ($step == 2)
                <!-- STEP 2: OTP VERIFICATION (Login) -->
                <div id="mobile-step-2" class="verify-form-container">
                    <div class="verify-header">
                        <h3 class="verify-title">تایید کد</h3>
                        <div class="create-description">کد ۴ رقمی به شماره <span dir="ltr">{{ $mobile }}</span> ارسال شد. لطفاً آن را وارد کنید.</div>
                    </div>

                    <form action="{{ route('client.login.verify.code') }}" method="POST" id="otp-form">
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

                        @error('code')<span class="text-danger mt-1">{{ $message }}</span>@enderror


                        <div class="change-mobile-link">
                            <!-- Linking back to the login form route resets the flow -->
                            <a href="{{ route('client.login.mobile.form') }}"
                               id="reset-mobile-link"
                               style="color: var(--primary-blue); text-decoration: none;">تغییر شماره موبایل</a>
                        </div>

                        <button class="btn-primary" type="submit">تایید و ورود</button>

                    </form>
                </div>
            @endif
        </div>

        <!-- EMAIL/PASSWORD TAB -->
        <div id="email-tab" class="tab-pane {{ ($errors->has('email') || $errors->has('password')) ? 'active' : '' }}">
            <div class="verify-form-container">
                <div class="verify-header">
                    <h3 class="verify-title">ورود با ایمیل</h3>
                    <div class="create-description">با وارد کردن ایمیل و کلمه عبور خود وارد شوید.</div>
                </div>

                <!-- Error Handling for Email/Password -->
                @if ($errors->has('email') || $errors->has('password'))
                    <div class="message-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('client.login.authenticate') }}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="email_input" class="form-label">آدرس ایمیل</label>
                        <div class="input-wrapper">
                            <i class="fa fa-envelope login-input-icon"></i>
                            <input type="email"
                                   class="form-control input-ltr @error('email') is-invalid @enderror"
                                   name="email"
                                   id="email_input"
                                   value="{{ old('email') }}"
                                   placeholder="example@mail.com"
                                   required>
                        </div>
                        @error('email')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                    </div>

                    <!-- Password Input -->
                    <div class="form-group password-container">
                        <label for="password_input" class="form-label">کلمه عبور</label>
                        <div class="input-wrapper">
                            <i class="fa fa-lock login-input-icon"></i>
                            <input type="password"
                                   class="form-control input-ltr @error('password') is-invalid @enderror"
                                   name="password"
                                   id="password_input"
                                   placeholder="کلمه عبور"
                                   required>
                            <span class="password-toggle" data-target="password_input">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                        @error('password')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                    </div>

                    <a href="#" class="change-mobile-link" style="text-align: right;">فراموشی رمز عبور</a>

                    <button class="btn-primary" type="submit">ورود</button>

                    <div class="create-terms-section">
                        <p>یا با استفاده از حساب‌های اجتماعی وارد شوید:</p>
                        <a href="{{ route('google.login') }}" class="btn-google">
                            <i class="fab fa-google"></i> ورود با گوگل
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Handles unexpected state -->
        @if ($step != 1 && $step != 2)
            <div class="verify-header">
                <h3 class="verify-title">خطا</h3>
                <div class="create-description">خطای جریان ورود. لطفاً
                    <a href="{{ route('client.login.mobile.form') }}" style="color: var(--primary-blue); text-decoration: none;">دوباره شروع کنید</a>.
                </div>
            </div>
        @endif

    </div>
</div>

<!-- Custom Modal/Message Box (Copied from Register) -->
<div class="custom-modal-backdrop" id="custom-modal-backdrop">
    <div class="custom-modal-content">
        <h4>خطای ورودی</h4>
        <p id="modal-message">لطفاً کد ۴ رقمی را به طور کامل وارد کنید.</p>
        <button class="modal-button" onclick="closeCustomModal()">باشه</button>
    </div>
</div>

<script>
    // Custom Modal Functions
    const modalBackdrop = document.getElementById('custom-modal-backdrop');
    const modalMessage = document.getElementById('modal-message');

    function showCustomModal(message) {
        modalMessage.textContent = message;
        modalBackdrop.style.display = 'flex';
    }

    function closeCustomModal() {
        modalBackdrop.style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {

        // --- Tab Switching Logic ---
        const tabs = document.querySelectorAll('.tab-menu button');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                switchTab(targetTab);
            });
        });

        function switchTab(targetTab) {
            tabs.forEach(t => t.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            document.getElementById(`tab-${targetTab}`).classList.add('active');
            document.getElementById(`${targetTab}-tab`).classList.add('active');
        }


        // --- Password Toggle Logic ---
        const passwordToggles = document.querySelectorAll('.password-toggle');

        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });


        // --- OTP Handling Script ---
        const otpForm = document.getElementById('otp-form');
        if (otpForm) {
            const inputs = [
                document.getElementById('otp-input-1'),
                document.getElementById('otp-input-2'),
                document.getElementById('otp-input-3'),
                document.getElementById('otp-input-4'),
            ];
            const hiddenInput = document.getElementById('hidden-otp-code');

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
            otpForm.addEventListener('submit', (e) => {
                updateHiddenCode();
                // Check if all fields are filled before submitting
                if (hiddenInput.value.length !== 4) {
                    e.preventDefault();
                    showCustomModal('لطفاً کد ۴ رقمی را به طور کامل وارد کنید.');
                }
            });
        }
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
