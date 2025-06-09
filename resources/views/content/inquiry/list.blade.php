@extends('layouts/contentNavbarLayout')
@section('title', 'Inquiry Management')
@section('content')

@php
$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$urlComponents = explode('/', $currentURL);
@endphp
<div class="card mb-4">
    <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                        <div>
                            <h4 class="mb-0">{{$total_order}}</h4>
                            <p class="mb-0">Total Inquirys</p>
                        </div>
                        <span class="avatar w-px-40 h-px-40 me-3 me-sm-6">
                            <span class="avatar-initial bg-label-secondary rounded">
                                <i class="bx bx-calendar bx-sm text-heading"></i>
                            </span>
                        </span>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none me-6">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                        <div>
                            <h4 class="mb-0">{{$completed_order}}</h4>
                            <p class="mb-0">Completed Inquirys</p>
                        </div>
                        <span class="avatar w-px-40 h-px-40 p-2 me-lg-6 me-3">
                            <span class="avatar-initial bg-label-secondary rounded">
                                <i class="bx bx-check-double bx-sm text-heading"></i>
                            </span>
                        </span>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end pb-4 pb-sm-0 card-widget-3">
                        <div>
                            <h4 class="mb-0">{{$pending_order}}</h4>
                            <p class="mb-0">Pending Inquirys</p>
                        </div>
                        <span class="avatar w-px-40 h-px-40 p-2 me-sm-6 me-3">
                            <span class="avatar-initial bg-label-secondary rounded">
                                <i class="bx bx-wallet bx-sm text-heading"></i>
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="mb-0">{{$cancel_order}}</h4>
                            <p class="mb-0">Cancelled Inquirys</p>
                        </div>
                        <span class="avatar w-px-40 h-px-40 p-2">
                            <span class="avatar-initial bg-label-secondary rounded">
                                <i class="bx bx-error-alt bx-sm text-heading"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3> {{ __('Inquiry Management')}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2 form-group">
                        <select name="stock_status" id="stock_status" class="form-control">
                            <option value="">Select Status</option>
                            
                            <option value="1">pending</option>
                            <option value="2">complete</option>
                            <option value="3">Cancelled</option>


                        </select>
                    </div>
                    <!-- <div class="col-sm-2 form-group">
                        <select name="payment_type" id="payment_type" class="form-control">
                            <option value="">Payment Type</option>
                            <option value="0">Offline</option>
                            <option value="1">Online</option>
                        </select>
                    </div> -->

                    <div class="col-sm-2 form-group">
                        <input type="text" name="name_s" id="name_s" class="form-control" placeholder="Search">
                    </div>
                    {{-- <div class="col-sm-2 form-group">
                        <input type="number" min="0" name="id_search" id="id_search" class="form-control" placeholder="Search by order id">
                    </div> --}}

                    <!-- <div class="col-sm-3 form-group">
                        <input type="text" name="date" id="date" class="form-control daterange" placeholder="DD-MM-YYYY to DD-MM-YYYY">
                        <input type="hidden" name="start_range" id="start_range">
                        <input type="hidden" name="end_range" id="end_range">
                    </div> -->

                    <div class="form-group col-sm-3">
                        <button type="button" class="btn btn-primary btn-rounded-20 me-2" id="reset_data">
                            <i class="bx bx-reset"></i>
                        </button>

                        <!-- <a class="btn btn-primary btn-rounded-20" href="{{ url('/inquiry/create') }}">
                        <i class="bx bx-plus me-0 me-sm-2"></i> Add
                    </a> -->
                    </div>

                </div>
                <div class="table-responsive">
                    <table id="listing_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('##')}}</th>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('email')}}</th>
                                <th>{{ __('Mobile Number')}}</th>
                                <!-- <th>{{ __('Product Count')}}</th> -->
                                <th>{{ __('Status')}}</th>
                                <th>{{ __('Message')}}</th>
                                <th>{{ __('created_at')}}</th>
                                <!-- <th style="min-width:110px;">{{ __('Inquiry Date')}}</th> -->
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



<!-- letter modal start-->
<div class="modal fade edit-layout  pr-0 " id="addEditModal" role="dialog" aria-labelledby="addEditModalLabel" aria-hidden="true">
    <div class="modal-dialog w-70" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="addEditForm">
                    <input class="dealer_id" type="hidden" name="dealer_id">
                    <input class="order_id" type="hidden" name="order_id">
                    @csrf
                    <div class="form-group">
                        <input class="btn btn-primary submitFrm" type="submit" name="Save" value="Save">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- letter modal end-->



@endsection
<!-- push external js -->
@push('scripts')
<?php
if (in_array("online_orders", $urlComponents)) {
?>
    <script>
        $(document).ready(function() {
            $("#payment_type").val("1").trigger("change");

        });
    </script>

<?php }
if (in_array("offline_orders", $urlComponents)) {
?>
    <script>
        $(document).ready(function() {
            $("#payment_type").val("0").trigger("change");

        });
    </script>

<?php }

?>


<!-- Select the state when select the country -->
<script>
    $('#cat').select2({
        placeholder: 'Select cat',
    });
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
        //$('#dealer').select2();
        $('#update_dealer').select2();


        //listing data table ------------------------------------------------------ Start
        var table = $('#listing_table').DataTable({
            sDom: '<"top"f>rt<"bottom table_bottom"lip><"clear">', // shift selection box in footer
            bFilter: false, //hide defalt search box
            responsive: true,
            "bProcessing": true,
            "serverSide": true,
            "lengthMenu": [10, 50, 100, 500],
            ajax: {
                url: "{{ url('/inquiry/list') }}",
                data: function(d) {
                    d.status = $('#status').val()
                    d.name = $('#name_s').val()
                    d.id_search = $('#id_search').val()
                    d.stock_status = $('#stock_status').val()
                    d.payment_type = $('#payment_type').val()
                    d.start_range = $('#start_range').val()
                    d.end_range = $('#end_range').val()
                    d.dealer = $('#dealer').val()

                }
            },
            "aoColumns": [{
                    mData: 'id'
                },
                // {
                //     mData: 'order_id'
                // },
                {
                    mData: 'name'
                },
                {
                    mData: 'email'
                },
                {
                    mData: 'phone'
                },
                {
                    mData: 'status'
                },

                {
                    mData: 'message',
                    render: function(data, type, row) {
                        return data.length > 10 ? data.substring(0, 10) + '...' : data;
                    }
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
                'aTargets': [0, 2, 3, 4]
            }, ],
            order: [
                [0, 'desc']
            ]
        });

        $('#dealer').on('change', function() {
            table.draw();
            // setTimeout(function() {
            // var customSelect1 = document.querySelector('.payment_status');
            // var customSelect = document.querySelector('.order_status');
            // updateTextColor(customSelect1);
            // updateTextColor(customSelect);
            // }, 300);
        });

        $('#status').on('change', function() {
            table.draw();
            // setTimeout(function() {
            // var customSelect1 = document.querySelector('.payment_status');
            // var customSelect = document.querySelector('.order_status');
            // updateTextColor(customSelect1);
            // updateTextColor(customSelect);
            // }, 300);
        });
        $('.daterange').on('change', function() {
            if (($('#start_range').val() == '') || ($('#end_range').val() == '')) {
                $('.daterange').val('');
            } else {
                table.draw();
                //     setTimeout(function() {
                // var customSelect1 = document.querySelector('.payment_status');
                // var customSelect = document.querySelector('.order_status');
                // updateTextColor(customSelect1);
                // updateTextColor(customSelect);
                // }, 300);
            }
        });
        $('#cat').on('change', function() {
            table.draw();
        });
        $('#name_s').keyup(function() {
            table.draw();
            // setTimeout(function() {
            // var customSelect1 = document.querySelector('.payment_status');
            // var customSelect = document.querySelector('.order_status');
            // updateTextColor(customSelect1);
            // updateTextColor(customSelect);
            // }, 300);
        });
        $('#id_search').keyup(function() {
            table.draw();
            // setTimeout(function() {
            // var customSelect1 = document.querySelector('.payment_status');
            // var customSelect = document.querySelector('.order_status');
            // updateTextColor(customSelect1);
            // updateTextColor(customSelect);
            // }, 300);
        });
        $('#stock_status').on('change', function() {
            table.draw();
            // setTimeout(function() {
            // var customSelect1 = document.querySelector('.payment_status');
            // var customSelect = document.querySelector('.order_status');
            // updateTextColor(customSelect1);
            // updateTextColor(customSelect);
            // }, 300);
        });
        $('#payment_type').on('change', function() {
            table.draw();
            // setTimeout(function() {
            // var customSelect1 = document.querySelector('.payment_status');
            // var customSelect = document.querySelector('.order_status');
            // updateTextColor(customSelect1);
            // updateTextColor(customSelect);
            // }, 300);
        });
        $('#reset_data').on('click', function() {
            $('.daterange').val('');
            $('#start_range').val('');
            $('#end_range').val('');
            $('#status').val('');
            $('#stock_status').val('');
            $('#payment_type').val('');
            $('#dealer').val('');
            $('#id_search').val('');
            $('#name_s').val('');
            $('#cat').val(null).trigger('change');
            table.draw();
            var daterangepicker = $('.daterange').data("daterangepicker");
            daterangepicker.startDate = moment();
            daterangepicker.endDate = moment();
            // setTimeout(function() {
            // var customSelect1 = document.querySelector('.payment_status');
            // var customSelect = document.querySelector('.order_status');
            // updateTextColor(customSelect1);
            // updateTextColor(customSelect);
            // }, 300);
        });
        //listing data table ------------------------------------------------------ End


    });

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


    function removedata(id) {
        $.ajax({
            type: "POST",
            url: "{{route('delete.inquiry')}}",
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


    $(document).ready(function() {
        $(document).on('change', '.status-checkbox', function() {
            var id = $(this).data("id");
            if (this.checked) {
                var value = '2';
            } else {
                var value = '1';
            }
            updateItemStatus(id = id, type = 'status', value = value);

        })
    });

    //update item
    function updateItemStatus(id, type, value) {
        $.ajax({
            type: "POST",
            url: "{{route('inquiry.status')}}",
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
                    toastr.error(response.msg, "error");
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


    //    setTimeout(function() {
    //         var customSelect = document.querySelector('.order_status');
    //         updateTextColor(customSelect);
    //     }, 300);
    //     setTimeout(function() {
    //         var customSelect1 = document.querySelector('.payment_status');
    //         updateTextColor(customSelect1);
    //     }, 300);

    //     function updateTextColor(selectElement) {
    //     // console.log("hsgfsg",selectElement);
    //     var selectedOption = selectElement.options[selectElement.selectedIndex];
    //     var textColor = getComputedStyle(selectedOption).color;
    //     selectElement.style.color = textColor;
    // }

    $(document).ready(function() {
        $(document).on('change', '.payment_status', function() {
            var id = $(this).data("id");
            var value = $(this).val();
            Swal.fire({
                title: 'Payment Status',
                text: 'Are you sure you want to change payment status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('inquiry.payment_status')}}",
                        data: {
                            id: id,
                            value: value,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(data) {
                            var response = JSON.parse(data);
                            if (response.code == 200) {
                                toastr.success(response.msg);
                            } else {
                                toastr.error(response.msg);
                            }
                            var active_page = $(".pagination").find("li.active a").text();
                            $('#listing_table').dataTable().fnPageChange((parseInt(active_page) - 1));
                        },
                    });
                } else {
                    $('#listing_table').DataTable().ajax.reload();
                }
            });
        });
    });



    $(document).ready(function() {
        $(document).on('change', '.order_status', function() {
            var id = $(this).data("id");
            var value = $(this).val();
            //alert(value);
            $.confirm({
                title: 'Order Status',
                content: 'Are you sure you want to change order status?',
                buttons: {
                    Cancel: function() {
                        //nothing to do
                        $('#listing_table').DataTable().ajax.reload();
                        // setTimeout(function() {
                        //                 var customSelect1 = document.querySelector('.payment_status');
                        //                 var customSelect = document.querySelector('.order_status');
                        //                 updateTextColor(customSelect1);
                        //                 updateTextColor(customSelect);
                        //             }, 300);

                    },
                    Sure: {
                        btnClass: 'btn-primary',
                        action: function() {
                            $.ajax({
                                type: "POST",
                                url: "{{route('inquiry.inquiry_status')}}",
                                data: {
                                    id: id,
                                    value: value,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function(data) {
                                    var response = JSON.parse(data);
                                    if (response.code == 200) {
                                        $.notify(response.msg, "success");
                                        // setTimeout(function() {
                                        //     var customSelect1 = document.querySelector('.payment_status');
                                        //     var customSelect = document.querySelector('.order_status');
                                        //     updateTextColor(customSelect1);
                                        //     updateTextColor(customSelect);
                                        // }, 300);
                                    } else {
                                        $.notify(response.msg, "warning");
                                    }
                                    var active_page = $(".pagination").find("li.active a").text();
                                    $('#listing_table').dataTable().fnPageChange((parseInt(active_page) - 1));


                                },
                            });

                        },
                    }
                }
            });

        });
    });

    //update item
    function updateItem(id, order_id) {
        //alert(id);
        //alert(order_id);

        $("#addEditModal").modal("show");
        $(".dealer_id").val(id);
        $(".order_id").val(order_id);
        setTimeout(function() {
            var selectElement = document.querySelector('.dealer_select');
            $('#update_dealer').val(null).trigger('change');

            $(".dealer_select").empty()
            for (var i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value == id) {
                    selectElement.selectedIndex = i;
                    break; // Exit the loop once the option is selected
                }
            }
        }, 300);

    }

    $("#addEditForm").validate({
        rules: {

        },
        messages: {},
        // errorElement: 'span',
        // errorPlacement: function(error, element) {
        //     error.addClass('invalid-feedback');
        //     element.closest('.form-control').parent().append(error);
        // },
        // highlight: function(element, errorClass, validClass) {
        //     $(element).addClass('is-invalid');
        // },
        // unhighlight: function(element, errorClass, validClass) {
        //     $(element).removeClass('is-invalid');
        // },
        submitHandler: function(form) {
            $('.submitFrm').attr('disabled', true); //Disable the submit button
            //serialize form data
            var formData = $("#addEditForm").serialize();
            $.ajax({
                type: "POST",
                url: "{{url('order/dealer_update')}}",
                data: formData,
                success: function(data) {
                    var response = JSON.parse(data);
                    $('.submitFrm').attr('disabled', false); //Enable the submit button
                    if (response.code == 200) {
                        var active_page = $(".pagination").find("li.active a").text();
                        $('#listing_table').dataTable().fnPageChange((parseInt(active_page) - 1));
                        // setTimeout(function() {
                        //             var customSelect1 = document.querySelector('.payment_status');
                        //             var customSelect = document.querySelector('.order_status');
                        //             updateTextColor(customSelect1);
                        //             updateTextColor(customSelect);
                        //         }, 300);
                        $.notify(response.msg, "success");
                        $("#addEditModal").modal("hide");
                        $("#addEditForm")[0].reset();
                    } else {
                        $.notify(response.msg, "error");
                    }
                },
            });
            return false;
        }
    });


    $(document).ready(function() {
        var table = $('#listing_table').DataTable();
        table.on('click', 'th', function() {
            // setTimeout(function() {
            //                         var customSelect1 = document.querySelector('.payment_status');
            //                         var customSelect = document.querySelector('.order_status');
            //                         updateTextColor(customSelect1);
            //                         updateTextColor(customSelect);
            //                     }, 300);
        });
    });

    function updateStatus(id, status) {
    if (!status) return;

    fetch('/update-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ id: id, status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            toastr.success(data.message);
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error updating status:', error);
    });
}

</script>
@endpush