<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ورود به سایت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('design/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('design/css/login.css')}}">

    <link rel="icon" href="{{asset('design/image/logo.png')}}" type="image/png">


</head>
<body>

    <canvas id="bg"></canvas>

    <div class="login" id="mainLoginContainer">
        <div class="tab-menu">
            <button id="tab-mobile" class="active" data-tab="mobile">ورود با شماره موبایل</button>
            <button id="tab-username" data-tab="username">ورود با نام کاربری</button>
        </div>

        <div class="form-container">

            {{--show errors--}}
            @include('admin.layouts._message')

            <div id="mobile-tab" class="tab-pane active w-100">

                <form id="mobile-step-1-form" class="custom-form active-step" method="POST" action="">
                     @csrf
                    <a class="logoContainer" href="\">
                        <img src="{{ asset('design/image/logo (4).png') }}" alt="شیرازچیپ" title="شیرازچیپ" class="img-fluid">
                    </a>
                    <p class="text-sm mt-4 text-center">برای ورود به سایت لطفا شماره موبایل خود را جهت دریافت کد تایید وارد کنید.</p>

                    <input type="tel" id="mobileNumberInput" name="mobile" class="form-control input-ltr"
                            placeholder="۰۹۱۲۶۳۲۴۷۴۵" maxlength="11" required>

                    <button class="btn-primary" type="button" id="js-mobile-continue">ادامه</button>
                </form>

                <form id="mobile-step-2-form" class="custom-form hidden" method="POST" action="">
                    <div class="w-100 text-start">
                        <button class="btn btn-link text-secondary p-0" type="button" id="backToMobileStep1">
                            <i class="fa fa-arrow-right fs-4"></i>
                        </button>
                    </div>
                    <h1 class="text-center"><i class="fa fa-mobile-alt login-input-icon mx-1"></i>کد تایید را وارد کنید</h1>
                    <p class="text-center text-sm">کد ۴ رقمی ارسال شده به شماره <span id="displayMobileNumber" class="fw-bold text-dark"></span> را وارد کنید.</p>

                    <div class="otp-input-group" dir="ltr">
                        <input type="text" class="otp-input form-control" maxlength="1" data-index="0" name="otp_0" inputmode="numeric">
                        <input type="text" class="otp-input form-control" maxlength="1" data-index="1" name="otp_1" inputmode="numeric">
                        <input type="text" class="otp-input form-control" maxlength="1" data-index="2" name="otp_2" inputmode="numeric">
                        <input type="text" class="otp-input form-control" maxlength="1" data-index="3" name="otp_3" inputmode="numeric">
                        <input type="hidden" id="hiddenMobileForOtp" name="mobile">
                    </div>

                    <button class="btn-primary" type="button" id="js-otp-login">ورود</button>

                    <a href="#" class="forgotPass mt-4" id="resend-otp">ارسال مجدد کد تایید</a>
                </form>
            </div>

            <div id="username-tab" class="tab-pane w-100">
                <a class="logoContainer" href="\">
                   <img src="{{ asset('design/image/logo (4).png') }}" alt="شیرازچیپ" title="شیرازچیپ" class="img-fluid">
                </a>

                <form class="custom-form"  method="POST" action="">
                    @csrf
                    <div class="social-container">
                        <a href="{{ route('google.login') }}" class="btn btn-danger w-100">
                            <i class="fab fa-google"></i> Login with Google
                        </a>
                    </div>

                    <input type="text" id="usernameInput" name="email" placeholder="Email" class="form-control" required>

                    <div class="password-container">
                        <input class="form-control passwordId" type="password" id="passwordInput" name="password" placeholder="کلمه عبور..." required>
                        <span class="password-toggle" data-target="passwordInput">
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </span>
                    </div>

                    <a href="" class="forgotPass">فراموشی رمز عبور</a>
                    <button class="btn-primary" type="submit">ورود</button>

                </form>

                {{-- forgot pass form --}}
                <form id="forgot-password-form" class="custom-form" method="POST" action="">

                    <a class="logoContainer" href="\">
                        <img src="{{ asset('design/image/logo (4).png') }}" alt="شیرازچیپ" title="شیرازچیپ" class="img-fluid">
                    </a>
                    <p class="text-sm mt-4 text-center">برای بازیابی رمز عبور، لطفا شماره موبایل خود را وارد کنید.</p>

                    <input type="tel" id="mobileNumberInputRecovery" name="mobile" class="form-control input-ltr"
                        placeholder="۰۹۱۲۶۳۲۴۷۴۵" maxlength="11" required>

                    <button class="btn-primary" type="submit">بازیابی رمز</button>
                    
                    <a href="#" id="backToLogin" class="mt-3 d-block text-center">بازگشت به صفحه ورود</a>
                </form>
                {{-- end forgot pass form --}}

            </div>

        </div>

    </div>


    <script type="module">

        //====================================================
        //            js code for background (THREE.js)
        //====================================================
            // Note: The THREE.js dependency must be loaded for this block to run
            import * as THREE from "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js";

            function setupThreeJS() {
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
                camera.position.z = 5;

                const canvas = document.getElementById("bg");
                if (!canvas) return; // Prevent error if canvas is missing

                const renderer = new THREE.WebGLRenderer({
                    canvas: canvas,
                    alpha: true,
                    antialias: true
                });
                renderer.setClearColor(0x000000, 0);
                renderer.setSize(window.innerWidth, window.innerHeight);

                // Stars (particles) logic... (as originally written)
                const starsCount = 2000;
                const positions = new Float32Array(starsCount * 3);
                const colors = new Float32Array(starsCount * 3);

                for(let i = 0; i < starsCount * 3; i += 3) {
                    positions[i] = (Math.random() - 0.5) * 100;
                    positions[i+1] = (Math.random() - 0.5) * 100;
                    positions[i+2] = (Math.random() - 0.5) * 100;

                    const r = Math.random() * 0.5 + 0.5;
                    const g = Math.random() * 0.5 + 0.5;
                    const b = Math.random() * 0.5 + 0.5;
                    colors[i] = r;
                    colors[i+1] = g;
                    colors[i+2] = b;
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

                // Nebula effect
                const nebulaGeometry = new THREE.SphereGeometry(50, 32, 32);
                const nebulaMaterial = new THREE.MeshBasicMaterial({
                    color: 0x222244,
                    side: THREE.BackSide,
                    transparent: true,
                    opacity: 0.2
                });
                const nebula = new THREE.Mesh(nebulaGeometry, nebulaMaterial);
                scene.add(nebula);

                // Animate
                function animate() {
                    requestAnimationFrame(animate);
                    stars.rotation.y += 0.0005;
                    stars.rotation.x += 0.0002;
                    renderer.render(scene, camera);
                }
                animate();

                // Handle window resize
                window.addEventListener("resize", () => {
                    renderer.setSize(window.innerWidth, window.innerHeight);
                    camera.aspect = window.innerWidth / window.innerHeight;
                    camera.updateProjectionMatrix();
                });
            }

            // Use DOMContentLoaded to ensure the canvas exists before calling setupThreeJS
            document.addEventListener('DOMContentLoaded', setupThreeJS);

        //====================================================
        //          end js code for background
        //====================================================



       // ==========================================================
        // UI Logic (Click, Visibility, Toggles)
        // ==========================================================
        const tabMobile = document.getElementById('tab-mobile');
        const tabUsername = document.getElementById('tab-username');
        const mobileTab = document.getElementById('mobile-tab');
        const usernameTab = document.getElementById('username-tab');
        const mobileStep1 = document.getElementById('mobile-step-1-form');
        const mobileStep2 = document.getElementById('mobile-step-2-form');
        const mobileNumberInput = document.getElementById('mobileNumberInput');
        const displayMobileNumber = document.getElementById('displayMobileNumber');
        const btnMobileContinue = document.getElementById('js-mobile-continue');
        const btnBackToStep1 = document.getElementById('backToMobileStep1');
        const btnOtpLogin = document.getElementById('js-otp-login');
        const otpInputs = document.querySelectorAll('.otp-input');
        const hiddenMobileForOtp = document.getElementById('hiddenMobileForOtp');


        function showSweetAlert(title, text, icon = 'error') {
            const alertIcon = (icon === 'success') ? 'success' : 'error';

            Swal.fire({
                title: title,
                text: text,
                icon: alertIcon,
                confirmButtonText: 'متوجه شدم',
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                buttonsStyling: false,
            });
        }


        // 1. Tab Switching Logic
        function switchTab(targetTab) {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-menu button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            // Add active class to the selected button and content pane
            if (targetTab === 'mobile') {
                tabMobile.classList.add('active');
                mobileTab.classList.add('active');
                mobileStep1.classList.remove('hidden'); // Ensure mobile starts at step 1
                mobileStep2.classList.add('hidden');

            } else { // username
                tabUsername.classList.add('active');
                usernameTab.classList.add('active');
            }
        }

        tabMobile.addEventListener('click', () => switchTab('mobile'));
        tabUsername.addEventListener('click', () => switchTab('username'));


        // 2. Mobile Login Flow (Step 1 -> Step 2)
        btnMobileContinue.addEventListener('click', () => {
            const mobileNumber = mobileNumberInput.value.trim();
            if (mobileNumber.length !== 11 || !/^\d+$/.test(mobileNumber)) {
                // !!! اصلاح شده: استفاده از showSweetAlert برای خطا !!!
                showSweetAlert(
                    'شماره نامعتبر',
                    'لطفاً یک شماره موبایل ۱۱ رقمی معتبر وارد کنید.'
                );
                return;
            }

            // UI Transition to Step 2
            displayMobileNumber.textContent = mobileNumber;
            hiddenMobileForOtp.value = mobileNumber; // ذخیره شماره موبایل در فیلد مخفی برای مرحله بعد
            mobileStep1.classList.add('hidden');
            mobileStep2.classList.remove('hidden');
            otpInputs[0].focus(); // Focus on the first OTP input



        });

        // Step 2 -> Step 1 (Back button)
        btnBackToStep1.addEventListener('click', () => {
            mobileStep2.classList.add('hidden');
            mobileStep1.classList.remove('hidden');
            mobileNumberInput.value = ''; // Clear number input
        });





        // 5. Password Visibility Toggle (EYE ICON)
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                const targetId = e.currentTarget.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = e.currentTarget.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye'); // Show
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash'); // Hide
                }
            });
        });

        // Initialize the first tab as active
        // document.addEventListener('DOMContentLoaded', () => {
        //     switchTab('mobile');
        // });

    </script>
</body>
</html>
