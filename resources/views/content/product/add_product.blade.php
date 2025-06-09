@extends('layouts.contentNavbarLayout')
@section('title', 'Product Management')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    .upload-item__size {
        display: none !important;
    }
    <style>
    /* Placeholder text ko light gray banane ke liye */
    .select2-container--default .select2-selection__placeholder {
        color: #aaa !important; /* Light Gray */
        font-style: italic;/*  Optional: Italic for differentiation*/ 
    }
</style>
</style>
<div class="app-ecommerce">
    <!-- Add Product -->
    <div class="card-header justify-content-between d-flex">

        @if(isset($product_detail))
            <h4 class="">Edit Product</h4>
        @else
            <h4 class="">Add Product</h4>
        @endif
        <div class="pull-right mb-3">
            <a class="btn btn-primary" href="{{ url('product') }}">
                <i class='bx bx-list-ul '></i> List of Product
            </a>
        </div>
    </div>
    <form id="addEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="id" placeholder="" name='id'
            value="{{ isset($product_detail) ? $product_detail->id : '0'}}">
        @csrf
        <div class="row">
            <!-- First column-->
            <div class="col-12 col-lg-8">
                <!-- Product Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product information</h5>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label" for="ecommerce-product-name">Product Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ecommerce-product-name"
                                    placeholder="Product Name" name="name" aria-label="Product name"
                                    value="{{ isset($product_detail) ? $product_detail->name : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="code">Product Code<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="code" placeholder=" Product Code"
                                    name="code" aria-label=" Product URL"
                                    value="{{ isset($product_detail) ? $product_detail->code : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!-- <div class="col-sm-6 mt-2">
                                <label class="form-label" for="brands">Brands<span class="text-danger">*</span></label>
                                <select class="form-control form-select" id="brands" name="brands">
                                    <option value="" selected disabled>Select Brands</option>
                                    @foreach($brands as $brands_data)
                                        <option value="{{$brands_data->id}}" {{ isset($product_detail) && $product_detail->brands == $brands_data->id ? 'selected' : '' }}>
                                            {{$brands_data->name}}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                         <div class="col-sm-6 mt-2">
    <label class="form-label" for="category">Categories<span class="text-danger">*</span></label>
    <select class="form-control select2-category" id="category" name="category[]" multiple="multiple">
        @foreach($category as $category_data)
            <option value="{{$category_data->id}}" 
                {{ isset($product_detail) && in_array($category_data->id, explode(',', $product_detail->category_id)) ? 'selected' : '' }}>
                {{$category_data->name}} 
            </option>
        @endforeach
    </select>
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
</div>
 -->

 <div class="col-sm-6 mt-2">
    <label class="form-label" for="brands">Brands<span class="text-danger">*</span></label>
    <select class="form-control form-select" id="brands" name="brands">
        <option value="" selected disabled>Select Brands</option>
        @foreach($brands as $brands_data)
            <option value="{{$brands_data->id}}" 
                {{ isset($product_detail) && $product_detail->brands == $brands_data->id ? 'selected' : '' }}>
                {{$brands_data->name}}
            </option>
        @endforeach
    </select>
</div>

<div class="col-sm-6 mt-2">
    <label class="form-label" for="category">Categories<span class="text-danger">*</span></label>
    <select class="form-control select2-category" id="category" name="category[]" multiple="multiple">
        @foreach($category as $category_data)
            <option value="{{$category_data->id}}">
                {{$category_data->name}}
            </option>
        @endforeach
    </select>
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
</div>

<div class="col-sm-6 mt-2">
    <label class="form-label" for="subcategory">Subcategories</label>
    <select class="form-control select2-subcategory" id="subcategory" name="subcategory[]" multiple="multiple">
        @foreach($subcategory as $subcategory_data)
            <option value="{{$subcategory_data->id}}" 
                {{ isset($product_detail) && in_array($subcategory_data->id, explode(',', $product_detail->subcategory_id)) ? 'selected' : '' }}>
                {{$subcategory_data->name}}
            </option>
        @endforeach
    </select>
</div>
                            <div class="col-sm-6">
                                <label class="form-label" for="origin">Origin<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="origin" placeholder="ORIGIN" name="origin"
                                    aria-label="Origin "
                                    value="{{ isset($product_detail) ? $product_detail->origin : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="measurement">MEASUREMENTS<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="measurement" placeholder="Measurement"
                                    name="measurement" aria-label="Measurement "
                                    value="{{ isset($product_detail) ? $product_detail->measurements : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="warranty">WARRANTY (number of months)<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="warranty"
                                    placeholder="WARRANTY (number of months)" name="warranty" aria-label="Warranty "
                                    value="{{ isset($product_detail) ? $product_detail->warranty : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label class="form-label" for="ecommerce-product-name">Product Image<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="product_intro_image"
                                    placeholder="Product Image" name="product_intro_image" aria-label="Image/Vedio">


                                <small>Supported formats: JPG,JPEG, PNG, GIF.</small>

                            </div>
                            @if(isset($product_detail))
                                @unless(isset($product_detail->id))
                                    <div class="col-sm-6 mt-2 image-border-shap d-none mb-3" id="image-border-shap">
                                        @if(isset($product_detail->product_image))
                                            @if(str_contains($product_detail->product_image, '.mp4') || str_contains($product_detail->product_image, '.webm'))
                                                <video width="100" height="100" controls>
                                                    <source
                                                        src="{{ asset('uploads/product/product_image/' . $product_detail->product_image) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="{{ asset('uploads/product/product_image/' . $product_detail->product_image) }}"
                                                    alt="Product Image">
                                            @endif
                                        @endif
                                    </div>
                                @endunless

                                @if(isset($product_detail->id))
                                    <div class="col-sm-6 mt-2 image-border-shap mb-3" id="image-border-shap">
                                        @if(isset($product_detail->product_image))
                                            @if(str_contains($product_detail->product_image, '.mp4') || str_contains($product_detail->product_image, '.webm'))
                                                <video width="100" height="100" controls>
                                                    <source
                                                        src="{{ asset('uploads/product/product_image/' . $product_detail->product_image) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="{{ asset('uploads/product/product_image/' . $product_detail->product_image) }}"
                                                    alt="Product Image">
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            @endif
                            {{--<div class="col-sm-6 mt-2">
                                <label for="colors">Select Colors</label>
                                <div class="form-check">
                                    @php
                                        $selectedColors = explode(',', $product_detail->color ?? ''); // Convert string to array
                                    @endphp
                                    @foreach($colors as $color)
                                        <div class="form-check">
                                            <input 
                                                type="checkbox" 
                                                name="colors[]" 
                                                value="{{ $color->id }}" 
                                                id="color_{{ $color->id }}" 
                                                class="form-check-input"
                                                {{ in_array($color->id, $selectedColors) ? 'checked' : '' }}> 
                                            <label class="form-check-label" for="color_{{ $color->id }}">
                                                {{ $color->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>     --}} 
                            

                            <div class="col-sm-12 mt-2">
                                <div id="dynamic-fields">
                                    @php
                                        // Exploding titles and descriptions into arrays
                                        $titles = explode(',', $product_detail['titles'] ?? '');
                                        $descriptions = explode(',', $product_detail['descriptions'] ?? '');
                                    @endphp
                            
                                    <!-- Loop through titles and descriptions to show as input fields -->
                                    @foreach($titles as $index => $title)
                                        <div class="field-group mb-2 p-2 border rounded">
                                            <label>Title & Description</label>
                                            <input type="text" class="form-control mb-2" name="titles[]" value="{{ $title }}" required>
                                            <textarea class="form-control mb-2" name="descriptions[]" required>{{ $descriptions[$index] ?? '' }}</textarea>
                                            @if($index > 0) <!-- Display remove button for all but the first title-description set -->
                                                <button type="button" class="btn btn-danger btn-sm remove-btn">Remove</button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Button to Add New Fields -->
                                <button class="btn btn-info mt-2" type="button" id="add-field">Add New Title & Description</button>
                            </div>
                            {{-- <div class="col-sm-12 mt-2">
                                <label class="form-label" for="summary">Summary<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="summary" placeholder="Summary" name="summary"
                                    aria-label="summary">{{ isset($product_detail) ? $product_detail->summary : ''}}</textarea>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div> --}}


                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label" for="ecommerce-product-sku">SKU<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ecommerce-product-sku" placeholder="SKU"
                                    name="sku" aria-label="Product SKU"
                                    value="{{ isset($product_detail) ? $product_detail->sku : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="ecommerce-product-attachments">Attachments<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="attachments" placeholder="Attachements"
                                    name="attachments" aria-label="Product Attachments">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                                @if(isset($product_detail))
                                    @unless(isset($product_detail->id))
                                        <div class="col-sm-6 mt-2 image-border-shap d-none mb-3" id="image-border-shap">
                                            @if(isset($product_detail->attachments))
                                                @if(str_contains($product_detail->attachments, '.pdf'))
                                                    <a href="{{ asset('uploads/product/attachments/' . $product_detail->attachments) }}"
                                                        target="_blank">
                                                        <i class="menu-icon tf-icons bx bxs-file-pdf"
                                                            style="color: red; font-size: 80px;"></i>
                                                    </a>
                                                @elseif(str_contains($product_detail->attachments, ['.jpg', '.jpeg', '.png', '.gif']))
                                                    <img src="{{ asset('uploads/product/attachments/' . $product_detail->attachments) }}"
                                                        alt="Attachements">
                                                @else
                                                    <a href="{{ asset('uploads/product/attachments/' . $product_detail->attachments) }}"
                                                        target="_blank">
                                                        Download Document
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    @endunless

                                    @if(isset($product_detail->id))
                                        <div class="col-sm-6 mt-2 image-border-shap mb-3" id="image-border-shap">
                                            @if(isset($product_detail->attachments))
                                                @if(str_contains($product_detail->attachments, '.pdf'))
                                                    <a href="{{ asset('uploads/product/attachments/' . $product_detail->attachments) }}"
                                                        target="_blank">
                                                        <i class="menu-icon tf-icons bx bxs-file-pdf"
                                                            style="color: red; font-size: 80px;"></i>
                                                    </a>
                                                @elseif(preg_match('/\.(jpg|jpeg|png|gif)$/i', $product_detail->attachments))
                                                    <img src="{{ asset('uploads/product/attachments/' . $product_detail->attachments) }}"
                                                        alt="Attachments">
                                                @else
                                                    <a href="{{ asset('uploads/product/attachments/' . $product_detail->attachments) }}"
                                                        target="_blank">
                                                        Download Document
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    @endif

                                @endif

                            </div>
                            <!-- <div class="col-sm-6 mt-2">
                                <label class="form-label" for="ecommerce-stock-quantity">Stock Quantity<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="ecommerce-stock-quantity"
                                    placeholder="Stock Quantity" name="stock_quantity" aria-label="Stock Quantity"
                                    value="{{ isset($product_detail) ? $product_detail->stock_quantity : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div> -->

                            <div class="col-sm-6 mt-2">
                                <label class="form-label" for="bestseller">Best Seller<span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-select" id="category" name="best_seller">
                                    <option value=""></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>


                                </select>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <label class="form-label" for="newproduct">New Products<span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-select" id="category" name="new_products">
                                    <option value=""></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>


                                </select>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                            <label class="form-label" for="newproduct">Most Populer<span
                                    class="text-danger">*</span></label>
                            <select class="form-control form-select" id="category" name="most_populer">
                                <option value=""></option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>


                            </select>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        </div>

                        


                        <div
                            class="d-flex justify-content-between align-items-center border-top border-bottom pb-3 pt-3 mb-3">
                            <span class="mb-0 h6">In stock</span>
                            <div class="w-25 d-flex justify-content-end">
                                <label class="switch switch-primary switch-sm me-4 pe-2">

                                    @if(isset($product_detail) && !empty($product_detail))
                                        <input type="checkbox" class="switch-input" name="stock_status" {{ isset($product_detail) && $product_detail->stock_status == 1 ? 'checked' : '' }}>
                                    @else
                                        <input type="checkbox" class="switch-input" name="stock_status" checked>
                                    @endif

                                    <span class="switch-toggle-slider">
                                        <span class=" switch-on  switch-off">
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>



                        <!-- Description -->
                        <div class="form-group" id='editor'>
                            <label class="form-label editor">Full Description <span class="text-muted"></span><span
                                    class="text-danger">*</span></label>
                            <textarea id="full_description" placeholder="Full Description" class="form-control"
                                name="description"
                                value="{{ isset($product_detail) ? $product_detail->full_description : ''}}">{{ isset($product_detail) ? $product_detail->full_description : ''}}</textarea>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>

                        {{-- Overview --}}
                        <div class="form-group mt-2" id='editor'>
                            <label class="form-label editor">Overview<span class="text-muted"></span><span
                                    class="text-danger">*</span></label>
                            <textarea id="overview" placeholder="Product Overview" class="form-control"
                                name="overview"
                                value="{{ isset($product_detail) ? $product_detail->overview : ''}}">{{ isset($product_detail) ? $product_detail->overview : ''}}</textarea>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Media -->


                {{-- <div class="">
                    <input type="hidden" id="sliderImages" name="sliderImages[]" />
                    <div class="thumb_nail position-relative">
                        <p>Overview Images/Videos</p>
                        <div class="dropzone d-flex flex-wrap" id="slider">
                        </div>
                        <div class="dropzone-uploads__inner" id="previews1">
                            <div class="upload-item m-0" id="uploadItemTemplate1" data-dz-name>
                                <span class="upload-item__thumb">
                                    <img class="w-100" data-dz-thumbnail />
                                </span>
                                <strong class="upload-item__error-message" data-dz-errormessage></strong>
                                <div class="progress" role="progressbar">
                                    <div class="progress__inner" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                                <span class="upload-item__size" data-dz-size></span>
                                <button class="btn btn-sm btn-danger remove-btn" data-dz-remove>
                                    <i class='bx bxs-message-rounded-x'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="">
                    <input type="hidden" id="sliderImages" name="sliderImages[]" />
                    <div class="thumb_nail position-relative">
                        <p>Overview Images/Videos</p>
                        <div class="dropzone d-flex flex-wrap" id="slider"></div>
                        <div class="dropzone-uploads__inner" id="previews1">
                            <div class="upload-item m-0" id="uploadItemTemplate1" data-dz-name>
                                <span class="upload-item__thumb">
                                    <img class="w-100" data-dz-thumbnail />
                                </span>
                                <strong class="upload-item__error-message" data-dz-errormessage></strong>
                                <div class="progress" role="progressbar">
                                    <div class="progress__inner" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                                <span class="upload-item__size" data-dz-size></span>
                                <button class="btn btn-sm btn-danger remove-btn" data-dz-remove>
                                    <i class='bx bxs-message-rounded-x'></i>
                                </button>
                            </div>
                        </div>
                
                        <!-- Show Validation Errors -->
                        @if ($errors->has('sliderImages'))
                            <div class="text-danger">
                                {{ $errors->first('sliderImages') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /Media -->
                <div class="">
                    <input type="hidden" id="listing_images" name="listing_images[]" />
                    <div class="thumb_nail position-relative">
                        <p>Product Listing Images</p>
                        <div class="dropzone d-flex flex-wrap" id="product_listing">
                        </div>
                        <div class="dropzone-uploads__inner" id="productPreviews">
                            <div class="upload-item m-0" id="upload_listing_images" data-dz-name>
                                <span class="upload-item__thumb">
                                    <img class="w-100" data-dz-thumbnail />
                                </span>
                                <strong class="upload-item__error-message" data-dz-errormessage></strong>
                                <div class="progress" role="progressbar">
                                    <div class="progress__inner" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                                <span class="upload-item__size" data-dz-size></span>
                                <button class="btn btn-sm btn-danger remove-btn" data-dz-remove>
                                    <i class='bx bxs-message-rounded-x'></i>
                                </button>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>

                <!-- /Media -->
            </div>

            <div class="col-12 col-lg-4">
                <!-- Pricing Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Pricing</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="mrp">Normal User price</label>
                            <input type="number" class="form-control" placeholder="M.R.P " id="normal_price"
                                name="normal_price" aria-label="M.R.P"
                                value="{{ isset($product_detail) ? $product_detail->normal_price : ''}}">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mrp">Loyal User price</label>
                            <input type="number" class="form-control" placeholder="M.R.P " id="loyal_price"
                                name="loyal_price" aria-label="M.R.P"
                                value="{{ isset($product_detail) ? $product_detail->loyal_price : ''}}">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mrp">WholeSaler price</label>
                            <input type="number" class="form-control" placeholder="M.R.P " id="wolesales_price"
                                name="wolesales_price" aria-label="M.R.P"
                                value="{{ isset($product_detail) ? $product_detail->wholesaler_price : ''}}">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Pricing Card -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Meta information</h5>
                        </div>
                        <div class="card-body">
                            <!-- Meta Title -->
                            <div class="mb-3 col">
                                <label class="form-label mb-1" for="ecommerce-meta-title">Meta Title<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ecommerce-meta-title"
                                    placeholder="Meta Title" name="meta_title" aria-label="Meta Title"
                                    value="{{ isset($product_detail) ? $product_detail->meta_title : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!-- /Meta Title -->
                            <!-- Meta Keyword -->
                            <div class="mb-3 col">
                                <label class="form-label mb-1" for="ecommerce-meta-keyword">Meta Keyword<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ecommerce-meta-keyword"
                                    placeholder="Meta Keyword" name="meta_keyword" aria-label="Meta Keyword"
                                    value="{{ isset($product_detail) ? $product_detail->meta_keyword : ''}}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!-- /Meta Keyword -->
                            <!-- Meta Description -->
                            <div class="mb-3 col">
                                <label class="form-label mb-1" for="ecommerce-meta-description">Meta Description<span
                                        class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="ecommerce-meta-description"
                                    placeholder="Meta Description" name="meta_description"
                                    aria-label="Meta Description">{{ isset($product_detail) ? $product_detail->meta_description : ''}}</textarea>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!-- /Meta Description -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
        <!-- Submit Button -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary submit_button">Save Product</button>
        </div>
        <!-- /Submit Button -->
    </form>
</div>



<!-- Custom Bootstrap Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Removal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove this static file?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmRemove">Confirm</button>
            </div>
        </div>
    </div>
</div>
<style>
    .dropzone {
        border: 2px dashed #007bff;
        border-radius: 5px;
        padding: 20px;
    }

    .upload-item {
        margin: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .ps_section_mblock {
        display: flex;
        gap: 73px;
        border-top: 1px solid rgba(255, 255, 255, 20%);
        padding: 18px 0px;
    }

    .ps_sectiond_sblock {
        width: 30%;
    }

    .psectiond_cblock {
        width: 70%;
    }
</style>

@endsection
@push('scripts')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    {{-- <script>
        $(document).ready(function () {
            // Add new fields
            $("#add-field").click(function () {
                let newField = `
                    <div class="field-group mb-2 p-2 border rounded">
                        <input type="text" class="form-control mb-2" name="titles[]" placeholder="Enter Title" required>
                        <textarea class="form-control mb-2" name="descriptions[]" placeholder="Enter Description" required></textarea>
                        <button type="button" class="btn btn-danger btn-sm remove-btn">Remove</button>
                    </div>`;
                $("#dynamic-fields").append(newField);
            });
    
            // Remove a field
            $(document).on("click", ".remove-btn", function () {
                $(this).closest(".field-group").remove();
            });
        });
    </script> --}}

    <script>
        $(document).ready(function () {
            // Add new fields dynamically
            $("#add-field").click(function () {
                let newField = `
                    <div class="field-group mb-2 p-2 border rounded">
                        <input type="text" class="form-control mb-2" name="titles[]" placeholder="Enter Title" required>
                        <textarea class="form-control mb-2" name="descriptions[]" placeholder="Enter Description" required></textarea>
                        <button type="button" class="btn btn-danger btn-sm remove-btn">Remove</button>
                    </div>`;
                $("#dynamic-fields").append(newField);
            });
    
            // Remove a dynamically added field
            $(document).on("click", ".remove-btn", function () {
                $(this).closest(".field-group").remove();
            });
        });
    </script>

    <script>
        Dropzone.autoDiscover = false; // Prevent Dropzone from auto-initializing

        // Select the preview template and remove it from the DOM
        var previewNode1 = document.querySelector("#upload_listing_images");
        previewNode1.id = "";
        var previewTemplate = previewNode1.parentNode.innerHTML;
        previewNode1.parentNode.removeChild(previewNode1);

        // Initialize Dropzone
        var seafDropzone_listing = new Dropzone("#product_listing", {
            url: '/UploadFile', // URL for uploading files
            maxFiles: 5, // Maximum number of files
            maxFilesize: 20, // Maximum file size in MB
            acceptedFiles: ".jpg, .jpeg, .png, .gif, .mp4, .mov, .avi", // Allowed file types
            previewTemplate: previewTemplate, // Use custom preview template
            autoQueue: true, // Automatically queue files
            init: function () {
                var _this = this;

                // Replace with your static files data
                var product_listing_images = @json($product_listing_images ?? '');

                if (product_listing_images && product_listing_images.length > 0) {
                    product_listing_images.forEach(function (file) {
                        var mockFile = {
                            name: file.name,
                            size: file.size
                        };
                        _this.emit("addedfile", mockFile);
                        if (file.url.endsWith(".mp4") || file.url.endsWith(".mov") || file.url.endsWith(".avi")) {
                            var videoPreview = document.createElement("video");
                            videoPreview.width = 320;
                            videoPreview.height = 240;
                            videoPreview.controls = true;
                            videoPreview.src = file.url;
                            mockFile.previewElement.appendChild(videoPreview);
                        } else {
                            _this.emit("thumbnail", mockFile, file.url);
                        }
                        _this.emit("complete", mockFile);
                    });
                }

                this.on("addedfile", function (file) {
                    if (file.type.match(/video\/.*/)) {
                        var videoPreview = document.createElement("video");
                        videoPreview.width = 320;
                        videoPreview.height = 240;
                        videoPreview.controls = true;
                        videoPreview.src = URL.createObjectURL(file);
                        file.previewElement.appendChild(videoPreview);
                    } else {
                        // Adjust the preview settings for images
                        this.options.thumbnailWidth = 60;
                        this.options.thumbnailHeight = 60;
                        this.options.resizeWidth = 800;
                        this.options.resizeHeight = 600;
                        this.options.resizeMimeType = 'image/jpeg';
                        this.options.resizeQuality = 0.8;
                    }
                });

                this.on("totaluploadprogress", function (progress) {
                    var progresElement = document.querySelector(".progress .progress__inner");
                    if (progresElement) {
                        progresElement.style.width = progress + "%";
                    }
                });

                this.on("removedfile", function (file) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will delete this item!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var url_up = "{{ url('product/listing_img_remove') }}";
                            var fileName = encodeURIComponent(file.name);
                            var fullUrl = url_up + '?list_remove=' + fileName;

                            $.ajax({
                                type: "GET",
                                url: fullUrl,
                                success: function (data) {
                                    //  console.log("File removed successfully:", data);
                                    var response = JSON.parse(data);
                                    toastr.success(response.msg);
                                    setTimeout(function () {
                                        //location.reload();
                                    }, 3000);

                                },
                                error: function (xhr, status, error) {
                                    console.error("Error removing file:", status, error);
                                }
                            });
                        }
                    });
                });
            }
        });

        // Initialize Sortable.js for the Dropzone preview container
        document.addEventListener('DOMContentLoaded', function () {
            var sortable = Sortable.create(document.querySelector("#product_listing"), {
                animation: 150,
                onEnd: function (evt) {
                    console.log('Sorting complete');
                }
            });
        });




        var seafDropzone1 = '';
        Dropzone.autoDiscover = false;
        var previewNode1 = document.querySelector("#uploadItemTemplate1");
        previewNode1.id = "";

        var previewTemplate = previewNode1.parentNode.innerHTML;
        previewNode1.parentNode.removeChild(previewNode1);

        seafDropzone1 = new Dropzone("#slider", {
            url: '/UploadFile',
            maxFiles: 5, // restrict to 5 files
            maxFilesize: 20, // in MB
            acceptedFiles: ".jpg, .jpeg, .png, .gif, .mp4, .mov, .avi", // restrict file types
            previewTemplate: previewTemplate,
            init: function () {
                var _this = this;

                // Static files (Replace with your own static files data)
                var productSliders = @json($productSliders ?? '');

                if (productSliders && productSliders.length > 0) {
                    productSliders.forEach(function (file) {
                        var mockFile = {
                            name: file.name,
                            size: file.size
                        };
                        _this.emit("addedfile", mockFile);
                        if (file.url.endsWith(".mp4") || file.url.endsWith(".mov") || file.url.endsWith(".avi")) {
                            var videoPreview = document.createElement("video");
                            videoPreview.width = 320;
                            videoPreview.height = 240;
                            videoPreview.controls = true;
                            videoPreview.src = file.url;
                            mockFile.previewElement.appendChild(videoPreview);
                        } else {
                            _this.emit("thumbnail", mockFile, file.url);
                        }
                        _this.emit("complete", mockFile);
                    });
                }

                this.on("addedfile", function (file) {
                    if (file.type.match(/video\/.*/)) {
                        var videoPreview = document.createElement("video");
                        videoPreview.width = 320;
                        videoPreview.height = 240;
                        videoPreview.controls = true;
                        videoPreview.src = URL.createObjectURL(file);
                        file.previewElement.appendChild(videoPreview);
                    } else {
                        this.options.autoQueue = true;
                        this.options.previewsContainer = "#previews1";
                        this.options.thumbnailWidth = 60;
                        this.options.thumbnailHeight = 60;
                        this.options.resizeWidth = 800;
                        this.options.resizeHeight = 600;
                        this.options.resizeMimeType = 'image/jpeg';
                        this.options.resizeQuality = 0.8;
                    }
                });

                this.on("totaluploadprogress", function (progress) {
                    var progr = document.querySelector(".progress .progress__inner");
                    if (progr === undefined || progr === null)
                        return;

                    progr.style.width = progress + "%";
                });

                this.on("removedfile", function (file) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will delete this item!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // call the removedata function with the id parameter
                            var url_up = "{{ url('product/slider_img_remove') }}";
                            var fileName = encodeURIComponent(file.name); // Encode the file name
                            var fullUrl = url_up + '?slider_remove=' + fileName;

                            $.ajax({
                                type: "GET",
                                url: fullUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    toastr.success(response.msg);
                                    setTimeout(function () {
                                        //   location.reload();
                                    }, 3000);
                                },
                                error: function (xhr, status, error) {
                                    // Handle error
                                    console.error("Error removing file:", status, error);
                                }
                            });
                        }
                    });
                });
            }
        });

        // Initialize Sortable.js for the Dropzone preview container
        document.addEventListener('DOMContentLoaded', function () {
            var sortable = Sortable.create(document.querySelector("#previews1"), {
                animation: 150,
                onEnd: function (evt) {
                    // Handle sorting completion
                    console.log('Sorting complete');
                }
            });
        });









        var seafDropzone = '';
        Dropzone.autoDiscover = false;
        var previewNode = document.querySelector("#uploadItemTemplate");
        previewNode.id = "";

        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        seafDropzone = new Dropzone("#seafDrop", {
            sortable: {
                container: "#previews",
                items: ".upload-item",
                cursor: "grab"
            },
            url: '/UploadFile',
            maxFiles: 5, // restrict to 5 files
            maxFilesize: 20, // in MB
            acceptedFiles: ".jpg, .jpeg, .png, .gif, .mp4, .mov, .avi", // restrict file types
            previewTemplate: previewTemplate,
            init: function () {
                var _this = this;

                // Static files (Replace with your own static files data)
                // var staticFiles = [
                //     { name: "example1.jpg", size: 123456, url: "https://fitspark-admin.orbitnapp.com/uploads/product/overviewImages/1722412844_66a9ef2c1b3b1.jpeg" },
                //     { name: "example2.mp4", size: 654321, url: "https://fitspark-admin.orbitnapp.com/uploads/product/overviewImages/1722412525_66a9eded910a0.mp4" }
                // ];

                // Static files data from Laravel
                var staticFiles = @json($staticFiles ?? '');

                if (staticFiles && staticFiles.length > 0) {

                    // Add static files to Dropzone
                    staticFiles.forEach(function (file) {
                        var mockFile = {
                            name: file.name,
                            size: file.size
                        };
                        _this.emit("addedfile", mockFile);
                        //if (file.url.endsWith(".mp4")) {
                        if (file.url.endsWith(".mp4") || file.url.endsWith(".mov") || file.url.endsWith(".avi")) {
                            // Handle video files
                            var videoPreview = document.createElement("video");
                            videoPreview.width = 320;
                            videoPreview.height = 240;
                            videoPreview.controls = true;
                            videoPreview.src = file.url;
                            mockFile.previewElement.appendChild(videoPreview);
                        } else {
                            // Handle image files
                            _this.emit("thumbnail", mockFile, file.url);
                        }
                        _this.emit("complete", mockFile);

                    });
                }


                this.on("addedfile", function (file) {
                    if (file.type.match(/video\/.*/)) {
                        var videoPreview = document.createElement("video");
                        videoPreview.width = 320;
                        videoPreview.height = 240;
                        videoPreview.controls = true;
                        videoPreview.src = URL.createObjectURL(file);
                        file.previewElement.appendChild(videoPreview);
                    } else {
                        this.options.autoQueue = true;
                        this.options.previewsContainer = "#previews";
                        this.options.thumbnailWidth = 60;
                        this.options.thumbnailHeight = 60;
                        this.options.resizeWidth = 800;
                        this.options.resizeHeight = 600;
                        this.options.resizeMimeType = 'image/jpeg';
                        this.options.resizeQuality = 0.8;
                    }


                    // Call the function to remove invalid thumbnails after a 2-second delay


                });



                this.on("totaluploadprogress", function (progress) {
                    var progr = document.querySelector(".progress .progress__inner");
                    if (progr === undefined || progr === null)
                        return;

                    progr.style.width = progress + "%";
                });

                this.on("removedfile", function (file) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will delete this item!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var url_up = "{{ url('product/img_remove') }}";
                            var fileName = encodeURIComponent(file.name); // Encode the file name
                            var fullUrl = url_up + '?file_remove=' + fileName;

                            $.ajax({
                                type: "GET",
                                url: fullUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    toastr.success(response.msg);
                                    setTimeout(function () {
                                        //   location.reload();
                                    }, 3000);
                                },
                                error: function (xhr, status, error) {
                                    // Handle error
                                    console.error("Error removing file:", status, error);
                                }
                            });
                        }
                    });
                });



            }
        });

        $(document).ready(function () {
            $('#product_feature').select2({
                placeholder: 'Select Product Feature',
                width: '100%'
            });
        });

        $(document).ready(function () {
            $('#lifestyle_gear').select2({
                placeholder: 'Select Lifestyle Gear',
                width: '100%'
            });
        });

        // CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        //     toolbar: {
        //         items: [
        //             '|',
        //             'findAndReplace', '|',
        //             'heading', '|',
        //             'bold', 'italic', 'underline', 'code', , 'alignment', 'removeFormat', '|',
        //             'bulletedList', 'numberedList', '|',
        //             'outdent', 'indent', '|',
        //             'undo', 'redo',
        //             '-',
        //             'fontSize', 'fontFamily', 'fontColor', 'uploadImage', 'fontBackgroundColor', '|',
        //             '|',
        //             'link', 'blockQuote', 'insertTable', '|',
        //             'specialCharacters', 'horizontalLine', '|',
        //             'textPartLanguage', '|',
        //             'sourceEditing'
        //         ],
        //         shouldNotGroupWhenFull: true
        //     },
        //     // Changing the language of the interface requires loading the language file using the <script> tag.
        //     // language: 'es',
        //     list: {
        //         properties: {
        //             styles: true,
        //             startIndex: true,
        //             reversed: true
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        //     heading: {
        //         options: [{
        //             model: 'paragraph',
        //             title: 'Paragraph',
        //             class: 'ck-heading_paragraph'
        //         },
        //         {
        //             model: 'heading1',
        //             view: 'h1',
        //             title: 'Heading 1',
        //             class: 'ck-heading_heading1'
        //         },
        //         {
        //             model: 'heading2',
        //             view: 'h2',
        //             title: 'Heading 2',
        //             class: 'ck-heading_heading2'
        //         },
        //         {
        //             model: 'heading3',
        //             view: 'h3',
        //             title: 'Heading 3',
        //             class: 'ck-heading_heading3'
        //         },
        //         {
        //             model: 'heading4',
        //             view: 'h4',
        //             title: 'Heading 4',
        //             class: 'ck-heading_heading4'
        //         },
        //         {
        //             model: 'heading5',
        //             view: 'h5',
        //             title: 'Heading 5',
        //             class: 'ck-heading_heading5'
        //         },
        //         {
        //             model: 'heading6',
        //             view: 'h6',
        //             title: 'Heading 6',
        //             class: 'ck-heading_heading6'
        //         }
        //         ]
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        //     placeholder: 'Welcome to CKEditor 5!',
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        //     fontFamily: {
        //         options: [
        //             'default',
        //             'Arial, Helvetica, sans-serif',
        //             'Courier New, Courier, monospace',
        //             'Georgia, serif',
        //             'Lucida Sans Unicode, Lucida Grande, sans-serif',
        //             'Tahoma, Geneva, sans-serif',
        //             'Times New Roman, Times, serif',
        //             'Trebuchet MS, Helvetica, sans-serif',
        //             'Verdana, Geneva, sans-serif'
        //         ],
        //         supportAllValues: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        //     fontSize: {
        //         options: [10, 12, 14, 'default', 18, 20, 22],
        //         supportAllValues: true
        //     },
        //     // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        //     htmlSupport: {
        //         allow: [{
        //             name: /.*/,
        //             attributes: true,
        //             classes: true,
        //             styles: true
        //         }]
        //     },
        //     // Be careful with enabling previews
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        //     htmlEmbed: {
        //         showPreviews: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        //     link: {
        //         decorators: {
        //             addTargetToExternalLinks: true,
        //             defaultProtocol: 'https://',
        //             toggleDownloadable: {
        //                 mode: 'manual',
        //                 label: 'Downloadable',
        //                 attributes: {
        //                     download: 'file'
        //                 }
        //             }
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        //     mention: {
        //         feeds: [{
        //             marker: '@',
        //             feed: [
        //                 '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
        //                 '@chocolate', '@cookie', '@cotton', '@cream',
        //                 '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
        //                 '@gummi', '@ice', '@jelly-o',
        //                 '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
        //                 '@sesame', '@snaps', '@soufflé',
        //                 '@sugar', '@sweet', '@topping', '@wafer'
        //             ],
        //             minimumCharacters: 1
        //         }]
        //     },
        //     // The "superbuild" contains more premium features that require additional configuration, disable them below.
        //     // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        //     removePlugins: [
        //         // These two are commercial, but you can try them out without registering to a trial.
        //         // 'ExportPdf',
        //         // 'ExportWord',
        //         'AIAssistant',
        //         'CKBox',
        //         'CKFinder',
        //         'EasyImage',
        //         // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        //         // Storing images as Base64 is usually a very bad idea.
        //         // Replace it on production website with other solutions:
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        //         // 'Base64UploadAdapter',
        //         'RealTimeCollaborativeComments',
        //         'RealTimeCollaborativeTrackChanges',
        //         'RealTimeCollaborativeRevisionHistory',
        //         'PresenceList',
        //         'Comments',
        //         'TrackChanges',
        //         'TrackChangesData',
        //         'RevisionHistory',
        //         'Pagination',
        //         'WProofreader',
        //         // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        //         // from a local file system (file://) - load this site via HTTP server if you enable MathType.
        //         'MathType',
        //         // The following features are part of the Productivity Pack and require additional license.
        //         'SlashCommand',
        //         'Template',
        //         'DocumentOutline',
        //         'FormatPainter',
        //         'TableOfContents',
        //         'PasteFromOfficeEnhanced',
        //         'CaseChange'
        //     ]
        // });

        // CKEDITOR.ClassicEditor.create(document.getElementById("easy_offloads"), {
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        //     toolbar: {
        //         items: [
        //             '|',
        //             'findAndReplace', '|',
        //             'heading', '|',
        //             'bold', 'italic', 'underline', 'code', , 'alignment', 'removeFormat', '|',
        //             'bulletedList', 'numberedList', '|',
        //             'outdent', 'indent', '|',
        //             'undo', 'redo',
        //             '-',
        //             'fontSize', 'fontFamily', 'fontColor', 'uploadImage', 'fontBackgroundColor', '|',
        //             '|',
        //             'link', 'blockQuote', 'insertTable', '|',
        //             'specialCharacters', 'horizontalLine', '|',
        //             'textPartLanguage', '|',
        //             'sourceEditing'
        //         ],
        //         shouldNotGroupWhenFull: true
        //     },
        //     // Changing the language of the interface requires loading the language file using the <script> tag.
        //     // language: 'es',
        //     list: {
        //         properties: {
        //             styles: true,
        //             startIndex: true,
        //             reversed: true
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        //     heading: {
        //         options: [{
        //             model: 'paragraph',
        //             title: 'Paragraph',
        //             class: 'ck-heading_paragraph'
        //         },
        //         {
        //             model: 'heading1',
        //             view: 'h1',
        //             title: 'Heading 1',
        //             class: 'ck-heading_heading1'
        //         },
        //         {
        //             model: 'heading2',
        //             view: 'h2',
        //             title: 'Heading 2',
        //             class: 'ck-heading_heading2'
        //         },
        //         {
        //             model: 'heading3',
        //             view: 'h3',
        //             title: 'Heading 3',
        //             class: 'ck-heading_heading3'
        //         },
        //         {
        //             model: 'heading4',
        //             view: 'h4',
        //             title: 'Heading 4',
        //             class: 'ck-heading_heading4'
        //         },
        //         {
        //             model: 'heading5',
        //             view: 'h5',
        //             title: 'Heading 5',
        //             class: 'ck-heading_heading5'
        //         },
        //         {
        //             model: 'heading6',
        //             view: 'h6',
        //             title: 'Heading 6',
        //             class: 'ck-heading_heading6'
        //         }
        //         ]
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        //     placeholder: 'Welcome to CKEditor 5!',
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        //     fontFamily: {
        //         options: [
        //             'default',
        //             'Arial, Helvetica, sans-serif',
        //             'Courier New, Courier, monospace',
        //             'Georgia, serif',
        //             'Lucida Sans Unicode, Lucida Grande, sans-serif',
        //             'Tahoma, Geneva, sans-serif',
        //             'Times New Roman, Times, serif',
        //             'Trebuchet MS, Helvetica, sans-serif',
        //             'Verdana, Geneva, sans-serif'
        //         ],
        //         supportAllValues: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        //     fontSize: {
        //         options: [10, 12, 14, 'default', 18, 20, 22],
        //         supportAllValues: true
        //     },
        //     // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        //     htmlSupport: {
        //         allow: [{
        //             name: /.*/,
        //             attributes: true,
        //             classes: true,
        //             styles: true
        //         }]
        //     },
        //     // Be careful with enabling previews
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        //     htmlEmbed: {
        //         showPreviews: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        //     link: {
        //         decorators: {
        //             addTargetToExternalLinks: true,
        //             defaultProtocol: 'https://',
        //             toggleDownloadable: {
        //                 mode: 'manual',
        //                 label: 'Downloadable',
        //                 attributes: {
        //                     download: 'file'
        //                 }
        //             }
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        //     mention: {
        //         feeds: [{
        //             marker: '@',
        //             feed: [
        //                 '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
        //                 '@chocolate', '@cookie', '@cotton', '@cream',
        //                 '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
        //                 '@gummi', '@ice', '@jelly-o',
        //                 '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
        //                 '@sesame', '@snaps', '@soufflé',
        //                 '@sugar', '@sweet', '@topping', '@wafer'
        //             ],
        //             minimumCharacters: 1
        //         }]
        //     },
        //     // The "superbuild" contains more premium features that require additional configuration, disable them below.
        //     // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        //     removePlugins: [
        //         // These two are commercial, but you can try them out without registering to a trial.
        //         // 'ExportPdf',
        //         // 'ExportWord',
        //         'AIAssistant',
        //         'CKBox',
        //         'CKFinder',
        //         'EasyImage',
        //         // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        //         // Storing images as Base64 is usually a very bad idea.
        //         // Replace it on production website with other solutions:
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        //         // 'Base64UploadAdapter',
        //         'RealTimeCollaborativeComments',
        //         'RealTimeCollaborativeTrackChanges',
        //         'RealTimeCollaborativeRevisionHistory',
        //         'PresenceList',
        //         'Comments',
        //         'TrackChanges',
        //         'TrackChangesData',
        //         'RevisionHistory',
        //         'Pagination',
        //         'WProofreader',
        //         // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        //         // from a local file system (file://) - load this site via HTTP server if you enable MathType.
        //         'MathType',
        //         // The following features are part of the Productivity Pack and require additional license.
        //         'SlashCommand',
        //         'Template',
        //         'DocumentOutline',
        //         'FormatPainter',
        //         'TableOfContents',
        //         'PasteFromOfficeEnhanced',
        //         'CaseChange'
        //     ]
        // });


        // CKEDITOR.ClassicEditor.create(document.getElementById("key_features"), {
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        //     toolbar: {
        //         items: [
        //             '|',
        //             'findAndReplace', '|',
        //             'heading', '|',
        //             'bold', 'italic', 'underline', 'code', , 'alignment', 'removeFormat', '|',
        //             'bulletedList', 'numberedList', '|',
        //             'outdent', 'indent', '|',
        //             'undo', 'redo',
        //             '-',
        //             'fontSize', 'fontFamily', 'fontColor', 'uploadImage', 'fontBackgroundColor', '|',
        //             '|',
        //             'link', 'blockQuote', 'insertTable', '|',
        //             'specialCharacters', 'horizontalLine', '|',
        //             'textPartLanguage', '|',
        //             'sourceEditing'
        //         ],
        //         shouldNotGroupWhenFull: true
        //     },
        //     // Changing the language of the interface requires loading the language file using the <script> tag.
        //     // language: 'es',
        //     list: {
        //         properties: {
        //             styles: true,
        //             startIndex: true,
        //             reversed: true
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        //     heading: {
        //         options: [{
        //             model: 'paragraph',
        //             title: 'Paragraph',
        //             class: 'ck-heading_paragraph'
        //         },
        //         {
        //             model: 'heading1',
        //             view: 'h1',
        //             title: 'Heading 1',
        //             class: 'ck-heading_heading1'
        //         },
        //         {
        //             model: 'heading2',
        //             view: 'h2',
        //             title: 'Heading 2',
        //             class: 'ck-heading_heading2'
        //         },
        //         {
        //             model: 'heading3',
        //             view: 'h3',
        //             title: 'Heading 3',
        //             class: 'ck-heading_heading3'
        //         },
        //         {
        //             model: 'heading4',
        //             view: 'h4',
        //             title: 'Heading 4',
        //             class: 'ck-heading_heading4'
        //         },
        //         {
        //             model: 'heading5',
        //             view: 'h5',
        //             title: 'Heading 5',
        //             class: 'ck-heading_heading5'
        //         },
        //         {
        //             model: 'heading6',
        //             view: 'h6',
        //             title: 'Heading 6',
        //             class: 'ck-heading_heading6'
        //         }
        //         ]
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        //     placeholder: 'Welcome to CKEditor 5!',
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        //     fontFamily: {
        //         options: [
        //             'default',
        //             'Arial, Helvetica, sans-serif',
        //             'Courier New, Courier, monospace',
        //             'Georgia, serif',
        //             'Lucida Sans Unicode, Lucida Grande, sans-serif',
        //             'Tahoma, Geneva, sans-serif',
        //             'Times New Roman, Times, serif',
        //             'Trebuchet MS, Helvetica, sans-serif',
        //             'Verdana, Geneva, sans-serif'
        //         ],
        //         supportAllValues: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        //     fontSize: {
        //         options: [10, 12, 14, 'default', 18, 20, 22],
        //         supportAllValues: true
        //     },
        //     // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        //     htmlSupport: {
        //         allow: [{
        //             name: /.*/,
        //             attributes: true,
        //             classes: true,
        //             styles: true
        //         }]
        //     },
        //     // Be careful with enabling previews
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        //     htmlEmbed: {
        //         showPreviews: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        //     link: {
        //         decorators: {
        //             addTargetToExternalLinks: true,
        //             defaultProtocol: 'https://',
        //             toggleDownloadable: {
        //                 mode: 'manual',
        //                 label: 'Downloadable',
        //                 attributes: {
        //                     download: 'file'
        //                 }
        //             }
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        //     mention: {
        //         feeds: [{
        //             marker: '@',
        //             feed: [
        //                 '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
        //                 '@chocolate', '@cookie', '@cotton', '@cream',
        //                 '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
        //                 '@gummi', '@ice', '@jelly-o',
        //                 '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
        //                 '@sesame', '@snaps', '@soufflé',
        //                 '@sugar', '@sweet', '@topping', '@wafer'
        //             ],
        //             minimumCharacters: 1
        //         }]
        //     },
        //     // The "superbuild" contains more premium features that require additional configuration, disable them below.
        //     // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        //     removePlugins: [
        //         // These two are commercial, but you can try them out without registering to a trial.
        //         // 'ExportPdf',
        //         // 'ExportWord',
        //         'AIAssistant',
        //         'CKBox',
        //         'CKFinder',
        //         'EasyImage',
        //         // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        //         // Storing images as Base64 is usually a very bad idea.
        //         // Replace it on production website with other solutions:
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        //         // 'Base64UploadAdapter',
        //         'RealTimeCollaborativeComments',
        //         'RealTimeCollaborativeTrackChanges',
        //         'RealTimeCollaborativeRevisionHistory',
        //         'PresenceList',
        //         'Comments',
        //         'TrackChanges',
        //         'TrackChangesData',
        //         'RevisionHistory',
        //         'Pagination',
        //         'WProofreader',
        //         // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        //         // from a local file system (file://) - load this site via HTTP server if you enable MathType.
        //         'MathType',
        //         // The following features are part of the Productivity Pack and require additional license.
        //         'SlashCommand',
        //         'Template',
        //         'DocumentOutline',
        //         'FormatPainter',
        //         'TableOfContents',
        //         'PasteFromOfficeEnhanced',
        //         'CaseChange'
        //     ]
        // });

        // CKEDITOR.ClassicEditor.create(document.getElementById("specifications"), {
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        //     toolbar: {
        //         items: [
        //             '|',
        //             'findAndReplace', '|',
        //             'heading', '|',
        //             'bold', 'italic', 'underline', 'code', , 'alignment', 'removeFormat', '|',
        //             'bulletedList', 'numberedList', '|',
        //             'outdent', 'indent', '|',
        //             'undo', 'redo',
        //             '-',
        //             'fontSize', 'fontFamily', 'fontColor', 'uploadImage', 'fontBackgroundColor', '|',
        //             '|',
        //             'link', 'blockQuote', 'insertTable', '|',
        //             'specialCharacters', 'horizontalLine', '|',
        //             'textPartLanguage', '|',
        //             'sourceEditing'
        //         ],
        //         shouldNotGroupWhenFull: true
        //     },
        //     // Changing the language of the interface requires loading the language file using the <script> tag.
        //     // language: 'es',
        //     list: {
        //         properties: {
        //             styles: true,
        //             startIndex: true,
        //             reversed: true
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        //     heading: {
        //         options: [{
        //             model: 'paragraph',
        //             title: 'Paragraph',
        //             class: 'ck-heading_paragraph'
        //         },
        //         {
        //             model: 'heading1',
        //             view: 'h1',
        //             title: 'Heading 1',
        //             class: 'ck-heading_heading1'
        //         },
        //         {
        //             model: 'heading2',
        //             view: 'h2',
        //             title: 'Heading 2',
        //             class: 'ck-heading_heading2'
        //         },
        //         {
        //             model: 'heading3',
        //             view: 'h3',
        //             title: 'Heading 3',
        //             class: 'ck-heading_heading3'
        //         },
        //         {
        //             model: 'heading4',
        //             view: 'h4',
        //             title: 'Heading 4',
        //             class: 'ck-heading_heading4'
        //         },
        //         {
        //             model: 'heading5',
        //             view: 'h5',
        //             title: 'Heading 5',
        //             class: 'ck-heading_heading5'
        //         },
        //         {
        //             model: 'heading6',
        //             view: 'h6',
        //             title: 'Heading 6',
        //             class: 'ck-heading_heading6'
        //         }
        //         ]
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        //     placeholder: 'Welcome to CKEditor 5!',
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        //     fontFamily: {
        //         options: [
        //             'default',
        //             'Arial, Helvetica, sans-serif',
        //             'Courier New, Courier, monospace',
        //             'Georgia, serif',
        //             'Lucida Sans Unicode, Lucida Grande, sans-serif',
        //             'Tahoma, Geneva, sans-serif',
        //             'Times New Roman, Times, serif',
        //             'Trebuchet MS, Helvetica, sans-serif',
        //             'Verdana, Geneva, sans-serif'
        //         ],
        //         supportAllValues: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        //     fontSize: {
        //         options: [10, 12, 14, 'default', 18, 20, 22],
        //         supportAllValues: true
        //     },
        //     // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        //     htmlSupport: {
        //         allow: [{
        //             name: /.*/,
        //             attributes: true,
        //             classes: true,
        //             styles: true
        //         }]
        //     },
        //     // Be careful with enabling previews
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        //     htmlEmbed: {
        //         showPreviews: true
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        //     link: {
        //         decorators: {
        //             addTargetToExternalLinks: true,
        //             defaultProtocol: 'https://',
        //             toggleDownloadable: {
        //                 mode: 'manual',
        //                 label: 'Downloadable',
        //                 attributes: {
        //                     download: 'file'
        //                 }
        //             }
        //         }
        //     },
        //     // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        //     mention: {
        //         feeds: [{
        //             marker: '@',
        //             feed: [
        //                 '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
        //                 '@chocolate', '@cookie', '@cotton', '@cream',
        //                 '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
        //                 '@gummi', '@ice', '@jelly-o',
        //                 '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
        //                 '@sesame', '@snaps', '@soufflé',
        //                 '@sugar', '@sweet', '@topping', '@wafer'
        //             ],
        //             minimumCharacters: 1
        //         }]
        //     },
        //     // The "superbuild" contains more premium features that require additional configuration, disable them below.
        //     // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        //     removePlugins: [
        //         // These two are commercial, but you can try them out without registering to a trial.
        //         // 'ExportPdf',
        //         // 'ExportWord',
        //         'AIAssistant',
        //         'CKBox',
        //         'CKFinder',
        //         'EasyImage',
        //         // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        //         // Storing images as Base64 is usually a very bad idea.
        //         // Replace it on production website with other solutions:
        //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        //         // 'Base64UploadAdapter',
        //         'RealTimeCollaborativeComments',
        //         'RealTimeCollaborativeTrackChanges',
        //         'RealTimeCollaborativeRevisionHistory',
        //         'PresenceList',
        //         'Comments',
        //         'TrackChanges',
        //         'TrackChangesData',
        //         'RevisionHistory',
        //         'Pagination',
        //         'WProofreader',
        //         // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        //         // from a local file system (file://) - load this site via HTTP server if you enable MathType.
        //         'MathType',
        //         // The following features are part of the Productivity Pack and require additional license.
        //         'SlashCommand',
        //         'Template',
        //         'DocumentOutline',
        //         'FormatPainter',
        //         'TableOfContents',
        //         'PasteFromOfficeEnhanced',
        //         'CaseChange'
        //     ]
        // });

        // $("#cgst").on("input", function() {
        //     calculate_gst();
        //     calculate_price();
        // });


        // $("#sgst").on("input", function() {
        //     calculate_gst();
        //     calculate_price();
        // });

        // $("#cutoff_price").on("input", function() {
        //     calculate_gst();
        //     calculate_price();
        // });

        // $("#mrp").on("input", function() {
        //     calculate_gst();
        //     calculate_price();
        // });





        // $("#discount_percentage").on("input", function() {
        //     calculate_gst();
        //     calculate_price();
        // });


        // $("#mrp").on("input", function() {
        //     calculate_gst();
        //     calculate_price();

        // });

        //  $("#price").on("input", function() {
        //     calculate_gst();
        //  });

        // function calculate_price() {
        //     var gst_price = $('#cutoff_price').val();
        //     var dis_per = $('#discount_percentage').val();
        //     var dis_amt = (gst_price * dis_per) / 100;
        //     if (dis_amt > gst_price) {
        //         var price_amt = 0;
        //         var price_amts = 0;
        //     } else {
        //         var price_amt = parseFloat(gst_price) - parseFloat(dis_amt);
        //         var price_amts = price_amt.toFixed(2);
        //     }

        //     $('#price').val(price_amts);
        // }

        // function calculate_gst() {
        //     var cgst = $('#cgst').val();
        //     var sgst = $('#sgst').val();
        //     var price = $('#mrp').val();
        //     var cgst_amt = ((price * cgst) / 100);
        //     var sgst_amt = ((price * sgst) / 100);
        //     var final_gst_amt = cgst_amt + sgst_amt;
        //     var final_price = parseFloat(final_gst_amt) + parseFloat(price);
        //     var final_prices = final_price.toFixed(2);
        //     $('#cutoff_price').val(final_prices);
        // }

    </script>

    <script>
        // $(document).ready(function () {
    // $('#category').on('change', function () {
    //     let categoryId = $(this).val();

    //     // Convert array to single value if multiple selection is allowed
    //     if (Array.isArray(categoryId)) {
    //         categoryId = categoryId[0]; // Take the first category only
    //     }

    //     // Clear existing options in the subcategory dropdown
    //     $('#subcategory').empty().append('<option value="">Select Subcategory</option>');

    //     if (categoryId) {
    //         $.ajax({
    //             url: '/get-subcategories/' + categoryId, // Your route to get subcategories
    //             type: 'GET',
    //             success: function (response) {
    //                 if (response.subcategories && response.subcategories.length > 0) {
    //                     // Append subcategories if available
    //                     $.each(response.subcategories, function (key, subcategory) {
    //                         $('#subcategory').append(
    //                             `<option value="${subcategory.id}">${subcategory.name}</option>`
    //                         );
    //                     });
    //                 }
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(xhr.responseText); // Log error but don't show alert
    //             }
    //         });
    //     }
    // });
    $('#category').on('change', function () {
    let selectedCategories = $(this).val() || [];

    // Store the currently selected subcategories
    let selectedSubcategories = $('#subcategory').val() || [];

    // Clear existing options in the subcategory dropdown
    $('#subcategory').empty().append('<option value="">Select Subcategory</option>');

    if (selectedCategories.length > 0) {
        $.ajax({
            url: '/get-subcategories/',
            type: 'GET',
            data: { category_ids: selectedCategories }, // Send multiple categories
            success: function (response) {
                if (response.subcategories && response.subcategories.length > 0) {
                    $.each(response.subcategories, function (key, subcategory) {
                        let isSelected = selectedSubcategories.includes(subcategory.id.toString()) ? 'selected' : '';
                        $('#subcategory').append(
                            `<option value="${subcategory.id}" ${isSelected}>${subcategory.name}</option>`
                        );
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});

// });

        function addItem() {

            // $('#addEditModal').reset()
            $('#image-border-shap').hide();
            $('#offcanvasAddUserLabel').text('Add Product');
            //document.getElementById("fileControl").setAttribute("required", "required");


            $('#imagePreview').hide();
            $('#imagePreview').attr('src', '');
            $("#addEditForm")[0].reset();
            $("#pass").show();
            $("#con_pass").show();
            $("#addEditModal").modal("show");
            $("#addEditModal").find(".modal-title").text('Add');
            $("#addEditModal").find("input[name='id']").val(0);
            $("#addEditModal").find("input").removeClass('is-invalid');
            $("#addEditModal").find("textarea").removeClass('is-invalid');
            $("#addEditModal").find("select").removeClass('is-invalid');
            $("#addEditModal").find(".error").remove();

        }


        $.validator.addMethod("requiredMultiSelect", function (value, element) {
            return $(element).val().length > 0;
        }, "Please select at least one option");
        // $(document).ready(function() {
        $('#addEditForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                code: {
                    required: true,
                },
                brands: {
                    required: true,
                },
                category: {
                    required: true,
                },
                // subcategory: {
                //     required: true,
                // },
                origin: {
                    required: true,
                },
                // measurement: {
                //     required: true,
                // },
                warranty: {
                    required: true,
                },
             
                summary: {
                    required: true,
                },

                short_description: {
                    required: true,
                    minlength: 5
                },
                // productSku: {
                //     required: true
                // },

                // lifestyle_gear: {
                //     required: true
                // },
                // stock_quantity: {
                //     required: true,
                //     digits: true
                // },
                // sku: {
                //     required: true,
                // },
                description: {
                    required: true
                },
                meta_title: {
                    required: true
                },
                meta_keyword: {
                    required: true
                },
                meta_description: {
                    required: true,
                    maxlength: '500',
                },
                // attachments: {
                //     extension: "pdf", 
                // },
                d_mode: {
                    required: true,
                },
                product_feature: {
                    required: true,
                },
                normal_price: {
                    required: true,
                    number: true
                },
                normal_sellprice: {
                    required: true,
                    number: true
                },
                loyal_price: {
                    required: true,
                    number: true
                },
                loyal_sellprice: {
                    required: true,
                    number: true
                },
                wolesales_price: {
                    required: true,
                    number: true
                },
                wolesales_sellprice: {
                    required: true,
                    number: true
                },
                // cutoff_price: {
                //     required: true,
                //     number: true
                // },
                // discount_percentage: {
                //     number: true
                // },
                // final_price: {
                //     required: true,
                //     number: true
                // },
                // discounted_price: {

                //     number: true
                // },
                // sgst: {
                //     required: true,
                //     number: true
                // },
                // cgst: {
                //     required: true,
                //     number: true
                // },
                vendor: {
                    required: true
                },
                status: {
                    required: true
                },
                status: {
                    required: true
                },
                status: {
                    required: true
                },
                status: {
                    required: true
                },
                status: {
                    required: true
                },

            },
            messages: {
                url: {
                    url: 'Invalid URL',
                },
                product_feature: {
                    requiredMultiSelect: "Please select at least one option"
                },
                attachments: {

                    extension: "Only PDF files are allowed."
                }

                // Custom error messages can be defined here if needed
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                element.next('.fv-plugins-message-container').addClass('invalid-feedback').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).toggleClass('is-invalid is-valid', true);
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).toggleClass('is-invalid is-valid', false);
            },
            submitHandler: function (form) {
                if (editorInstance) {
                    $('#full_description').val(editorInstance.getData());
                }
                var formData = new FormData($("#addEditForm")[0]);

                seafDropzone_listing.files.forEach(function (file) {
                    //console.log('file',file);
                    formData.append('listing_images[]', file);
                });
                // seafDropzone.files.forEach(function(file) {
                //     //console.log('file',file);
                //     formData.append('overviewImages[]', file);
                // });
                seafDropzone1.files.forEach(function (file) {
                    //console.log('file',file);
                    formData.append('sliderImages[]', file);
                });


                var url_up = "{{url('product/store')}}";
                $.ajax({
                    type: "POST",
                    url: url_up,
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $("#addEditForm").find('.submit_button').attr("disabled", true);
                        $('.loader').show();
                    },
                    success: function (data) {
                        $("#addEditForm").find('.submit_button').attr("disabled", true);
                        $('.loader').hide();
                        var response = JSON.parse(data);
                        //console.log(response);
                        if (response.code == 200) {
                            toastr.success(response.msg);
                            setTimeout(function () {
                                window.location.href = "{{url('product')}}";
                            }, 3000);
                        } else {
                            toastr.error(response.msg, "error");
                            $("#addEditForm").find('.submit_button').attr("disabled", false);
                        }
                    },
                });
                return false;
            }
        });
        // });


 // CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
 //            toolbar: {
 //                items: [
 //                    '|',
 //                    'findAndReplace', '|',
 //                    'heading', '|',
 //                    'bold', 'italic', 'underline', 'code', , 'alignment', 'removeFormat', '|',
 //                    'bulletedList', 'numberedList', '|',
 //                    'outdent', 'indent', '|',
 //                    'undo', 'redo',
 //                    '-',
 //                    'fontSize', 'fontFamily', 'fontColor', 'uploadImage', 'fontBackgroundColor', '|',
 //                    '|',
 //                    'link', 'blockQuote', 'insertTable', '|',
 //                    'specialCharacters', 'horizontalLine', '|',
 //                    'textPartLanguage', '|',
 //                    'sourceEditing'
 //                ],
 //                shouldNotGroupWhenFull: true
 //            },
 //            // Changing the language of the interface requires loading the language file using the <script> tag.
 //            // language: 'es',
 //            list: {
 //                properties: {
 //                    styles: true,
 //                    startIndex: true,
 //                    reversed: true
 //                }
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
 //            heading: {
 //                options: [{
 //                    model: 'paragraph',
 //                    title: 'Paragraph',
 //                    class: 'ck-heading_paragraph'
 //                },
 //                {
 //                    model: 'heading1',
 //                    view: 'h1',
 //                    title: 'Heading 1',
 //                    class: 'ck-heading_heading1'
 //                },
 //                {
 //                    model: 'heading2',
 //                    view: 'h2',
 //                    title: 'Heading 2',
 //                    class: 'ck-heading_heading2'
 //                },
 //                {
 //                    model: 'heading3',
 //                    view: 'h3',
 //                    title: 'Heading 3',
 //                    class: 'ck-heading_heading3'
 //                },
 //                {
 //                    model: 'heading4',
 //                    view: 'h4',
 //                    title: 'Heading 4',
 //                    class: 'ck-heading_heading4'
 //                },
 //                {
 //                    model: 'heading5',
 //                    view: 'h5',
 //                    title: 'Heading 5',
 //                    class: 'ck-heading_heading5'
 //                },
 //                {
 //                    model: 'heading6',
 //                    view: 'h6',
 //                    title: 'Heading 6',
 //                    class: 'ck-heading_heading6'
 //                }
 //                ]
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
 //            placeholder: 'Welcome to CKEditor 5!',
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
 //            fontFamily: {
 //                options: [
 //                    'default',
 //                    'Arial, Helvetica, sans-serif',
 //                    'Courier New, Courier, monospace',
 //                    'Georgia, serif',
 //                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
 //                    'Tahoma, Geneva, sans-serif',
 //                    'Times New Roman, Times, serif',
 //                    'Trebuchet MS, Helvetica, sans-serif',
 //                    'Verdana, Geneva, sans-serif'
 //                ],
 //                supportAllValues: true
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
 //            fontSize: {
 //                options: [10, 12, 14, 'default', 18, 20, 22],
 //                supportAllValues: true
 //            },
 //            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
 //            htmlSupport: {
 //                allow: [{
 //                    name: /.*/,
 //                    attributes: true,
 //                    classes: true,
 //                    styles: true
 //                }]
 //            },
 //            // Be careful with enabling previews
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
 //            htmlEmbed: {
 //                showPreviews: true
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
 //            link: {
 //                decorators: {
 //                    addTargetToExternalLinks: true,
 //                    defaultProtocol: 'https://',
 //                    toggleDownloadable: {
 //                        mode: 'manual',
 //                        label: 'Downloadable',
 //                        attributes: {
 //                            download: 'file'
 //                        }
 //                    }
 //                }
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
 //            mention: {
 //                feeds: [{
 //                    marker: '@',
 //                    feed: [
 //                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
 //                        '@chocolate', '@cookie', '@cotton', '@cream',
 //                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
 //                        '@gummi', '@ice', '@jelly-o',
 //                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
 //                        '@sesame', '@snaps', '@soufflé',
 //                        '@sugar', '@sweet', '@topping', '@wafer'
 //                    ],
 //                    minimumCharacters: 1
 //                }]
 //            },
 //            // The "superbuild" contains more premium features that require additional configuration, disable them below.
 //            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
 //            removePlugins: [
 //                // These two are commercial, but you can try them out without registering to a trial.
 //                // 'ExportPdf',
 //                // 'ExportWord',
 //                'AIAssistant',
 //                'CKBox',
 //                'CKFinder',
 //                'EasyImage',
 //                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
 //                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
 //                // Storing images as Base64 is usually a very bad idea.
 //                // Replace it on production website with other solutions:
 //                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
 //                // 'Base64UploadAdapter',
 //                'RealTimeCollaborativeComments',
 //                'RealTimeCollaborativeTrackChanges',
 //                'RealTimeCollaborativeRevisionHistory',
 //                'PresenceList',
 //                'Comments',
 //                'TrackChanges',
 //                'TrackChangesData',
 //                'RevisionHistory',
 //                'Pagination',
 //                'WProofreader',
 //                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
 //                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
 //                'MathType',
 //                // The following features are part of the Productivity Pack and require additional license.
 //                'SlashCommand',
 //                'Template',
 //                'DocumentOutline',
 //                'FormatPainter',
 //                'TableOfContents',
 //                'PasteFromOfficeEnhanced',
 //                'CaseChange'
 //            ]
 //        });





        //deleteItem
        function deleteItem(id) {
            //show confirmation popup
            $.confirm({
                title: 'Delete',
                content: 'Are you sure you want to delete this?',
                buttons: {
                    Cancel: function () {
                        //nothing to do
                    },
                    Sure: {
                        btnClass: 'btn-primary',
                        action: function () {
                            removedata(id = id);
                        },
                    }
                }
            });
        }


        function removedata(id) {
            $.ajax({
                type: "POST",
                url: "{{route('delete.product')}}",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    // console.log(data.success)
                    $.notify(data.success, "success");
                    $('#listing_table').DataTable().ajax.reload();
                },
            });
        }
        

        $(document).ready(function () {
            $(document).on('change', '.status-checkbox', function () {
                var id = $(this).data("id");
                if (this.checked) {
                    var value = '1';
                } else {
                    var value = '0';
                }
                updateItemStatus(id = id, type = 'status', value = value);

            })
        });

        // update item ------>


        function remove_edit(id) {
            const elements = document.querySelectorAll('.remove-property-edit');

            if (elements.length > 1) {
                document.getElementById(id).remove();
            }

            const elements1 = document.querySelectorAll('.remove-property-edit');

            if (elements1.length === 1) {
                // Hide the div element with !important
                elements1[0].style.setProperty('display', 'none', 'important');
            } else {
                // Remove the specific element by ID
                document.getElementById(id).remove();

                // Check again if there are any elements left
                if (document.querySelectorAll('.remove-property-edit').length > 0) {
                    // If there are more than 1 element, remove the 'display: none' style
                    elements1.forEach(el => el.style.removeProperty('display'));
                }
            }
        }


        function updateItem(id) {
            $('.image-border-shap').show();
            $.ajax({
                type: "POST",
                url: "{{ url('customer/get_by_id') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        var item = response.data.customer_detail;
                        console.log(item.stock_status)

                        // Populate form fields with item data
                        $("#addEditForm").find("input[name='product']").val(item.product);
                        // $("#addEditForm").find("select[name='stock_status']").val(item.stock_status);
                        $("#addEditForm").find("input[name='stock_status']").prop('checked', item.stock_status == 1);
                        $("#addEditForm").find("input[name='quantity']").val(item.quantity);
                        $("#addEditForm").find("input[name='hsn']").val(item.hsn);
                        $("#addEditForm").find("input[name='short_description']").val(item.short_description);
                        $("#addEditForm").find("input[name='taxable_amount']").val(item.taxable_amount);
                        $("#addEditForm").find("input[name='cgst']").val(item.cgst);
                        $("#addEditForm").find("input[name='sgst']").val(item.sgst);
                        $("#addEditForm").find("input[name='mrp']").val(item.mrp);
                        $("#addEditForm").find("input[name='discount']").val(item.discount);
                        $("#addEditForm").find("input[name='final_price']").val(item.final_price);
                        $("#addEditForm").find("input[name='meta_title']").val(item.meta_title);
                        $("#addEditForm").find("input[name='meta_keyword']").val(item.meta_keyword);
                        $("#addEditForm").find("input[name='meta_des']").val(item.meta_des);
                        $("#addEditForm").find("input[name='description']").val(item.description);

                        // Handle image if needed
                        var imagePath = '/uploads/product_img/' + item.image;
                        var imgTag = $('<img>').attr('src', imagePath).attr('alt', 'Product Image');
                        $("#addEditForm").find(".image-preview-container").html(imgTag);

                        // Update modal title or any other UI elements
                        $("#offcanvasAddUserLabel").text('Update Product');

                        // Show necessary elements or perform any other UI updates
                        $('#imagePreview').show();
                        $('#imagePreview').attr('src', imagePath);

                    } else {
                        $.notify(response.msg, "error");
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $.notify("Error fetching data", "error");
                }
            });
        }

 // CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
 //            toolbar: {
 //                items: [
 //                    '|',
 //                    'findAndReplace', '|',
 //                    'heading', '|',
 //                    'bold', 'italic', 'underline', 'code', , 'alignment', 'removeFormat', '|',
 //                    'bulletedList', 'numberedList', '|',
 //                    'outdent', 'indent', '|',
 //                    'undo', 'redo',
 //                    '-',
 //                    'fontSize', 'fontFamily', 'fontColor', 'uploadImage', 'fontBackgroundColor', '|',
 //                    '|',
 //                    'link', 'blockQuote', 'insertTable', '|',
 //                    'specialCharacters', 'horizontalLine', '|',
 //                    'textPartLanguage', '|',
 //                    'sourceEditing'
 //                ],
 //                shouldNotGroupWhenFull: true
 //            },
 //            // Changing the language of the interface requires loading the language file using the <script> tag.
 //            // language: 'es',
 //            list: {
 //                properties: {
 //                    styles: true,
 //                    startIndex: true,
 //                    reversed: true
 //                }
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
 //            heading: {
 //                options: [{
 //                    model: 'paragraph',
 //                    title: 'Paragraph',
 //                    class: 'ck-heading_paragraph'
 //                },
 //                {
 //                    model: 'heading1',
 //                    view: 'h1',
 //                    title: 'Heading 1',
 //                    class: 'ck-heading_heading1'
 //                },
 //                {
 //                    model: 'heading2',
 //                    view: 'h2',
 //                    title: 'Heading 2',
 //                    class: 'ck-heading_heading2'
 //                },
 //                {
 //                    model: 'heading3',
 //                    view: 'h3',
 //                    title: 'Heading 3',
 //                    class: 'ck-heading_heading3'
 //                },
 //                {
 //                    model: 'heading4',
 //                    view: 'h4',
 //                    title: 'Heading 4',
 //                    class: 'ck-heading_heading4'
 //                },
 //                {
 //                    model: 'heading5',
 //                    view: 'h5',
 //                    title: 'Heading 5',
 //                    class: 'ck-heading_heading5'
 //                },
 //                {
 //                    model: 'heading6',
 //                    view: 'h6',
 //                    title: 'Heading 6',
 //                    class: 'ck-heading_heading6'
 //                }
 //                ]
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
 //            placeholder: 'Welcome to CKEditor 5!',
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
 //            fontFamily: {
 //                options: [
 //                    'default',
 //                    'Arial, Helvetica, sans-serif',
 //                    'Courier New, Courier, monospace',
 //                    'Georgia, serif',
 //                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
 //                    'Tahoma, Geneva, sans-serif',
 //                    'Times New Roman, Times, serif',
 //                    'Trebuchet MS, Helvetica, sans-serif',
 //                    'Verdana, Geneva, sans-serif'
 //                ],
 //                supportAllValues: true
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
 //            fontSize: {
 //                options: [10, 12, 14, 'default', 18, 20, 22],
 //                supportAllValues: true
 //            },
 //            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
 //            htmlSupport: {
 //                allow: [{
 //                    name: /.*/,
 //                    attributes: true,
 //                    classes: true,
 //                    styles: true
 //                }]
 //            },
 //            // Be careful with enabling previews
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
 //            htmlEmbed: {
 //                showPreviews: true
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
 //            link: {
 //                decorators: {
 //                    addTargetToExternalLinks: true,
 //                    defaultProtocol: 'https://',
 //                    toggleDownloadable: {
 //                        mode: 'manual',
 //                        label: 'Downloadable',
 //                        attributes: {
 //                            download: 'file'
 //                        }
 //                    }
 //                }
 //            },
 //            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
 //            mention: {
 //                feeds: [{
 //                    marker: '@',
 //                    feed: [
 //                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
 //                        '@chocolate', '@cookie', '@cotton', '@cream',
 //                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
 //                        '@gummi', '@ice', '@jelly-o',
 //                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
 //                        '@sesame', '@snaps', '@soufflé',
 //                        '@sugar', '@sweet', '@topping', '@wafer'
 //                    ],
 //                    minimumCharacters: 1
 //                }]
 //            },
 //            // The "superbuild" contains more premium features that require additional configuration, disable them below.
 //            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
 //            removePlugins: [
 //                // These two are commercial, but you can try them out without registering to a trial.
 //                // 'ExportPdf',
 //                // 'ExportWord',
 //                'AIAssistant',
 //                'CKBox',
 //                'CKFinder',
 //                'EasyImage',
 //                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
 //                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
 //                // Storing images as Base64 is usually a very bad idea.
 //                // Replace it on production website with other solutions:
 //                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
 //                // 'Base64UploadAdapter',
 //                'RealTimeCollaborativeComments',
 //                'RealTimeCollaborativeTrackChanges',
 //                'RealTimeCollaborativeRevisionHistory',
 //                'PresenceList',
 //                'Comments',
 //                'TrackChanges',
 //                'TrackChangesData',
 //                'RevisionHistory',
 //                'Pagination',
 //                'WProofreader',
 //                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
 //                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
 //                'MathType',
 //                // The following features are part of the Productivity Pack and require additional license.
 //                'SlashCommand',
 //                'Template',
 //                'DocumentOutline',
 //                'FormatPainter',
 //                'TableOfContents',
 //                'PasteFromOfficeEnhanced',
 //                'CaseChange'
 //            ]
 //        });

    </script>
    <!-- <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script> -->

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script> -->
<!-- <script>
    ClassicEditor
        .create(document.querySelector('#descriptionnn'), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|',
                'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                'undo', 'redo', 'sourceEditing'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
            }
        })
        .catch(error => {
            console.error('CKEditor Initialization Failed:', error);
        });
</script> -->
<!-- Include jQuery & Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Select2 for Categories
        $('.select2-category').select2({
            placeholder: "Select Category",
            closeOnSelect: false,
            tags: false, 
            allowClear: true
        });

        // Select2 for Subcategories
        $('.select2-subcategory').select2({
            placeholder: "Select Subcategory",
            closeOnSelect: false,
            tags: false, 
            allowClear: true
        });

        // Ensure individual remove works
        $('.select2-category, .select2-subcategory').on("select2:unselect", function (e) {
            $(this).trigger('change');
        });
    });
</script>
<script>
let editorInstance;

        CKEDITOR.ClassicEditor.create(document.getElementById("full_description"), {
                toolbar: {
                    items: [
                        '|',
                        'findAndReplace', '|',
                        'heading', '|',
                        'bold', 'italic', 'underline', 'code', 'alignment', 'removeFormat', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'uploadImage', 'fontBackgroundColor', '|',
                        '|',
                        'link', 'blockQuote', 'insertTable', '|',
                        'specialCharacters', 'horizontalLine', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                placeholder: 'Welcome to CKEditor 5!',
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                htmlEmbed: {
                    showPreviews: true
                },
                // link: {
                //     decorators: {
                //         addTargetToExternalLinks: true,
                //         defaultProtocol: 'https://',
                //         toggleDownloadable: {
                //             mode: 'manual',
                //             label: 'Downloadable',
                //             attributes: {
                //                 download: 'file'
                //             }
                //         }
                //     }
                // },
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@candy', '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream', '@cupcake',
                            '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                            '@gummi', '@ice', '@jelly-o', '@liquorice', '@macaroon',
                            '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame',
                            '@snaps', '@soufflé', '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                removePlugins: [
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange'
                ]
            })
            .then(editor => {
                editorInstance = editor; // Save the instance globally
            })
            .catch(error => {
                console.error('There was a problem initializing CKEditor.', error);
            });

</script>

@endpush