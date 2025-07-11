@extends('layouts/contentNavbarLayout')
@section('title', 'SubCategory Management')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3>{{ __('SubCategory Management')}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2 form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">Select All</option>
                            <option value="2">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-3 form-group">
                        <select name="select_category" id="select_category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($Ucategory as $data)

                            <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2 form-group">
                        <input type="text" name="name_s" id="name_s" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-sm-5">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary btn-rounded-20" id="reset_data">
                                <i class="bx bx-reset"></i>
                            </button>
                            <div class="dt-buttons ms-2" style="margin-right: 80px;">
                                <button id="submit_form11" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#addEditModal"><span><i class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block" onclick=addItem()>
                                            Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <table id="listing_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('##')}}</th>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Image')}}</th>
                                <th>{{ __('Category Name')}}</th>
                                <th>{{ __('Status')}}</th>
                                <th>{{ __('Created at')}}</th>
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
    <!-- letter modal start-->
    <div class="offcanvas offcanvas-end w-40" id="addEditModal" aria-labelledby="offcanvasAddUserLabel" aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addEditForm" method="POST">
                @csrf
                <input type="hidden" name="id" id="user_id" value="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="question">Category<span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($Category as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="question">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="SubCategory Name" name="name" aria-label="Name">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>

                </div>
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="profile-image">Image</label>
                    <input type="file" id="add-user-contact" class="form-control phone-mask mb-2 img_name" placeholder="Category Image" aria-label=".jpeg" name="image">
                    <small class="f_b_0">(Only formats are allowed: jpeg, jpg, png)</small>
                    <img id="existing-image" src="" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;" />
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <input class="btn btn-primary pull-right submit_button " type="submit" name="Save" value="Save">
                </div>
            </form>
        </div>
    </div>
    <!-- letter modal end-->
    <div class="offcanvas offcanvas-end w-30" id="viewModal" aria-labelledby="offcanvasViewLabel" aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h5 id="offcanvasViewLabel" class="offcanvas-title">View Categories</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="view_category">Category Name:</label>
                        <div class="view_category"></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="view_subcategory">SubCategory Name:</label>
                        <div class="view_subcategory"></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="view_image">Image:</label>
                        <div class="view_image">
                            <div class="answer-text"></div>
                            <img id="existing-image" src="" class="show-image" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="view_date">Created Date:</label>
                        <div class="view_date"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('scripts')
    <!--server side table script start-->
    <script>
        //listing data table
        $(document).ready(function() {

            var table = $('#listing_table').DataTable({
                pageLength: 20,
                lengthMenu: [
                    [10, 20, 50],
                    [10, 20, 50]
                ],
                sDom: '<"top"f<"close_button fa fa-times">>rt<"bottom table_bottom"lip><"clear">',
                bFilter: false, //hide defalt search box

                processing: true,
                serverSide: true,
                ajax: {
                    url: 'subcategory/list',
                    type: "get",
                    data: function(d) {
                        d.status = $('#status').val()
                        d.name = $('#name_s').val()
                        d.select_category = $('#select_category').val()
                    }
                },
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                        targets: 0,
                        data: 'id',
                        name: 'id'

                    },
                    {
                        targets: 1,
                        data: 'name',
                        name: 'name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: 2, // Target the 'image' column
                        data: 'image',
                        name: 'image',
                        orderable: false,

                    },
                    {
                        targets: 3,
                        data: 'category_name',
                        name: 'category_name',

                    },
                    {
                        targets: 4,
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: 5,
                        data: 'created_at',
                        name: 'created_at',
                        orderable: false,
                        searchable: false
                    },
                    //only those have manage_user permission will get access
                    {
                        targets: 6,
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "aoColumnDefs": [{
                    "bSortable": false,
                    'aTargets': [-1, 3]
                }, ],
                order: [
                    [0, 'desc']
                ]
            });
            $('#select_category').on('change', function() {
                table.draw();
            });
            $('#status').on('change', function() {
                table.draw();
            });

            $('#name_s').keyup('change', function() {
                table.draw();
            });
            $('#reset_data').on('click', function() {
                $('#status').val('');
                $('#select_category').val('');
                $('#name_s').val('');

                table.draw();
            });
            initialize_tooltip();
            table.on('search.dt', function() {
                if (table.search() == '') {
                    $('.close_button').hide();
                } else {
                    $('.close_button').show();
                }
            });
        });
    </script>
    <!--server side table script end-->
    <script>
        document.getElementById('submit_form11').addEventListener('click', addItem);
        //add item
        function addItem() {
            $("#addEditForm")[0].reset();
            // / assume isAddMode is a boolean flag indicating whether it's add or edit mode
            $('#offcanvasAddUserLabel').text('Add');
            $("#addEditModal").find("#existing-image").hide();


            $("#addEditModal").find(".modal-title").text('Add');
            //put id zero in case of add new item
            $("#addEditModal").find("input[name='id']").val(0);

            $("#addEditModal").find("input").removeClass('is-invalid');
            $("#addEditModal").find("textarea").removeClass('is-invalid');
            $("#addEditModal").find("select").removeClass('is-invalid');
            $("#addEditModal").find(".error").remove();



        }
        //update item
        function updateItem(id) {
            // $("#addEditForm")[0].reset();
            $('#offcanvasAddUserLabel').text('Update');
            $("#addEditModal").find("input[name='image']").rules('remove', 'required');
            // alert(id)
            $.ajax({
                type: "POST",
                url: "{{url('subcategory/get_by_id')}}",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        var item = response.data;
                        console.log(item)
                        var variables = response.config_val;
                        //put  item details in all input fields
                        $("#addEditModal").find(".modal-title").text('Update');
                        $("#addEditModal").find("input[name='id']").val(item.id);
                        $("#addEditModal").find("input[name='name']").val(item.name);
                        $("#addEditModal").find("select[name='category_id']").val(item.category_id);
                        $("#addEditModal").find("input[name='slug']").val(item.slug);
                        //    $("#addEditModal").find("input[name='image']").val(item.image);
                        $("#addEditModal").find("#existing-image").attr("src", 'uploads/SubCategory/' + item.image);
                        var imageUrl = item.image ? 'uploads/SubCategory/' + item.image : 'uploads/default_image/default.png';
                        $("#addEditModal").find("#existing-image").attr('src', imageUrl); // assume item.image_url contains the URL of the existing image
                        $("#addEditModal").find("#existing-image").show(); // Show the existing image element
                        $("#addEditModal").find("input").removeClass('is-invalid');
                        $("#addEditModal").find("textarea").removeClass('is-invalid');
                        $("#addEditModal").find("select").removeClass('is-invalid');

                        $("#addEditModal").find(".error").remove();


                        //For show the modal
                        //    $("#addEditModal").modal("show");

                    } else {
                        toastr.error(response.msg);
                    }
                },
            });
        }


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

        $.validator.addMethod("alphabatesOnly", function(value, element) {
            if (!value) {
                return true; // allow empty values
            }
            return /^[a-zA-Z ]+$/.test(value); // only allow alphabetical characters and spaces
        }, 'Only alphabates are allowed');


        //add update item
        $("#addEditForm").validate({
            rules: {

                name: {
                    required: true,
                    alphabatesOnly: false,
                },
                category_id: {
                    required: true,
                },
            },
            messages: {},
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
                $('.submit_button').prop('disabled', true);
                //serialize form data
                // var formData = $("#addEditForm").serialize();
                var formData = new FormData($("#addEditForm")[0]);
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "{{url('subcategory/store')}}",
                    data: formData,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        // $("#addEditForm").find('.submit_button').attr("disabled", true);
                        $('.loader').show();
                    },
                    success: function(data) {
                        // $("#addEditForm").find('.submit_button').attr("disabled", false);
                        $('.loader').hide();
                        var response = JSON.parse(data);
                        $('.submit_button').attr('disabled', false); //Enable the submit button
                        if (response.code == 200) {
                            //reload datatable
                            //get datatable active page
                            var itemId = $("#addEditForm").find("input[name='id']").val();
                            if (itemId != '' && itemId > 0) {
                                //in case of edit load active page data
                                var active_page = $(".pagination").find("li.active a").text();
                            } else {
                                //in case of add new item get first page data
                                var active_page = 1;
                            }
                            //load datatable
                            $('#listing_table').dataTable().fnPageChange(parseInt(active_page) - 1);
                            //show notification
                            toastr.success(response.msg);

                            $("#addEditModal").modal("hide");
                            //reset form
                            $("#addEditForm")[0].reset();
                            setTimeout(function() {
                                window.location.href = "{{url('subcategory')}}";
                            }, 3000);
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                });
                return false;
            }
        });


        // view item
        function viewItem(id) {
            $.ajax({
                type: "POST",
                url: "{{url('subcategory/get_by_id')}}",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        var item = response.data;
                        //set edit id
                        console.log(item)
                        let base_url = 'uploads/SubCategory'
                        $("#viewModal .view_subcategory").text(item.name);
                        $("#viewModal .view_category").text(item.category_name);
                        $("#viewModal .view_slug").text(item.slug);

                        const createdAt = moment(item.created_at);
                        $("#viewModal .view_date").text(createdAt.format("DD-MM-YYYY"));
                        var imageUrl = item.image ? 'uploads/SubCategory/' + item.image : 'uploads/default_image/default.png';
                        $("#viewModal .show-image").attr('src', imageUrl);
                        // Select the corresponding category option
                        $('#type').val(item.category);

                        //set modal title for update
                        $("#viewModal").find(".modal-title").text('View');
                    } else {
                        toastr.error(response.msg);
                    }
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




        //deleteItem

        function deleteItem(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this item !',
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
                url: "{{route('delete.subcategory')}}",
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
        //update item
        function updateItemStatus(id, type, value) {
            $.ajax({
                type: "POST",
                url: "{{url('subcategory/update_status')}}",
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
                    if (type == 'delete') {
                        var active_page = $(".pagination").find("li.active a").text();
                        //reload datatable
                        $('#listing_table').dataTable().fnPageChange((parseInt(active_page) - 1));
                    }

                },
            });
        }
    </script>
    <!-- <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    @endpush
    @endsection