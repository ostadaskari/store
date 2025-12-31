</div>
</div>
{{--<footer class="main-footer"style="">--}}
{{--    <strong>Copyright &copy; {{date('Y')}} shirazhip.ir</strong> All rights reserved.--}}
{{--</footer>--}}
</div>

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
