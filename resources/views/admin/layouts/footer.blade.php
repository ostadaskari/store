</div>
</div>
{{--<footer class="main-footer"style="">--}}
{{--    <strong>Copyright &copy; {{date('Y')}} shirazhip.ir</strong> All rights reserved.--}}
{{--</footer>--}}
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('admin.layouts.swal')
<script src="{{asset('design/js/applyNumberFormat.js')}}"></script>

@yield('script')
<script src="{{asset('design/js/adminPanel.js')}}"></script>

</body>
</html>
