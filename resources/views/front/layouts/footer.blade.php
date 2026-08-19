<!-- start footer -->
<div class="container mt-60 footer-style">
    <div class="row">
        <div class="container bg-light" style="border-radius: 0 0 120px 120px;">
            <div class="row d-flex justify-content-center p-4 shadow newsFooter" >
                <div class="col-sm-12 col-md-3 title-footer d-flex flex-column mb-4 p-1 ">
                    <h6>عضویت در خبرنامه</h6>
                    <a class="text-decoration-none">با عضویت از<span class="text-danger"> 30% تخفیف</span> بهره مند شوید</a>
                </div>
                <div class="col-sm-12 col-md-4 title-footer d-flex flex-column justify-content-center mb-4 p-1 ">
                    <h6>ویژه ی مشترکین</h6>
                    <a class="text-decoration-none">به <span class="text-success"> یک میلیون</span> مشترک ما بپیوندید.و از تخفیفات مشترکین خبرنامه ما بهره مند شوید.</a>
                </div>
                <div class="col-sm-12 col-md-5 d-flex align-items-center">
                    <div class="input-group input-group-sm ">
                        <input type="text" class="form-control Subscription-input" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="آدرس ایمیل خود را وارد کنید..." >
                        <div class="input-group-append Subscription" style="align-content: center;">
                            <button class="btn btn-danger mx-3 py-3" type="button">اشتراک</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid about-us mt-4">
            <div class="row">
                <div class="col-6 col-md-3 customer-services ">
                    <div class="borderFooterDiv d-flex flex-row align-items-center w-100">
                        <h5>سفارشات</h5>
                    </div>
                    <div class="customm-dropdown-menu">
                        <ul class="dropdown p-0 ordersFooter">
                            <li class="d-flex flex-row align-items-center">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                </svg>
                                <a class="dropdown-item mx-2" data-bs-toggle="modal" data-bs-target="#returnModal">مرجوع کالا</a>
                            </li>

                            <li class="d-flex flex-row align-items-center">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"></path>
                                </svg>
                                <a class="dropdown-item mx-2" data-bs-toggle="modal" data-bs-target="#shippingModal">نحوه ارسال</a>
                            </li>

                            <li class="d-flex flex-row align-items-center">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
                                    <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
                                </svg>
                                <a class="dropdown-item mx-2" data-bs-toggle="modal" data-bs-target="#advisorModal">تماس با مشاور خرید</a>
                            </li>

                            <li class="d-flex flex-row align-items-center">
                                <svg width="18" height="18" fill="currentColor" class="bi bi-cup-hot-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M.5 6a.5.5 0 0 0-.488.608l1.652 7.434A2.5 2.5 0 0 0 4.104 16h5.792a2.5 2.5 0 0 0 2.44-1.958l.131-.59a3 3 0 0 0 1.3-5.854l.221-.99A.5.5 0 0 0 13.5 6zM13 12.5a2 2 0 0 1-.316-.025l.867-3.898A2.001 2.001 0 0 1 13 12.5"/>
                                </svg>
                                <a class="dropdown-item mx-2" data-bs-toggle="modal" data-bs-target="#contactModal">همکاری با ما</a>
                            </li>
                        </ul>
                        <!-- مودال مرجوع کالا -->
                        <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="returnModalLabel">راهنمای مرجوع کالا</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        برای مرجوع کردن کالا، لطفا مراحل زیر را دنبال کنید:<br>
                                        1. با پشتیبانی تماس بگیرید.<br>
                                        2. شماره سفارش خود را آماده داشته باشید.<br>
                                        3. کالای مرجوعی را بسته‌بندی کنید.<br>
                                        4. از طریق پست یا پیک به آدرس ماارسال کنید.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- مودال نحوه ارسال -->
                        <div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="shippingModalLabel">نحوه ارسال</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ارسال سفارشات به صورت زیر انجام می‌شود:<br>
                                        - بسته‌بندی استاندارد و امن.<br>
                                        - تحویل توسط پست یا پیک.<br>
                                        - پیگیری وضعیت ارسال از طریق شماره رهگیری.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- مودال تماس با مشاور خرید -->
                        <div class="modal fade" id="advisorModal" tabindex="-1" aria-labelledby="advisorModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="advisorModalLabel">تماس با مشاور خرید</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        برای دریافت مشاوره خرید، لطفا با شماره زیر تماس بگیرید:<br>
                                        <a href="tel:09966852565" class="btn btn-primary mt-2">📞 09966852565</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- مودال همکاری با ما -->
                        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="contactModalLabel">تماس برای همکاری</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        برای همکاری با ما لطفا با شماره زیر تماس بگیرید:<br>
                                        <a href="tel:09966852565" class="btn btn-primary mt-2">📞 09966852565</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-6 col-md-3 customer-services">
                    <div class="borderFooterDiv d-flex flex-row align-items-center w-100">
                        <h5>پشتیبانی</h5>
                    </div>

                    <div class="tell">
                        <div class="d-flex flex-row align-items-center">
                            <svg width="18" height="18" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
                                <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
                            </svg>
                            <p class="mx-2">امور مشترکین :</p>
                            <a href="#" class="text-decoration-none">09170000000</a>
                        </div>

                        <div class="d-flex flex-row align-items-center">
                            <svg width="18" height="18" fill="currentColor" class="bi bi-telephone-inbound" viewBox="0 0 16 16">
                                <path d="M15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0m-12.2 1.182a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                            </svg>
                            <p class="mx-2">ارتباط با پشتیبانی :</p>
                            <a href="#" class="text-decoration-none">09120000000</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 customer-services">
                    <div class="borderFooterDiv d-flex flex-row align-items-center w-100">
                        <h5>شبکه های اجتماعی</h5>
                    </div>
                    <a class="d-flex flex-row align-items-center my-3" href="#">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                            <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                        </svg>
                        <p class="px-2">info@shirazchip.ir</p>
                    </a>
                    <a class="d-flex flex-row align-items-center my-3" href="#">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                        </svg>
                        <p class="px-2">09170000000</p>
                    </a>
                    <a class="d-flex flex-row align-items-center my-3" href="#">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                        </svg>
                        <p class="px-2">@ShirazChip</p>
                    </a>
                </div>
                <div class="col-6 col-md-3 customer-services">
                    <div class="borderFooterDiv d-flex flex-row align-items-center w-100">
                        <h5>نمادها</h5>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=680372&Code=9Z0QvMUwmtzqqmLYIlM6IoJWI9SYAdXh'><img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=680372&Code=9Z0QvMUwmtzqqmLYIlM6IoJWI9SYAdXh' alt='' style='cursor:pointer' code='9Z0QvMUwmtzqqmLYIlM6IoJWI9SYAdXh'></a>
                        <img class="img-fluid img-enamad" src="{{ asset('design/image/samandehi.png') }}">
                    </div>
                </div>
                <div class="col-12 d-flex flex-row align-items-center justify-content-center my-2">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <p class="text-light m-0 px-2">آدرس :شیراز، چهارراه پارامونت، خیابان قصرالدشت ،کوچه 2 , ساختمان داور</p>
                </div>
            </div>
        </div>
    </div>
    <div  class="copyright">
        کلیه حقوق برای شرکت
        <b data-v-11bd7140="" class="copyright__company">
            shirazchip
        </b>
        محفوظ است.
    </div>
</div>
<!-- end footer -->


<!-- FontAwesome -->
<script defer src="{{asset('design/js/kit.fontawesome.js')}}" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="{{asset('design/js/jquery-3.7.1.min.js')}}"></script>

<!--*********** loading ***********-->

<!--*********** Ends ***********-->

<!-- Bootstrap 5 -->
<script defer src="{{asset('design/js/bootstrap.bundle.min.js')}}"></script>

<!-- Owl Carousel -->
<script src="{{asset('design/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('design/js/aos.js')}}"></script>
<script>
  AOS.init({
    // تنظیمات دلخواه (اختیاری)
    duration: 2000, // مدت زمان انیمیشن به میلی‌ثانیه
    once: false,      // فقط یکبار انیمیشن اجرا شود (هنگام اولین رسیدن به عنصر)
  });
</script>

<!-- SweetAlert2 -->
<script src="{{asset('design/js/sweetalert2.all.min.js')}}"></script>
<!-- js -->
<script src="{{asset('design/js/main.js')}}"></script>
@yield('script')


@include('front.layouts.swal')

{{--    script of updating cart ajax --}}


</body>

</html>
