@extends('layouts.stc_product.header')
@section('content')
<style>
    .warrent {
        width: 146px;
        position: absolute;
    }

    .warrent span {
        position: relative;
        float: left;
        height: 49px;
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 30px;
        width: 49px;
        justify-content: center;
        margin-top: 8px;
        font-weight: bolder;
        font-size: 35px;
        color: #009ed2;
    }

    video {
        width: 100%;
        height: 60vh;
    }
.out-of-stock img {
    background-color: red;
    opacity: 0.5; /* Image transparency */
    filter: grayscale(100%); /* Convert to grayscale for better effect */
    pointer-events: none; /* Disable interactions */
}

/* Fix for lightSlider image zooming issue */
#mainDisplay {
    height: 100% !important;
    object-fit: contain !important;
    width: 100% !important;
    max-width: 100% !important;
    max-height: 100% !important;
}

/* Ensure all product images maintain proper aspect ratio */
.card_images img {
    height: 100% !important;
    object-fit: contain !important;
    width: 100% !important;
    max-width: 100% !important;
    max-height: 100% !important;
}

/* Force consistent image display in lightSlider */
.lSSlideWrapper.usingCss img,
.lSSlideOuter .lightSlider img,
#lightSlider img {
    height: 100% !important;
    object-fit: contain !important;
    width: 100% !important;
    max-width: 100% !important;
    max-height: 100% !important;
}

/* Styles for clickable images */
.clickable-image {
    cursor: pointer;
    transition: opacity 0.3s ease;
}

.clickable-image:hover {
    opacity: 0.8;
}

/* Add a subtle overlay to indicate clickability */
.image-container {
    position: relative;
    display: inline-block;
}

.image-container::after {
    content: "🔍";
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px;
    border-radius: 50%;
    font-size: 14px;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.image-container:hover::after {
    opacity: 1;
}

/* Ensure clickable images work properly within lightSlider */
.lSSlideWrapper.usingCss .image-container {
    width: 100%;
    height: 100%;
}

.lSSlideWrapper.usingCss .image-container a {
    display: block;
    width: 100%;
    height: 100%;
}

.lSSlideWrapper.usingCss .image-container img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Ensure the magnifying glass icon appears correctly */
.lSSlideWrapper.usingCss .image-container::after {
    z-index: 10;
}

/* Custom Warranty Icon Styles */
.warranty-icon-container {
    display: inline-flex; /* Use inline-flex to prevent full width */
    align-items: center;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 50px;
    padding: 5px 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    gap: 12px; /* Use gap for spacing between items */
}

.warranty-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #3887CD; /* Using theme blue color */
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    flex-shrink: 0;
}

.warranty-text {
    font-size: 1rem;
    color: #495057;
    font-weight: 600;
    white-space: nowrap;
}

</style>
<!-- CSS for Selected Color -->
<style>
    .bg_color_p {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-block;
        margin: 5px;
        border: 2px solid transparent;
        cursor: pointer;
    }

    .bg_color_p.selected {
        border: 2px solid black; /* Highlight selected color */
    }

    .color-label input {
        display: none; /* Hide the checkbox */
    }
</style>
<div class="breadcrumb_card">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&quot;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('index')}}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.875 16.2498V12.4998C11.875 12.334 11.8092 12.1751 11.6919 12.0579C11.5747 11.9406 11.4158 11.8748 11.25 11.8748H8.75C8.58424 11.8748 8.42527 11.9406 8.30806 12.0579C8.19085 12.1751 8.125 12.334 8.125 12.4998V16.2498C8.125 16.4156 8.05915 16.5745 7.94194 16.6917C7.82473 16.809 7.66576 16.8748 7.5 16.8748H3.75C3.58424 16.8748 3.42527 16.809 3.30806 16.6917C3.19085 16.5745 3.125 16.4156 3.125 16.2498V9.02324C3.1264 8.93674 3.14509 8.8514 3.17998 8.77224C3.21486 8.69308 3.26523 8.6217 3.32812 8.5623L9.57812 2.88261C9.69334 2.77721 9.84384 2.71875 10 2.71875C10.1562 2.71875 10.3067 2.77721 10.4219 2.88261L16.6719 8.5623C16.7348 8.6217 16.7851 8.69308 16.82 8.77224C16.8549 8.8514 16.8736 8.93674 16.875 9.02324V16.2498C16.875 16.4156 16.8092 16.5745 16.6919 16.6917C16.5747 16.809 16.4158 16.8748 16.25 16.8748H12.5C12.3342 16.8748 12.1753 16.809 12.0581 16.6917C11.9408 16.5745 11.875 16.4156 11.875 16.2498Z"
                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                        بيت</a>
                </li>
                <li class="breadcrumb-item " aria-current="page">فئة</li>
                <li class="breadcrumb-item active" aria-current="page">تفاصيل المنتج</li>
            </ol>
        </nav>
    </div>
</div>


<div class="product_details">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="card_images">
                    <div class="demo">
                        <ul id="lightSlider">
                            <!-- Main Display Image (First Item) -->
                          <li data-thumb="{{ asset('uploads/product/product_image/' . $productdetails->product_image) }}">
    <div class="image-container">
        <a href="{{ asset('uploads/product/product_image/' . $productdetails->product_image) }}" target="_blank" class="clickable-image" title="انقر لفتح الصورة في نافذة جديدة">
            <img id="mainDisplay" 
                 src="{{ asset('uploads/product/product_image/' . $productdetails->product_image) }}" 
                 alt="Main Product Image" />
        </a>
    </div>
</li>

                            <!-- Loop through the other images/videos -->
                            @foreach ($productImages as $video)
                                @php
                                    // Check if file is a video
                                    $isVideo = strpos($video->list_image, '.mp4') !== false;
                                    // Default thumbnail for videos
                                    $videoThumb = asset('uploads/product/listing_images/istockphoto-1370510901-612x612.jpg');
                                @endphp
                        
                                <li data-thumb="{{ $isVideo ? $videoThumb : asset('uploads/product/listing_images/' . $video->list_image) }}">
                                    @if($isVideo)
                                        <!-- Video -->
                                        <video class="thumbnail" width="640" height="360" controls>
                                            <source src="{{ asset('uploads/product/listing_images/' . $video->list_image) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <!-- Image -->
                                        <div class="image-container">
                                            <a href="{{ asset('uploads/product/listing_images/' . $video->list_image) }}" target="_blank" class="clickable-image" title="انقر لفتح الصورة في نافذة جديدة">
                                                <img class="thumbnail" 
                                                     src="{{ asset('uploads/product/listing_images/' . $video->list_image) }}" 
                                                     alt="Product Image" />
                                            </a>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        
                        
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="product_de_text">
                    <h2>{{ $productdetails->name }}</h2>
                    <p>{{ $productdetails->overview }}</p>
                    <div class="product_man">
                        <div class="lable_pr"><label>كود المنتج:</label> {{ $productdetails->code }}</div>
                        <div class="lable_pr current_st"><label>العلامة التجارية:</label>
                            {{ $productdetails->brands_name ?? 'No Brand' }}</div>
                        <div class="lable_pr">
                            <label>التوفر:</label>
                            @if($productdetails->stock_status > 0)
                                متوفر في المخزون
                            @else
                                نفد من المخزون
                            @endif
                        </div>

                        <div class="lable_pr">
                            <label>الفئة:</label>
                            {{ $productdetails->category_name ?? 'No Category' }}
                        </div>
                    </div>
                    @if(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "loyal")
                        <div class="product_price">{{$productdetails->loyal_price}}</div>
                    @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "wholesaler")
                        <div class="product_price">{{$productdetails->wholesaler_price}}</div>
                    @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "normal")
                        <div class="product_price">{{$productdetails->normal_price}}</div>
                    @endif


                    <div class="select_p">
                        {{-- <select class="form-select" aria-label="Default select example" style="    background-position: left .75rem center;
    padding: .375rem .75rem .375rem 2.25rem;background-color: #F0F2F3; color:#464748;border: none;">
                            <option selected="">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">حدد الحجم</font>
                                </font>
                            </option>
                            <option value="1">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">حدد الحجم</font>
                                </font>
                            </option>
                            <option value="2">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">حدد الحجم</font>
                                </font>
                            </option>
                            <option value="3">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">حدد الحجم</font>
                                </font>
                            </option>
                            <option value="4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">حدد الحجم</font>
                                </font>
                            </option>
                        </select> --}}
                    </div>
                   @if($productdetails->stock_status > 0)
                        <form action="{{ route('add_tocart', $productdetails->id) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="pr_btn">
                                @if(!Auth::guard('local')->check())
                                    <a href="{{route('sign_in')}}" class="btn btn-primary">Add to Cart</a>
                                @else
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                @endif
                                <div class="input-add d-flex">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="qty">
                                            <span class="glyphicon glyphicon-plus">+</span>
                                        </button>
                                    </span>
                                    <input type="text" name="qty" class="form-control input-number" value="1" min="1" max="10">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="qty" disabled="disabled">
                                            <span class="glyphicon glyphicon-minus">-</span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" name="price" value="{{ $productdetails->normal_price }}">
                            <input type="hidden" name="name" value="{{ $productdetails->name}}">
                            <input type="hidden" name="selected_colors" id="selectedColorsInput">
                        </form>
                    @else
                        <div class="mt-4" style="color: red; font-weight: bold; font-size: 1.5rem;">
                            نفد من المخزون
                        </div>
                    @endif

                    <div class="warrent_images d-flex mt-3">
                        @if(isset($productdetails->warranty) && $productdetails->warranty > 0)
                            <div class="warranty-icon-container">
                                <div class="warranty-circle">
                                    {{ $productdetails->warranty }}
                                </div>
                                <div class="warranty-text">
                                    أشهر ضمان
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="product_dis">
    <div class="container">
        <div class="product_dis_inner">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="true">مواصفة</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="false" tabindex="-1">وصف</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false" tabindex="-1">آحرون</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div class="product_sp">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="2">مواصفات المنتج </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>اسم المنتج</td>
                                    <td>{{ $productdetails->name }}</td>
                                </tr>
                                @php
                                    $titles = explode(',', $productdetails->titles);
                                    $descriptions = explode(',', $productdetails->descriptions);
                                @endphp
                                @foreach($titles as $key => $title)
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>{{ $descriptions[$key] ?? '' }}</td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <h3>وصف</h3>
                       <p>{!! $productdetails->full_description !!}</p> 
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0" style="text-align: center;">
                    <h3>{{$productdetails->attachments}}</h3>
                    @if( $productdetails->attachments)
                        <a href="{{ asset('uploads/product/attachments/' . $productdetails->attachments) }}" target="_blank" class="pdf-link"><b>Click to View PDF</b></a>
                    @else
                        <p>No attachment available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product_slider light_bg_rel mt-5">
    <div class="container">
        <div class="hedding_part d-flex">
            <h2>المنتجات ذات الصلة</h2>

        </div>

        <div class="product_inner">
            <div class="row">
                @foreach ($productss as $product)
                            
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="product_card">
                            <a href="{{ url('productdetails') }}/{{ $product->id }}">
                              <div class="product_img {{ $product->stock_status == 0 ? 'out-of-stock' : '' }}">
    <img src="{{ asset('uploads/product/product_image/' . $product->product_image) }}" alt="">
    @if($product->stock_status == 0)
        <div class="out-of-stock-text">Out of Stock</div>
    @endif
</div>

                                <div class="product_con">
                                    <h3>{{$product->name}}</h3>
                                    <h6>{{$product->category_name}}</h6>
                                    <h5>{{$product->code}}</h5>
                                    @if(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "loyal")
                                        <div class="product_price">{{$product->loyal_price}}</div>
                                    @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "wholesaler")
                                        <div class="product_price">{{$product->wholesaler_price}}</div>
                                    @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "normal")
                                        <div class="product_price">{{$product->normal_price}}</div>
                                    @endif
                                </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>



            <!-- 
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="product_card">
                            <a href="">
                                <div class="product_img">
                                    <img src="./images/cardimg2.png" alt="">
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

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="product_card">
                            <a href="">
                                <div class="product_img">
                                    <img src="./images/cardimg3.png" alt="">
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

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="product_card">
                            <a href="">
                                <div class="product_img">
                                    <img src="./images/cardimg4.png" alt="">
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
                                    <div class="feature_text">
                        <h4>دعم 24/7</h4>
                        <p>الاتصال المباشر/الرسالة</p>
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
                                    <div class="feature_text">
                        <h4>الدفع الآمن</h4>
                        <p>أموالك في أمان</p>
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
                                    <div class="feature_text">
                        <h4>إرجاع خلال 24 ساعة</h4>
                        <p>ضمان استرداد الأموال بنسبة 100%</p>
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
                                    <div class="feature_text">
                        <h4>أسرع توصيل</h4>
                        <p>التوصيل خلال 24 ساعة</p>
                    </div>
            </div>

        </div>
    </div>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('script')
<script>
    $(document).ready(function() {
    $(".bg_color_p").click(function() {
        var checkbox = $(this).prev("input[type='checkbox']");
        checkbox.prop("checked", !checkbox.prop("checked")); // Toggle checkbox state
        $(this).toggleClass("selected"); // Toggle selected class
        updateSelectedColors(); // Update hidden input
    });

    function updateSelectedColors() {
        var selectedColors = [];
        $(".color-checkbox:checked").each(function() {
            selectedColors.push($(this).val());
        });

        $("#selectedColorsInput").val(selectedColors.join(',')); // Store selected colors in hidden input
        console.log("Selected Colors:", selectedColors.join(',')); // 🐞 Debugging - Check values in console
    }

    // 🎯 Ensure colors are saved before form submission
    $("#addToCartForm").submit(function() {
        updateSelectedColors(); // Update before form submission
        console.log("Submitting Colors:", $("#selectedColorsInput").val()); // 🐞 Debugging
    });
});

</script>
    {{-- <script>
        $(document).ready(function () {
            const sliderOptions = {
                gallery: true,
                item: 1,
                loop: false,
                slideMargin: 0,
                rtl: true,
                thumbItem: 6
            };

            $('#lightSlider').lightSlider(sliderOptions);
        });

    </script> --}}


    {{-- <script>
        $(document).ready(function () {
            const sliderOptions = {
                gallery: true,
                item: 1,
                loop: false,
                slideMargin: 0,
                rtl: true,
                thumbItem: 6
            };

            $('#lightSlider').lightSlider(sliderOptions);
        });

    </script> --}}

    
   
    <script>
        $(document).ready(function () {
            // Wait a bit for all resources to load
            setTimeout(function() {
                const sliderOptions = {
                    gallery: true,
                    item: 1,
                    loop: true,
                    slideMargin: 0,
                    rtl: true,
                    thumbItem: 6,
                    onBeforeStart: function (el) {
                        // Ensure images are properly sized before slider starts
                        el.find('img').each(function() {
                            $(this).css({
                                'height': '100%',
                                'object-fit': 'contain',
                                'width': '100%',
                                'max-width': '100%',
                                'max-height': '100%'
                            });
                        });
                    },
                    onAfterStart: function (el) {
                        // Additional fix after slider starts
                        el.find('img').each(function() {
                            $(this).css({
                                'height': '100%',
                                'object-fit': 'contain',
                                'width': '100%',
                                'max-width': '100%',
                                'max-height': '100%'
                            });
                        });
                    }
                };
        
                $('#lightSlider').lightSlider(sliderOptions);
        
                // Ensure images maintain proper aspect ratio
                $('#lightSlider img').css({
                    'height': '100%',
                    'object-fit': 'contain',
                    'width': '100%',
                    'max-width': '100%',
                    'max-height': '100%'
                });
        
                $(".thumbnail").click(function (e) {
                    // Prevent the default anchor behavior for lightSlider functionality
                    e.preventDefault();
                    
                    var src = $(this).attr("src");  // Get the src of the clicked image
                    console.log("Clicked image source:", src); // Debug log
        
                    var type = $(this).prop("tagName");  // Check if it's an image or video (tag name)
        
                    // Update the main display based on whether it's an image or video
                    if (type === "IMG") {
                        // Update the main display image and its wrapper
                        var newImage = '<img id="mainDisplay" src="' + src + '" alt="Product Image" style="height: 100%; object-fit: contain; width: 100%; max-width: 100%; max-height: 100%;" />';
                        var newWrapper = '<div class="image-container"><a href="' + src + '" target="_blank" class="clickable-image" title="انقر لفتح الصورة في نافذة جديدة">' + newImage + '</a></div>';
                        $(".lSSlideWrapper.usingCss li.lslide.active").html(newWrapper);
                    } else if (type === "VIDEO") {
                        var videoElement = '<video id="mainDisplay" width="640" height="360" controls autoplay style="height: 100%; object-fit: contain; width: 100%; max-width: 100%; max-height: 100%;">' +
                                            '<source src="' + src + '" type="video/mp4">' +
                                            'Your browser does not support the video tag.' +
                                            '</video>';
                        $(".lSSlideWrapper.usingCss li.lslide.active").html(videoElement);
                    }
                });
            }, 100); // Small delay to ensure everything is loaded
        });
    </script>

{{-- <script>
    $(document).ready(function () {
    const slider = $('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop: false,
        slideMargin: 0,
        rtl: true,
        thumbItem: 6
    });

    $(document).ready(function () {
    console.log("Document ready!");

    // Debugging: Check total thumbnails inside the loop
    console.log("Total Thumbnails:", $(".thumbnail").length);

    // Handle thumbnail click event using delegation
    $(document).on("click", ".thumbnail", function () {
        console.log("Thumbnail clicked!"); // Confirm event fires

        var videoUrl = $(this).attr("data-video");
        var imgSrc = $(this).attr("data-image") || $(this).attr("src");

        console.log("Clicked Source:", imgSrc, "Video URL:", videoUrl);

        if (videoUrl) {
            var videoElement = `
                <video id="mainDisplay" width="100%" height="auto" controls autoplay>
                    <source src="${videoUrl}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>`;
            $(".main-display").html(videoElement);
        } else {
            $("#mainDisplay").replaceWith(`<img id="mainDisplay" src="${imgSrc}" alt="Main Product Image" />`);
        }
    });
});

});

    </script> --}}

    
    


    <script>



        //plugin bootstrap minus and plus
        //http://jsfiddle.net/laelitenetwork/puJ6G/
        // $('.btn-number').click(function (e) {
        //     e.preventDefault();

        //     var fieldName = $(this).attr('data-field');
        //     var type = $(this).attr('data-type');
        //     var input = $("input[name='" + fieldName + "']");
        //     var currentVal = parseInt(input.val());
        //     var min = parseInt(input.attr('min'));
        //     var max = parseInt(input.attr('max'));

        //     if (!isNaN(currentVal)) {
        //         if (type == 'minus') {
        //             if (currentVal > min) {
        //                 input.val(currentVal - 1).change();
        //             }

        //             // Disable the minus button when the minimum value is reached
        //             if (currentVal - 1 <= min) {
        //                 $(this).attr('disabled', true);
        //             }
        //         } else if (type == 'plus') {
        //             if (currentVal < max) {
        //                 input.val(currentVal + 1).change();
        //             }

        //             // Disable the plus button when the maximum value is reached
        //             if (currentVal + 1 >= max) {
        //                 $(this).attr('disabled', true);
        //             }
        //         }
        //     } else {
        //         input.val();
        //     }

        //     // Enable/disable buttons based on current value
        //     if (currentVal -1 <= min) {
        //         $('.btn-number[data-type="minus"]').attr('disabled', true);
        //     } else {
        //         $('.btn-number[data-type="minus"]').attr('disabled', false);
        //     }

        //     if (currentVal +1 >= max) {
        //         $('.btn-number[data-type="plus"]').attr('disabled', true);
        //     } else {
        //         $('.btn-number[data-type="plus"]').attr('disabled', false);
        //     }
        // });
        // $('.input-number').focusin(function () {
        //     $(this).data('oldValue', $(this).val());
        // });
        // $('.input-number').change(function () {

        //     minValue = parseInt($(this).attr('min'));
        //     maxValue = parseInt($(this).attr('max'));
        //     valueCurrent = parseInt($(this).val());

        //     name = $(this).attr('name');
        //     if (valueCurrent >= minValue) {
        //         $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        //     } else {
        //         alert('Sorry, the minimum value was reached');
        //         $(this).val($(this).data('oldValue'));
        //     }
        //     if (valueCurrent <= maxValue) {
        //         $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        //     } else {
        //         alert('Sorry, the maximum value was reached');
        //         $(this).val($(this).data('oldValue'));
        //     }


        // });
        // $(".input-number").keydown(function (e) {
        //     // Allow: backspace, delete, tab, escape, enter and .
        //     if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        //         // Allow: Ctrl+A
        //         (e.keyCode == 65 && e.ctrlKey === true) ||
        //         // Allow: home, end, left, right
        //         (e.keyCode >= 35 && e.keyCode <= 39)) {
        //         // let it happen, don't do anything
        //         return;
        //     }
        //     // Ensure that it is a number and stop the keypress
        //     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        //         e.preventDefault();
        //     }
        // });

        $('.btn-number').click(function (e) {
    e.preventDefault();

    var fieldName = $(this).attr('data-field');
    var type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    var min = parseInt(input.attr('min'));
    var max = parseInt(input.attr('max'));

    if (!isNaN(currentVal)) {
        if (type === 'minus') {
            if (currentVal > min) {
                input.val(currentVal - 1).change();
            }
        } else if (type === 'plus') {
            if (currentVal < max) {
                input.val(currentVal + 1).change();
            }
        }
    } else {
        input.val(min);
    }

    // **Update button state after value change**
    updateButtonState(input, min, max);
});

// **Function to enable/disable buttons properly**
function updateButtonState(input, min, max) {
    var currentVal = parseInt(input.val());

    // Minus button disable/enable
    if (currentVal <= min) {
        $(".btn-number[data-type='minus'][data-field='" + input.attr('name') + "']").attr('disabled', true);
    } else {
        $(".btn-number[data-type='minus'][data-field='" + input.attr('name') + "']").removeAttr('disabled');
    }

    // Plus button disable/enable
    if (currentVal >= max) {
        $(".btn-number[data-type='plus'][data-field='" + input.attr('name') + "']").attr('disabled', true);
    } else {
        $(".btn-number[data-type='plus'][data-field='" + input.attr('name') + "']").removeAttr('disabled');
    }
}

// **Input change event to recheck button states**
$('.input-number').change(function () {
    var minValue = parseInt($(this).attr('min'));
    var maxValue = parseInt($(this).attr('max'));
    var valueCurrent = parseInt($(this).val());

    // Validate input value
    if (valueCurrent < minValue) {
        alert('Sorry, the minimum value was reached');
        $(this).val(minValue);
    } else if (valueCurrent > maxValue) {
        alert('Sorry, the maximum value was reached');
        $(this).val(maxValue);
    }

    // Update button state
    updateButtonState($(this), minValue, maxValue);
});

// **Prevent non-numeric values**
$(".input-number").keydown(function (e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        (e.keyCode == 65 && e.ctrlKey === true) ||
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

    </script>
@endpush
@endsection