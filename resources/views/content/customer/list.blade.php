@extends('layouts/contentNavbarLayout')
@section('title', 'User Management')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Total Users</span>
                        <div class="d-flex align-items-end mt-2">
                            <h3 class="mb-0 me-2">{{$total_users}}</h3>
                        </div>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-user bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Active Users</span>
                        <div class="d-flex align-items-end mt-2">
                            <h3 class="mb-0 me-2">{{$active_users}}</h3>
                        </div>
                    </div>
                    <span class="badge bg-label-success rounded p-2">
                        <i class="bx bx-user-check bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Inactive Users</span>
                        <div class="d-flex align-items-end mt-2">
                            <h3 class="mb-0 me-2">{{$inactive_users}}</h3>
                        </div>
                    </div>
                    <span class="badge bg-label-danger rounded p-2">
                        <i class="bx bx-group bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Verification Pending</span>
                        <div class="d-flex align-items-end mt-2">
                            <h3 class="mb-0 me-2">5</h3>
                            <small class="text-danger">(+6%)</small>
                        </div>
                        <small>Recent analytics</small>
                    </div>
                    <span class="badge bg-label-warning rounded p-2">
                        <i class="bx bx-user-voice bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3> {{ __('User Management')}}</h3>
                <div class="pull-right">
                    <div class="d-flex">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- <div class="col-sm-3 form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">Select All</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-3 form-group">
                        <input type="text" name="name_s" id="name_s" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-sm-3 form-group datetimepicker">
                        <input type="text" name="date" id="date" class="form-control daterange"
                            placeholder="DD-MM-YYYY to DD-MM-YYYY">
                        <input type="hidden" name="start_range" id="start_range">
                        <input type="hidden" name="end_range" id="end_range">
                    </div>

                    <div class="col-sm-3">
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary btn-rounded-20" id="reset_data">
                                <i class="bx bx-reset"></i>
                            </button>
                            <div class="dt-buttons ms-2">
                                <button id="submit_form11" class="dt-button add-new btn btn-primary" tabindex="0"
                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasAddUser"><span><i
                                            class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block"
                                            onclick=addItem()>
                                            Add New User
                                </button>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group mb-3">
                            <select name="status" id="status" class="form-control">
                                <option value="">Select All</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group mb-3">
                            <select name="customer_type" id="customer_type" class="form-control">
                                <option value="">Type of Customer</option>
                                <option value="loyal">Loyal</option>
                                <option value="normal">Normal</option>
                                <option value="wholesaler">Wholesaler</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group mb-3">
                            <input type="text" name="name_s" id="name_s" class="form-control" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 ">
                        <div class="form-group mb-3 datetimepicker">
                            <input type="text" name="date" id="date" class="form-control daterange"
                                placeholder="DD-MM-YYYY to DD-MM-YYYY">
                            <input type="hidden" name="start_range" id="start_range">
                            <input type="hidden" name="end_range" id="end_range">
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-3">
                        <div class="form-group mb-3">
                            <button type="button" class="btn btn-primary btn-rounded-20" id="reset_data">
                                <i class="bx bx-reset"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3 d-flex">

                            <div class="dt-buttons ms-2">
                                <button id="submit_form11" class="dt-button add-new btn btn-primary" tabindex="0"
                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasAddUser"><span><i
                                            class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block"
                                            onclick=addItem()>
                                            Add New User
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- add new user model start --}}
                    <div class="offcanvas offcanvas-end w-50" id="offcanvasAddUser"
                        aria-labelledby="offcanvasAddUserLabel" aria-modal="true" role="dialog">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mx-0 flex-grow-0">
                            <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addEditForm"
                                method="POST">
                                @csrf
                                <input type="hidden" name="id" id="user_id" value="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-fullname">First Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="add-user-first"
                                                placeholder="John Doe" name="first_name" aria-label="John Doe">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-fullname">last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="add-user-lastlname"
                                                placeholder="John Doe" name="last_name" aria-label="John Doe">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="Type">Gender <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <select id="type" name="gender" class=" form-select" aria-hidden="true">
                                                    <option value="">Select</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-email">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="add-user-email" class="form-control"
                                                placeholder="john.doe@example.com" aria-label="john.doe@example.com"
                                                name="email">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-email">Date Of Birth <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="dob" class="form-control" placeholder="Date Of Birth"
                                                aria-label="john.doe@example.com" name="dob">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-contact">Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" id="add-user-contact" class="form-control phone-mask"
                                                placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com"
                                                name="phone">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-email">User Type<span
                                                    class="text-danger">*</span></label>
                                            <select name="user_type" id="user_type" class="form-control">
                                                <option value="">Select User Type</option>
                                                <option value="normal">Normal</option>
                                                <option value="loyal">Loyal</option>
                                                <option value="wholesaler">Wholesaler</option>
                                            </select>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="profile-image">Profile Image</label>

                                            <input type="file" id="add-user-contact"
                                                class="form-control phone-mask mb-2" placeholder="Profile Image"
                                                aria-label=".jpeg" name="image">

                                            <small style="position:relative;top:-9px;"> &nbsp;(Only formats are allowed:
                                                jpeg, jpg,
                                                png)</small>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <img id="imagePreview" src="/uploads/default_image/default.png"
                                                class="logo-icon cursor-pointer" alt="logo icon">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container" id="pass">
                                            <label class="form-label" for="add-user-company">Password</label>
                                            <div class="input-group input-group-merge " id="password_view">
                                                <input id="password" type="password" placeholder="Password"
                                                    class="pass_word form-control @error('password') is-invalid @enderror"
                                                    name="password" required="true">
                                                <span class="input-group-text cursor-pointer passwordViewBtn"><i
                                                        class="bx bx-hide"></i></span>
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container" id="con_pass">
                                            <label for="pin" class="form-label">Confirm Password</label>
                                            <div class="input-group input-group-merge " id="password_view">
                                                <input type="password" class="pass_word form-control "
                                                    id="confirm_password" placeholder=" Confirm Password"
                                                    name="confirm_password" required="true">
                                                <span class="input-group-text cursor-pointer passwordViewBtn"><i
                                                        class="bx bx-hide"></i></span>
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- <input type="hidden"> --}}
                                {{-- <button type="submit" onclick="submit_form();" id="submit_button"
                                    class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button> --}}
                                <div class="col-12 d-flex justify-content-end">
                                    <input class="btn btn-primary pull-right submit_button " type="submit" name="Save"
                                        value="Save">
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- password change -->
                    <div class="modal fade" id="changePasswordModal" tabindex="-1"
                        aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="changePasswordForm" method="POST">
                                        @csrf
                                                 <!-- Hidden ID field -->
                    <input type="hidden" id="user_idd" name="user_idd">
                                        <div class="form-group">
                                            <label for="newPassword">New Password:</label>
                                            <div class="eye_icon position-relative">
                                                <input type="password" class="form-control" id="password"
                                                    name="password" required minlength="8" maxlength="16">
                                                <span class="passwordViewBtn1">
                                                    <i class="fa fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmpassword">Confirm Password:</label>
                                            <div class=" eye_icon position-relative">
                                                <input type="password" class="form-control" id="confirm_password"
                                                    name="confirm_password" required minlength="8" maxlength="16">
                                                <span class="passwordViewBtn">
                                                    <i class="fa fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Add any additional fields here, like confirm password -->

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="updatePasswordd()">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- add user model end --}}
                    <div class="table-responsive">
                        <table id="listing_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('##')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Email')}}</th>
                                    <th>{{ __('Phone No.')}}</th>
                                    <th>{{ __('Type of customer')}}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th>{{ __('Created At')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')

        <script src="https://code.jquery.com/jquery-5.0.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script>
            $(document).ready(function () {
                $("#dob").datepicker({
                    dateFormat: "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
            });
        </script>

        <script>
            $('.daterange').daterangepicker({
                autoUpdateInput: true,
                autoApply: true,
                locale: {
                    format: 'DD-MM-YYYY',
                    separator: ' to ',
                }
            }, function (start, end, label) {
                $('#start_range').val(start.format('YYYY-MM-DD'));
                $('#end_range').val(end.format('YYYY-MM-DD'));
            });
            $('.daterange').val('');
        </script>
        <script>
            document.getElementById('submit_form11').addEventListener('click', addItem);

            function addItem() {
                $("#addEditForm")[0].reset();
                $('#offcanvasAddUserLabel').text('Add User');

                // Clear validation error messages and classes
                $("#addEditForm").find('.is-invalid').removeClass('is-invalid');
                $("#addEditForm").find('.invalid-feedback').empty();
                $("#addEditForm").find(".error").remove();

                // Hide and clear the image preview
                $('#imagePreview').hide();
                $('#imagePreview').attr('src', '');

                // Show password and confirm password fields
                $("#pass").show();
                $("#con_pass").show();

                // Set modal title and reset hidden input field for user id
                $("#addEditModal").modal("show");
                $("#addEditModal").find(".modal-title").text('Add');
                $("#offcanvasAddUser").find("input[name='id']").val(0);
            }

            $(document).ready(function () {
                // alert('------------------')
                //listing data table ------------------------------------------------------ Start
                var table = $('#listing_table').DataTable({
                    sDom: '<"top"f>rt<"bottom table_bottom"lip><"clear">', // shift selection box in footer
                    bFilter: false, //hide defalt search box
                    responsive: true,
                    "bProcessing": true,
                    "serverSide": true,
                    "lengthMenu": [20, 50, 100, 500],

                    ajax: {
                        url: "{{ url('/customer/list') }}",
                        data: function (d) {
                            d.status = $('#status').val()
                            d.type = $('#customer_type').val()
                            d.name = $('#name_s').val()
                            d.start_range = $('#start_range').val()
                            d.end_range = $('#end_range').val()

                        }
                    },
                    "aoColumns": [{
                        mData: 'id'
                    },
                    {
                        mData: 'name'
                    },
                    {
                        mData: 'email'
                    },
                    {
                        mData: 'phone'
                    },
                    {
                        mData: 'user_type'
                    },

                    {
                        mData: 'status'
                    },
                    {
                        mData: 'created_at'
                    },

                    {
                        mData: 'actions'
                    },
                    ],
                    //add attribute on column using id or attribute 
                    "aoColumnDefs": [{
                        "bSortable": false,
                        'aTargets': [-1, 3]
                    },],
                    order: [
                        [0, 'desc']
                    ]
                });
                $('#customer_type').on('change', function () {
                    table.draw();
                });
                $('#status').on('change', function () {
                    table.draw();
                });
                $('.daterange').on('change', function () {
                    if (($('#start_range').val() == '') || ($('#end_range').val() == '')) {
                        $('.daterange').val('');
                    } else {
                        table.draw();
                    }
                });
                $('#cat').on('change', function () {
                    table.draw();
                });
                $('#name_s').keyup(function () {
                    table.draw();
                });
                $('#reset_data').on('click', function () {
                    $('.daterange').val('');
                    $('#start_range').val('');
                    $('#end_range').val('');
                    $('#status').val('');
                    $('#customer_type').val('');
                    $('#name_s').val('');
                    $('#cat').val(null).trigger('change');
                    table.draw();
                    var daterangepicker = $('.daterange').data("daterangepicker");
                    daterangepicker.startDate = moment();
                    daterangepicker.endDate = moment();
                });
                //listing data table ------------------------------------------------------ End


            });



            $(document).ready(function () {

                $.validator.addMethod(
                    "regex",
                    function (value, element) {
                        return value.match(/^[a-zA-Z ]*$/);
                    },
                    "Only alphabetic characters are allowed."
                );

                $.validator.addMethod(
                    "address",
                    function (value, element) {
                        return value.match(/^[-a-zA-Z0-9., ]*$/);
                    },
                    "Special characters are not allowed."
                );

                $.validator.addMethod(
                    "pincode",
                    function (value, element) {
                        return value.match(/^[a-zA-Z0-9 ]*$/);
                    },
                    "Special characters are not allowed."
                );

                $.validator.addMethod("customPassword", function (value, element) {
                    // Use a regular expression to check if the input contains at least one number,
                    // one lowercase letter, and one uppercase letter.
                    if (value) {
                        return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(value);
                    } else {
                        return true;
                    }
                },
                    "Password must contain at least one uppercase, one lowercase ,one number, one special character and without spaces."
                );

                $.validator.addMethod("email_val", function (value, element) {
                    return this.optional(element) || value == value.match(
                        /^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
                }, 'Please enter a valid email address.');

                //add update item
                $("#addEditForm").validate({
                    rules: {
                        first_name: {
                            required: true,
                            regex: true
                        },
                        last_name: {
                            required: true,
                            regex: true
                        },

                        email: {
                            required: true,
                            email_val: true
                        },
                        // dob: {
                        //     required: true,
                        // },
                        phone: {
                            required: true,
                            minlength: 10,
                            maxlength: 10
                        },

                        // gender: {
                        //     required: true,
                        // },
                        user_type: {
                            required: true,
                        },

                        // password: {
                        //     required: true,
                        //     customPassword: false,
                        //     minlength: 8,
                        //     maxlength: 15
                        // },
                        // confirm_password: {
                        //     required: true,
                        //     minlength: 8,
                        //     maxlength: 15,
                        //     equalTo: "#password"
                        // }
                    },
                    messages: {
                        phone: {
                            maxlength: 'Please enter only 10 digits'
                        },

                        confirm_password: {
                            equalTo: 'Password and confirm password must be same.'
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-control').parent().append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                    submitHandler: function (form) {
                        //form.submit();
                        var formData = new FormData($("#addEditForm")[0]);
                        var url_up = "{{url('customer/store')}}";
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: url_up,
                            data: formData,
                            mimeType: "multipart/form-data",
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function () {
                                $("#addEditForm").find('.submit_button').attr("disabled", true);
                                $('.loader').show();
                            },
                            success: function (data) {
                                $("#addEditForm").find('.submit_button').attr("disabled",
                                    false);
                                $('.loader').hide();
                                var response = JSON.parse(data);
                                //console.log(response);
                                if (response.code == 200) {
                                    //show notification
                                    //location.reload();
                                    toastr.success(response.msg);
                                    setTimeout(function () {
                                        window.location.href = "{{url('customer')}}";
                                    }, 3000);
                                } else {
                                    toastr.error(response.msg);
                                    // $("#addEditForm").find('.submit_button').attr("disabled", true);
                                }
                            },
                        });
                        return false;
                    }
                });
            });

            function removedata(id) {
                $.ajax({
                    type: "POST",
                    url: "{{route('delete.customer')}}",
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (data) {
                        // console.log(data.success)
                        toastr.success(data.success);
                        $('#listing_table').DataTable().ajax.reload();
                    },
                });
            }


            function deleteItem(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to delete this customer!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // call the removedata function with the id parameter
                        removedata(id);
                    }
                });
            }



            $(document).ready(function () {
                $(document).on('change', '.status-checkbox', function () {
                    var id = $(this).data("id");
                    if (this.checked) {
                        var value = '1';
                    } else {
                        var value = '0';
                    }
                    updateItemStatus(id = id, type = 'status', value = value);

                })
            });



            function updateItem(id) {
                $("#addEditForm").find('.invalid-feedback').empty();
                $("#addEditForm").find(".error").remove();
                $('#offcanvasAddUserLabel').text('Update User');
                //  alert(id)
                // $("#offcanvasAddUser").modal('show');

                $("#con_pass").hide();
                $("#pass").hide();
                $.ajax({
                    type: "POST",
                    url: "{{ url('customer/get_by_id') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        var response = JSON.parse(data);
                        console.log(response)
                        if (response.code == 200) {
                            var item = response.data.customer_detail;
                            var variables = response.config_val;
                            $("#addEditForm").find("input[name='password']").removeAttr("required");
                            //put  item details in all input fields
                            $("#addEditForm").find(".modal-title").text('Update');
                            $("#addEditForm").find("input[name='id']").val(item.id);
                            $("#addEditForm").find("select[name='gender']").val(item.gender);
                            $("#addEditForm").find("input[name='first_name']").val(item.first_name);
                            $("#addEditForm").find("input[name='last_name']").val(item.last_name);
                            $("#addEditForm").find("input[name='email']").val(item.email);
                            $("#addEditForm").find("input[name='phone']").val(item.phone);
                            $("#addEditForm").find("input[name='password']").val("");
                            $("#addEditForm").find("select[name='user_type']").val(item.user_type);
                            var fileName = item.image;
                            var imagePath = '/uploads/customer_profile_img/' + fileName;

                            if (fileName) {
                                // Update the label text to show the selected file name
                                $("#addEditForm").find(".file-upload-info").val(fileName).attr('placeholder',
                                    fileName);

                                // Create the <img> tag
                                var imgTag = $('<img>').attr('src', imagePath).attr('alt', 'Image');

                                // Append the <img> tag to a container in your modal
                                $("#addEditForm").find(".image-preview-container").html(imgTag);

                                // Show the image preview
                                $('#imagePreview').show();
                                $('#imagePreview').attr('src', imagePath);
                            } else {
                                // If no image, display a default image or a placeholder
                                $('#imagePreview').show();
                                $('#imagePreview').attr('src',
                                    '/uploads/default_image/default.png'); // display default image
                            }


                            $("#addEditForm").find("input").removeClass('is-invalid');
                            $("#addEditForm").find("textarea").removeClass('is-invalid');
                            $("#addEditForm").find("number").removeClass('is-invalid');
                            $("#addEditForm").find(".error").remove();
                            // $("#addEditForm").modal("show");


                        } else {
                            toastr.error(response.msg);
                        }
                    },
                });
            }
            function updatePassword(id) {
                $("#user_idd").val(id);
                $("#changePasswordModal").modal("show");
            }
            function updatePasswordd(id) {
                var id = $("#user_idd").val();
                // Get values from modal input fields
                var password = $("#changePasswordForm").find("input[name='password']").val();
                var confirmPassword = $("#changePasswordForm").find("input[name='confirm_password']").val();

                // Validate that both passwords match
                if (password !== confirmPassword) {
                    toastr.error("Passwords do not match.");
                    return;
                }

                // Validate password length
                if (password.length < 8 || password.length > 16) {
                    toastr.error("Password must be between 8 and 16 characters.");
                    return;
                }

                // Send the data via AJAX
                $.ajax({
                    type: "POST",
                    url: "{{ url('customer/get_by_id_pass') }}", // Update to the correct route for password update
                    data: {
                        password: password,
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                      
                        console.log(data.code);
                        if (data.code == 200) {
                            toastr.success("Password updated successfully!");
                            $("#changePasswordModal").modal("hide");
                            window.location.reload();
                            // Close the modal after success
                        } else {
                            toastr.error(data.msg);
                        }
                    },
                    error: function (error) {
                        toastr.error("An error occurred.");
                    }
                });
            }



            //update item
            function updateItemStatus(id, type, value) {
                $.ajax({
                    type: "POST",
                    url: "{{route('customer.status')}}",
                    data: {
                        id: id,
                        type: type,
                        value: value,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (data) {
                        var response = JSON.parse(data);
                        if (response.code == 200) {
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg, "warning");
                        }
                        //reload data table in case of delete item
                        // if (type == 'delete') {
                        var active_page = $(".pagination").find("li.active a").text();
                        //reload datatable
                        $('#listing_table').dataTable().fnPageChange((parseInt(active_page) - 1));
                        // }

                    },
                });
            }


            $(document).on("click", ".passwordViewBtn", function () {
                var $input = $(this).parent().find("input.pass_word");
                var atrr = $input.attr('type');
                if (atrr == 'password') {
                    $input.attr('type', 'text');
                    $(this).find("i").attr('class', 'bx bx-show');
                } else {
                    $input.attr('type', 'password');
                    $(this).find("i").attr('class', 'bx bx-hide');
                }
            });
        </script>
    @endpush