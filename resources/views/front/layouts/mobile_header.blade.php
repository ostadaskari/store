<!-- Start Mobile Store Header -->
<div class="container-fluid custom-bg-color px-0 d-md-none StoreHeader pt-2">
    <div class="row d-flex flex-row justify-content-between align-items-center">
        <!-- btn humbergerMenu -->
        <div class="col-2">
            <!-- Main Navbar -->
            <div class="custom-navbar d-flex justify-content-center align-items-center">
                <div class="container">
                    <nav class="navbar navbar-expand-lg" style="padding: 0!important;">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuList" aria-controls="mobileMenuList">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
                <!-- Collapsible Mobile Menu -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenuList" aria-labelledby="mobileMenuLabel">
                    <div class="offcanvas-header bg-dark text-white p-3" style="height:5vh;">
                        <h5 class="offcanvas-title" id="mobileMenuLabel">منوی فروشگاه</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" style="padding-bottom: 100px;">
                        <ul class="list-group list-group-flush">

                            <!-- home -->
                            <li class="list-group-item"><a href="{{url('')}}">خانه</a></li>

                            <!-- قطعات غیرفعال -->
                            <li class="list-group-item">
                                <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileParts" role="button" aria-expanded="false">
                                    قطعات غیرفعال
                                    <span class="bi bi-chevron-down"></span>
                                </a>
                                <div class="collapse" id="mobileParts">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="#">مقاومت‌ها</a></li>
                                        <li class="list-group-item"><a href="#">خازن‌ها</a></li>

                                        <li class="list-group-item">
                                            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileInductors" role="button">
                                                سلف‌ها
                                                <span class="bi bi-chevron-down"></span>
                                            </a>
                                            <div class="collapse" id="mobileInductors">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileSmallInductors" role="button">
                                                            سلف‌های کوچک
                                                            <span class="bi bi-chevron-down"></span>
                                                        </a>
                                                        <div class="collapse" id="mobileSmallInductors">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><a href="#">سلف 1</a></li>
                                                                <li class="list-group-item"><a href="#">سلف 2</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item"><a href="#">سلف‌های بزرگ</a></li>
                                                    <li class="list-group-item">
                                                        <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileSpecialInductors" role="button">
                                                            سلف‌های ویژه
                                                            <span class="bi bi-chevron-down"></span>
                                                        </a>
                                                        <div class="collapse" id="mobileSpecialInductors">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><a href="#">سلف A</a></li>
                                                                <li class="list-group-item"><a href="#">سلف B</a></li>
                                                                <li class="list-group-item"><a href="#">سلف C</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileDiodes" role="button">
                                                دیودها
                                                <span class="bi bi-chevron-down"></span>
                                            </a>
                                            <div class="collapse" id="mobileDiodes">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><a href="#">دیود زنر</a></li>
                                                    <li class="list-group-item"><a href="#">LED</a></li>
                                                    <li class="list-group-item"><a href="#">دیود شاتکی</a></li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="list-group-item"><a href="#">ترانزیستورها</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- IC & میکروکنترلر -->
                            <li class="list-group-item">
                                <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileIC" role="button">
                                    IC & میکروکنترلر
                                    <span class="bi bi-chevron-down"></span>
                                </a>
                                <div class="collapse ps-3" id="mobileIC">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="#">آی‌سی دیجیتال</a></li>
                                        <li class="list-group-item"><a href="#">آی‌سی آنالوگ</a></li>
                                        <li class="list-group-item"><a href="#">آی‌سی حافظه</a></li>
                                        <li class="list-group-item"><a href="#">آی‌سی منطق</a></li>
                                        <li class="list-group-item"><a href="#">آی‌سی تغذیه</a></li>
                                        <li class="list-group-item"><a href="#">میکروکنترلر AVR</a></li>
                                        <li class="list-group-item"><a href="#">ARM</a></li>
                                        <li class="list-group-item"><a href="#">ESP32</a></li>
                                        <li class="list-group-item"><a href="#">STM32</a></li>
                                        <li class="list-group-item"><a href="#">PIC</a></li>
                                        <li class="list-group-item"><a href="#">حسگر دما</a></li>
                                        <li class="list-group-item"><a href="#">حسگر نور</a></li>
                                        <li class="list-group-item"><a href="#">حسگر فاصله</a></li>
                                        <li class="list-group-item"><a href="#">ماژول WiFi</a></li>
                                        <li class="list-group-item"><a href="#">ماژول Bluetooth</a></li>
                                        <li class="list-group-item"><a href="#">ماژول کنترل</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ابزار -->
                            <li class="list-group-item">
                                <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileTools" role="button">
                                    ابزار & تجهیزات
                                    <span class="bi bi-chevron-down"></span>
                                </a>
                                <div class="collapse ps-3" id="mobileTools">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="#">ابزار لحیم‌کاری</a></li>
                                        <li class="list-group-item"><a href="#">هویه قلمی</a></li>
                                        <li class="list-group-item"><a href="#">سیم لحیم</a></li>
                                        <li class="list-group-item"><a href="#">فیکسچر</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- سایر -->
                            <li class="list-group-item"><a href="./registration.html">عضویت</a></li>
                            <li class="list-group-item"><a href="./blog.html">بلاگ</a></li>
                            <li class="list-group-item"><a href="{{route('about')}}">درباره ما</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- End Main Navbar -->
        </div>
        <!-- logo -->
        <div class="col-7">
            <div class="d-flex flex-row align-items-center w-100">
                <div class="logoMobile">
                    <img class="img-fluid" src="{{ url('design/image/logo (4).png') }}">
                </div>
                <a href="#" class="m-2 title-logo">
                    <p class="mb-0 d-none d-md-block">فروشگاه تخصصی برق و الکترونیک</p>
                </a>
            </div>
        </div>

        <!-- cart and login -->
        <div class="col-3">
            <div class="d-flex flex-row justify-content-end w-100">
                <!-- Cart -->
                <div class="mx-1 position-relative" dir="rtl">
                    <a class="text-white nav-font-size d-flex justify-content-center align-items-center p-0 position-relative" id="cartBtn" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="22" height="22" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        </svg>
                        <span class="position-absolute translate-middle badge rounded-pill bg-danger" id="cart-count">3</span>
                    </a>

                    <!-- لیست dropdown -->
                    <ul class="dropdown-menu dropdown-menu-end py-3 px-2 inMobile" style="min-width: 350px;">
                        <div class="cart-items mb-3">
                            <!-- آیتم 1 -->
                            <li class="d-flex align-items-center mb-2 justify-content-between">
                                <span class="fw-bold">1.</span>
                                <span class="flex-grow-1 mx-2">خازن</span>
                                <div class="d-flex align-items-center item">
                                    <button class="btn btn-sm btnHover me-1 minus-btn">
                                        <svg width="18" height="18" fill="#e92222" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                        </svg>
                                    </button>
                                    <span class="spanNum">1</span>
                                    <button class="btn btn-sm btnHover ms-1 plus-btn">
                                        <svg width="18" height="18" fill="#32800e" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                        </svg>
                                    </button>
                                </div>
                                <button class="btn btn-sm btnHover">
                                    <svg width="18" height="18" fill="#bb0303" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </li>
                            <!-- آیتم 2 -->
                            <li class="d-flex align-items-center mb-2 justify-content-between">
                                <span class="fw-bold">2.</span>
                                <span class="flex-grow-1 mx-2">سنسور دما</span>
                                <div class="d-flex align-items-center item">
                                    <button class="btn btn-sm btnHover me-1 minus-btn">
                                        <svg width="18" height="18" fill="#e92222" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                        </svg>
                                    </button>
                                    <span class="spanNum">1</span>
                                    <button class="btn btn-sm btnHover ms-1 plus-btn">
                                        <svg width="18" height="18" fill="#32800e" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                        </svg>
                                    </button>
                                </div>
                                <button class="btn btn-sm btnHover">
                                    <svg width="18" height="18" fill="#bb0303" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </li>
                        </div>

                        <!-- جمع کل -->
                        <li class="border-top pt-2">
                            <div class="d-flex justify-content-between mb-2">
                                <span>آیتم ها:</span>
                                <span>3</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span> مبلغ کل:</span>
                                <span>3,800,000 ریال</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary flex-grow-1">ادامه خرید</button>
                                <button class="btn btn-primary flex-grow-1">نهایی کردن خرید</button>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- Login -->
                <div class="mx-2">
                    <div class="dropdown">
                        <a class="text-white d-flex align-items-center dropdown-toggle nav-font-size" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="22" height="22" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end text-end mt-2 shadow rounded-3 border-0 nav-font-size" aria-labelledby="userDropdown" style="min-width: 200px;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="./userAccount.html">
                                    <svg width="16" height="16" fill="#a4bad4" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    </svg>
                                    حساب کاربری من
                                </a>
                            </li>
                            <hr class="my-2" style="margin: auto; width: 80%;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#">
                                    <svg width="20" height="20" fill="#e35858" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                    </svg>
                                    خروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Store Header -->
