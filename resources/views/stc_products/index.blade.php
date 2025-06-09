@extends('layouts.stc_product.header')
@section('content')
<style>
    .owl-nav {
        display: none;
    }
    .brand_img img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
    }
    /* Shop by categories images: fill the box */
    .shop_cat .brand_img img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
    }
    /* Best brands logos: larger, centered, contained */
    .brands_section:not(.shop_cat) .brand_carousel .brand_img img {
        width: auto;
        max-width: 100%;
        max-height: 150px;
        height: auto;
        object-fit: contain;
        border-radius: 12px;
        display: block;
        margin: 0 auto;
        background: #fff;
    }
    /* Add red border to the brands section */
    .brands_section {
        border: 2px solid #ff0000;
        border-radius: 24px;
        background: #f6fbff;
        padding: 28px 0 18px 0;
        margin-bottom: 40px;
    }
    @media (max-width: 991px) {
        .imag_offer {
            display: block !important;
            width: 100% !important;
            max-height: 220px !important;
            height: 220px !important;
            margin-bottom: 16px;
            padding-right: 0 !important;
        }
        .imag_offer img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
        }
    }
    /* Add border to the whole Shop by Categories carousel */
    .brands_section.shop_cat .brand_slider {
        border: 2px solid #3887CD;
        border-radius: 18px;
        padding: 18px 10px 10px 10px;
        background: #fafdff;
        margin-bottom: 32px;
    }
    /* Shop by categories section border */
    .brands_section.shop_cat {
        border: 2px solid #b3d6f5;
        border-radius: 24px;
        background: #f6fbff;
        padding: 28px 0 18px 0;
        margin-bottom: 40px;
    }
    /* Newly Arrived section border with fancy effect */
    .product_slider {
        border: 2px solid #e0e6f7;
        border-radius: 20px;
        background: linear-gradient(135deg, #f8faff 80%, #eaf3ff 100%);
        padding: 32px 0 18px 0;
        margin-bottom: 40px;
        box-shadow: 0 4px 24px 0 #b3d6f533, 0 1.5px 6px 0 #3887cd22;
        transition: box-shadow 0.3s, transform 0.3s;
    }
    .product_slider:hover {
        box-shadow: 0 8px 32px 0 #3887cd44, 0 3px 12px 0 #3887cd33;
        transform: translateY(-6px) scale(1.01);
    }
</style>
<!-- machine-text-carousel-start -->

<div class="hero_slider">
    <div class="hero_slider-fullwidth">
        <div class="hero_card">
            <div class="owl-carousel hero_carousel owl-rtl owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transform: translate3d(4504px, 0px, 0px); transition: 0.25s; width: 7882px;">

                        @foreach($sliders as $key => $slider)
                            <div class="owl-item {{ $key == 0 ? 'active' : '' }}" style="width: 1116px; margin-left: 10px;">
                                <div class="item">
                                    <!-- <div class="slider_contant">

                                        <h1>{{$slider->title}}</h1>
                                        <p>{!! $slider->description !!}</p>
                                        
                                    </div> -->
                                    <div class="hero_images" id="banner-img">
                                        <img src="{{ asset('uploads/slider_image/' . $slider->image) }}" alt="First slide">     
                                    </div>
                                    <div class="slider_btn_hero">
                                        <a href="{{route('products')}}">
                                            <button type="button" class="btn btn-hero" id="btnn">المزيد من المعلومات
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                    viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                                    <path
                                                        d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="owl-nav disabled">
                    <button type="button" role="presentation" class="owl-prev"><span
                            aria-label="Previous"></span></button>
                    <button type="button" role="presentation" class="owl-next"><span aria-label="Next"></span></button>
                </div>
                <!-- <div class="owl-dots">
                    @foreach($sliders as $key => $slider)
                        <button role="button" class="owl-dot {{ $key == 0 ? 'active' : '' }}"><span></span></button>
                    @endforeach
                </div> -->
            </div>
        </div>
    </div>
</div>









<!-- machine-text-carousel-start -->

<!-- brands section -->
<div class="brands_section">
    <div class="container">
        <div class="hedding_part">
            <h2>أفضل العلامات التجارية</h2>
        </div>
        <div class="brand_slider">
            <div class="owl-carousel brand_carousel">
                @foreach($brands as $brand)

                    <div class="item">
                        <a href="{{route('products', ['brands[]' => $brand->id])}}">
                            <div class="brand_img">

                                <img src="{{asset('uploads/Brands/' . $brand->image)}}" alt="Brand 1">

                            </div>
                            </a>
                    </div>

                @endforeach
                <!-- <div class="item">
    <div class="brand_img">
        <img src="{{asset('stc_css/images/BISON POWER.png')}}" alt="Brand 2">
    </div>
</div>
<div class="item">
    <div class="brand_img">
        <img src="{{asset('stc_css/images/FIREBIRD.png')}}" alt="Brand 3">
    </div>
</div>
<div class="item">
    <div class="brand_img">
        <img src="{{asset('stc_cssimages/FLEXBIMEC LOGO.png')}}" alt="Brand 4">
    </div>
</div>
<div class="item">
    <div class="brand_img">
        <img {{asset('stc_css/images/IDROBASE.png')}}" alt="Brand 5">
    </div>
</div>
<div class="item">
    <div class="brand_img">
        <img src="{{asset('stc_css/images/MAZZONI (1).png')}}" alt="Brand 6">
    </div>
</div> -->

            </div>
        </div>
    </div>
</div>

<!-- End brands section -->


<!-- Shop by Categories section -->
<div class="brands_section shop_cat">
    <div class="container">
        <div class="hedding_part d-flex">
            <h2>التسوق حسب الفئات</h2>
            <div class="btn_all">
                <a href="{{route('products')}}">عرض الكل <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.375 10H3.625" stroke="#3887CD" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.25 4.375L3.625 10L9.25 15.625" stroke="#3887CD" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="brand_slider">
            <div class="owl-carousel brand_carousel">
                @foreach($categorys as $category)
                <a href="{{route('products',['categories[]' => $category->id])}}">

                    <div class="item">
                        <div class="brand_img">
                            <img src="{{asset('uploads/Category/' . $category->image)}}" alt="">
                        </div>
                        <h4 style="color: black;">{{$category->name}}</h4>
                       
                    </div>
                    </a>
                @endforeach
                <!-- <div class="item">
    <div class="brand_img">
        <img src="./images/cat_imag2.png" alt="">
    </div>
    <h4>تنظيف غسالة الضغط</h4>
</div>

<div class="item">
    <div class="brand_img">
        <img src="./images/cat_imag3.png" alt="">
    </div>
    <h4>تنظيف غسالة الضغط</h4>
</div>

<div class="item">
    <div class="brand_img">
        <img src="./images/cat_imag4.png" alt="">
    </div>
    <h4>تنظيف غسالة الضغط</h4>
</div>

<div class="item">
    <div class="brand_img">
        <img src="./images/cat_imag5.png" alt="">
    </div>
    <h4>تنظيف غسالة الضغط</h4>
</div> -->


            </div>
        </div>
    </div>
</div>

<!-- End Shop by Categories section -->


<!-- Product Section -->

<div class="product_slider">
    <div class="container">
        <div class="hedding_part d-flex">
            <h2>الوافدون الجدد</h2>
            <div class="btn_all">
                <a href="{{route('products')}}">عرض الكل <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.375 10H3.625" stroke="#3887CD" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.25 4.375L3.625 10L9.25 15.625" stroke="#3887CD" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="product_inner">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="product_card">
                            <a href="{{ route('productdetails', $product->id) }}">
                                <div class="product_img">
                                    <img src="{{asset('uploads/product/product_image/' . $product->product_image)}}" alt="">
                                </div>
                                <div class="product_con">
                                    <h6>{{$product->category_name}}</h6>
                                    <h3>{{$product->name}}</h3>
                                    <h5>{{$product->code}}</h5>
                                    {{-- @if(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type ==
                                    "loyal")
                                    <div class="product_price">{{$product->loyal_price}}</div>
                                    @endif --}}
                                    @if(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "loyal")
                                        <div class="product_price">{{$product->loyal_price}}</div>
                                    @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "wholesaler")
                                        <div class="product_price">{{$product->wholesaler_price}}</div>
                                    @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "normal")
                                        <div class="product_price">{{$product->normal_price}}</div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach


                <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="product_card">
                        <a href="">
                            <div class="product_img">
                                <img src="{{asset('stc_css/images/cardimg2.png')}}" alt="">
                            </div>
                            <div class="product_con">
                                <h6>قطع غيار</h6>
                                <h3>صمام التفريغ</h3>
                                <h5>TCM-36MPA</h5>
                                <div class="product_price">₪ 3400.00</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="product_card">
                        <a href="">
                            <div class="product_img">
                                <img src="{{asset('stc_css/images/cardimg3.png')}}" alt="">
                            </div>
                            <div class="product_con">
                                <h6>قطع غيار</h6>
                                <h3>صمام التفريغ</h3>
                                <h5>TCM-36MPA</h5>
                                <div class="product_price">₪ 3400.00</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="product_card">
                        <a href="">
                            <div class="product_img">
                                <img src="{{asset('stc_css/images/cardimg4.png')}}" alt="">
                            </div>
                            <div class="product_con">
                                <h6>قطع غيار</h6>
                                <h3>صمام التفريغ</h3>
                                <h5>TCM-36MPA</h5>
                                <div class="product_price">₪ 3400.00</div>
                            </div>
                        </a>
                    </div>
                </div> -->

            </div>
        </div>

    </div>
</div>

<!-- End Product Section -->


<!-- Offer Car -->

<div class="offer_card">
    <div class="container">
        <div class="row">
            @foreach ($mostproducts as $product)
                <div class="col-md-6">

                    <div class="offer_card_inner best-product-card" style="border: 2px solid #3887CD; border-radius: 18px; box-shadow: 0 2px 12px #3887cd22; padding: 24px; margin-bottom: 24px;">

                        <a href="{{ route('productdetails', $product->id) }}">
                            <div class="d-flex">

                                <div class="offer_contant">
                                    <h5 class="best-products-title" style="font-size: 2.2rem; font-weight: bold; color: #3887CD; letter-spacing: 1px; text-shadow: 1px 1px 8px #e3eaff; margin-bottom: 18px;">أفضل المنتجات</h5>
                                    <h2>{{$product->name}}</h2>
                                    <p>{!! $product->full_description !!}</p>

                                    <button type="button" class="btn btn-hero" id="btnn">المزيد من المعلومات <svg
                                            xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#5f6368">
                                            <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z">
                                            </path>
                                        </svg></button>
                                </div>
                                <div class="imag_offer">
                                    <img src="{{asset('uploads/product/product_image/' . $product->product_image)}}" alt="">
                                </div>

                            </div>
                        </a>

                    </div>

                </div>
            @endforeach


        </div>
    </div>
</div>

<!-- End Offer Car -->


<!-- Google Ad Section -->
<div class="ads_card">
    <div class="container">

    <div class="hero_slider">
    <div class="container">
        <div class="hero_card">
            <div class="owl-carousel hero_carousel owl-rtl owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transform: translate3d(4504px, 0px, 0px); transition: 0.25s; width: 7882px;">

                        @foreach($ads as $key => $slider)
                            <div class="owl-item {{ $key == 0 ? 'active' : '' }}" style="width: 1116px; margin-left: 10px;">
                                
                                   
                                    <div class="hero_imagess" id="bannerr-img">
                                        <img src="{{ asset('uploads/ad_image/' . $slider->image) }}" alt="First slide"
                                            style="width: 100%; max-height:360px;">

                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="owl-nav disabled">
                            <button type="button" role="presentation" class="owl-prev"><span
                                    aria-label="Previous"></span></button>
                            <button type="button" role="presentation" class="owl-next"><span
                                    aria-label="Next"></span></button>
                        </div>
                        <!-- <div class="owl-dots">
                    @foreach($sliders as $key => $slider)
                        <button role="button" class="owl-dot {{ $key == 0 ? 'active' : '' }}"><span></span></button>
                    @endforeach
                </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Google Ad Section -->


<!-- About Section -->
<div class="about_card">
    <div class="container">
        <div class="about_card_inner">
            <div class="card_item">
                <div class="ab_card_icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35.2344 21.25H30.2344C29.5713 21.25 28.9354 21.5134 28.4666 21.9823C27.9978 22.4511 27.7344 23.087 27.7344 23.75V30C27.7344 30.6631 27.9978 31.299 28.4666 31.7678C28.9354 32.2366 29.5713 32.5 30.2344 32.5H32.7344C33.3974 32.5 34.0333 32.2366 34.5021 31.7678C34.971 31.299 35.2344 30.6631 35.2344 30V21.25ZM35.2344 21.25C35.2344 19.2696 34.8424 17.3088 34.0807 15.4808C33.3191 13.6527 32.203 11.9935 30.7969 10.599C29.3907 9.20447 27.7224 8.10219 25.888 7.35576C24.0537 6.60933 22.0897 6.23353 20.1094 6.25003C18.1304 6.2356 16.1681 6.61294 14.3355 7.36029C12.503 8.10765 10.8365 9.21026 9.432 10.6046C8.02751 11.9989 6.91283 13.6574 6.15218 15.4844C5.39153 17.3115 4.99995 19.271 5 21.25V30C5 30.6631 5.26339 31.299 5.73223 31.7678C6.20107 32.2366 6.83696 32.5 7.5 32.5H10C10.663 32.5 11.2989 32.2366 11.7678 31.7678C12.2366 31.299 12.5 30.6631 12.5 30V23.75C12.5 23.087 12.2366 22.4511 11.7678 21.9823C11.2989 21.5134 10.663 21.25 10 21.25H5"
                            stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="ad_text">
                    <h4>دعم 24/7</h4>
                    <p>الاتصال المباشر/الرسالة</p>
                    <p>00970592350011</p>
                    <p>00972524012039</p>
                </div>
            </div>

            <div class="card_item">
                <div class="ab_card_icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35 8.75H5C4.30964 8.75 3.75 9.30964 3.75 10V30C3.75 30.6904 4.30964 31.25 5 31.25H35C35.6904 31.25 36.25 30.6904 36.25 30V10C36.25 9.30964 35.6904 8.75 35 8.75Z"
                            stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M26.25 26.25H31.25" stroke="#191C1F" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M18.75 26.25H21.25" stroke="#191C1F" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M3.75 15.1406H36.25" stroke="#191C1F" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                </div>
                <div class="ad_text">
                    <h4>الدفع الآمن</h4>
                    <p>أموالك في أمان</p>
                    <p>الدفع باستخدام الفيزا أو الدفع عند الاستلام</p>
                </div>
            </div>

            <div class="card_item">
                <div class="ab_card_icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.75 8.75V17.3594C8.75 23.5625 13.7187 28.7031 19.9219 28.75C21.4058 28.7603 22.8771 28.4769 24.2511 27.9162C25.625 27.3554 26.8744 26.5284 27.9274 25.4827C28.9803 24.437 29.816 23.1933 30.3862 21.8233C30.9565 20.4533 31.25 18.984 31.25 17.5V8.75C31.25 8.41848 31.1183 8.10054 30.8839 7.86612C30.6495 7.6317 30.3315 7.5 30 7.5H10C9.66848 7.5 9.35054 7.6317 9.11612 7.86612C8.8817 8.10054 8.75 8.41848 8.75 8.75Z"
                            stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15 35H25" stroke="#191C1F" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M20 28.75V35" stroke="#191C1F" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M30.9688 20H32.5C33.8261 20 35.0979 19.4732 36.0355 18.5355C36.9732 17.5979 37.5 16.3261 37.5 15V12.5C37.5 12.1685 37.3683 11.8505 37.1339 11.6161C36.8995 11.3817 36.5815 11.25 36.25 11.25H31.25"
                            stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M9.0625 20H7.48438C6.15829 20 4.88652 19.4732 3.94884 18.5355C3.01116 17.5979 2.48438 16.3261 2.48438 15V12.5C2.48438 12.1685 2.61607 11.8505 2.85049 11.6161C3.08491 11.3817 3.40285 11.25 3.73438 11.25H8.73438"
                            stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>
                <div class="ad_text">
                    <h4>إرجاع خلال 24 ساعة</h4>
                    <p>ضمان استرداد الأموال بنسبة 100%</p>
                    <p>أفضل الجودة والضمان</p>
                </div>
            </div>

            <div class="card_item">
                <div class="ab_card_icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M35 27.7031V12.2968C34.9988 12.0743 34.939 11.856 34.8265 11.664C34.714 11.4719 34.5529 11.313 34.3594 11.2031L20.6094 3.4687C20.4241 3.36173 20.2139 3.30542 20 3.30542C19.7861 3.30542 19.5759 3.36173 19.3906 3.4687L5.64062 11.2031C5.44711 11.313 5.28599 11.4719 5.17352 11.664C5.06105 11.856 5.0012 12.0743 5 12.2968V27.7031C5.0012 27.9256 5.06105 28.1439 5.17352 28.3359C5.28599 28.528 5.44711 28.6869 5.64062 28.7968L19.3906 36.5312C19.5759 36.6382 19.7861 36.6945 20 36.6945C20.2139 36.6945 20.4241 36.6382 20.6094 36.5312L34.3594 28.7968C34.5529 28.6869 34.714 28.528 34.8265 28.3359C34.939 28.1439 34.9988 27.9256 35 27.7031V27.7031Z"
                            stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M27.6562 23.8281V15.7031L12.5 7.34375" stroke="#191C1F" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M34.8281 11.6562L20.1406 20L5.17188 11.6562" stroke="#191C1F" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20.1406 20L20 36.6875" stroke="#191C1F" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                </div>
                <div class="ad_text">
                    <h4>أسرع توصيل</h4>
                    <p>التوصيل خلال 24 ساعة</p>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- End About Section -->

<script>
    $(document).ready(function () {
        $(".hero_carousel").owlCarousel({
            loop: true, // Enable infinite loop
            margin: 10, // Add space between items
            nav: true, // Enable navigation arrows
            autoplay: true, // Enable auto-slide
            autoplayTimeout: 5000, // Set time between slides (in milliseconds)
            autoplayHoverPause: true, // Pause on hover
            rtl: true, // Enable RTL if needed
            responsive: {
                0: {
                    items: 1 // Show 1 item on small screens
                },
                768: {
                    items: 1 // Show 1 item on medium screens
                },
                1200: {
                    items: 1 // Show 1 item on large screens
                }
            }
        });
    });
</script>

<!-- Footer -->

@endsection