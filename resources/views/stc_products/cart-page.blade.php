@extends('layouts.stc_product.header')

@push('head')
<style>
    .cart-items-scroll {
        max-height: min(420px, 55vh);
        overflow-y: auto;
        overflow-x: auto;
        border: 1px solid #E4E7E9;
        border-radius: 0 0 6px 6px;
        -webkit-overflow-scrolling: touch;
    }
    .cart-items-scroll .cart-table {
        margin-bottom: 0;
    }
    .cart-items-scroll thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #F2F4F5;
        box-shadow: 0 1px 0 #E4E7E9;
    }
    .cart-product-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 160px;
    }
    .cart-product-thumb {
        width: 52px;
        height: 52px;
        object-fit: contain;
        flex-shrink: 0;
        border: 1px solid #E4E7E9;
        border-radius: 4px;
        background: #fff;
    }
    .cart-product-name {
        line-height: 1.35;
        word-break: break-word;
    }
    .guest-captcha-box {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .guest-captcha-box img {
        height: 50px;
        border: 1px solid #E4E7E9;
        border-radius: 4px;
        background: #fff;
    }
</style>
@endpush

@section('content')

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
                <li class="breadcrumb-item active" aria-current="page">بطاقة التسوق</li>
            </ol>
        </nav>
    </div>
</div>


<div class="cart_page">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="cart_list">
                    <h3>بطاقة التسوق</h3>
                    {{-- Cart list for logged-in customers and guests --}}
                    @if (!empty($cart))
                                <div class="cart-items-scroll">
                                <table class="cart-table">
                                    <thead>
                                        <tr>
                                            <th>منتجات</th>
                                            <th>سعر</th>
                                            <th>كمية</th>
                                            <th>اسم المنتج</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($cart as $item)
                                        {{-- @php
                                        print_r($item);die;
                                        @endphp --}}
                                                            <tr>
                                                                <td>
                                                                    <div class="list_c">
                                                                        <div class="remove">
                                                                            <a href="{{ route('remove_tocart', ['item_id' => $item['product_id']]) }}">
                                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                                                                                        stroke="#929FA5" stroke-width="1.5" stroke-miterlimit="10">
                                                                                    </path>
                                                                                    <path d="M15 9L9 15" stroke="#929FA5" stroke-width="1.5"
                                                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                    <path d="M15 15L9 9" stroke="#929FA5" stroke-width="1.5"
                                                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>₪ {{ number_format($item['price'], 2) }}</td>

                                                                <td>
                                                                    <div class="input-add d-flex" id="item-{{ $item['product_id'] }}">
                                                                        <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-default btn-number" data-type="minus"
                                                                                data-field="qty-{{ $item['product_id'] }}" @if($item['quantity'] == 1)
                                                                                disabled @endif>
                                                                                <span class="glyphicon glyphicon-minus">-</span>
                                                                            </button>
                                                                        </span>
                                                                        <input type="text" name="qty-{{ $item['product_id'] }}"
                                                                            class="form-control input-number" value="{{ $item['quantity'] }}" min="1"
                                                                            max="10">
                                                                        <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-default btn-number" data-type="plus"
                                                                                data-field="qty-{{ $item['product_id'] }}" @if($item['quantity'] == 10)
                                                                                disabled @endif>
                                                                                <span class="glyphicon glyphicon-plus">+</span>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="cart-product-cell">
                                                                        @if(!empty($item['product_image']))
                                                                            <img src="{{ asset('uploads/product/product_image/' . $item['product_image']) }}"
                                                                                alt="{{ $item['name'] }}"
                                                                                class="cart-product-thumb">
                                                                        @else
                                                                            <img src="{{ asset('stc_css/images/Logo.svg') }}"
                                                                                alt=""
                                                                                class="cart-product-thumb">
                                                                        @endif
                                                                        <span class="cart-product-name">{{ $item['name'] }}</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                </div>
                    @else
                        <p>سلة التسوق فارغة.</p>
                        <p><small>Your cart is empty.</small></p>
                    @endif
                    <div class="cunt_shoping">
                            <a href="{{route('products')}}">
                                <button type="button" class="btn btn-sho">العودة إلى المتجر <svg
                                        xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#5f6368">
                                        <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                    </svg></button>
                            </a>
                        </div>
                </div>
            </div>

            @if(!empty($cart))
                <div class="col-md-4">
                    @if($totalSubTotal  > 0 || $totalAmount > 0)
                        <div class="cart_det">
                            <h3>مجموع البطاقات</h3>
                            <div class="cart_amount">
                                <div class="cart_am">
                                    <p>المجموع الفرعي</p>
                                    <h4>₪ {{ number_format($totalSubTotal, 2) }}</h4>
                                </div>
                                <!-- <div class="cart_am">
                                    <p>شحن</p>
                                    <h4>₪ {{ number_format($shippingCost, 2) }}</h4>
                                </div> -->
                                {{-- <div class="cart_am">
                                    <p>ضريبة</p>
                                    <h4>₪ {{ number_format($tax, 2) }}</h4>
                                </div> --}}
                                <div class="cart_am total_am">
                                    <p>المجموع</p>
                                    <h4>₪ {{ number_format($totalAmount, 2) }}</h4>
                                </div>
                                {{-- <a href="{{ route('enquire_now') }}">
                                    <button type="button" class="btn btn-cart w-100">الاستفسار الان
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#5f6368">
                                            <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                        </svg>
                                    </button>
                                </a> --}}
                                @if(Auth::guard('local')->check())
                                    <button type="button" class="btn btn-cart w-100" id="openInquiryModal" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                                        الاستفسار الان
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#5f6368">
                                            <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                        </svg>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-cart w-100" id="openGuestCheckoutModal" data-bs-toggle="modal" data-bs-target="#guestCheckoutModal">
                                        إرسال الطلب
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#5f6368">
                                            <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                        </svg>
                                    </button>
                                @endif                                
                            </div>
                        </div>
                    @endif

                </div>
            @endif

            <div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inquiryModalLabel">استفسار</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="inquiryForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="message" class="form-label">رسالتك</label>
                                    <textarea class="form-control" name="message" id="message" rows="4" placeholder="اكتب استفسارك هنا..."></textarea>
                                </div>
            
                                <!-- Dynamic Product List with hidden fields for product_id and qty -->
                                <div id="productList" style="display:none;"></div>
            
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="guestCheckoutModal" tabindex="-1" aria-labelledby="guestCheckoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="guestCheckoutModalLabel">إرسال الطلب / Place Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="guestCheckoutForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="guest_first_name" class="form-label">الاسم الأول / First Name *</label>
                                        <input type="text" class="form-control" name="guest_first_name" id="guest_first_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="guest_last_name" class="form-label">اسم العائلة / Last Name *</label>
                                        <input type="text" class="form-control" name="guest_last_name" id="guest_last_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="guest_phone" class="form-label">رقم الهاتف / Phone *</label>
                                        <input type="text" class="form-control" name="guest_phone" id="guest_phone" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="guest_email" class="form-label">البريد الإلكتروني / Email</label>
                                        <input type="email" class="form-control" name="guest_email" id="guest_email">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="guest_location" class="form-label">الموقع / Location *</label>
                                    <textarea class="form-control" name="guest_location" id="guest_location" rows="2" placeholder="المدينة، العنوان، أو أي تفاصيل للتوصيل" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="guest_message" class="form-label">ملاحظات / Notes</label>
                                    <textarea class="form-control" name="message" id="guest_message" rows="3" placeholder="أي ملاحظات إضافية..."></textarea>
                                </div>
                                <div id="guestProductList" style="display:none;"></div>
                                <div class="mb-3">
                                    <label for="guest_captcha" class="form-label">رمز التحقق / Security code *</label>
                                    <div class="guest-captcha-box mb-2">
                                        <img src="{{ route('guest.captcha') }}" id="guestCaptchaImage" alt="Security code">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" id="refreshGuestCaptcha">↻ رمز جديد</button>
                                    </div>
                                    <input type="text" class="form-control" name="captcha" id="guest_captcha" required autocomplete="off" placeholder="اكتب الأحرف والأرقام كما تظهر">
                                    <small class="text-muted">Type the letters and numbers shown in the image.</small>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">إرسال الطلب</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
            



            <!-- Add cart items table and other logic as needed -->




        </div>
    </div>
</div>





@push('script')
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
        //         input.val(0);
        //     }

        //     // Enable/disable buttons based on current value for each item
        //     var itemId = $(this).closest('div').attr('id').replace('item-', '');
        //     var itemInput = $("input[name='qty-" + itemId + "']");
        //     var currentVal = parseInt(itemInput.val());

        //     if (currentVal <= min) {
        //         $('.btn-number[data-field="qty-' + itemId + '"][data-type="minus"]').attr('disabled', true);
        //     } else {
        //         $('.btn-number[data-field="qty-' + itemId + '"][data-type="minus"]').attr('disabled', false);
        //     }

        //     if (currentVal >= max) {
        //         $('.btn-number[data-field="qty-' + itemId + '"][data-type="plus"]').attr('disabled', true);
        //     } else {
        //         $('.btn-number[data-field="qty-' + itemId + '"][data-type="plus"]').attr('disabled', false);
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
        //         $(".btn-number[dat a-type='minus'][data-field='" + name + "']").removeAttr('disabled')
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

//         $('.btn-number').click(function (e) {
//     e.preventDefault();

//     var fieldName = $(this).attr('data-field');
//     var type = $(this).attr('data-type');
//     var input = $("input[name='" + fieldName + "']");
//     var currentVal = parseInt(input.val());
//     var min = parseInt(input.attr('min'));
//     var max = parseInt(input.attr('max'));

//     if (!isNaN(currentVal)) {
//         if (type === 'minus') {
//             if (currentVal > min) {
//                 input.val(currentVal - 1).change();
//             }
//         } else if (type === 'plus') {
//             if (currentVal < max) {
//                 input.val(currentVal + 1).change();
//             }
//         }
//     } else {
//         // input.val(min);
//     }

//     // **Update button state after value change**
//     updateButtonState(input, min, max);
// });

// // **Function to enable/disable buttons properly**
// function updateButtonState(input, min, max) {
//     var currentVal = parseInt(input.val());

//     // Minus button disable/enable
//     if (currentVal <= min) {
//         $(".btn-number[data-type='minus'][data-field='" + input.attr('name') + "']").attr('disabled', true);
//     } else {
//         $(".btn-number[data-type='minus'][data-field='" + input.attr('name') + "']").removeAttr('disabled');
//     }

//     // Plus button disable/enable
//     if (currentVal >= max) {
//         $(".btn-number[data-type='plus'][data-field='" + input.attr('name') + "']").attr('disabled', true);
//     } else {
//         $(".btn-number[data-type='plus'][data-field='" + input.attr('name') + "']").removeAttr('disabled');
//     }
// }

// // **Input change event to recheck button states**
// $('.input-number').change(function () {
//     var minValue = parseInt($(this).attr('min'));
//     var maxValue = parseInt($(this).attr('max'));
//     var valueCurrent = parseInt($(this).val());

//     // Validate input value
//     if (valueCurrent < minValue) {
//         alert('Sorry, the minimum value was reached');
//         $(this).val(minValue);
//     } else if (valueCurrent > maxValue) {
//         alert('Sorry, the maximum value was reached');
//         $(this).val(maxValue);
//     }

//     // Update button state
//     updateButtonState($(this), minValue, maxValue);
// });

// // **Prevent non-numeric values**
// $(".input-number").keydown(function (e) {
//     if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
//         (e.keyCode == 65 && e.ctrlKey === true) ||
//         (e.keyCode >= 35 && e.keyCode <= 39)) {
//         return;
//     }
//     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
//         e.preventDefault();
//     }
// });

    </script>
<script>
    function loadCartProductsInto(containerSelector) {
        $.ajax({
            url: '{{ route("get.cart.data") }}',
            method: 'GET',
            success: function(response) {
                if (response.length > 0) {
                    var productListHtml = '';
                    response.forEach(function(item) {
                        productListHtml += `
                            <input type="hidden" name="product_id[]" value="${item.product_id}">
                            <input type="hidden" name="qty[]" value="${item.qty}">
                        `;
                    });
                    $(containerSelector).html(productListHtml);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching cart data:', error);
            }
        });
    }

    function refreshGuestCaptcha() {
        $('#guestCaptchaImage').attr('src', '{{ route('guest.captcha') }}?refresh=1&t=' + Date.now());
        $('#guest_captcha').val('');
    }

    $(document).ready(function() {
        $('#openInquiryModal').on('click', function() {
            loadCartProductsInto('#productList');
        });

        $('#openGuestCheckoutModal').on('click', function() {
            loadCartProductsInto('#guestProductList');
            refreshGuestCaptcha();
        });

        $('#refreshGuestCaptcha').on('click', function() {
            refreshGuestCaptcha();
        });

        $('#inquiryForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("save.inquiry") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr) {
                    var message = xhr.responseJSON && xhr.responseJSON.error
                        ? xhr.responseJSON.error
                        : 'حدث خطأ. يرجى المحاولة مرة أخرى.';
                    alert(message);
                }
            });
        });

        $('#guestCheckoutForm').on('submit', function(e) {
            e.preventDefault();

            if (!$('#guest_captcha').val().trim()) {
                alert('يرجى إدخال رمز التحقق.');
                return;
            }

            $.ajax({
                url: '{{ route("save.inquiry") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr) {
                    refreshGuestCaptcha();
                    var message = xhr.responseJSON && xhr.responseJSON.error
                        ? xhr.responseJSON.error
                        : 'حدث خطأ. يرجى المحاولة مرة أخرى.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        message = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    }
                    alert(message);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
    var isLoggedIn = {{ Auth::guard('local')->check() ? 'true' : 'false' }};
    var userId = {{ Auth::guard('local')->check() ? Auth::guard('local')->id() : 'null' }};

    $(".btn-number").click(function (e) {
        e.preventDefault();

        let button = $(this);
        let type = button.attr("data-type");
        let input = button.closest(".input-add").find("input");
        let productId = input.attr("name").split("-")[1];
        let currentValue = parseInt(input.val());
        let min = parseInt(input.attr('min')) || 1;
        let max = parseInt(input.attr('max')) || 10;

        if (type === "plus" && currentValue < max) {
            input.val(currentValue + 1);
        } else if (type === "minus" && currentValue > min) {
            input.val(currentValue - 1);
        } else {
            return;
        }

        updateQty(productId, input.val());
        updateButtonState(input, min, max);
    });

    $(".input-number").change(function () {
        let input = $(this);
        let min = parseInt(input.attr('min')) || 1;
        let max = parseInt(input.attr('max')) || 10;
        let valueCurrent = parseInt(input.val());
        let productId = input.attr("name").split("-")[1];

        if (valueCurrent < min) {
            alert("Minimum quantity reached");
            input.val(min);
        } else if (valueCurrent > max) {
            alert("Maximum quantity reached");
            input.val(max);
        }

        updateQty(productId, input.val());
        updateButtonState(input, min, max);
    });

    function updateButtonState(input, min, max) {
        let currentVal = parseInt(input.val());
        
        input.closest(".input-add").find(".btn-number[data-type='minus']").prop("disabled", currentVal <= min);
        input.closest(".input-add").find(".btn-number[data-type='plus']").prop("disabled", currentVal >= max);
    }

    $(".input-number").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    function updateQty(productId, newValue) {
        var payload = {
            product_id: productId,
            quantity: newValue,
            _token: "{{ csrf_token() }}"
        };

        if (isLoggedIn && userId) {
            payload.user_id = userId;
        }

        $.ajax({
            url: "/update-quantity",
            method: "POST",
            data: payload,
            success: function (response) {
                window.location.reload();
            },
            error: function (error) {
                console.log("Error updating quantity:", error);
            }
        });
    }
});
</script>

@endpush

@endsection