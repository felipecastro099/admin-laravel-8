<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/admin/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/node-waves/node-waves.min.js')}}"></script>
@yield('script')

<!-- App js -->
<script src="{{ URL::asset('admin/js/app.min.js')}}"></script>
<!-- Sweet Alerts js -->
<script src="{{ URL::asset('/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ URL::asset('/admin/js/pages/sweet-alerts.init.js') }}"></script>

<script src="{{ URL::asset('/admin/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/datepicker/datepicker.min.js') }}"></script>

<!-- form advanced init -->
<script src="{{ URL::asset('/admin/js/pages/form-advanced.init.js') }}"></script>

<script src="{{ URL::asset('/admin/libs/parsleyjs/parsleyjs.min.js') }}"></script>

<script src="{{ URL::asset('/admin/js/pages/form-validation.init.js') }}"></script>

<!-- toastr plugin -->
<script src="{{ URL::asset('/admin/libs/toastr/toastr.min.js') }}"></script>

<!-- toastr init -->
<script src="{{ URL::asset('/admin/js/pages/toastr.init.js') }}"></script>

<script src="{{ URL::asset('/admin/js/pages/alertModal.js') }}"></script>

@yield('script-bottom')
