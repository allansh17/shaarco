@extends('layouts/contentNavbarLayout')
@section('title', 'Product Management')
@section('content')
{{-- <div class="card mb-4">
    <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                        <div>
                            <h6 class="mb-2">In-store Sales</h6>
                            <h4 class="mb-2">$5,345.43</h4>
                            <p class="mb-0"><span class="text-muted me-2">5k orders</span><span
                                    class="badge bg-label-success">+5.7%</span></p>
                        </div>
                        <div class="avatar me-sm-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class="bx bx-store-alt bx-sm"></i>
                            </span>
                        </div>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none me-4">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                        <div>
                            <h6 class="mb-2">Website Sales</h6>
                            <h4 class="mb-2">$674,347.12</h4>
                            <p class="mb-0"><span class="text-muted me-2">21k orders</span><span
                                    class="badge bg-label-success">+12.4%</span></p>
                        </div>
                        <div class="avatar me-lg-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class="bx bx-laptop bx-sm"></i>
                            </span>
                        </div>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                        <div>
                            <h6 class="mb-2">Discount</h6>
                            <h4 class="mb-2">$14,235.12</h4>
                            <p class="mb-0 text-muted">6k orders</p>
                        </div>
                        <div class="avatar me-sm-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class="bx bx-gift bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Affiliate</h6>
                            <h4 class="mb-2">$8,345.23</h4>
                            <p class="mb-0"><span class="text-muted me-2">150 orders</span><span
                                    class="badge bg-label-danger">-3.5%</span></p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class="bx bx-wallet bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="mb-0"> {{ __('Product Management')}}</h3>
                <div class="pull-right">
                    <div class="d-flex">
                        @can('master_add_products')
                        <!-- <a class="btn btn-primary btn-rounded-20" href="{{ url('/product/create') }}">
                     <i class="ik ik-plus"></i> Add
                     </a> -->
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="form-group mb-3">
                            <select name="status" id="status" class="form-control">
                                <option value="">Select All</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="form-group mb-3">
                            <select name="stock_status" id="stock_status" class="form-control">
                                <option value="">Stock Status</option>
                                <option value="1">In stock</option>
                                <option value="0">Out of stock</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 ">
                        <div class="form-group mb-3">
                            <input type="text" name="name_s" id="name_s" class="form-control" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 ">
                        <div class="form-group mb-3 datetimepicker">
                            <input type="text" name="date" id="date" class="form-control daterange"
                                placeholder="DD-MM-YYYY to DD-MM-YYYY">
                            <input type="hidden" name="start_range" id="start_range">
                            <input type="hidden" name="end_range" id="end_range">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3 d-flex">
                            <button type="button" class="btn btn-primary btn-rounded-20 me-3" id="reset_data">
                                <i class="bx bx-reset"></i>
                            </button>
                            <div class="dt-buttons">
                                <a href="/product/create" class="dt-button add-new btn btn-primary" onclick="addItem()">
                                    <i class="bx bx-plus me-0 me-sm-2"></i>
                                    <span class="d-none d-sm-inline-block">
                                        Add New
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="listing_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('##')}}</th>
                                <th>{{ __('Code')}}</th>
                                <th>{{ __('Product Name')}}</th>
                                <th>{{ __('Image')}}</th>
                                <!-- <th>{{ __('sku')}}</th> -->
                                <th>{{ __('Stock Status')}}</th>
                                <th>{{ __('Status')}}</th>
                                <th>{{ __('Created At')}}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- push external js -->
@push('scripts')

<script>
// Ensure this._config is initialized properly somewhere in your code
this._config = {}; // Example initialization

// Now access the backdrop property with a check for undefined
let backdropEnabled = Boolean(this._config && this._config.backdrop);

$('.daterange').daterangepicker({
    autoUpdateInput: true,
    autoApply: true,
    locale: {
        format: 'DD-MM-YYYY',
        separator: 'o ',
    }
}, function(start, end, label) {
    $('#start_range').val(start.format('YYYY-MM-DD'));
    $('#end_range').val(end.format('YYYY-MM-DD'));
});
$('.daterange').val('');
</script>
<!-- Select the state when select the country -->
<script>
$('#cat').val(null).trigger('change');
$('.daterange').daterangepicker({
    autoUpdateInput: true,
    autoApply: true,
    locale: {
        format: 'DD-MM-YYYY',
        separator: ' to ',
    }
}, function(start, end, label) {
    // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    $('#start_range').val(start.format('YYYY-MM-DD'));
    $('#end_range').val(end.format('YYYY-MM-DD'));
});
$('.daterange').val('');
</script>
<!--server side table script start-->
<script>
//listing data table
$(document).ready(function() {
    //listing data table ------------------------------------------------------ Start
    var table = $('#listing_table').DataTable({
        sDom: '<"top"f>rt<"bottom table_bottom"lip><"clear">', // shift selection box in footer
        bFilter: false, //hide defalt search box
        responsive: true,
        "bProcessing": true,
        "serverSide": true,
        "lengthMenu": [20, 50, 100, 500],
        ajax: {
            url: "{{ url('/product/list') }}",
            data: function(d) {
                d.status = $('#status').val()
                d.name = $('#name_s').val()
                d.stock_status = $('#stock_status').val()
                d.start_range = $('#start_range').val()
                d.end_range = $('#end_range').val()

            }
        },
        "aoColumns": [{
                mData: 'id'
            },
            {
                mData: 'code'
            },
            {
                mData: 'name'
            },
            {
                mData: 'small_image'
            },
            // {
            //     mData: 'sku'
            // },

            {
                mData: 'stock_status'
            },

            {
                mData: 'status'
            },
            {
                mData: 'created_at'
            },
            {
                mData: 'actions'
            },
        ],
        //add attribute on column using id or attribute 
        "aoColumnDefs": [{
            "bSortable": false,
            'aTargets': [-1, 5]
        }, ],
        order: [
            [0, 'desc']
        ]
    });

    $('#status').on('change', function() {
        table.draw();
    });
    $('.daterange').on('change', function() {
        if (($('#start_range').val() == '') || ($('#end_range').val() == '')) {
            $('.daterange').val('');
        } else {
            table.draw();
        }
    });
    $('#cat').on('change', function() {
        table.draw();
    });
    $('#name_s').keyup(function() {
        table.draw();
    });
    $('#stock_status').on('change', function() {
        table.draw();
    });
    $('#reset_data').on('click', function() {
        $('.daterange').val('');
        $('#start_range').val('');
        $('#end_range').val('');
        $('#status').val('');
        $('#stock_status').val('');

        $('#name_s').val('');
        $('#cat').val(null).trigger('change');
        table.draw();
        var daterangepicker = $('.daterange').data("daterangepicker");
        daterangepicker.startDate = moment();
        daterangepicker.endDate = moment();
    });
    //listing data table ------------------------------------------------------ End


});


$("#addEditForm").validate({
    rules: {
        first_name: {
            required: true,
            regex: true
        },
        last_name: {
            required: true,
            regex: true
        },

        email: {
            required: true,
            email_val: true
        },
        phone: {
            required: true,
            minlength: 10,
            maxlength: 10
        },

        gender: {
            required: true,
        },

        password: {
            required: true,
            //notEqualToUsername: true,
            minlength: 8,
            maxlength: 15,
            customPassword: true
        },
        confirm_password: {
            required: true,
            minlength: 8,
            maxlength: 15,
            equalTo: "#password"
        }
    },
    messages: {

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
        var formData = new FormData($("#addEditForm")[0]);
        var url_up = "{{url('product/store')}}";
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
                        window.location.href = "{{url('customer')}}";
                    }, 3000);
                } else {
                    toastr.error(response.msg, "error");
                    // $("#addEditForm").find('.submit_button').attr("disabled", true);
                }
            },
        });
        return false;
    }
});


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



function removedata(id) {
    $.ajax({
        type: "POST",
        url: "{{route('delete.product')}}",
        data: {
            id: id,
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
            // console.log(data.success)
            toastr.success(data.success);
            $('#listing_table').DataTable().ajax.reload();
        },
    });
}
//deleteItem

function deleteItem(id) {
    //    alert(id)
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
            removedata(id);
        }
    });
}



$(document).ready(function() {
    $(document).on('change', '.status-checkbox', function() {
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

function updateItem(id) {
    $.ajax({
        type: "POST",
        url: "{{ url('customer/get_by_id') }}",
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            var response = JSON.parse(data);
            if (response.code == 200) {
                var item = response.data.customer_detail;

                // Populate form fields with item data
                $("#addEditForm").find("input[name='product']").val(item.product);
                $("#addEditForm").find("select[name='stock_status']").val(item.stock_status);
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
                toastr.error(response.msg, "error");
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            toastr.error("Error fetching data", "error");
        }
    });
}






//update item status
function updateItemStatus(id, type, value) {
    $.ajax({
        type: "POST",
        url: "{{route('product.status')}}",
        data: {
            id: id,
            type: type,
            value: value,
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
            var response = JSON.parse(data);
            if (response.code == 200) {
                toastr.success(response.msg);
            } else {
                toastr.error(response.msg, "warning");
            }
            //reload data table in case of delete item
            // if (type == 'delete') {
            var active_page = $(".pagination").find("li.active a").text();
            //reload datatable
            $('#listing_table').dataTable().fnPageChange((parseInt(active_page) - 1));
            // }

        },
    });
}
</script>

@endpush