<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('Reset Password | Safelines') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.png')}}" type="image/x-icon" />

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
    <style>
        .reset-password .form-group .form-control~i {
            top: 50% !important;
            right: 16px;
            transform: translateY(-50%);
        }

        .auth-wrapper .authentication-form .form-group .form-control~i {
            left: unset;
        }
    </style>
</head>




<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-6 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-7 my-auto p-0">
                    <div class="authentication-form mx-auto reset-password">
                        <div class="logo-centered">
                            <a href=""><img max-width="250" src="{{ asset('company_logo/') }}/{{(isset($company_detail->company_logo) && !empty($company_detail->company_logo) ? $company_detail->company_logo:'')}}" alt=""></a>
                        </div>
                        <h3>{{ __('Reset Password') }}</h3>
                        <p>{{ __('Enter your new password.') }}</p>
                        <form method="POST"  id="myForm1">
                            <input type="hidden" name="token" value="{{$token}}">
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password"  id="password" required>
                                <!-- <i class="ik ik-lock"></i> -->
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                <!-- <i class="ik ik-eye-off"></i> -->
                            </div>
                            <div class="sign-btn text-center">
                                <button class="btn btn-theme submit_button">{{ __('Submit') }}</button>
                            </div>
                        </form>
                        <!--                            <div class="register">
                                <p>{{ __('Not a member') }}? <a href="{{ url('register')}}">{{ __('Create an account') }}</a></p>
                            </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('src/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('plugins/popper.js')}}/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('plugins/screenfull/dist/screenfull.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

    <script>
         $("#myForm1").validate({
        rules: {

            password: {
                required: true,
                minlength:8,
               
            },

            password_confirmation: {
                required: true,
                minlength:8,
                equalTo:"#password"
               
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
        submitHandler: function(form) {
            
            $('.submitFrm').attr('disabled', true); //Disable the submit button
            //serialize form data
            // var formData = $("#addEditForm").serialize();
            var formData = new FormData($("#myForm1")[0]);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{route('dealerpassword.update')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#myForm1").find('.submit_button').attr("disabled", true);
                   // $('.loader').show();
                },
                success: function(data) {
                 $("#myForm1").find('.submit_button').attr("disabled", false);
                    // $('.loader').hide();
                     var response = JSON.parse(data);
                     console.log("Pranav",response);
                     $('.submitFrm').attr('disabled', false); //Enable the submit button
                    if (response.status==200) {
                        $.notify(response.msg, "success");
                        window.location.href = '{{url("dealer/login")}}';
                        // sessionStorage.setItem("phone", response.phone);
                        //let phone = sessionStorage.getItem("phone");
                       
                    } else {
                        $.notify(response.msg, "error");
                    }
                },
            });
            return false;
        
        }
    });

    </script>
</body>

</html>