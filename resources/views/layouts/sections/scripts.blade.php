<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jquery-validate/jquery.validate-1.19.3.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/dropzone/quill.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

	<!-- Toastr -->
<!-- Add this to the head section of your HTML file -->


<!-- Add this to the body section of your HTML file, just before the closing body tag -->
{{-- <script src="https://trade.orbitnapp.com/plugins/DataTables/datatables.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}
{{-- 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
 <script src="https://infra-admin.orbitnapp.com/plugins/bootstrap-datepicker/datepicker.min.js"></script> 
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/super-build/ckeditor.js"></script>
<script src="https://infra-admin.orbitnapp.com/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/js/main.js') }}"></script>
@php
$currentUrl = $_SERVER['REQUEST_URI'];
@endphp
<?php if($_SERVER['REQUEST_URI'] == '/block' || $_SERVER['REQUEST_URI'] =='/coupon' || $_SERVER['REQUEST_URI'] =='/masters/emailtemplate' || $_SERVER['REQUEST_URI'] =='/faqs' || $_SERVER['REQUEST_URI'] =='/faqscategory' || $_SERVER['REQUEST_URI'] =='/lifestyle'){ ?> 
  <script>
    $('#master_id').addClass('open');
  
  </script>
  <?php } elseif($_SERVER['REQUEST_URI'] == '/transaction_report' || $_SERVER['REQUEST_URI'] =='/product_report' || $_SERVER['REQUEST_URI'] =='/sales_report' || $_SERVER['REQUEST_URI'] =='/order_report' || $_SERVER['REQUEST_URI'] =='/customer_reports' || $_SERVER['REQUEST_URI'] =='/reviewreport'){ ?> 
  <script>
    $('#report_id').addClass('open');
  
  </script>
  <?php } ?>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
