@extends('layouts.stc_product.header')
@section('content')

<style>
    .out-of-stock img {
    background-color: red;
    opacity: 0.5; /* Image transparency */
    filter: grayscale(100%); /* Convert to grayscale for better effect */
    pointer-events: none; /* Disable interactions */
    content: "Out of Stock";
    color: red;
}

/* Bubble Filter Styles */
.bubble-filters-section {
    background: linear-gradient(135deg, #f8faff 0%, #e3f2fd 100%);
    padding: 30px 20px;
    margin: 20px 0;
    border-radius: 25px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

.bubble-filters-header {
    text-align: center;
    margin-bottom: 25px;
}

.bubble-filters-header h3 {
    color: #1b6392;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(27, 99, 146, 0.1);
}

.bubble-filters-subtitle {
    color: #666;
    font-size: 1rem;
    margin-bottom: 0;
}

.bubble-filter-category {
    margin-bottom: 25px;
}

.bubble-filter-category h4 {
    color: #2c3e50;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
    text-align: center;
    padding: 8px 20px;
    background: linear-gradient(135deg, #3887CD 0%, #2c6bb3 100%);
    color: white;
    border-radius: 20px;
    display: inline-block;
    margin: 0 auto 15px auto;
    display: block;
    width: fit-content;
    box-shadow: 0 4px 15px rgba(56, 135, 205, 0.3);
}

/* Bubble Container */
.bubble-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-bottom: 20px;
}

/* Individual Bubble */
.bubble-filter {
    position: relative;
    background: white;
    border-radius: 50px;
    padding: 12px 20px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 3px solid transparent;
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 60px;
    overflow: hidden;
}

.bubble-filter:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 12px 35px rgba(56, 135, 205, 0.2);
    border-color: #3887CD;
}

.bubble-filter.selected {
    background: linear-gradient(135deg, #3887CD 0%, #2c6bb3 100%);
    color: white;
    border-color: #1b6392;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 10px 30px rgba(56, 135, 205, 0.4);
}

.bubble-filter input[type="checkbox"] {
    display: none;
}

/* Bubble Image */
.bubble-image {
    width: 35px !important;
    height: 35px !important;
    border-radius: 50% !important;
    object-fit: contain !important;
    object-position: center !important;
    border: 2px solid #fff !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
    transition: transform 0.3s ease !important;
    flex-shrink: 0 !important;
    background: #ffffff !important;
    padding: 3px !important;
    display: block !important;
    max-width: 35px !important;
    max-height: 35px !important;
}

.bubble-filter:hover .bubble-image {
    transform: scale(1.1) rotate(5deg);
}

.bubble-filter.selected .bubble-image {
    border-color: #fff;
    transform: scale(1.05);
}

/* Bubble Text */
.bubble-text {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
    white-space: nowrap;
    transition: color 0.3s ease;
}

.bubble-filter.selected .bubble-text {
    color: white;
}

/* Bubble Selected Badge */
.bubble-selected-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    opacity: 0;
    transition: all 0.3s ease;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.bubble-filter.selected .bubble-selected-badge {
    opacity: 1;
    transform: scale(1.1);
}

/* Specific styles for category images */
#categories-container .bubble-image,
#categories-section .bubble-image {
    width: 35px !important;
    height: 35px !important;
    border-radius: 50% !important;
    object-fit: contain !important;
    background: #ffffff !important;
    padding: 3px !important;
    max-width: 35px !important;
    max-height: 35px !important;
}

/* Fallback for items without images */
.bubble-placeholder {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 1.2rem;
    border: 2px solid #ddd;
}

.bubble-filter.selected .bubble-placeholder {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    color: #3887CD;
    border-color: #fff;
}

/* Traditional checkboxes for subcategories */
.subcategory-checkboxes {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.subcategory-bubble {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    padding: 8px 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    color: #495057;
}

.subcategory-bubble:hover {
    border-color: #3887CD;
    background: #f8faff;
    transform: translateY(-2px);
}

.subcategory-bubble.selected {
    background: linear-gradient(135deg, #3887CD 0%, #2c6bb3 100%);
    color: white;
    border-color: #1b6392;
}

.subcategory-bubble input[type="checkbox"] {
    display: none;
}

/* Hide/Show Sections */
.bubble-filter-category.hidden {
    display: none;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .bubble-container {
        gap: 8px;
    }
    
    .bubble-filter {
        padding: 8px 12px;
        min-height: 45px;
        gap: 6px;
    }
    
    .bubble-image {
        width: 28px !important;
        height: 28px !important;
        max-width: 28px !important;
        max-height: 28px !important;
        border-width: 1.5px !important;
        padding: 2px !important;
    }
    
    .bubble-text {
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .bubble-filters-header h3 {
        font-size: 1.4rem;
    }
    
    .bubble-filter-category h4 {
        font-size: 0.95rem;
        padding: 5px 12px;
    }
    
    .bubble-selected-badge {
        width: 18px;
        height: 18px;
        font-size: 10px;
        top: -3px;
        right: -3px;
    }
}

@media (max-width: 576px) {
    .bubble-container {
        gap: 6px;
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 5px;
        scrollbar-width: thin;
    }
    
    .bubble-filter {
        padding: 6px 10px;
        min-height: 40px;
        gap: 5px;
        white-space: nowrap;
        flex-shrink: 0;
    }
    
    .bubble-image {
        width: 24px !important;
        height: 24px !important;
        max-width: 24px !important;
        max-height: 24px !important;
        border-width: 1px !important;
        padding: 2px !important;
    }
    
    .bubble-text {
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .bubble-filters-section {
        padding: 20px 15px;
    }
    
    .bubble-filters-header h3 {
        font-size: 1.2rem;
    }
    
    .bubble-filter-category h4 {
        font-size: 0.9rem;
        padding: 4px 10px;
    }
}
</style>

<div class="breadcrumb_card">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><svg width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                            d="M11.875 16.2498V12.4998C11.875 12.334 11.8092 12.1751 11.6919 12.0579C11.5747 11.9406 11.4158 11.8748 11.25 11.8748H8.75C8.58424 11.8748 8.42527 11.9406 8.30806 12.0579C8.19085 12.1751 8.125 12.334 8.125 12.4998V16.2498C8.125 16.4156 8.05915 16.5745 7.94194 16.6917C7.82473 16.809 7.66576 16.8748 7.5 16.8748H3.75C3.58424 16.8748 3.42527 16.809 3.30806 16.6917C3.19085 16.5745 3.125 16.4156 3.125 16.2498V9.02324C3.1264 8.93674 3.14509 8.8514 3.17998 8.77224C3.21486 8.69308 3.26523 8.6217 3.32812 8.5623L9.57812 2.88261C9.69334 2.77721 9.84384 2.71875 10 2.71875C10.1562 2.71875 10.3067 2.77721 10.4219 2.88261L16.6719 8.5623C16.7348 8.6217 16.7851 8.69308 16.82 8.77224C16.8549 8.8514 16.8736 8.93674 16.875 9.02324V16.2498C16.875 16.4156 16.8092 16.5745 16.6919 16.6917C16.5747 16.809 16.4158 16.8748 16.25 16.8748H12.5C12.3342 16.8748 12.1753 16.809 12.0581 16.6917C11.9408 16.5745 11.875 16.4156 11.875 16.2498Z"
                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        بيت</a></li>
                <li class="breadcrumb-item active" aria-current="page">فئة</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Bubble Filters Section -->
<div class="container">
    <div class="bubble-filters-section">
        <div class="bubble-filters-header">
            <h3>اختر فئاتك المفضلة</h3>
            <p class="bubble-filters-subtitle">اختر من العلامات التجارية والفئات لتصفية المنتجات</p>
        </div>

        <form method="GET" action="{{ route('products') }}" id="filter-form">
            <!-- Hidden Input for Search Query -->
            <input type="hidden" name="query1" id="hiddenSearchQuery" value="{{ request('query1') }}">
            
            <!-- Brands Bubbles -->
            <div class="bubble-filter-category" id="brands-section">
                <h4>العلامات التجارية</h4>
                <div class="bubble-container">
                    @foreach ($brands as $brand)
                        <div class="bubble-filter {{ in_array($brand->id, $selectedBrands) ? 'selected' : '' }}" 
                             onclick="toggleBubbleFilter(this, 'brands[]', '{{ $brand->id }}')">
                            <input type="checkbox" name="brands[]" value="{{ $brand->id }}" 
                                   id="brand-{{ $brand->id }}" 
                                   {{ in_array($brand->id, $selectedBrands) ? 'checked' : '' }}>
                            <img src="{{asset('uploads/Brands/' . $brand->image)}}" 
                                 alt="{{$brand->name}}" class="bubble-image">
                            <span class="bubble-text">{{ $brand->name }}</span>
                            <div class="bubble-selected-badge">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Categories Bubbles -->
            <div class="bubble-filter-category hidden" id="categories-section">
                <h4>الفئات</h4>
                <div class="bubble-container" id="categories-container">
                    <!-- Categories will be dynamically loaded -->
                </div>
            </div>

            <!-- Subcategories Bubbles -->
            <div class="bubble-filter-category hidden" id="subcategories-section">
                <h4>الفئات الفرعية</h4>
                <div class="subcategory-checkboxes" id="subcategories-container">
                    <!-- Subcategories will be dynamically loaded -->
                </div>
            </div>
        </form>
    </div>
</div>

<div class="product_list_p">
    <div class="container">
        <div class="row">
            
            <div class="col-12">
                <div class="product_inner">
                    <div class="Short_by">
                        <div class="d-flex">
                        <h5>فرز حسب:</h5>
                        <div class="short_by_f">
                            <select class="form-select" id="filterSelect" aria-label="Default select example"
                                onchange="filterProducts()">
                                <option value="all">All Products</option>
                                <option value="best_seller">Best Seller</option>
                                <option value="new_products">Most Popular</option>
                            </select>

                        </div>
                        </div>
                        <div class="search-custom_btn">
                            <input type="text" id="searchBox1" class="form-control" placeholder="ابحث عن أي شيء..." value="{{ request('query1') }}" autocomplete="off">
                            <button class="btn" type="button" id="searchButton1">يبحث </button>
                        </div>
                    </div>
                    <div class="row" id="productTable">
                        @if($allProducts->isEmpty())
                            <div class="col-12">
                                <h4 class="text-center">No product found</h4>
                            </div>
                        @else
                        @foreach($allProducts as $key => $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 product-card" data-seller="{{ $product->best_seller }}">
                                <div class="product_card">
                                    <a href="{{ route('productdetails', $product->id) }}">
                                     <div class="product_img {{ $product->stock_status == 0 ? 'out-of-stock' : '' }}">
                            <img src="{{ asset('uploads/product/product_image/' . $product->product_image) }}" alt="">
                        </div>
                                        <div class="product_con">
                                            <h3>{{ $product->name }}</h3>
                                            <h5>{{ $product->code }}</h5>

                                            @if(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "loyal")
                                                <div class="product_price">{{ $product->loyal_price }}</div>
                                            @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "wholesaler")
                                                <div class="product_price">{{ $product->wholesaler_price }}</div>
                                            @elseif(Auth::guard('local')->check() && Auth::guard('local')->user()->user_type == "normal")
                                                <div class="product_price">{{ $product->normal_price }}</div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach


                          
                        @endif
                    </div>
                    <!-- Pagination Links -->


                    <!-- </div>

                 <div class="pagination_list">
                    <nav aria-label="Page navigation example">
                         <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true"><svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.04248 12H20.5425" stroke="#3887CD" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.7925 5.25L20.5425 12L13.7925 18.75" stroke="#3887CD"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true"><svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.5425 12H4.04248" stroke="#3887CD" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10.7925 5.25L4.04248 12L10.7925 18.75" stroke="#3887CD"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>
                            </li>
                        </ul> 
                        {{ $allProducts->links() }} 
                    </nav>
                </div> -->

                    <div class="pagination_list">
                        {{ $allProducts->links('pagination::bootstrap-4') }}
                    </div>

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
    <!-- End About Section -->
    <!-- Dropdown Menu -->
    <!-- <select class="form-select" id="filterSelect" aria-label="Default select example" onchange="filterTable()">
    <option value="all">All Products</option>
    <option value="best_seller">Best Seller</option>
</select> -->
    <!--  -->

    <!-- JavaScript -->
    @push('script')

        <script>
            // Bubble Filter Toggle Function
            function toggleBubbleFilter(element, inputName, value) {
                const checkbox = element.querySelector('input[type="checkbox"]');
                const isSelected = element.classList.contains('selected');
                
                if (isSelected) {
                    element.classList.remove('selected');
                    checkbox.checked = false;
                } else {
                    element.classList.add('selected');
                    checkbox.checked = true;
                }
                
                // Trigger change event to update filters
                $(checkbox).trigger('change');
            }

            // Subcategory Bubble Toggle Function
            function toggleSubcategoryBubble(element, value) {
                const checkbox = element.querySelector('input[type="checkbox"]');
                const isSelected = element.classList.contains('selected');
                
                if (isSelected) {
                    element.classList.remove('selected');
                    checkbox.checked = false;
                } else {
                    element.classList.add('selected');
                    checkbox.checked = true;
                }
                
                // Trigger form submission
                submitForm();
            }

            function filterProducts() {
                const filterValue = document.getElementById('filterSelect').value;
                const productCards = document.querySelectorAll('#productTable .product-card');

                productCards.forEach((card) => {
                    const isBestSeller = card.getAttribute('data-seller') === 'yes';

                    if (filterValue === 'all') {
                        card.style.display = ''; // Show all
                    } else if (filterValue === 'best_seller' && isBestSeller) {
                        card.style.display = ''; // Show only best sellers
                    } else if (filterValue === 'new_products') {
                        // Add logic here for "Most Popular" if needed
                        card.style.display = ''; // Example: Show all (You can add specific logic for popular products)
                    } else {
                        card.style.display = 'none'; // Hide others
                    }
                });
            }

        </script>

        <script>
        $(document).ready(function () {
            let urlParams = new URLSearchParams(window.location.search);
            let selectedBrands = [];
            let selectedCategories = [];
            let selectedSubCategories = [];

            // Extract URL parameters
            urlParams.forEach((value, key) => {
                if (key.startsWith("brands")) {
                    selectedBrands.push(value);
                }
                if (key.startsWith("categories")) {
                    selectedCategories.push(value);
                }
                if (key.startsWith("subcategories")) {
                    selectedSubCategories.push(value);
                }
            });

            // Initially hide category and subcategory containers (they have 'hidden' class by default)

            // Check URL path for brand ID (header dropdown selection)
            let pathBrandId = "{{ request('id') }}";
            if (pathBrandId && !selectedBrands.includes(pathBrandId)) {
                selectedBrands.push(pathBrandId);
            }

            // Check corresponding brand checkboxes based on URL
            $('input[name="brands[]"]').each(function () {
                if (selectedBrands.includes($(this).val()) || $(this).val() === pathBrandId) {
                    $(this).prop("checked", true);
                }
            });

            // If brands are selected, fetch categories
            if (selectedBrands.length > 0) {
                fetchCategories(selectedBrands, selectedCategories);
            }

            // Brand checkbox change event
            $('input[name="brands[]"]').change(function () {
                selectedBrands = [];
                $('input[name="brands[]"]:checked').each(function () {
                    selectedBrands.push($(this).val());
                });

                if (selectedBrands.length > 0) {
                    fetchCategories(selectedBrands, selectedCategories);
                } else {
                    // Clear category and subcategory selections when no brands are selected
                    $('input[name="categories[]"]').prop('checked', false);
                    $('input[name="subcategories[]"]').prop('checked', false);
                    
                    document.getElementById("categories-section").classList.add("hidden");
                    document.getElementById("subcategories-section").classList.add("hidden");
                    
                    // Clear the selected arrays
                    selectedCategories = [];
                    selectedSubCategories = [];
                }

                submitForm();
            });

            // Function to fetch categories based on selected brands
            function fetchCategories(brands, selectedCategories) {
                fetch("{{ route('fetch.categories') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ brands: brands })
                })
                .then(response => response.json())
                .then(data => {
                    const categoriesGrid = document.getElementById("categories-container");
                    const categoriesSection = document.getElementById("categories-section");
                    categoriesGrid.innerHTML = ""; 
                    if (data.categories.length > 0) {
                        categoriesSection.classList.remove("hidden");
                        
                        data.categories.forEach(category => {
                            let checked = selectedCategories.includes(category.id.toString()) ? "checked" : "";
                            let selectedClass = checked ? "selected" : "";
                            
                            let categoryHtml = `
                                <div class="bubble-filter ${selectedClass}" 
                                     onclick="toggleBubbleFilter(this, 'categories[]', '${category.id}')">
                                    <input type="checkbox" name="categories[]" value="${category.id}" 
                                           id="category-${category.id}" ${checked}>
                                    <img src="{{asset('uploads/Category')}}/${category.image}" 
                                         alt="${category.name}" class="bubble-image">
                                    <span class="bubble-text">${category.name}</span>
                                    <div class="bubble-selected-badge">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>`;
                            categoriesGrid.innerHTML += categoryHtml;
                        });

                        // Add event listeners to category checkboxes
                        document.querySelectorAll('input[name="categories[]"]').forEach(catCheckbox => {
                            catCheckbox.addEventListener('change', function () {
                                let selectedCats = [];
                                $('input[name="categories[]"]:checked').each(function () {
                                    selectedCats.push($(this).val());
                                });

                                if (selectedCats.length > 0) {
                                    fetchSubcategories(selectedCats, selectedSubCategories);
                                } else {
                                    document.getElementById("subcategories-section").classList.add("hidden");
                                }

                                submitForm();
                            });
                        });

                        // If categories are already selected, fetch subcategories
                        if (selectedCategories.length > 0) {
                            fetchSubcategories(selectedCategories, selectedSubCategories);
                        }
                    } else {
                        categoriesSection.classList.add("hidden");
                        document.getElementById("subcategories-section").classList.add("hidden");
                    }
                })
                .catch(error => console.log(error));
            }

            // Function to fetch subcategories based on selected categories
            function fetchSubcategories(categories, selectedSubCategories) {
                fetch("{{ route('fetch.subcategories') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ categories: categories })
                })
                .then(response => response.json())
                .then(data => {
                    const subcategoriesList = document.getElementById("subcategories-container");
                    const subcategoriesSection = document.getElementById("subcategories-section");
                    subcategoriesList.innerHTML = "";
                    if (data.subcategories.length > 0) {
                        subcategoriesSection.classList.remove("hidden");
                        
                        data.subcategories.forEach(subcategory => {
                            let checked = selectedSubCategories.includes(subcategory.id.toString()) ? "checked" : "";
                            let selectedClass = checked ? "selected" : "";
                            let subcategoryHtml = `
                                <div class="subcategory-bubble ${selectedClass}" onclick="toggleSubcategoryBubble(this, '${subcategory.id}')">
                                    <input type="checkbox" name="subcategories[]" value="${subcategory.id}" id="subcategory-${subcategory.id}" ${checked}>
                                    ${subcategory.name}
                                </div>`;
                            subcategoriesList.innerHTML += subcategoryHtml;
                        });

                        // Add event listeners to subcategory checkboxes
                        document.querySelectorAll('.subcategory-bubble').forEach(subCheckbox => {
                            subCheckbox.addEventListener('change', function () {
                                submitForm();
                            });
                        });
                    } else {
                        subcategoriesSection.classList.add("hidden");
                    }
                })
                .catch(error => console.log(error));
            }

            // Form auto-submit function
            function submitForm() {
                $("#filter-form").submit();
            }

            // Category and subcategory change events (for dynamically added elements)
            $(document).on("change", 'input[name="categories[]"], input[name="subcategories[]"]', function () {
                submitForm();
            });
        });
        </script>


    @endpush
    @endsection