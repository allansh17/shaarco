{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
@extends('layouts.main')
<?php if(isset($customer_detail->id )){ $title = 'Update'; }else{ $title = 'Add'; } ?>
@section('title', $title.' Customer')
<!-- @section('url_name', '/customer') -->
@section('content')
<link rel="stylesheet" href="{{ asset('plugins/form-wizard/from_wizard.css') }}">
<style>

    .bi-eye-slash , 
    .bi-eye {
        font-size: 18px;
        top: 11px;
        right: 10px;
    }

</style>
<div class="card">
    <div class="card-header justify-content-between d-flex">
        <h3>{{ __($title.' Customer')}}</h3>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('customer') }}">
                <i class="ik ik-list"></i> List of Customer
            </a>
        </div>
    </div>
    <div class="card-body">
        <form class="forms-sample" id="addEditForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="id" placeholder="" name='id' value="{{ isset($customer_detail) ? $customer_detail->id :'0'}}">
            <div class="row">
                <div class="col-sm-4">
                   <div class="form-group" >
                        <label for="pkgs" class="required">{{ __('Name')}}</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name='name' value="{{ isset($customer_detail) ? $customer_detail->name :''}}">
                    </div>
                </div>
                <div class="col-sm-4">
                   <div class="form-group" >
                        <label for="vol_wt" class="">{{ __('Email')}}</label>
                        <input type="text" class="form-control" id="email" placeholder="Email" name='email' value="{{ isset($customer_detail) ? $customer_detail->email :''}}">
                    </div>
                </div>
                <div class="col-sm-4">
                   <div class="form-group" >
                        <label for="dimensions" class="required">{{ __('Phone Number')}}</label>
                         <input type="tel" class="form-control" id="phone" pattern="[0-9]{10}" placeholder="Contact Number" name="phone" maxlength="10" value="{{ isset($customer_detail) ? $customer_detail->phone :''}}" onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" >
                        <label for="agent" class="required">{{ __('Gender')}}</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option {{ isset($customer_detail) && $customer_detail->gender == '1' ? 'selected' :''}} value="1">Male</option>
                            <option {{ isset($customer_detail) && $customer_detail->gender == '2' ? 'selected' :''}} value="2">Female</option>
                        </select>
                    </div>
                </div> 


                <div class="col-sm-4">
                   <div class="form-group">
                        <label for="agent" class="required">{{ __('Address')}}</label>
                        <textarea type="text"  class="form-control" id="address" rows="1" placeholder="Address" name='address'>{{ isset($customer_detail) ? $customer_detail->address :''}}</textarea>
                    </div>
                </div>

                <div class="col-sm-4">
                   <div class="form-group">
                        <label for="agent" class="required">{{ __('City')}}</label>
                        <input type="text" class="form-control" id="city" placeholder="City" name='city' value="{{ isset($customer_detail) ? $customer_detail->city :''}}" required>
                    </div>
                </div>

                <div class="col-sm-4">
                   <div class="form-group">
                        <label for="agent" class="required">{{ __('State')}}</label>
                        <input type="text" class="form-control" id="state" placeholder="State" name='state' value="{{ isset($customer_detail) ? $customer_detail->state :''}}" required>
                    </div>
                </div>

                <div class="col-sm-4">
                   <div class="form-group">
                        <label for="agent" class="required">{{ __('Pincode')}}</label>
                        <input type="text" class="form-control" id="pincode" placeholder="Pincode" name='pincode' value="{{ isset($customer_detail) ? $customer_detail->pin_code :''}}" required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group" >
                        <label for="agent" class="required">{{ __('Type')}}</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Select Type</option>
                            <option {{ isset($customer_detail) && $customer_detail->type == '1' ? 'selected' :''}} value="1">Home</option>
                            <option {{ isset($customer_detail) && $customer_detail->type == '2' ? 'selected' :''}} value="2">Work</option>
                        </select>
                    </div>
                </div> 
</div>
            @if(isset($customer_detail))
            <div class="sub-head d-flex align-items-center">
                <h4 class="m-0">Change Password</h4>
            </div>
            @endif
            <div class="row">

                <div class="col-sm-4" style="margin-top:20px">
                   <div class="form-group" id="password_view">
                        <label for="agent" class="{{ isset($customer_detail)? '' : 'required'}}">{{ __('Password')}}</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password" maxlength="15" placeholder="Password" name='password' value="" {{ isset($customer_detail) ? '' : 'required'}}>
                            <a><i class="bi bi-eye-slash position-absolute cursor-pointer"></i></a>
                        </div>
                    </div>
                </div>

             
                <div class="col-sm-4" style="margin-top:20px">
                   <div class="form-group" id="confirm_password_view">
                        <label for="agent" class="{{ isset($customer_detail) ? '' : 'required'}}">{{ __('Confirm Password')}}</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="confirm_password" maxlength="15" placeholder="Confirm Password" name='confirm_password' value="" {{ isset($customer_detail) ? '' : 'required'}}>
                            <a><i class="bi bi-eye-slash position-absolute cursor-pointer"></i></a>
                        </div>
                    </div>
                </div>


                  <div class="col-sm-12 ">
                  <div class="form-group">
                <input class="btn btn-primary pull-right submit_button" type="submit" name="Save" value="Save">
            </div>
            </div>
                </div> 
        </form>

    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/form-wizard/from_wizard.js') }}"></script>

    <script>

    $("#password_view a").on('click', function(event) {
        event.preventDefault();
        if ($('#password_view input').attr("type") == "text") {
            $('#password_view input').attr('type', 'password');

            $('#password_view i').removeClass('bi-eye');
            $('#password_view i').addClass('bi-eye-slash');

        } else if ($('#password_view input').attr("type") == "password") {
            $('#password_view input').attr('type', 'text');
            $('#password_view i').removeClass('bi-eye-slash');
            $('#password_view  i').addClass('bi-eye');
        }
    });
    
    $("#confirm_password_view a").on('click', function(event) {
            event.preventDefault();
            if ($('#confirm_password_view input').attr("type") == "text") {
                $('#confirm_password_view input').attr('type', 'password');

                $('#confirm_password_view i').removeClass('bi-eye');
                $('#confirm_password_view i').addClass('bi-eye-slash');

            } else if ($('#confirm_password_view input').attr("type") == "password") {
                $('#confirm_password_view input').attr('type', 'text');
                $('#confirm_password_view i').removeClass('bi-eye-slash');
                $('#confirm_password_view  i').addClass('bi-eye');
            }
        });

    $('.datetimepicker').datetimepicker({
        format: 'MM-DD-YYYY',
        useCurrent:false,
        showClose:true
    }).on('dp.change',function (e) {
        var formatedValue = e.date.format('YYYY-MM-DD');
        // console.log(formatedValue);
        $('#dob').val(formatedValue);
    });

$.validator.addMethod(
  "regex",
  function(value, element) {
    return value.match(/^[a-zA-Z ]*$/);
  },
  "Only alphabetic characters are allowed."
);
$.validator.addMethod(
  "address",
  function(value, element) {
    return value.match(/^[-a-zA-Z0-9., ]*$/);
  },
  "Special characters are not allowed."
);
$.validator.addMethod(
  "pincode",
  function(value, element) {
    return value.match(/^[a-zA-Z0-9 ]*$/);
  },
  "Special characters are not allowed."
);

$.validator.addMethod("customPassword", function(value, element) {
            // Use a regular expression to check if the input contains at least one number,
            // one lowercase letter, and one uppercase letter.
            if(value){
                return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(value);
            }else{
                return true;
            }
        }, "Password must contain at least one uppercase, one lowercase ,one number, one special character and without spaces.");

$.validator.addMethod("email_val", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter a valid email address.');

//add update item
$("#addEditForm").validate({
    rules: {
        
        name: {
           required: true
        //    regex: true
        },
        city: {
           required: true,
           regex: true,
        },
        state: {
           // required: true,
           regex: true,
        },
        pincode: {
           // required: true,
           pincode: true,
        },
        type: {
           required: true,
        },
         email: {
           // required: true,
           email_val: true,
        },
         phone: {
           required: true,
            minlength: 10,
            maxlength: 10,

        }, 
         address: {
           required: true,
           address: true,
        },
        password: {
            // required: true,
            // notEqualToUsername: true,
            minlength: 8,
            maxlength: 15,
            customPassword: true

        },
        confirm_password: {
            // required: true,
            minlength: 8,
            maxlength: 15,
            equalTo: "#password",
        },
        
    },
    messages: {},
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-control').parent().append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
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
                $("#addEditForm").find('.submit_button').attr("disabled", false);
                $('.loader').hide();
                var response = JSON.parse(data);
                //console.log(response);
                if (response.code == 200) {
                    //show notification
                    //location.reload();
                    $.notify(response.msg, "success");
                    setTimeout(function () {
                    window.location.href = "{{url('customer')}}";
                        // body...
                    },3000);
                } else {
                    $.notify(response.msg, "error");
                    // $("#addEditForm").find('.submit_button').attr("disabled", true);
                }
            },
        });
        return false;
    }
});
</script>


    @endpush
    @endsection --}}