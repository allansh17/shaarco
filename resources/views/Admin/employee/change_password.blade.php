@extends('layouts/contentNavbarLayout')
@section('title', 'Change Password')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3>{{ __('Change Password ')}}</h3>
               
            </div>
            <div class="card-body">
                <form id="addEditForm" >
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                    
                    <div class="row">
                        <div class="col-sm-4">
                
                            <div class="mb-3 fv-plugins-icon-container" >
                                <label class="form-label" for="add-user-company">Old Password</label>
                                <div class="input-group input-group-merge " id="password_view">
                                   <input id="old_password" type="password" placeholder="Old Password" class="pass_word form-control @error('password') is-invalid @enderror" name="old_password" required="true">                  
                                   <span class="input-group-text cursor-pointer passwordViewBtn"><i class="bx bx-hide"></i></span>
                                   <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                             </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3 fv-plugins-icon-container" >
                                <label for="pin" class="form-label">New Password</label>
                                <div class="input-group input-group-merge " id="password_view">
                                    <input type="password" class="pass_word form-control @error('password') is-invalid @enderror" id="new_password" placeholder=" New Password" name="new_password" required="true">                  
                                   <span class="input-group-text cursor-pointer passwordViewBtn"><i class="bx bx-hide"></i></span>
                                   <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                             </div>
                        </div>
                        <div class="col-sm-4">
                           
                            <div class="mb-3 fv-plugins-icon-container" >
                                <label for="pin" class="form-label">Confirm Password</label>
                                <div class="input-group input-group-merge " id="password_view">
                                    <input type="password" class="pass_word form-control file-upload-info" id="confirm_password" placeholder=" Confirm Password" name="confirm_password" required="true">    
                                   <span class="input-group-text cursor-pointer passwordViewBtn"><i class="bx bx-hide"></i></span>
                                   <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                             </div>
                        </div>
             
                    </div>
                    <!-- <div class="col-sm-12"> -->
                     <div class="form-group text-right justify-content-end d-flex">
                        <input class="btn btn-primary" type="submit" name="Save" value="Save">
                    </div>
                    <!-- </div> -->
                            
                </form>
            </div>
        </div>
    </div>
    </div>


<!-- push external js -->


@push('scripts')
<script>
 $.validator.addMethod("customPassword", function(value, element) {
    // Use a regular expression to check if the input contains at least one number,
    // one lowercase letter, and one uppercase letter.
    return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(value);
}, "Password must contain at least one uppercase, one lowercase, one number, one special character and without spaces.");
    //add update item
    $("#addEditForm").validate({
        rules: {
            new_password:{
                required: true,
                minlength:8,
                maxlength:15,
                customPassword: true
            },
            old_password:{
                required: true,
                minlength:8,
                maxlength:15
            },
            confirm_password:{
                required: true,
                equalTo:'#new_password'
            },
                        
        },
        messages: {
        confirm_password:{
            equalTo:'New password and confirm password must be same.'
        }
    },
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

        submitHandler: function(form) {
            //serialize form data
  
            var formData = $("#addEditForm").serialize();

            $.ajax({
                type: "POST",
                url: "{{url('change/password/update')}}",
                data: formData,
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.code == 200) {    
                      //show notification
                      $('input[type="password"]').val('');
                      $('input[type="text"]').val('');
                       // $.toast(response.msg, "success");
                       toastr.success(response.msg);
                        // location.reload();
                        setTimeout(function () {
                            window.location.href = "{{url('dashboard')}}";
                            // body...
                        },3000);
                    } else {
                        
                    toastr.error(response.msg);
                    }
                },
            });
            return false;
        }
    });

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
@endsection