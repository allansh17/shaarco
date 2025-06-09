@extends('layouts.stc_product.header')
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
                    @php
                        $cart = json_decode(Cookie::get('cart', '[]'), true);
                    @endphp

                    @if (!empty($cart))
                                <table>
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
                                                                @if(Auth::guard('local')->check())
                                                                                        @if(
                                                                                                Auth::guard('local')->user()->user_type == "normal" ||
                                                                                                Auth::guard('local')->user()->user_type == "loyal" ||
                                                                                                Auth::guard('local')->user()->user_type == "wholesaler"
                                                                                            )
                                                                                            <td>₪ {{ number_format($item['price'], 2) }}</td>
                                                                                        @endif
                                                                @else
                                                                    <td>N/A</td>
                                                                @endif

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

                                                                <td>{{ $item['name'] }}</td>
                                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                    @if(Auth::guard('local')->check())
                        <div class="cunt_shoping">
                            <a href="{{route('products')}}">
                                <button type="button" class="btn btn-sho">العودة إلى المتجر <svg
                                        xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#5f6368">
                                        <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                    </svg></button>
                            </a>
                        </div>
                    @else
                        <div class="cunt_shoping" style="display: flex;">
                         
                            <a href="{{route('products')}}">
                                <button type="button" class="btn btn-sho">العودة إلى المتجر <svg
                                        xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#5f6368">
                                        <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                    </svg></button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="{{ route('enquire_now') }}">
                                <button type="button" class="btn btn-cart w-100">الاستفسار الان
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#5f6368">
                                        <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                    </svg>
                                </button>                                
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            @if(Auth::guard('local')->check())
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
                                <button type="button" class="btn btn-cart w-100" id="openInquiryModal" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                                    الاستفسار الان
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#5f6368">
                                        <path d="M400-240 160-480l240-240 56 58-142 142h486v80H314l142 142-56 58Z"></path>
                                    </svg>
                                </button>                                
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
    $(document).ready(function() {
        $('#openInquiryModal').on('click', function() {
            // Get the authenticated user's ID from JavaScript
            var userId = "{{ Auth::guard('local')->id() }}"; // Inject the user's ID via Blade

            // Make AJAX call to get the cart data
            $.ajax({
                url: '{{ route("get.cart.data") }}',  // The route you created
                method: 'GET',
                data: { user_id: userId },  // Send user_id as part of the data
                success: function(response) {
                    if (response.length > 0) {
                        var productListHtml = '';
                        response.forEach(function(item) {
                            // Generate HTML for each cart item
                            productListHtml += `
                                <div class="mb-3">
                                    <label class="form-label">Product ID: ${item.product_id}</label>
                                    <input type="hidden" name="product_id[]" value="${item.product_id}">
                                    <input type="hidden" name="qty[]" value="${item.qty}">
                                    <label class="form-label">Quantity: ${item.qty}</label>
                                </div>
                            `;
                        });

                        // Append the product data to the modal body
                        $('#productList').html(productListHtml);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching cart data:', error);
                }
            });
        });

        // Handle form submission
        $('#inquiryForm').on('submit', function(e) {
            e.preventDefault();

            // Make AJAX call to save the inquiry
            $.ajax({
                url: '{{ route("save.inquiry") }}',  // The route to save the inquiry
                method: 'POST',
                data: $(this).serialize(),  // Serialize the form data
                success: function(response) {
                    // Show success message and redirect
                    // alert(response.success);
                    window.location.href = response.redirect;  // Redirect to the desired page
                },
                error: function(xhr, status, error) {
                    console.error('Error saving inquiry:', error);
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
    $(".btn-number").click(function (e) {
        e.preventDefault();

        let button = $(this);
        let type = button.attr("data-type");
        let input = button.closest(".input-add").find("input");
        let productId = input.attr("name").split("-")[1]; // Extract product ID from input name
        let currentValue = parseInt(input.val());
        let min = parseInt(input.attr('min')) || 1;
        let max = parseInt(input.attr('max')) || 10;
        let userId = "{{ Auth::guard('local')->check() ? Auth::guard('local')->user()->id : null }}"; // Get logged-in user ID

        if (!userId) {
            alert("User not authenticated!");
            return;
        }

        // **Quantity Increase/Decrease**
        if (type === "plus" && currentValue < max) {
            input.val(currentValue + 1);
        } else if (type === "minus" && currentValue > min) {
            input.val(currentValue - 1);
        } else {
            return;
        }

        // **Update Quantity via AJAX**
        updateQty(userId, productId, input.val());

        // **Enable/Disable buttons accordingly**
        updateButtonState(input, min, max);
    });

    // **Input Change Event**
    $(".input-number").change(function () {
        let input = $(this);
        let min = parseInt(input.attr('min')) || 1;
        let max = parseInt(input.attr('max')) || 10;
        let valueCurrent = parseInt(input.val());
        let productId = input.attr("name").split("-")[1];
        let userId = "{{ Auth::guard('local')->check() ? Auth::guard('local')->user()->id : null }}"; // Get logged-in user ID

        // Validate input
        if (valueCurrent < min) {
            alert("Minimum quantity reached");
            input.val(min);
        } else if (valueCurrent > max) {
            alert("Maximum quantity reached");
            input.val(max);
        }

        // **Update Quantity via AJAX**
        updateQty(userId, productId, input.val());

        // **Enable/Disable buttons**
        updateButtonState(input, min, max);
    });

    // **Function to Enable/Disable Buttons**
    function updateButtonState(input, min, max) {
        let currentVal = parseInt(input.val());
        
        input.closest(".input-add").find(".btn-number[data-type='minus']").prop("disabled", currentVal <= min);
        input.closest(".input-add").find(".btn-number[data-type='plus']").prop("disabled", currentVal >= max);
    }

    // **Prevent Non-Numeric Input**
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

    // **AJAX Function to Update Quantity in Database**
    function updateQty(userId, productId, newValue) {
        $.ajax({
            url: "/update-quantity",
            method: "POST",
            data: {
                user_id: userId,
                product_id: productId,
                quantity: newValue,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                console.log("Quantity updated:", response.message);
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