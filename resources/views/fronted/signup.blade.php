<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User signup</title>
</head>

<body>


    @extends('layouts.stc_product.header')
    @section('content')
    <div class="breadcrumb_card">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.875 16.2498V12.4998C11.875 12.334 11.8092 12.1751 11.6919 12.0579C11.5747 11.9406 11.4158 11.8748 11.25 11.8748H8.75C8.58424 11.8748 8.42527 11.9406 8.30806 12.0579C8.19085 12.1751 8.125 12.334 8.125 12.4998V16.2498C8.125 16.4156 8.05915 16.5745 7.94194 16.6917C7.82473 16.809 7.66576 16.8748 7.5 16.8748H3.75C3.58424 16.8748 3.42527 16.809 3.30806 16.6917C3.19085 16.5745 3.125 16.4156 3.125 16.2498V9.02324C3.1264 8.93674 3.14509 8.8514 3.17998 8.77224C3.21486 8.69308 3.26523 8.6217 3.32812 8.5623L9.57812 2.88261C9.69334 2.77721 9.84384 2.71875 10 2.71875C10.1562 2.71875 10.3067 2.77721 10.4219 2.88261L16.6719 8.5623C16.7348 8.6217 16.7851 8.69308 16.82 8.77224C16.8549 8.8514 16.8736 8.93674 16.875 9.02324V16.2498C16.875 16.4156 16.8092 16.5745 16.6919 16.6917C16.5747 16.809 16.4158 16.8748 16.25 16.8748H12.5C12.3342 16.8748 12.1753 16.809 12.0581 16.6917C11.9408 16.5745 11.875 16.4156 11.875 16.2498Z"
                                    stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            بيت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">قائمة المنتجات</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="form_card">
        <div class="container">
            <div class="form-area">
                <div class="form-inner">
                    <h3>اشتراك</h3>
                    <form method="POST" action="{{route('sign_upData')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}"
                                placeholder="الاسم الكامل">
                            @error('first_name')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="بريد إلكتروني" autocomplete="off">
                            @error('email')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <div class="form-group">  
                            <select class="form-select" name="user_type" aria-label="Default select example">
                                <option selected>حدد نوع المستخدم</option>
                                <option value="">حدد نوع المستخدم</option>
                                <option value="">حدد نوع المستخدم</option>
                                <option value="">حدد نوع المستخدم</option>
                            </select>                            
                        </div>   -->

                        <div class="form-group mobile_code">
                            <input type="number" id="mobile_code" class="form-control" value="{{ old('phone') }}"
                                name="phone">
                            @error('phone')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="كلمة المرور" autocomplete="off">
                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                            @error('password')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password_confirmation" class="form-control"
                                placeholder="تأكيد كلمة المرور">
                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                            @error('password_confirmation')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <div class="form-check-sign">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                هل توافق على شروط وأحكام STC وسياسة الخصوصية؟
                            </label>
                        </div> -->

                        <div class="form-check-sign">
                            <input class="form-check-input" type="checkbox" name="agree_terms" value="1"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                هل توافق على شروط وأحكام STC وسياسة الخصوصية؟
                            </label>
                        </div>

                        <!-- <button type="button" class="btn btn-login">اشتراك <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path></svg></button> -->
                        <button type="submit" class="btn btn-login">
                            اشتراك
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#5f6368">
                                <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                            </svg>
                        </button>

                        <div class="Sign_links">
                            <p>هل لديك حساب بالفعل؟ <a href="{{route('sign_in')}}">تسجيل الدخول</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    @endsection
    @push('script')
        <script>

            // -----Country Code Selection
            $("#mobile_code").intlTelInput({
    initialCountry: "PS", // Country code for Palestine
    separateDialCode: true,
});


        </script>
         <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    @endpush
</body>

</html>