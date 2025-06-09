@extends('layouts/contentNavbarLayout')
@section('title', 'Banner Management')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3> {{ __('Banner Management')}}</h3>
                <div class="pull-right">
                    <div class="d-flex">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">Select All</option>
                            <option value="1">Published</option>
                            <option value="2">Unpublished</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group mb-3">
                            <select name="customer_type" id="customer_type" class="form-control">
                                <option value="">Type of Customer</option>
                                <option value="all">All</option>
                                <option value="normal">Normal</option>
                                <option value="loyal">Loyal</option>
                                <option value="wholesaler">Wholesaler</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 form-group">
                        <input type="text" name="name_s" id="name_s" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary btn-rounded-20" id="reset_data">
                                <i class="bx bx-reset"></i>
                            </button>
                            <div class="dt-buttons ms-2">
                                <button id="submit_form11" class="dt-button add-new btn btn-primary" tabindex="0"
                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasAddUser"><span><i
                                            class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block"
                                            onclick=addItem()>
                                            Add New
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- add new ad model start  --}}
                    <div class="offcanvas offcanvas-end w-60" id="offcanvasAddUser"
                        aria-labelledby="offcanvasAddUserLabel" aria-modal="true" role="dialog">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mx-0 flex-grow-0">
                            <form class="add-new-email-template pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
                                id="addEditForm" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="email_template_id" value="">
                                <div class="row">
                                    <!-- <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-email-template-title">Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title" placeholder="Title"
                                                name="title" aria-label="Title">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-sm-6">
                                        <label class="mb-2" for="showOnBottom">User</label>
                                        <select name="user_type" class="form-select" id="user_type">
                                            <option value="" selected disabled>Select User</option>
                                            <option value="all">All Users</option>
                                            <option value="normal">Normal</option>
                                            <option value="loyal">Loyal</option>
                                            <option value="wholesaler">Wholesaler</option>
                                        </select>
                                    </div>



                                    {{-- <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="add-email-template-link">Link <span
                                                    class="text-danger">*</span></label>
                                            <input type="url" class="form-control" id="add-email-template-link"
                                                placeholder="Link" name="link" aria-label="Link">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="select-Date">Select Date<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="date" id="date" class="form-control daterange" placeholder="DD-MM-YYYY to DD-MM-YYYY">
                                            <input type="hidden" name="start_range" id="start_range">
                                            <input type="hidden" name="end_range" id="end_range">
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="select-Date">Status<span
                                                    class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="select-Date">Published Status<span
                                                    class="text-danger">*</span></label>
                                            <select name="published_status" id="published_status" class="form-control">
                                                <option value="">Select Published Status</option>
                                                <option value="1">Published</option>
                                                <option value="2">Unpublished</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 fv-plugins-icon-container">
                                            <label class="form-label" for="profile-image">File Upload</label>
                                            <input type="file" id="fileUpload" name='image' class="form-control"
                                                accept=".jpeg, .jpg, .png, .mp4" name="fileUpload">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                            <small style="position:relative;top:-9px;"> &nbsp;(Only formats are allowed:
                                                jpeg, jpg, png, mp4,size:width=430,height=700)</small>
                                        </div>
                                        {{-- <div class="col-md-3 mb-3">
                                            <div class="image-border-shap">
                                            <img style="display:none;" id="filePreview" src="" 
                                                class="logo-icon cursor-pointer" alt="preview">
                                            <video style="display:none;" id="videoPreview"  controls>
                                                <source id="videoSource" src="" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div> --}}

                                        <div class="col-md-12 mb-3" id="bannerimagepreview">
                                            <div class="image-border-shap">
                                                <div id="imagePreviewContainer1" class="w-100 h-100" style="display:none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12" id="editor">
                                    <div class="mb-3 fv-plugins-icon-container">
                                        <label class="form-label" for="description">Description</label>
                                        <div class="pad">
                                            <textarea name="description" id="description" rows="10" cols="80"></textarea>
                                        </div>
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <input class="btn btn-primary pull-right submit_button " type="submit" name="Save"
                                        value="Save">
                                </div>
                            </form>
                        </div>
                    </div>


                    {{-- viewmodal start --}}

                    <div class="offcanvas offcanvas-end w-30" id="viewModal" aria-labelledby="offcanvasViewLabel"
                        aria-modal="true" role="dialog">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasViewLabel" class="offcanvas-title">View</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mx-0 flex-grow-0">
                            <div class="row">

                                <div class="col-sm-6" id="title">
                                    <div class="mb-3 fv-plugins-icon-container">
                                        <label class="form-label" for="view_type">Title:</label>
                                        <div class="view_title"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-sm-6">
                                    <div class="mb-3 fv-plugins-icon-container">
                                        <label class="form-label" for="view_question">Link:</label>
                                        <div class="view_link"></div>
                                    </div>
                                </div> --}}

                                <div class="col-md-12 mb-3">
                                    <label for="">File</label>
                                    <div class="image-border-shap">
                                        <div id="imagePreviewContainer" class="w-100 h-100" style="display:none;">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3 fv-plugins-icon-container">
                                        <label class="form-label" for="view_question">Description:</label>
                                        <div class="view_des"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-sm-12" id="date">
                                    <div class="mb-3 fv-plugins-icon-container">
                                        <label class="form-label" for="view_answer">Start Date:</label>
                                        <div class="view_start_date"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="dateend">
                                    <div class="mb-3 fv-plugins-icon-container">
                                        <label class="form-label" for="view_answer" id="date_name">End Date:</label>
                                        <div class="view_end_date"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    {{-- viewmodal end --}}

                    {{-- add ad model end --}}

                </div>
                <div class="table-responsive">
                    <table id="listing_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('##')}}</th>
                                <!-- <th>{{ __('Title')}}</th> -->
                                <th>{{ __('Image')}}</th>
                                {{-- <th>{{ __('Link')}}</th> --}}
                                <th>{{ __('Type of Customers')}}</th>
                                <th>{{ __('Status')}}</th>
                                <!-- <th>{{ __('Start')}}</th>
                                <th>{{ __('End')}}</th> -->
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

    @endsection


    @push('scripts')

    <script>
        let editorInstance;

        CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
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


        function addItem() {
            if (editorInstance) {
                editorInstance.setData('');
            }

            $("#addEditForm")[0].reset();
            $('#imagePreviewContainer1').hide();
            // $('#bannerimagepreview').hide();add
            $('#offcanvasAddUserLabel').text('Add');

            // Clear validation error messages and classes
            $("#addEditForm").find('.is-invalid').removeClass('is-invalid');
            $("#addEditForm").find('.invalid-feedback').empty();
            $("#addEditForm").find(".error").remove();

            // Hide and clear the image preview
            $('#imagePreview').hide();
            $('#imagePreview').attr('src', '');
            // Set modal title and reset hidden input field for user id
            $("#addEditModal").modal("show");
            $('#bannerimagepreview').hide();
            $("#addEditModal").find(".modal-title").text('Add');
            $("#addEditModal").find("input[name='id']").val(0);
        }

        $(document).ready(function() {
            // alert('------------------')
            //listing data table ------------------------------------------------------ Start
            var table = $('#listing_table').DataTable({
                sDom: '<"top"f>rt<"bottom table_bottom"lip><"clear">', // shift selection box in footer
                bFilter: false, //hide defalt search box
                responsive: true,
                "bProcessing": true,
                "serverSide": true,
                "lengthMenu": [20, 50, 100, 500],

                ajax: {
                    url: "{{ url('/ad/list') }}",
                    data: function(d) {
                        d.status = $('#status').val()
                        d.customer_type = $('#customer_type').val()
                        d.title = $('#name_s').val()

                    }
                },
                "aoColumns": [{
                        mData: 'id'
                    },
                    // {
                    //     mData: 'title'
                    // },
                    {
                        mData: 'image',
                        // createdCell: function(td, cellData, rowData, row, col) {
                        //     // Apply inline styles to the cell
                        //     $(td).css({
                        //         'width': '80px', // Set the width for the image column
                        //         'height': '50px', // Set the height for the image column
                        //         'text-align': 'center', // Optional: center the image horizontally
                        //     });

                        //     // Ensure the image fits the cell's width and height
                        //     $(td).find('img').css({
                        //         'width': '100%',
                        //         'height': '100%',
                        //         'object-fit': 'cover' // Ensures the image covers the area proportionally
                        //     });
                        // }
                    },

                    // {
                    //     mData: 'link',
                    //     mRender: function(data, type, row) {
                    //         return '<a href="' + data + '" target="_blank">Link</a>';
                    //     }
                    // },


                    {
                        mData: 'customers'
                    },
                    {
                        mData: 'published_status'
                    },
                    // {
                    //     mData: 'start_date'
                    // },
                    // {
                    //     mData: 'end_date'
                    // },

                    {
                        mData: 'actions'
                    },
                ],
                //add attribute on column using id or attribute 
                "aoColumnDefs": [{
                    "bSortable": false,
                    'aTargets': [-1, 2, 3, ]
                }, ],
                order: [
                    [0, 'desc']
                ]
            });
            $('#customer_type').on('change', function() {
                table.draw();
            });
            $('#status').on('change', function() {
                table.draw();
            });

            $('#cat').on('change', function() {
                table.draw();
            });
            $('#name_s').keyup(function() {
                table.draw();
            });
            $('#reset_data').on('click', function() {
                $('.daterange').val('');
                $('#start_range').val('');
                $('#end_range').val('');
                $('#status').val('');
                $('#customer_type').val('');
                $('#name_s').val('');
                $('#cat').val(null).trigger('change');
                table.draw();
                var daterangepicker = $('.daterange').data("daterangepicker");
                daterangepicker.startDate = moment();
                daterangepicker.endDate = moment();
            });
            //listing data table ------------------------------------------------------ End


        });



        $(document).ready(function() {

            $.validator.addMethod(
                "regex",
                function(value, element) {
                    return value.match(/^[a-zA-Z. ]*$/);
                },
                "Only alphabetic characters are allowed."
            );





            //add update item
            $("#addEditForm").validate({

                rules: {
                    // title: {
                    //     required: true,
                    //     regex: false
                    // },
                    // link: {
                    //     required: true,
                    // },
                    // date: {
                    //     required: true,
                    // },
                    published_status: {
                        required: true,
                    },
                    user_type: {
                        required: true,
                    },

                    status: {
                        required: true,
                    },
                   
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
                    // alert(required);
                    //form.submit();
                    var formData = new FormData($("#addEditForm")[0]);
                    var url_up = "{{url('ad/store')}}";
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
                            $("#addEditForm").find('.submit_button').attr("disabled",
                                false);
                            $('.loader').hide();
                            var response = JSON.parse(data);
                            //console.log(response);
                            if (response.code == 200) {

                                toastr.success(response.msg);
                                setTimeout(function() {
                                    window.location.href = "{{url('ad')}}";
                                }, 3000);
                            } else {
                                toastr.error(response.sg);
                                // $("#addEditForm").find('.submit_button').attr("disabled", true);
                            }
                        },
                    });
                    return false;
                }
            });
        });


        function viewItem(id) {
            $.ajax({
                type: "POST",
                url: "{{route('view.ad')}}",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $('#listing_table').DataTable().ajax.reload();
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        var item = response.data.ad;
                        console.log(item)
                        var variables = response.config_val;
                        //put  item details in all input fields
                        $("#viewModal").find(".view_title").text(item.title);
                        var strippedDescription = $("<div>").html(item.description).text();
                        $("#viewModal").find(".view_des").text(strippedDescription);
                        // $("#viewModal").find(".view_des").text(item.description);
                        // $("#viewModal").find(".view_link").html('<a href="' + item.link + '" target="_blank">View Link</a>');
                        const startdate = moment(item.start_date);
                        $("#viewModal .view_start_date").text(startdate.format("DD-MM-YYYY"));
                        const enddate = moment(item.end_date);
                        $("#viewModal .view_end_date").text(enddate.format("DD-MM-YYYY"));

                        var fileName1 = item.image;
                        var imagePath1 = '/uploads/ad_image/' + fileName1;
                        // $('#imagePreviewContainer').html('<img>').show();
                        // Check if the file is a video or image
                        var extension = fileName1.split('.').pop().toLowerCase();
                        
                        //  alert(extension);
                        if (extension === 'jpg' || extension === 'jpeg' || extension === 'png' || extension === 'gif') {
                            // Create an <img> tag
                            var imgTag1 = $('<img>').attr('src', imagePath1).attr('alt', 'Image');
                            $('#imagePreviewContainer').html(imgTag1).show();
                            
                        } else if (extension === 'mp4' || extension === 'avi' || extension === 'mov') {
                            // Create a <video> tag
                            var videoTag1 = $('<video>').attr('controls', true).attr('class', 'w-100 h-100'); // add controls attribute to enable video controls
                            var sourceTag = $('<source>').attr('src', imagePath1).attr('type', 'video/' + extension);
                            videoTag1.append(sourceTag);
                            $('#imagePreviewContainer').html(videoTag1).show();
                        }


                        $("#viewModal").find("input").removeClass('is-invalid');
                        $("#viewModal").find("textarea").removeClass('is-invalid');
                        $("#viewModal").find("number").removeClass('is-invalid');
                        $("#viewModal").find(".error").remove();
                        // $("#addEditForm").modal("show");

                    } else {
                        toastr.error(response.msg);
                    }
                },
            });
        }

        function deleteItem(id) {
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
                url: "{{route('delete.ad')}}",
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

        function updateItem(id) {
            required = false;
            $("#addEditForm").find('.invalid-feedback').empty();
            $("#addEditForm").find(".error").remove();
            $('#imagePreviewContainer1').show();
            $('#offcanvasAddUserLabel').text('Update');
            $('#bannerimagepreview').show();
            $("#date").hide();
            $("#dateend").hide();
            
            $("#title").hide();
            $.ajax({
                type: "POST",
                url: "{{ url('ad/get_by_id') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        var item = response.data.ad;
                        var variables = response.config_val;
                        //put  item details in all input fields
                        $("#addEditForm").find(".modal-title").text('Update');
                        $("#addEditForm").find("input[name='id']").val(item.id);
                        $("#addEditForm").find("input[name='title']").val(item.title);
                        // $("#addEditForm").find("input[name='link']").val(item.link);
                        $("#addEditForm").find("select[name='published_status']").val(item.published_status);
                        $("#addEditForm").find("select[name='status']").val(item.status);
                        $("#addEditForm").find("select[name='user_type']").val(item.customer_type);
                        // Function to format date from 'YYYY-MM-DD' to 'DD-MM-YYYY'
                        function formatDate(dateString) {
                            const date = new Date(dateString);
                            const day = String(date.getDate()).padStart(2, '0');
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const year = date.getFullYear();
                            return `${day}-${month}-${year}`;
                        }

                        // Assuming item.start_date and item.end_date are in 'YYYY-MM-DD' format
                        let formattedStartDate = formatDate(item.start_date);
                        let formattedEndDate = formatDate(item.end_date);

                        // Combine the formatted dates
                        let dateRange = formattedStartDate + ' to ' + formattedEndDate;

                        // Set the formatted date range in the input field
                        $("#addEditForm").find("input[name='date']").val(dateRange);
                        $('.daterange').daterangepicker({
                            autoUpdateInput: true,
                            autoApply: true,
                            startDate: formattedStartDate,
                            endDate: formattedEndDate,
                            locale: {
                                format: 'DD-MM-YYYY',
                                separator: ' to ',
                            }
                        }, function(start, end, label) {
                            $('#start_range').val(start.format('YYYY-MM-DD'));
                            $('#end_range').val(end.format('YYYY-MM-DD'));
                        });
                        // $("#addEditForm").find("input[name='start_range']").val(item.start_date);
                        // $("#addEditForm").find("input[name='end_range']").val(item.end_date);




                        // if (editorInstance) {
                        //     editorInstance.setData(item.description); // Set the CKEditor content
                        // } else {
                        //     console.error('CKEditor instance is not available.');
                        // }

                        var fileName = item.image;
                        var imagePath = '/uploads/ad_image/' + fileName;

                        // Check if the file is an image
                        var extension = fileName.split('.').pop().toLowerCase();
                        if (extension === 'jpg' || extension === 'jpeg' || extension === 'png' || extension === 'gif') {
                            // Create an <img> tag
                            var imgTag1 = $('<img>').attr('src', imagePath).attr('alt', 'Image');
                            $('#imagePreviewContainer1').html(imgTag1).show();
                        } else if (extension === 'mp4' || extension === 'avi' || extension === 'mov') {
                            // Create a <video> tag
                            var videoTag1 = $('<video>').attr('controls', true).attr('class', 'w-100 h-100'); // add controls attribute to enable video controls
                            var sourceTag = $('<source>').attr('src', imagePath).attr('type', 'video/' + extension);
                            videoTag1.append(sourceTag);
                            $('#imagePreviewContainer1').html(videoTag1).show();
                        }

                        $("#addEditForm").find("input").removeClass('is-invalid');
                        $("#addEditForm").find("textarea").removeClass('is-invalid');
                        $("#addEditForm").find("number").removeClass('is-invalid');
                        $("#addEditForm").find(".error").remove();
                        // $("#addEditForm").modal("show");



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
                    var value = '1';
                } else {
                    var value = '2';
                }
                updateItemStatus(id = id, type = 'status', value = value);

            })
        });

        //update item
        function updateItemStatus(id, type, value) {
            $.ajax({
                type: "POST",
                url: "{{route('ad.status')}}",
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


        $(document).on("click", ".passwordViewBtn", function() {
            var $input = $(this).parent().find("input.pass_word");
            var atrr = $input.attr('type');
            if (atrr == 'password') {
                $input.attr('type', 'text');
                $(this).find("i").attr('class', 'bx bx-show');
            } else {
                $input.attr('type', 'password');
                $(this).find("i").attr('class', 'bx bx-hide');
            }
        });
    </script>
    <script>
        $('.daterange').daterangepicker({
            autoUpdateInput: true,
            autoApply: true,
            locale: {
                format: 'DD-MM-YYYY',
                separator: ' to ',
            }
        }, function(start, end, label) {
            $('#start_range').val(start.format('YYYY-MM-DD'));
            $('#end_range').val(end.format('YYYY-MM-DD'));
        });
        $('.daterange').val('');
    </script>
    @endpush