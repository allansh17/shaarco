<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | {{(isset($company_detail->company_name) && !empty($company_detail->company_name) ? $company_detail->company_name:'')}}</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="{{ asset('company_logo/') }}/{{(isset($company_detail->favi_icon) && !empty($company_detail->favi_icon) ? $company_detail->favi_icon:'')}}" type="image/x-icon" />

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
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="auth-wrapper forgot_password_form">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-6 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" >
                            <div class="lavalite-bg-text">
                                <h2>Welcome to <br>our community</h2>
                                <p>Enter your email address and password <br>to access admin panel.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href=""><img style="max-width: 250px;height:70px;"  src="{{ asset('company_logo/') }}/{{(isset($company_detail->company_logo) && !empty($company_detail->company_logo) ? $company_detail->company_logo:'')}}" alt=""></a>
                            </div>

                            <div class="logo-centered-text">
                                <h2>Sign In</h2>
                                <p>Log in to your account to continue.</p>
                            </div>

                            
                            
                            <form method="POST" action="{{ route('login') }}">
                            @csrf
                                <div class="form-group">
                                    <label for="email" class="d-block"><b>Email ID</b></label>
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <i class="ik ik-user"></i>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <label for="password" class="d-block"><b>Password</b></label>
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    <i class="ik ik-lock"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                             <div class="row">
                                    <div class="col text-right">
                                        <a class="btn text-danger" href="{{url('password/forget')}}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    </div>
                                </div>
                            
                            <div class="sign-btn">
                                    <button class="btn btn-custom btn-primary w-100">Sign In</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('src/js/vendor/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset('plugins/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
        <script src="{{ asset('plugins/screenfull/dist/screenfull.js')}}"></script>
    </body>
</html>
