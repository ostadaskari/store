</div>
</div>
{{--<footer class="main-footer"style="">--}}
{{--    <strong>Copyright &copy; {{date('Y')}} shirazhip.ir</strong> All rights reserved.--}}
{{--</footer>--}}
</div>
{{-- date and time --}}
<script>
    function updateIranDateTime() {
        const now = new Date();

        const timeOptions = {
            timeZone: 'Asia/Tehran',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };

        // تنظیمات برای تاریخ شمسی
        const dateOptions = {
            timeZone: 'Asia/Tehran',
            calendar: 'persian',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };

        const timeString = new Intl.DateTimeFormat('fa-IR', timeOptions).format(now);
        let dateString = new Intl.DateTimeFormat('fa-IR', dateOptions).format(now);

        const englishDate = dateString.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d));
        const englishTime = timeString.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d));

        document.getElementById('live-time').innerText = englishTime;
        document.getElementById('live-date').innerText = englishDate;
    }

    setInterval(updateIranDateTime, 1000);

    updateIranDateTime();
</script>
<!-- jQuery -->
<script src="{{asset('design/js/jquery-3.7.1.min.js')}}"></script>

<!-- Bootstrap 5 -->
<script defer src="{{asset('design/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- SweetAlert2 -->

<script src="{{asset('design/js/sweetalert2.all.min.js')}}"></script>
@include('admin.layouts.swal')
<script src="{{asset('design/js/applyNumberFormat.js')}}"></script>

@yield('script')
<script src="{{asset('design/js/adminPanel.js')}}"></script>

</body>
</html>
