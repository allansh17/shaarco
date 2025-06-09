@extends('layouts/contentNavbarLayout')
@section('title', 'Static Page Management')
@section('content')
    <div class="row">
     
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3>{{ __('Static Page Management') }}</h3>
                    <!--                 <button class="btn btn-primary btn-rounded-20 pull-right" href="#" onclick="addItem()">
                        Add Email Template
                    </button> -->
                </div>

                <div class="card-body">

                    <div class="col-sm-3 form-group d-flex align-items-center">
                        <input type="text" name="name_s" id="name_s" class="form-control" placeholder="Search">

                        <button type="button" class="btn btn-primary btn-rounded-20 ms-3" id="reset_data">
                            <i class="bx bx-reset"></i>
                        </button>

                    </div>
                           

                    <div class="table-responsive">
                    <table id="listing_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('##') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Meta Title') }}</th>
                                <!-- <th>{{ __('Status') }}</th> -->
                                <th>{{ __('Action') }}</th>
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
    <div class="offcanvas offcanvas-end w-60" id="addEditModal" aria-labelledby="offcanvasAddUserLabel" aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Update</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addEditForm" method="POST">
                @csrf
                <input type="hidden" name="id" id="user_id" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" aria-label="Title">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3  fv-plugins-icon-container">
                            <label class="form-label" for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" placeholder="Enter Meta Title" name="meta_title" aria-label="Meta Title">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="meta_keyword">Meta Keyword</label>
                            <textarea type="text" class="form-control" rows="2" placeholder="Meta Keyword" name="meta_keyword" aria-label="Meta Keyword"></textarea>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="meta_description">Meta Description</label>
                            <textarea type="text" class="form-control" rows="2" placeholder="Meta Description" name="meta_description" aria-label="Meta Description"></textarea>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>
                   
                        <div class="col-sm-6 mt-2">
                            <label class="form-label" for="ecommerce-product-name">Image/Video</label>
                            <input type="file" class="form-control" id="img" placeholder="Page Image" name="img" aria-label="Image/Vedio">
                            
                            <small>Recommended image size: 1920*780 pixels. Supported formats: JPG,JPEG, PNG, GIF,MP4,MOV.</small>
                          
                        </div>
                        
                        {{-- <div class="col-sm-6 mt-2 ">
                            <div class=" image-border-shap mb-3" id="image-border_shap">
                            <img src="" alt="Product Image">
                        </div> --}}
                        <div class="col-md-6">
                            <div class="image-border-shap mb-3" id="image-border_shap">
                                <div id="imagePreviewContainer1" class="w-100 h-100" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                   
                   
                    <div class="col-sm-12" id="editor">
                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="description">Body</label>
                            <div class="pad">
                                <textarea name="description" id="description" rows="10" cols="80"></textarea>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="reset" class="btn btn-label-secondary " data-bs-dismiss="offcanvas">Cancel</button>
                        <input class="btn btn-primary pull-right submit_button  ms-3 " type="submit" name="Save" value="Save">
                        
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <!-- letter modal end-->

    <!-- push external js -->
    @push('scripts')


        <!--server side table script start-->
        <script>


            //listing data table
            $(document).ready(function() {
                var table = $('#listing_table').DataTable({
                    bFilter:false,
                    pageLength: 30,
                    lengthMenu: [
                        [10, 20, 30],
                        [10, 20, 30]
                    ],
                    sDom: '<"top"f<"close_button fa fa-times">>rt<"bottom table_bottom"lip><"clear">',
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('masters/static_pages/list') }}",
                        type: "get",
                        data: function (d) {
                        d.name = $('#name_s').val()
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
                            data: 'title',
                            name: 'title'

                        },
                        {
                            targets: 2,
                            data: 'meta_title',
                            name: 'meta_title'

                        },
                        /* {
                             targets: 2,
                             data: 'status',
                             name: 'status',
                             orderable: false,
                             searchable: false
                         },*/
                        //only those have manage_user permission will get access
                        {
                            targets: 3,
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                                    
                    $('#name_s').keyup(function () {
                        table.draw();
                    });

                    

           $('#reset_data').on('click',function () {
               $('#name_s').val('');
               table.draw();
           });

    });
           
        </script>


        <script>
            //add item
            function addItem() {
                //reset form
                $('#image-border_shap').hide();
                $("#addEditForm")[0].reset();
                //open modal
                $("#addEditModal").modal("show");
                //change modal title
                $("#addEditModal").find(".modal-title").text('Add');
                //put id zero in case of add new item
                $("#addEditModal").find("input[name='id']").val(0);
            }
            //update item
            function updateItem(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('masters/static_pages/get_by_id') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.code == 200) {
                            var item = response.data;
                            var variables = response.config_val;

                            //put  item details in all input fields
                            $("#addEditModal").find(".modal-title").text('Update');
                            $("#addEditModal").find("input[name='title']").val(item.title);
                            $("#addEditModal").find("input[name='meta_title']").val(item.meta_title);

                            $("#addEditModal").find("textarea[name='meta_keyword']").val(item.meta_keyword);

                            $("#addEditModal").find("textarea[name='meta_description']").val(item.meta_description);

                            $("#addEditModal").find("input[name='id']").val(item.id);
                            $("#addEditModal").find("input").removeClass('is-invalid');
                            $("#addEditModal").find(".error").remove();

                            

                            //For letter body

                            $('#addEditModal').find(".pad").html(
                                '<textarea id="description" name="description" rows="10" cols="80">' + item
                                .description + '</textarea>');


                                


        CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
                    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                    toolbar: {
                        items: [
                            '|',
                            'findAndReplace', '|',
                            'heading', '|',
                            'bold', 'italic', 'underline', 'code', , 'alignment', 'removeFormat', '|',
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
                    // Changing the language of the interface requires loading the language file using the <script> tag.
                    // language: 'es',
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
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
                    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                    placeholder: 'Welcome to CKEditor 5!',
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
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
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                    fontSize: {
                        options: [10, 12, 14, 'default', 18, 20, 22],
                        supportAllValues: true
                    },
                    // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                    htmlSupport: {
                        allow: [{
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }]
                    },
                    // Be careful with enabling previews
                    // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                    htmlEmbed: {
                        showPreviews: true
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                    link: {
                        decorators: {
                            addTargetToExternalLinks: true,
                            defaultProtocol: 'https://',
                            toggleDownloadable: {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'file'
                                }
                            }
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                    mention: {
                        feeds: [{
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                                '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                                '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                                '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }]
                    },
                    // The "superbuild" contains more premium features that require additional configuration, disable them below.
                    // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                    removePlugins: [
                        // These two are commercial, but you can try them out without registering to a trial.
                        // 'ExportPdf',
                        // 'ExportWord',
                        'AIAssistant',
                        'CKBox',
                        'CKFinder',
                        'EasyImage',
                        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                        // Storing images as Base64 is usually a very bad idea.
                        // Replace it on production website with other solutions:
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                        // 'Base64UploadAdapter',
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
                        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                        // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                        'MathType',
                        // The following features are part of the Productivity Pack and require additional license.
                        'SlashCommand',
                        'Template',
                        'DocumentOutline',
                        'FormatPainter',
                        'TableOfContents',
                        'PasteFromOfficeEnhanced',
                        'CaseChange'
                    ]
                });
                var fileName1 = item.image;
                var imagePath1 = fileName1 ? '/uploads/page/' + fileName1 : 'uploads/lifestyle_gear/default/defaul_banner.png';

                if (fileName1) {
                var extension = fileName1.split('.').pop().toLowerCase();
                if (extension === 'jpg' || extension === 'jpeg' || extension === 'png' || extension === 'gif') {
                    var imgTag1 = $('<img>').attr('src', imagePath1).attr('alt', 'Image');
                    $('#imagePreviewContainer1').html(imgTag1).show();
                } else if (extension === 'mp4' || extension === 'avi' || extension === 'mov') {
                    var videoTag1 = $('<video>').attr('controls', true).attr('class','w-100 h-100');
                    var sourceTag = $('<source>').attr('src', imagePath1).attr('type', 'video/' + extension);
                    videoTag1.append(sourceTag);
                    $('#imagePreviewContainer1').html(videoTag1).show();
                }
                } else {
                // Show default image if fileName1 is null or empty
                var defaultImg = 'https://fitspark-admin.orbitnapp.com/uploads/lifestyle_gear/default/defaul_banner.png';
                var defaultImgTag = $('<img>').attr('src', defaultImg).attr('alt', 'Image');
                $('#imagePreviewContainer1').html(defaultImgTag).show();
                }
                            //ck editor
                            //For show the modal

                            // $("#addEditModal").modal("show");

                        } else {
                            toastr.error(response.msg);
                        }
                    },
                });
            }
            //add update item
            //add update item
            $("#addEditForm").validate({
                rules: {
                    title: {
                        required: true,
                    },
                    meta_keyword: {
                        maxlength: "200"
                    },
                    meta_description: {
                        maxlength: "500"
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
                    $('.submitFrm').attr('disabled', true);
                    $('.loader').show(); 

					 var timeoutID = setTimeout(function () { 
                    // $('.submitFrm').attr('disabled', true); //Disable the submit button
                    var formData = new FormData($("#addEditForm")[0]);

                    $.ajax({
                        type: "POST",
                        url: "{{ url('masters/static_pages/store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            $("#addEditForm").find('.submitFrm').attr("disabled", false);
                            $('.loader').hide();
                                        var response = JSON.parse(data);
                            $('.submitFrm').attr('disabled', false); //Enable the submit button
                            if (response.code == 200) {
                                toastr.success(response.msg)
                                setTimeout(function () {
                                window.location.href = "{{url('masters/static_pages')}}";
                               },3000);
								
                            } else {
                                toastr.error(response.msg, "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText
                            console.log('Error - ' + errorMessage);
                        }
                    });
                    return false;
					
					 },3000);
					 
                }
            });



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
            //deleteItem
            function deleteItem(id) {
                //show confirmation popup
                $.confirm({
                    title: 'Delete',
                    content: 'Are you sure to want delete this?',
                    buttons: {
                        Cancel: function() {
                            //nothing to do
                        },
                        Sure: function() {
                            updateItemStatus(id = id, type = 'delete', value = '1');
                        },
                    }
                });

            }
            //update item
            function updateItemStatus(id, type, value) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('masters/static_pages/update_status') }}",
                    data: {
                        id: id,
                        type: type,
                        value: value,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.code == 200) {
                            $.notify(response.msg, "success");
                        } else {
                            $.notify(response.msg, "error");
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

        {{-- <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script> --}}
    @endpush
@endsection
