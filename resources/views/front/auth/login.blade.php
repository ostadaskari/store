<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود | احراز هویت</title>

    <!-- bootstrap -->
    <link href="{{asset('design/css/bootstrap.rtl.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('/design/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('/design/css/userlogin.css')}}" rel="stylesheet">


</head>
<body>
<canvas id="bg"></canvas>

<div class="registration-box" id="mainLoginContainer">

    <div class="w-100">
        <div class="logoContainer">
            <!-- Replace with your actual logo path -->
            <img src="{{asset('design/image/logo (4).png')}}" alt="Logo" style="max-height: 80px;">
        </div>

        <!-- Tab Menu -->
        <div class="tab-menu">
            <button id="tab-mobile" data-tab="mobile" class="{{ ($errors->has('email') || $errors->has('password')) ? '' : 'active' }}">ورود با شماره موبایل</button>
            <button id="tab-email" data-tab="email" class="{{ ($errors->has('email') || $errors->has('password')) ? 'active' : '' }}">ورود با ایمیل</button>
        </div>

        <!-- Tab Content -->

        <!-- MOBILE TAB -->
        <div id="mobile-tab" class="tab-pane {{ ($errors->has('email') || $errors->has('password')) ? '' : 'active' }}">

            

            <!-- Mobile Steps (Step 1 and Step 2) -->
            @if ($step == 1)
                <!-- STEP 1: MOBILE NUMBER INPUT (Login) -->
                <div id="mobile-step-1" class="verify-form-container">
                    <div class="verify-header">
                        <div class="create-description">لطفاً شماره موبایل خود را وارد کنید تا کد تایید برای شما ارسال و وارد شوید.</div>
                    </div>
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
                        </div>

                        <button class="btn-primary" type="submit">ارسال کد تایید و ورود</button>

                        <div class="create-terms-section" style="position: absolute;bottom: 10px;left: 34%;">
                            <p>
                                هنوز ثبت نام نکرده‌اید؟
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


                        <div class="change-mobile-link d-flex justify-content-between align-items-center mb-3">
                            {{-- Update the link to point to the RESET route --}}
                            <a href="{{ route('client.login.mobile.reset') }}"
                               style="color: var(--primary-blue); text-decoration: none; font-size: 0.9rem;">
                                <i class="fa fa-edit me-1"></i> تغییر شماره موبایل
                            </a>

                            {{-- Countdown Timer Display --}}
                            <div id="otp-timer" class="text-muted" style="font-size: 0.9rem;">
                                زمان باقی‌مانده: <span id="timer-counter" class="fw-bold">02:00</span>
                            </div>
                        </div>

                        {{-- Resend Code Link (Hidden by default) --}}
                        <div id="resend-container" class="text-center mb-3" style="display: none;">
                            <p class="small">کد را دریافت نکردید؟
                                <a href="{{ route('client.login.mobile.reset') }}" class="text-primary fw-bold">ارسال مجدد</a>
                            </p>
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
                        {{-- @error('email')<span class="text-danger mt-1">{{ $message }}</span>@enderror --}}
                    </div>

                    <!-- Password Input -->
                    <div class="form-group password-container">
                        <label for="password_input" class="form-label">کلمه عبور</label>
                        <div class="input-wrapper">
                            <i class="fa fa-lock login-input-icon"></i>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
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


                    <button class="btn-primary" type="submit">ورود</button>

                    <div class="create-terms-section mb-2" style="position: absolute;bottom: 10px;width:80%;">
                        <a href="{{ route('google.login') }}" class="btn-google">
                            <i class="fab fa-google"></i> ورود با گوگل
                        </a>
                        <a href="#" class="change-mobile-link" style="text-align: right;">فراموشی رمز عبور</a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. OTP Input Logic (Auto-focus next)
        const inputs = document.querySelectorAll('.otp-input');
        const hiddenInput = document.getElementById('hidden-otp-code');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHiddenInput();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        function updateHiddenInput() {
            let code = "";
            inputs.forEach(input => code += input.value);
            hiddenInput.value = code;
        }

        // 2. Countdown Timer (5 Minutes)
        let timeLeft = 300; // 5 minutes in seconds
        const timerDisplay = document.getElementById('timer-counter');
        const timerContainer = document.getElementById('otp-timer');
        const resendContainer = document.getElementById('resend-container');

        const timerInterval = setInterval(function() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            timerDisplay.textContent = minutes + ':' + seconds;

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerContainer.style.display = 'none';
                resendContainer.style.display = 'block';
            } else {
                timeLeft--;
            }
        }, 1000);
    });
</script>


<!-- Three.js Background Script -->
<script type="module">
    import * as THREE from "{{asset('design/js/three.module.js')}}";

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
