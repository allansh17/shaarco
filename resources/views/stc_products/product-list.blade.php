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


<div class="product_list_p">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <form method="GET" action="{{ route('products') }}" id="filter-form">
                     <!-- Hidden Input for Search Query -->
                    <input type="hidden" name="query1" id="hiddenSearchQuery" value="{{ request('query1') }}">
                    <div class="filter_card">
                        <h3>فرز المنتجات</h3>

                        <!-- Brand Filters -->
                        <div class="select_filter">
    <h4>علامات تجارية</h4>
    @foreach ($brands as $brand)
        <div class="form-check-f">
            <input class="form-check-input brand-checkbox" type="checkbox" name="brands[]" 
                value="{{ $brand->id }}" id="brand-{{ $brand->id }}" 
                @if(in_array($brand->id, $selectedBrands)) checked @endif>
            <label class="form-check-label" for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
        </div>
    @endforeach
</div>

                        <!-- div class="select_filter">
                            <h4>علامات تجارية</h4>
                            @foreach ($brands as $brand)
                                <div class="form-check-f">
                                    <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand->id }}"
                                        id="brand-{{ $brand->id }}" @if(in_array($brand->id, $selectedBrands)) checked @endif>
                                    <label class="form-check-label" for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                </div>
                            @endforeach
                        </div> -->

                        <!-- Category Filters -->
                        <div class="select_filter">
                              <div id="categories-container" style="display: none;">
                            <h4>فئات</h4>
                            <!-- Categories will be dynamically loaded based on selected brands -->
                             </div>
                        </div>

                        <!-- <div class="select_filter">
                            @if(isset($subcategorys))
                                <h4>Sub Category</h4>
                                @foreach ($subcategorys as $subcategory)
                                    <div class="form-check-f">
                                        <input class="form-check-input" type="checkbox" name="subcategories[]"
                                            value="{{ $subcategory->id }}" id="subcategory-{{ $subcategory->id }}"
                                            @if(in_array($subcategory->id, $selectedsubCategories)) checked @endif>
                                        <label class="form-check-label"
                                            for="subcategory-{{ $subcategory->id }}">{{ $subcategory->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div> -->

                        <div class="select_filter">
                            
                            <div id="subcategories-container" style="display: none;">
                                @if(isset($subcategorys) && count($subcategorys) > 0)
                                    @foreach ($subcategorys as $subcategory)
                                        <div class="form-check-f">
                                            <input class="form-check-input" type="checkbox" name="subcategories[]" 
                                                value="{{ $subcategory->id }}" id="subcategory-{{ $subcategory->id }}" 
                                                @if(in_array($subcategory->id, request('subcategories', []))) checked @endif>
                                            <label class="form-check-label" for="subcategory-{{ $subcategory->id }}">
                                                {{ $subcategory->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            
            <div class="col-md-8 col-lg-9">
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
                            <button class="btn" type="button" id="searchButton1">ابحث </button>
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

                                            @if($product->stock_status == 0)
                                                <div class="text-danger mt-2">Out of Stock</div>
                                            @else
                                                <form class="add-to-cart-form mt-2" data-product-id="{{ $product->id }}">
                                                    @csrf
                                                    <div class="input-add d-flex">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="qty" disabled="disabled">
                                                                <span class="glyphicon glyphicon-minus">-</span>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="qty" class="form-control input-number" value="1" min="1" max="10">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="qty">
                                                                <span class="glyphicon glyphicon-plus">+</span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    @if(!Auth::guard('local')->check())
                                                        <a href="{{route('sign_in')}}" class="btn btn-primary mt-2 w-100">Add to Cart</a>
                                                    @else
                                                        <button type="submit" class="btn btn-primary mt-2 w-100">Add to Cart</button>
                                                    @endif
                                                </form>
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
        {{-- <script>
            // Add event listeners to the checkboxes to submit the form on change
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    // Trigger the form submission when a checkbox is clicked
                    document.getElementById('filter-form').submit();
                });
            });
        </script> --}}

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

            let categoryContainer = document.getElementById("categories-container");
            let subcategoryContainer = document.getElementById("subcategories-container");

            // Initially hide category and subcategory containers
            categoryContainer.style.display = "none";
            subcategoryContainer.style.display = "none";

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

            // If categories are selected in URL but no brands, fetch associated brands first
            if (selectedCategories.length > 0 && selectedBrands.length === 0) {
                fetchBrandsFromCategories(selectedCategories);
            }
            // If brands are selected, fetch categories
            else if (selectedBrands.length > 0) {
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
                    
                    categoryContainer.style.display = "none";
                    subcategoryContainer.style.display = "none";
                    
                    // Clear the selected arrays
                    selectedCategories = [];
                    selectedSubCategories = [];
                }

                submitForm();
            });

            // Function to fetch brands based on selected categories
            function fetchBrandsFromCategories(categories) {
                fetch("{{ route('fetch.brands') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ categories: categories })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.brands && data.brands.length > 0) {
                        // Check the brand checkboxes that are associated with the selected categories
                        data.brands.forEach(brand => {
                            $('input[name="brands[]"][value="' + brand.id + '"]').prop('checked', true);
                            selectedBrands.push(brand.id.toString());
                        });
                        
                        // Now fetch categories with the selected brands
                        fetchCategories(selectedBrands, selectedCategories);
                    }
                })
                .catch(error => console.log(error));
            }

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
                    categoryContainer.innerHTML = ""; 
                    if (data.categories.length > 0) {
                        let categoryHtml = `<h4>فئات</h4>`;
                        categoryContainer.style.display = "block";
                        
                        data.categories.forEach(category => {
                            let checked = selectedCategories.includes(category.id.toString()) ? "checked" : "";
                            categoryHtml += `
                                <div class="form-check-f">
                                    <input class="form-check-input category-checkbox" type="checkbox" name="categories[]" 
                                        value="${category.id}" id="category-${category.id}" ${checked}>
                                    <label class="form-check-label" for="category-${category.id}">
                                        ${category.name}
                                    </label>
                                </div>`;
                        });
                        categoryContainer.innerHTML = categoryHtml;

                        // Add event listeners to category checkboxes
                        document.querySelectorAll('.category-checkbox').forEach(catCheckbox => {
                            catCheckbox.addEventListener('change', function () {
                                let selectedCats = [];
                                $('input[name="categories[]"]:checked').each(function () {
                                    selectedCats.push($(this).val());
                                });

                                if (selectedCats.length > 0) {
                                    fetchSubcategories(selectedCats, selectedSubCategories);
                                } else {
                                    subcategoryContainer.style.display = "none";
                                }

                                submitForm();
                            });
                        });

                        // If categories are already selected, fetch subcategories
                        if (selectedCategories.length > 0) {
                            fetchSubcategories(selectedCategories, selectedSubCategories);
                        }
                    } else {
                        categoryContainer.style.display = "none";
                        subcategoryContainer.style.display = "none";
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
                    subcategoryContainer.innerHTML = "";
                    if (data.subcategories.length > 0) {
                        let subcategoryHtml = `<h4>Sub Category</h4>`;
                        subcategoryContainer.style.display = "block";
                        
                        data.subcategories.forEach(subcategory => {
                            let checked = selectedSubCategories.includes(subcategory.id.toString()) ? "checked" : "";
                            subcategoryHtml += `
                                <div class="form-check-f">
                                    <input class="form-check-input subcategory-checkbox" type="checkbox" name="subcategories[]" 
                                        value="${subcategory.id}" id="subcategory-${subcategory.id}" ${checked}>
                                    <label class="form-check-label" for="subcategory-${subcategory.id}">
                                        ${subcategory.name}
                                    </label>
                                </div>`;
                        });
                        subcategoryContainer.innerHTML = subcategoryHtml;

                        // Add event listeners to subcategory checkboxes
                        document.querySelectorAll('.subcategory-checkbox').forEach(subCheckbox => {
                            subCheckbox.addEventListener('change', function () {
                                submitForm();
                            });
                        });
                    } else {
                        subcategoryContainer.style.display = "none";
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

        <script>
        $(document).ready(function() {
            // Handle quantity buttons
            $(".btn-number").click(function(e) {
                e.preventDefault();
                
                let button = $(this);
                let type = button.attr("data-type");
                let input = button.closest(".input-add").find("input");
                let currentValue = parseInt(input.val());
                let min = parseInt(input.attr('min')) || 1;
                let max = parseInt(input.attr('max')) || 10;

                if (type === "plus" && currentValue < max) {
                    input.val(currentValue + 1);
                } else if (type === "minus" && currentValue > min) {
                    input.val(currentValue - 1);
                }

                // Update button states
                input.closest(".input-add").find(".btn-number[data-type='minus']").prop("disabled", input.val() <= min);
                input.closest(".input-add").find(".btn-number[data-type='plus']").prop("disabled", input.val() >= max);
            });

            // Handle form submission
            $(".add-to-cart-form").submit(function(e) {
                e.preventDefault();
                
                let form = $(this);
                let productId = form.data('product-id');
                let quantity = form.find('input[name="qty"]').val();
                
                $.ajax({
                    url: '/add_tocart/' + productId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        qty: quantity
                    },
                    success: function(response) {
                        // Show success message
                        alert('تمت اضافة الاصناف للسلة بنجاح، الرجاء استكمال ارسال الطلب في سلتك');
                        // Optionally update cart count in header if you have one
                    },
                    error: function(xhr) {
                        alert('Error adding product to cart. Please try again.');
                    }
                });
            });

            // Prevent non-numeric input
            $(".input-number").keydown(function(e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            // Trigger search on Enter key in search box
            $('#searchBox1').on('keypress', function(e) {
                if (e.which === 13) { // 13 is Enter key
                    $('#searchButton1').click();
                    e.preventDefault();
                }
            });

            // Handle search button click
            $('#searchButton1').click(function() {
                // Set the value of the hidden input to the search box value
                $('#hiddenSearchQuery').val($('#searchBox1').val());
                // Submit the filter form
                $('#filter-form').submit();
            });
        });
        </script>


    @endpush
    @endsection