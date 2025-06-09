@extends('layouts/contentNavbarLayout')
@section('title', 'Add Product')
@section('content')


<div class="card order_card">
    <div class="card-header justify-content-between d-flex">
        <h3>{{(' Order')}}</h3>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('order') }}">
                <i class='bx bx-list-ul'></i> List of Order
            </a>
        </div>
    </div>
    <div class="card-body">
        <form class="forms-sample" id="addEditForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="id" placeholder="" name='id'
                value="{{ isset($order) ? $order->id :'0'}}">
            <div class="customer_1">
                <div class="sub-head d-flex align-items-center">
                    <h5 class="">Customer Details</h5>
                </div>
                <div class="row">
                    @if(isset($order))
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label for="pkgs" class="required mb-1">{{ __('Customer')}}</label>
                            <input class="form-control" type="text" name="hidden_product" id="product"
                                value="{{$order->name}}" readonly>
                            <input class="form-control" type="hidden" name="customer_id" id="product"
                                value="{{$order->customer_id}}">
                        </div>
                    </div>
                    @else
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label for="pkgs" class="required mb-1">{{ __('Customer')}}</label>
                            <select {{isset($order) ? 'disabled' :'' }} class="form-control" id="customer_id"
                                name='customer_id' required>
                                <option value="">Select Customer</option>
                                @foreach($customer as $val)
                                <option {{(isset($order) && $order->customer_id == $val->id ? 'Selected':'')}}
                                    value="{{$val->id}}">{{$val->first_name."  (".$val->phone.")"}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label for="pkgs" class="required mb-1">{{ __('Customer Address')}}</label>
                            <select class="form-control" id="customer_address" name='customer_address' required>
                                <option value="">Select Address</option>
                                @foreach($customers_add as $val)
                                <option {{(isset($order) && $order->customer_id == $val->customer_id ? 'Selected':'')}}
                                    value="{{$val->id}}">
                                    {{ $val->address.",".$val->city.",".$val->state.",".$val->pin_code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product_1">
                <div class="sub-head d-flex align-items-center">
                    <h5 class="">Product Details</h5>
                </div>

                <!-- <div class="row product_htmls">
                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <label for="pkgs" class="required mb-1">{{ __('Product Name')}}</label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <label for="gender" class="required mb-1">{{ __('Qty')}}</label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <label for="gender" class="required mb-1">{{ __('MRP')}}</label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <label for="gender" class="required mb-1">{{ __('SGST')}}</label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <label for="gender" class="required mb-1">{{ __('CGST')}}</label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <label for="gender" class="required mb-1">{{ __('Price')}}</label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <label for="gender" class="required mb-1">{{ __('Sub Total')}}</label>
                        </div>
                    </div>
                </div> -->


              

                <div class="data_loop mb-3">


                    @if(isset($order) && $order->id > 0)
                    @foreach($orders as $index => $Pfeature)
                    <div id="edit_delete{{$index}}">
                    <div id="form-container" class="establishment-row1" >
                        <div class="row bg_change">
                            <!-- for form data insert -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="pkgs" class="required mb-1">{{ __('Product Name')}}</label>
                                    <select class="form-control prdct_id_data" id="prdctid_{{$index}}" name='prdct_id[]'
                                        value="" required onchange="get_productData(this.id)">
                                        <option value="" selected disabled>Select Product</option>
                                        @if(isset($products))
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}" {{$product->id==$Pfeature->pid ? 'selected':''}}>{{$product->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('Qty')}}</label>
                                    <input type="hidden" class="form-control" id="checkstock_{{$index}}" name="stock[]"
                                        value="{{$Pfeature->stock_quantity ?? ''}}">
                                    <input type="number" class="form-control" onchange="getqtyData(this.id)"
                                        id="qty_{{$index}}" name="qty[]" placeholder="Quantity" required value="{{$Pfeature->pqty ?? ''}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('MRP')}}</label>
                                    <input type="number" class="form-control" id="mrp_{{$index}}" name="mrp1[]"
                                        placeholder="MRP" required readonly value="{{$Pfeature->mrp ?? ''}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('SGST')}}</label>
                                    <input type="number" class="form-control" id="sgst_{{$index}}" name="sgst[]"
                                        placeholder="SGST" required readonly value="{{$Pfeature->sgst ?? ''}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('CGST')}}</label>
                                    <input type="number" class="form-control" id="cgst_{{$index}}" name="cgst[]"
                                        placeholder="CGST" required readonly value="{{$Pfeature->cgst ?? ''}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('Price')}}</label>
                                    <input type="number" class="form-control" id="price_{{$index}}" name="price[]"
                                        placeholder="Price" required readonly value="{{$Pfeature->pprice ?? ''}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('Sub Total')}}</label>
                                    <input type="number" class="form-control subtotal" id="subtotal_{{$index}}"
                                        name="sub_total[]" placeholder="Sub Total" required value="{{$Pfeature->ptotal_price ?? ''}}">
                                </div>
                            </div>


                           

                        </div>
                        <div class="d-flex justify-content-end remove-div mt-3 remove-property-edit"><a href="javascript:void(0)"  onclick="remove_edit('edit_delete{{ $index }}')" class="remove-property button-design fw-semibold text-decoration-none"><i class="bi bi-trash"></i> Remove</a></div>
                    </div>
                </div>
                    @endforeach
                    @endif

                    @if(isset($order) && $order->id > 0)
                    @else
                    <div id="form-container" class="establishment-row1">
                        <div class="row bg_change">
                            <!-- for form data insert -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="pkgs" class="required mb-1">{{ __('Product Name')}}</label>
                                    <select class="form-control prdct_id_data" id="prdctid_0" name='prdct_id[]'
                                        value="" required onchange="get_productData(this.id)">
                                        <option value="" selected disabled>Select Product</option>
                                        @if(isset($products))
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}" >{{$product->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('Qty')}}</label>
                                    <input type="hidden" class="form-control" id="checkstock_0" name="stock[]"
                                        value="{{$Pfeature->stock_quantity ?? ''}}">
                                    <input type="number" class="form-control" onchange="getqtyData(this.id)"
                                        id="qty_0" name="qty[]" placeholder="Quantity" required value="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('MRP')}}</label>
                                    <input type="number" class="form-control" id="mrp_0" name="mrp1[]"
                                        placeholder="MRP" required readonly value="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('SGST')}}</label>
                                    <input type="number" class="form-control" id="sgst_0" name="sgst[]"
                                        placeholder="SGST" required readonly value="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('CGST')}}</label>
                                    <input type="number" class="form-control" id="cgst_0" name="cgst[]"
                                        placeholder="CGST" required readonly value="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('Price')}}</label>
                                    <input type="number" class="form-control" id="price_0" name="price[]"
                                        placeholder="Price" required readonly value="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender" class="required mb-1">{{ __('Sub Total')}}</label>
                                    <input type="number" class="form-control subtotal" id="subtotal_0"
                                        name="sub_total[]" placeholder="Sub Total" required value="">
                                </div>
                            </div>


                           

                        </div>
                        <div class="d-flex justify-content-end remove-div mt-3"></div>
                    </div>

                    @endif

                    <div class="establishment-container"> </div>
                    <div class="d-flex justify-content-end">
                        <a href="javascript:void(0)" class="add-more-people rounded-1 fw-semibold text-decoration-none">Add More </a>
                    </div>

                </div>

            </div>


            <div class="order_summery_1 w-50">
                <div class="sub-head ">
                    <h5 class="">Order Summary</h5>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group d-flex mb-3">
                            <input placeholder="Enter Coupon Code"  class="form-control rounded-end-0" type="text"
                                id="coupon_code" name="coupon_code" value="{{$order->coupon_code ?? ''}}">
                            <a href="javascript:void(0)" id="apply_code"
                                class="btn btn-primary rounded-start-0">Apply</a>
                            
                        </div>
                        <span id="coupon_error" 
                                style="display:none;  font-size: 12px; color: red;">
                                Invalid Coupn code<span>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group d-flex mb-3 align-items-center">
                            <label for="gender" class="w-25">{{ __('MRP')}}</label>
                            <input readonly class="form-control" type="text" id="mrp" name="mrp" value="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group d-flex mb-3 align-items-center">
                            <label for="gender" class="w-25">{{ __('Discount')}}</label>
                            <div class="discount_normal w-100">
                                <input oninput="total_oprice(this.value);" class="form-control" type="number"
                                    id="discount" name="discount" value="{{$order->discount ?? 0}}">
                            </div>
                            <div class="discount_coupon w-100" style="display:none;">
                                <input type="hidden" name="discount" value="{{$order->coupon_code ?? ''}}">
                                <input readonly oninput="total_oprice(this.value);" class="form-control" type="text"
                                    id="discount_coupon" name="discount" value="0">
                                <input class="form-control" type="hidden" id="coupon_id" name="coupon_id" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group d-flex mb-3 align-items-center">
                        <label for="gender" class="w-25">{{ __('Total')}}</label>
                        <input readonly class="form-control" type="text" id="total" name="total" value="0">
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-end">
                <input class="btn btn-primary pull-right submit_button" type="submit" name="Save" value="Save">
            </div>
        </form>
    </div>







</div>
<!-- push external js -->
@push('scripts')

<script>
$('#apply_code').on('click', function() {
    var coupon_value = $("#coupon_code").val();
    var mrp = $("#mrp").val();

    if (coupon_value) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "{{route('coupon_code.order')}}",
            data: {
                mrp: mrp,
                coupon_code: coupon_value,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                var response = data;
                if(response.code == '200'){
                    toastr.success(response.msg)
                }
                else{
                    toastr.error(response.error)
                }
                
                var discount_amount = response.dis_amt;
                if (response.code == "201") {

                    $("#coupon_code").val('');
                    $("#coupon_error").text(response.msg);
                    $("#coupon_error").show();
                    $(".discount_normal").show();
                    $(".discount_coupon").hide();
                    calculateTotal(discount_amount);
                    total_oprice($("#discount").val());
                } else {

                    $("#coupon_error").hide();
                    $(".discount_normal").hide();
                    $(".discount_coupon").show();
                    calculateTotal(discount_amount);


                    $("#coupon_id").val(response.coupon_data.id);
                    if (response.coupon_data.discount_type == 2) {
                        $("#discount_coupon").val(response.coupon_data.discount);
                    } else {
                        $("#discount_coupon").val($("#mrp").val() * response.coupon_data
                            .discount / 100);
                    }

                    var discount_coupon = $("#discount_coupon").val();
                    total_coupon_o(discount_coupon);

                }

            },
        });
    } else {
        total_oprice($("#discount").val());
        $(".discount_normal").show();
        $(".discount_coupon").hide();
        $("#coupon_error").hide();

    }
});

$('#coupon_code').keypress(function(e) {
    if (e.which == 13) {
        $("#apply_code").click();
        return false;
    }
});

$('#coupon_code').on('change', function() {
    if ($(this).val()) {

    } else {
        total_oprice($("#discount").val());
        $(".discount_normal").show();
        $(".discount_coupon").hide();
        $("#coupon_error").hide();
    }
});

$('#reset_data').on('click', function() {
    $('#category_id').val('').trigger('change');
    $('#brand_id').val('').trigger('change');
    $('#sub_category_id').val('').trigger('change');
});

const product_idinsert = [];

$('.add_product').on('click', function() {
    const product_id = $("#product_name").val();
    //console.log(product_idinsert);

    product_id.forEach(function(element) {
        if (product_idinsert.includes(element)) {
            product_id.splice(product_id.indexOf(element), 1);
            //console.log(element + " exists in product_idinsert");

        } else {
            product_idinsert.push(element);
            //console.log(element + " does not exist in product_idinsert");
        }
    });

    if (product_id.length > 0) {

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "",
            data: {
                id: product_id,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                var response = data;
                // $('#product_id').html(response.sub); 
                $(".product_htmls").show();

                $("#exampleModal").modal('hide');
                $('#form-container').append(response.sub);
                calculateTotalPrice();
                total_oprice($("#discount").val());
                remove_btn();
                $("#apply_code").click();

            },
        });
    } else {
        $("#exampleModal").modal('hide');

    }


});

remove_btn();

function remove_btn() {
    var elementsWithClass = document.querySelectorAll('.remove-field');
    var count = elementsWithClass.length;
    if (count == 1) {
        $(".remove-field").hide();
    } else {
        $(".remove-field").show();
    }
}

// To remove Form
function remove_form(id) {
    //product_idinsert.pop(id);
    removeElementById(product_idinsert, id);
    $("#product" + id).remove();
    calculateTotalPrice();
    $("#apply_code").click();
    total_oprice($("#discount").val());
    remove_btn();
    //console.log("Pranav=>", product_idinsert);
}

function removeElementById(array, idToRemove) {
    const indexToRemove = array.indexOf(idToRemove);

    //  if (indexToRemove !== -1) {
    array.splice(indexToRemove, 1);
    //  }
}

$(document).on("click", ".file-upload-browse", function() {
    var file = $(this).parent().parent().parent().find('.file-upload-default');
    file.trigger('click');
});


$(document).on("change", ".file-upload-default", function() {
    var input = $(this);
    var fileCount = input[0].files.length;

    if (fileCount > 0) {
        input.parent().find('.file-upload-info').attr('placeholder', fileCount + ' Image(s) selected');
    } else {
        input.parent().find('.file-upload-info').attr('placeholder', 'Upload Image');
    }

    // console.log('Number of files selected: ' + fileCount);
});





$('.prdct_id_data').select2();

function get_productData(id) {
    var baseId = id.match(/\d+$/)[0];
    // alert(baseId)
    // $('.prdct_id_data').select2({ placeholder: 'Select Product' }).on("select2:select", function (event) {
    //     alert('----------')
    var value = $('#prdctid_' + baseId).find("option:selected").val();
    var validator = $("#addEditForm").validate();
    validator.element("#prdctid_" + baseId);


    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: "{{route('product_detail.order')}}",
        data: {
            id: value,
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
            var response = data.data[0];

            //    $('#mrp').html(response.mrp);
            $('#mrp_' + baseId).val(response.mrp);
            $('#sgst_' + baseId).val(response.sgst);
            $('#cgst_' + baseId).val(response.cgst);
            $('#price_' + baseId).val(response.cutoff_price);
            $('#subtotal_' + baseId).val(response.cutoff_price);
            $('#qty_' + baseId).val('1');
            $('#checkstock_' + baseId).val(response.stock_quantity);
            subtotal();

            //    //  $('#customer_address').val(null).trigger('change');

        },
    });

    // });

}

subtotal();
const discount = '{{ $order->discount ?? '' }}';
calculateTotal(discount);


function subtotal() {

    var total = 0;
    $('.subtotal').each(function() {
        total += parseFloat($(this).val());
    });
    $('#mrp').val(total);
    $('#total').val(total); $('#total').val(total);
}

function calculateTotal(dis_amount) {
    var total = 0;
    $('.subtotal').each(function() {
        total += parseFloat($(this).val());
    });

    if (dis_amount != 0) {
       // var final_amount = (total * dis_amount) / 100;
         var final_amount = total - dis_amount;
        $('#total').val(final_amount);
    } else {
        $('#total').val(total);
    }


}


function getqtyData(id) {
    var baseId = id.match(/\d+$/)[0];

    // $('#qty_0').on('change', function() {

    var check_stock = parseInt($('#checkstock_' + baseId).val());
    var product_id = $('#prdctid_' + baseId).val();

    if (product_id == '' || product_id == null) {
        toastr.error("Please select a product first.");
        $('#qty_' + baseId).val('1'); // reset quantity to 1
    } else {
        var qty = parseInt($('#qty_' + baseId).val());
        if (qty < '1') {
            $('#qty_' + baseId).val('1'); // set value to 1 if less than 1
            qty = 1;
        }

        if (check_stock >= qty) {
            var price = $('#price_' + baseId).val();
            var subTotal = qty * price;
            $('#subtotal_' + baseId).val(subTotal.toFixed(2));
        } else {
            toastr.error("Currently unavailable. Check back soon.")
        }

        subtotal();
    }
}










$(document).ready(function() {
       
        @if(!isset($order->id))
        let counter = 1;
        let prop_counter = 1;
        @else
        let counter = {{count($orders)}};
        let prop_counter = {{count($orders)}};
        @endif

       

        prop_counter++;

        $(".add-more-people").on("click", function() {

         
             $('.prdct_id_data').select2('destroy');

                    // Clone the element
            let clone = document.querySelector('.establishment-row1').cloneNode(true);

            // Check and log the clone to verify it
            console.log('Before removing class:', clone);

            // Find the element with class 'remove-property-edit' inside the clone
            let removePropertyEdit = clone.querySelector('.remove-property-edit');

            // Remove the class 'remove-property-edit' from the found element
           // Remove the entire div with class 'remove-property-edit' from the found element
                if (removePropertyEdit) {
                    removePropertyEdit.parentNode.removeChild(removePropertyEdit);
                }
               // Clear the values of all input fields inside the clone
                    let inputs = clone.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.value = '';
                    });

                    // Remove the third img tag if it exists
                    let images = clone.querySelectorAll('select');
                    images.forEach(img => {
                        img.value = '';
                    });


                // Append or insert the clone wherever needed
                document.body.appendChild(clone);
            updateIdsAndNames(clone);
            document.querySelector('.establishment-container').appendChild(clone);
                addRemoveLink(clone);
           
            $("#name_count_" + counter).val(counter);

            counter++;
            prop_counter++;
            // toal_cat_price(counter);
            $('.prdct_id_data').select2();
        });




        function addRemoveLink(clone) {
            // Create a "Remove" link
            let removeDiv = document.createElement('div');
            removeDiv.classList.add('d-flex', 'justify-content-end', 'remove-div', 'mt-3');
            let removeLink = document.createElement('a');
            removeLink.href = 'javascript:void(0)';
            removeLink.innerHTML = '<i class="bi bi-trash"></i>Remove';
            removeLink.classList.add('remove-property', 'button-design', 'fw-semibold', 'text-decoration-none');

            // Append the <a> tag to the <div> element
            removeDiv.appendChild(removeLink);

            // Append the <div> element to the cloned row
            clone.appendChild(removeDiv);

            // Add an event listener to the <a> tag to remove the corresponding cloned row
            removeLink.addEventListener('click', function() {
                // alert("huu");
                //  $(document).on("click", '.remove-property', function() {
                prop_counter = prop_counter - 2;
                // $(".one-property").text(prop_counter + " Property");
                clone.remove();
                //toal_cat_price();
                prop_counter = prop_counter + 1;


            });


        }

        function updateIdsAndNames(clone) {
            clone.querySelectorAll('[id]').forEach(element => {
              //  element.id = element.id + '_' + counter;
              element.id = element.id.replace(/_[0-9]+$/, '_' + counter);
            });

            // Update 'name' attributes for radio buttons
            clone.querySelectorAll('[type="text"]').forEach((radio, index) => {
                let currentName = radio.name; // Get the existing name
                let newName = currentName.replace(/_\d+/, '_' + counter);
                radio.name = newName;
                // console.log('counter',counter);
                //  console.log('name',newName);
                return;


            });
            clone.querySelectorAll('[for]').forEach(element => {
                var currentForValue = element.getAttribute('for');
                element.setAttribute('for', currentForValue + '_' + counter);

            });

            // Update 'name' attributes for radio buttons
            clone.querySelectorAll('[type="radio"]').forEach((radio, index) => {
                let currentName = radio.name; // Get the existing name
                let newName = currentName.replace(/_\d+/, '_' + counter);
                radio.name = newName;

            });


            // Update 'name' attributes for radio buttons
            clone.querySelectorAll('[type="file"]').forEach((radio, index) => {
                let currentName = radio.name; // Get the existing name
                let newName = currentName.replace(/_\d+/, '_' + counter);
                radio.name = newName;

            });


            clone.querySelectorAll('.upload_images').forEach((fileInput, index) => {
                let currentName = fileInput.name; // Get the existing name
                // console.log(currentName);
                let newName = currentName.replace(/_\d+/, '_' + counter); // Update the counter in the name
                //console.log(newName);
                fileInput.name = newName;

            });


        }

    });




// var counter = 1;

// $(document).on('click', '.add_more', function() {
//     $('.prdct_id_data').select2('destroy');

//     var row = $(this).closest('.row');
//     var clone = row.clone();

//     $(clone).find('input').each(function() {
//         var id = $(this).attr('id');
//         var baseId = id.replace(/\_\d+$/, ''); // remove any existing counter value
//         var newId = baseId + '_' + counter;
//         $(this).attr('id', newId);
//         $(this).attr('name', $(this).attr('name'));
//     });

//     $(clone).find('select').each(function() {
//         var id = $(this).attr('id');
//         var baseId = id.replace(/\_\d+$/, ''); // remove any existing counter value
//         var newId = baseId + '_' + counter;
//         $(this).attr('id', newId);
//         $(this).attr('name', $(this).attr('name'));
//     });

//     // Remove the "Add More" button from the cloned row
//     $(clone).find('.add_more').remove();

//     // Add a "Remove" button to the cloned row
//     var removeButton = ' <a href="javascript:void(0)" class="btn btn-primary mt-4 remove_row">Remove</a>';
//     // var removeButton = '<button type="button" class="btn btn-primary remove_row">Remove</button>';
//     $(clone).append(removeButton);

//     row.after(clone);
//     counter++;

//     $('.prdct_id_data').select2();
// });

// Add an event listener for the "Remove" button
$(document).on('click', '.remove_row', function() {
    var row = $(this).closest('.row');
    row.remove();
});




// Reinitialize Select2 on cloned elements
$('#customer_id').select2().on("select2:select", function(event) {
    var value = $(event.currentTarget).find("option:selected").val();
    var validator = $("#addEditForm").validate();
    validator.element("#customer_id");

    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: "{{route('get_address.order')}}",
        data: {
            id: value,
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
            var response = data;
            $('#customer_address').html(response.sub);
            //  $('#customer_address').val(null).trigger('change');

        },
    });

});



function qty_price(id) {

    var maxQty = parseInt($("#" + id).attr("max-qty"), 10);
    var enteredQty = parseInt($("#" + id).val(), 10);
    if (enteredQty >= maxQty) {
        $("#" + id).val(maxQty);
    }
    if (enteredQty <= 0) {
        $("#" + id).val("1");
    }

    var qty = $("#" + id).val();

    var dataid = $("#" + id).data('id');

    var dataValue = $("#price" + dataid).data('value');
    if (qty > 0) {
        var totalPrice = qty * dataValue;
        $("#price" + dataid).val(totalPrice.toFixed(2));
        //$("#price"+dataid).val(qty*dataValue);
    } else {
        $("#price" + dataid).val(0);

    }
    calculateTotalPrice();
    $("#apply_code").click();
    // new code by pranav 
    total_oprice($("#discount").val());

}

$('.datetimepicker').datetimepicker({
    format: 'MM-DD-YYYY',
    useCurrent: false,
    showClose: true
}).on('dp.change', function(e) {
    var formatedValue = e.date.format('YYYY-MM-DD');
    // console.log(formatedValue);
    $('#date').val(formatedValue);
});


$.validator.addMethod("greaterThanZero", function(value, element) {
    return parseFloat(value) > 0;
}, "Value must be greater than 0");


$.validator.addMethod(
    "regex",
    function(value, element) {
        return value.match(/^[a-zA-Z ]*$/);
    },
    "Only alphabetic characters are allowed."
);

$.validator.addMethod("extyp", function(value, element) {
    // console.log(element)
    // console.log(value)
    if (!value) {
        return true;
    }
    if (!value.match(/\.(jpg|jpeg|png|JPG|PNG|JPEG)$/i)) {
        return false;
    }
    return true;
}, 'Only formats are allowed: jpeg, jpg, png');


// Extend the jQuery Validation Plugin with a custom method
$.validator.addMethod("maxQty", function(value, element) {
    var maxQty = parseInt($(element).attr('max-qty'), 10);
    var enteredQty = parseInt(value, 10);
    return enteredQty <= maxQty;
}, "Quantity cannot exceed the maximum allowed value.");


//add update item
$("#addEditForm").validate({
    rules: {

        name: {
            required: true,
            regex: true
        },

        discount: {
            required: true,
            min: 0
        },

        "qty[]": {
            required: true,
            greaterThanZero: true
            // maxQty: true
        }
    },
    messages: {
        "qty[]": {
            greaterThanZero: "Qty must be greater than 0"
        }
    },
    errorElement: 'span',
    errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-control').parent().append(error);
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function(form) {
        //form.submit();
        // $("#apply_code").click();
        var formData = new FormData($("#addEditForm")[0]);
        var url_up = "{{url('order/store')}}";
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: url_up,
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#addEditForm").find('.submit_button').attr("disabled", true);
                $('.loader').show();
            },
            success: function(data) {
                $("#addEditForm").find('.submit_button').attr("disabled", false);
                $('.loader').hide();
                var response = JSON.parse(data);
                //console.log(response);
                if (response.code == 200) {
                    //show notification
                    //location.reload();
                    toastr.success(response.msg);
                    setTimeout(function() {
                        window.location.href = "{{url('order')}}";
                        // body...
                    }, 3000);
                } else {
                   
                    toastr.error(response.msg);
                    $('.loader').hide();
                    // $("#addEditForm").find('.submit_button').attr("disabled", true);
                }
            },
        });
        return false;
    }
});
</script>

<script>
$(document).on('click', '.remove-image', function(e) {
    e.preventDefault();
    var id = $(this).data('id');

    $.confirm({
        title: 'Delete',
        content: 'Are you sure you want to delete this?',
        buttons: {
            Cancel: function() {
                //nothing to do
            },
            Sure: {
                btnClass: 'btn-primary',
                action: function() {
                    // removedata(id = id);
                    $.ajax({
                        type: 'POST',
                        url: '{{url("delete-image")}}/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            if (data.status === "200") {
                                // alert("ghfgj");
                                // alert(data.id);

                                $('#image_display' + data.id + '').remove();
                                toastr.success(data.message);


                            }
                        }
                    });
                },
            }
        }
    });

});





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






function calculateTotalPrice() {
    const priceInputs = document.querySelectorAll('.price_product');
    let total = 0;
    priceInputs.forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    $("#mrp").val(total);
    $("#total").val(total);
    //  $("#apply_code").click();
    // $("#apply_code").off("click");
}

function total_oprice(total_p) {
    var mrp_p = parseInt($("#mrp").val());
    if (total_p >= 0) {
        if (parseInt(total_p) <= mrp_p) {
            $("#total").val(mrp_p - total_p);
        } else {
            $("#total").val("0");
        }
    }


}

function total_coupon_o(dis_coupon) {
    var mrp_p = $("#mrp").val();
    $("#total").val(mrp_p - dis_coupon);
}


$('#exampleModal').on('hide.bs.modal', function() {
    $("#reset_data").click();
});

// edit time  product id insert

// const product_id= $("#product_name").val();

// product_id.forEach(function(element) {
//     if (product_idinsert.includes(element)) {
//         product_id.splice(product_id.indexOf(element), 1);
//     console.log(element + " exists in product_idinsert");

// } else {
//     product_idinsert.push(element);
//     console.log(element + " does not exist in product_idinsert");
// }
//     });
var productInputs = document.querySelectorAll('.product_id');
productInputs.forEach(function(input) {
    product_idinsert.push(input.value);
});
// console.log("Pranav push=>", product_idinsert);
</script>



@endpush
@endsection