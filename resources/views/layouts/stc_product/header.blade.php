<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- owl-carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('stc_css/images/Logo.svg')}}">


    <!-- font-awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <!-- custome-css -->
    <link rel="stylesheet" href="{{ asset('stc_css/style.css') }}" />

    <title>Home-page</title>
    <style>
        .cart {
            position: relative;
        }

        .user_login {
            position: relative;
            display: inline-block;
        }

        .dropdown_menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            min-width: 100px;
            border-radius: 8px;
        }

        .dropdown_menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .dropdown_menu ul li {
            padding: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown_menu ul li a {
            text-decoration: none;
            color: #333;
            display: block;
            transition: all 0.3s ease;
        }

        .dropdown_menu ul li a:hover {
            background-color: #f8f8f8;
            color: #3887CD;
        }

        .user_login:hover .dropdown_menu {
            display: block;
        }

        /* New Navigation Styles */
        .navbar-nav {
            gap: 1rem;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            color: #3887CD !important;
            background-color: rgba(56, 135, 205, 0.1);
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: transparent !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
            border-radius: 6px !important;
            transition: all 0.3s ease;
            color: #333 !important;
        }

        .dropdown-toggle:hover {
            background-color: rgba(56, 135, 205, 0.1) !important;
            color: #3887CD !important;
        }

        .dropdown-toggle::after {
            margin-right: 2.5em; /* Increased margin-right to move it further left */
            margin-left: -0.80em; /* Ensure no left margin */
        }

        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #eee;
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(56, 135, 205, 0.1);
            color: #3887CD;
        }

        .dropdown-item.active {
            background-color: #3887CD;
            color: white;
        }

        /* Specific styles for mobile menu when open */
        .navbar-collapse.show .nav-link,
        .navbar-collapse.show .dropdown-toggle {
            color: white !important;
        }
    </style>
</head>

<body>

    <!-- top-nav-bar -->
    <!-- social-links -->


    <header>
        <div class="container">
            <div class="top-nav d-flex justify-content-between align-items-center">
                <div class="text">
                    <h6>مرحبا بكم في شركة شعاركو للمعدات الصناعية</h6>
                </div>
                <div class="social-icons d-flex">
                    <p>تابعنا:</p>
                    <ul class="d-flex list-unstyled">
                        <li><a href="{{ company_setting()->facebook }}" target="_blank"><img
                                    src="{{asset('stc_css/images/Facebook.svg')}}" alt="Facebook"></a></li>
                        <li><a href="{{ company_setting()->instagram }}" target="_blank"><img
                                    src="{{asset('stc_css/images/Instagram.svg')}}" alt="Instagram"></a></li>
                        <li><a href="{{ company_setting()->twitter }}" target="_blank"><img
                                    src="{{asset('stc_css/images/tiktok.svg')}}" alt="TikTok" style="width: 17px;"></a>
                        </li>
                        <li><a href="{{ company_setting()->linkedin }}" target="_blank"><img
                                    src="{{asset('stc_css/images/Youtube.svg')}}" alt="Youtube"></a></li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="card_brand">
            <div class="container">
                <div class="Cart-part d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{route('index')}}">
                            <img src="{{asset('stc_css/images/Logo.svg')}}" alt="logo">
                        </a>
                    </div>

                    <div class="search-bar d-flex">
                        <form style="width: 100% !important;">
                            <div class="input_search d-flex">
                                <span class="search-button"><i class="fas fa-search"></i></span>
                                <input type="text" name="query" id="search" class="form-control"
                                    value="{{ request('query') }}" placeholder="ابحث">
                            </div>
                        </form>
                        <div class="dropdown">
                           
                            <div id="product-container"></div>



                        </div>
                    </div>

                    <!-- <div class="cart">
                        <a class="cart_icon" href="{{route('cart-page')}}"><img src="{{asset('stc_css/images/ShoppingCartSimple.svg')}}"
                                alt="Cart"></a>
                        <a class="user_login" href="#"><img src="{{asset('stc_css/images/User.svg')}}" alt="User"></a>
                    </div> -->
                    <div class="cart">
                        <a class="cart_icon" href="{{ route('cart-page') }}" style="position: relative;">
                            <img src="{{ asset('stc_css/images/ShoppingCartSimple.svg') }}" alt="Cart"
                                style="width: 30px; height: 30px;">
                            @php
                                $totalItems = App\Helpers\CartHelper::getTotalItems();
                            @endphp
                            @if ($totalItems > 0)
                                                            <span class="cart-count" style=" position: absolute;
                                    top: -5px;
                                    right: -5px;
                                    background-color: #ffffff;
                                    color: #1b6392;
                                    border-radius: 50%;
                                    padding: 8px 5px 5px 0px;
                                    font-size: 12px;
                                    display: flex
                                ;
                                    align-items: center;
                                    height: 20px;
                                    width: 20px;
                                ">
                                                                {{ $totalItems }}
                                                            </span>
                            @endif
                        </a>



                        @if(Auth::guard('local')->check())
                            <div class="user_login">
                                <div class="login_user_name">

                                    <i class="fa-solid fa-caret-right fa-rotate-by"
                                        style="--fa-rotate-angle: 90deg;"></i>&nbsp;&nbsp;{{ Auth::guard('local')->user()->first_name }}
                                </div>

                                <div class="dropdown_menu">
                                    <ul>
                                        <li><a href="#">My profile</a></li>
                                        <li><a href="{{ route('log_out') }}">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="user_login">
                                <a href="{{ route('sign_in') }}"><img src="{{asset('stc_css/images/User.svg')}}"
                                        alt="User"></a>

                            </div>
                        @endif


                    </div>



                </div>
            </div>
        </div>

        <!-- Bottom navigation bar -->
        <div class="bottom-nav">
            <div class="container d-flex justify-content-center">
                <nav class="navbar navbar-expand-lg">
                    <div class="container">
                        {{-- The 'جميع العلامات التجارية' dropdown button has been moved into the navbar-collapse for mobile --}}
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('products')}}">
                                        <i class="fas fa-box"></i>
                                        منتجات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('about-us')}}">
                                        <i class="fas fa-info-circle"></i>
                                        معلومات عنا
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('contact_us')}}">
                                        <i class="fas fa-headset"></i>
                                        دعم العملاء
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="categoryDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-tags"></i>
                                            {{ $brands->firstWhere('id', request('id'))?->name ?? 'جميع العلامات التجارية' }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('products') }}">
                                                    <i class="fas fa-th-large"></i>
                                                    All Brands
                                                </a>
                                            </li>
                                            @foreach ($brands as $brand)
                                                <li>
                                                    <a class="dropdown-item {{ request('id') == $brand->id ? 'active' : '' }}" 
                                                       href="{{ route('getproducts', ['id' => $brand->id]) }}">
                                                        <i class="fas fa-tag"></i>
                                                        {{ $brand->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    @yield('content')
    @include('layouts.stc_product.footer')





    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS (Optional, if used elsewhere) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Owl Carousel JS -->
    <!-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js')}}"></script> -->
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>


    @stack('script')


    <script>
        $(document).ready(function () {
            $(".hero_carousel").owlCarousel({
                loop: true,
                margin: 10,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000000,
                rtl: true, // Enable RTL mode
                dots: true, // Ensure dots are enabled
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });
            $('#search').on('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    var query = $(this).val();
                    searchProduct(query);
                }
            });

            // Adding click event for the search button
            $('.search-button').on('click', function () {
                var query = $('#search').val();
                searchProduct(query);
            });

            // Function to perform the search
            function searchProduct(query) {
                $.ajax({
                    url: '/searchproduct',
                    type: 'GET',
                    data: { query: query },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status) {
                            let redirectUrl = '/product-list?query=' + encodeURIComponent(query);
                            window.location.href = redirectUrl;
                        } else {
                            console.log('No products found.');
                        }
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }


        });
    </script>


    <script>

        function filterProductsByCategory(categoryName) {
            // Redirect to the products page with the category name as a query parameter
            window.location.href = `/products?category_name=${categoryName}`;
        }


        $(document).ready(function () {
            $(".brand_carousel").owlCarousel({
                autoWidth: true,
                loop: true,
                margin: 15,
                nav: true,
                dots: false,
                rtl: true,
                navText: [
                    '<i class="custom-arrow left-arrow"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"/></svg></i>', // Custom left arrow
                    '<i class="custom-arrow right-arrow"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"/></svg></i>'  // Custom right arrow
                ],
            });
        });

    </script>


    <script>
        $(document).ready(function () {

            $('.counter').each(function () {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });
    </script>

</body>

</html>