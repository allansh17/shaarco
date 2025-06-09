@extends('layouts/contentNavbarLayout')
@section('title', 'Profile')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <input type="file" name="profile_image" class="file-upload-default" accept=".jpg,.jpeg,.png" id="profile_image" style="display : none">
                
                <div class="magnific-img profile_class profile_img">
                    @if(isset($user->profile_image) && !empty($user->profile_image))
                   
                        <div class="copy_class">
                            <a class="image-popup-vertical-fit" href="{{get_file_url('uploads/admin_profile_img/'.$user->profile_image)}}" title="profile_image">
                                
                                <img src="{{get_file_url('uploads/admin_profile_img/'.$user->profile_image)}}" class="img-responsive avatar profile_images">
                            </a>
                        </div>
                    
                    @else
                    
                        <div class="copy_class">
                            <a class="image-popup-vertical-fit" href="{{ asset('img/default_user.png') }}" title="default_user">
                                <img src="{{ asset('img/default_user.png') }}" class="img-responsive avatar">
                            </a>
                        </div>
                    
                    @endif
                    <i class="menu-icon tf-icons bx bx-edit  file-upload-browse" style="cursor: pointer" data-toggle="tooltip" title="Change Profile Image" data-placement="bottom"></i>&nbsp;
                    <h3>
                        {{(isset($user->name) && !empty($user->name) ? $user->name :'')}}-ID#{{(isset($user->id) && !empty($user->id) ? $user->id :'')}}
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <form id="addEditForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : '' }}">

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    Name
                                      <span class="text-danger">*</span>                               
                                  </label>
                                <input @can('update_profile') @else readonly @endcan type="text" class="form-control " id="name" placeholder="First Name" name="name" value="{{ (isset($user->name) && !empty($user->name) ? $user->name : '')}}">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="phone" class="form-label">{{ __('Phone Number')}}</label>
                                <span class="text-danger">*</span> 
                                <input @can('update_profile') @else readonly @endcan type="tel" class="form-control" id="phone" pattern="[0-9]{10}"
                                    placeholder="Phone number" name="phone" value="{{ (isset($user->phone) && !empty($user->phone) ? $user->phone : '') }}"
                                    onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <span class="text-danger">*</span> 
                                <input  @can('update_profile') @else readonly @endcan type="text" class="form-control {{($user->employee_type == '0') ? 'email_edit' : '' }}" @if(isset($user->id) && $user->id != '1')  @endif id="email" placeholder="Email" name="email" autocomplete="off" value="{{ (isset($user->email) && !empty($user->email) ? $user->email : '') }}">
                            </div>
                        </div>
                       
                    </div>
                    @can('update_profile')
                    <div class="form-group text-right mt-3 justify-content-end d-flex">
                        <input class="btn btn-primary" type="submit" name="Save" value="Save">
                    </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
</div>
<!-- push external js -->
@push('scripts')
<script>
    @can('update_profile')
    $("#addEditForm").submit(function(e) {
        e.preventDefault();
        return false;
    });
    @endcan


    $('.file-upload-browse').on('click', function () {
        var file = $(this).parent().parent().parent().find('.file-upload-default');
        file.trigger('click');
    });
    $('.file-upload-default').on('change', function () {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
    //get city list


    $.validator.addMethod("email_val", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter a valid email address.');


$.validator.addMethod(
  "regex",
  function(value, element) {
    return value.match(/^[a-zA-Z ]*$/);
  },
  "Only alphabetic characters are allowed."
);




    //add update item
    $("#addEditForm").validate({
        rules: {
            name: {
                required: true,
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            email: {
                required: true,
                minlength:15,
                maxlength:320,
                email_val: true
            },

        },
       //  errorPlacement: function (error, element) {
       //      error.insertAfter(element.parent());
       // },
        messages: {
            phone: {
        minlength: "Phone number must be at least 10 digits",
        maxlength: "Please do not enter more than 10 digits"
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
        submitHandler: function (form) {
            //serialize form data

            //var formData = $("#addEditForm").serialize();

            var formData = new FormData($("#addEditForm")[0]);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{url('employee/profile/update')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var response = JSON.parse(data);
                    console.log(response);
                    if (response.code == 200) {
                        //show notification
                        toastr.success(response.msg);
                        setTimeout(function () {
                            window.location.href = "{{url('dashboard')}}";
                            // body...
                        },3000);
                    } else {

                        toastr.error(response.msg, "error");
                    }
                },
            });
            return false;
        }
    });



    // display image or pdf file after choosen
    function  imagesPreview(input, image_name) {

        if (input.files) {
            var filesAmount = input.files.length;



            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                if (!input.files[i].name.match(/\.(jpg|jpeg|png)$/i)) {
                    var fileExtension = ['jpeg', 'jpg', 'png'];
                    document.getElementById(image_name + '_err').innerHTML = 'Only formats are allowed : ' + fileExtension.join(', ');
                    document.getElementById(image_name + '_display').style.display = 'none';
                    $('#' + image_name).val('');

                    continue;
                } else {
                    document.getElementById(image_name + '_err').innerHTML = '';
                    document.getElementById(image_name + '_display').style.display = 'block';


                    document.getElementById(image_name + '_show').src = window.URL.createObjectURL(input.files[i]);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }

    }
    ;

    $('#profile_image').on('change', function () {

        //imagesPreview(this,'profile_image');
        var formData = new FormData();
        formData.append("files", document.getElementById('profile_image').files[0]);
        formData.append("id", "{{ $user->id }}");

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "{{url('employee/profile/profile_image_update')}}",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                var response = JSON.parse(data);
                console.log(response);
                if (response.code == 200) {
                    //show notification+
                    $('.profile_images').attr('src', response.image);
                    
                    toastr.success(response.msg);
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 3000);
                    
                } else {

                    toastr.error(response.msg, "error");
                }
            },
        });

    });


</script>
@endpush
@endsection