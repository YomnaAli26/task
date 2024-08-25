<!-- plugins:js -->
<script src="{{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('admin/assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/select2/select2.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('admin/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('admin/assets/js/template.js')}}"></script>
<script src="{{asset('admin/assets/js/settings.js')}}"></script>
<script src="{{asset('admin/assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('admin/assets/js/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('admin/assets/js/file-upload.js')}}"></script>
<script src="{{asset('admin/assets/js/typeahead.js')}}"></script>
<script src="{{asset('admin/assets/js/select2.js')}}"></script>
<!-- End custom js for this page-->
@stack('scripts')
