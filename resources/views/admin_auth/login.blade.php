<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | {{env('APP_NAME')}}</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="{{ asset('uploads/company_setting/favi_icon') }}/{{(isset($company_detail->favi_icon) && !empty($company_detail->favi_icon) ? $company_detail->favi_icon:'')}}" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/theme.min.css')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/theme-image.css')}}">
        <script src="{{ asset('src/js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
       
    </head>

    <style>
        .passView{
            position: absolute;
            right: 0;
            z-index: 111;
        }


       .passwordViewBtn .file-upload-browse{
            height: 50px;
            border: 1px solid #c3c2c6;
            background: #fab90f;
            border-radius: 0px 7px 7px 0px;
        }




    
    </style>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="auth-wrapper forgot_password_form login-page">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100">
                    <div class="col-xl-12 col-lg-12 col-md-12 my-auto">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered text-center">
                                <a href=""><img style="width: 60%" src="{{ asset('uploads/company_setting/logo') }}/{{(isset($company_detail->company_logo) && !empty($company_detail->company_logo) ? $company_detail->company_logo:'')}}" alt=""></a>
                            </div>

                            <div class="logo-centered-text">
                                <h2>Welcome to {{env('')}}!</h2>
                            </div>

                            
                            
                            <form  id="myForm">
                            @csrf
                                <div class="form-group">
                                    <input id="email" type="text" placeholder="Phone Number" class="form-control @error('email') is-invalid @enderror" name="phone_no" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                 <div class="form-group">

                                 <span class="input-group-append passView passwordViewBtn">
                                    <button class="file-upload-browse" type="button"><i class="fa fa-eye-slash"></i></button>
                                </span>

                                    <input  id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <!-- reCAPTCHA widget -->
                                <div class="rc-anchor-div" style="width: fit-content;" >
                                    <div class="g-recaptcha" data-sitekey="6LerSwwoAAAAAGyuy76MjC7WTS8fGT0kd2obeKsO"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <div class="form-group custom-check">
                                          <input type="checkbox" id="html">
                                          <label for="html">Remember Me</label>
                                        </div> -->
                                    </div>
                                    <div class="col-md-6 text-right forgot_password">
                                        <a class="" href="{{url('dealer/forgot_password')}}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    </div>
                                </div>
                            
                            <div class="sign-btn">
                                    <button class="btn btn-custom btn-primary">Login</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-bottom">
                <img src="{{ asset('dist/img/login-bg-img.png') }}" alt="">
            </div>
            <div class="login-info-img">
                <img src="{{ asset('dist/img/login-info-img.png') }}" alt="">
            </div>
        </div>
        <script>
  // Add an event listener to the form submission
 /* document.getElementById("myForm").addEventListener("submit", function(event) {
    // Prevent the form from submitting initially
    event.preventDefault();

    // Check if reCAPTCHA was completed successfully
    const recaptchaResponse = grecaptcha.getResponse();

    if (recaptchaResponse.length === 0) {
      // The reCAPTCHA was not checked; show an error message or take appropriate action.
    //   alert("Please complete the reCAPTCHA to submit the form.");
    $('.rc-anchor-div').css('border','1px solid red');
    } else {
      // The reCAPTCHA was checked; submit the form
      $('.rc-anchor-div').css('border','none');

      document.getElementById("myForm").submit();
    }
  }); */
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script>
//add update item
    $("#myForm").validate({
        rules: {

            phone_no: {
                required: true,
                number :true,
                minlength:10,
            },
            password: {
                required: true,
            },


        },
        messages: {
            phone_no:"Please enter a valid phone number"
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

            const recaptchaResponse = grecaptcha.getResponse();

            if (recaptchaResponse.length === 0) {
     
    $('.rc-anchor-div').css('border','1px solid red');
    }
            else{
            $('.submitFrm').attr('disabled', true); //Disable the submit button
            //serialize form data
            // var formData = $("#addEditForm").serialize();
            var formData = new FormData($("#myForm")[0]);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{route('dealer_login')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    // $("#addEditForm").find('.submit_button').attr("disabled", true);
                    $('.loader').show();
                },
                success: function(data) {
                    // $("#addEditForm").find('.submit_button').attr("disabled", false);
                    $('.loader').hide();
                    var response = JSON.parse(data);
                    $('.submitFrm').attr('disabled', false); //Enable the submit button
                    if (response.status==200) {
                        $.notify(response.msg, "success");
                        window.location.href = '{{url("dealer/dashboard")}}';
                    } else {
                        $.notify(response.msg, "error");
                    }
                },
            });
            return false;
        }
        }
    });

    $(document).on("click", ".passwordViewBtn", function () {
        var atrr = $(this).parent().find("#password").attr('type');
        if( atrr == 'password')
        {
            $(this).parent().find("#password").attr('type', 'text');
            $(this).parent().find("i").attr('class', 'fa fa-eye');
        }
        else
        {
            $(this).parent().find("#password").attr('type', 'password');            
            $(this).parent().find("i").attr('class', 'fa fa-eye-slash');   
        }
    });
    
</script>
        <script src="{{ asset('src/js/vendor/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset('plugins/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
        <script src="{{ asset('plugins/screenfull/dist/screenfull.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    </body>
</html>
