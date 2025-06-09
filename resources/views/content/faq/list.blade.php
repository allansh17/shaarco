@extends('layouts/contentNavbarLayout')
@section('title', 'Faqs Management')
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header justify-content-between">
            <h3>{{ __('FAQs Management')}}</h3>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-sm-3 form-group">
                  <select name="status" id="status" class="form-control">
                     <option value="">Select All</option>
                     <option value="1">Active</option>
                     <option value="2">Inactive</option>
                  </select>
               </div>
               <div class="col-sm-3 form-group">
                <select name="type12" id="type12" class="form-control">
                    <option value="">Select Type</option>
                    @foreach($Faq_Category_WithFaqs as $category)
                        <option value="{{$category->category}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
               <div class="col-sm-3 form-group">
                  <input type="text" name="question_s" id="question_s" class="form-control" placeholder="Search">
               </div>
               <div class="col-sm-3">
                <div class="d-flex justify-content-evenly">
                <button type="button" class="btn btn-primary btn-rounded-20" id="reset_data">
                   <i class="bx bx-reset"></i>
               </button>
               <div class="dt-buttons ms-2"> 
                @can('master_add_faqss')
                  <button id="submit_form11" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#addEditModal"><span><i class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block" onclick="addItem()">
                     Add
                   </button> 
                @endcan
                </div>
             </div>
            </div>
            <div class="table-responsive">
            <table id="listing_table" class="table">
                <thead>
                   <tr>
                      <th>{{ __('##')}}</th>
                      <th>{{ __('Question')}}</th>
                      <th>{{ __('Category Type')}}</th>
                      <th>{{ __('Status')}}</th>
                      {{-- <th>{{ __('Sort')}}</th> --}}
                      <th style="min-width:125px;">{{ __('Created at')}}</th>
                      <th style="min-width:100px;">{{ __('Action')}}</th>
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
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add FAQs</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
        <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addEditForm" method="POST">
            @csrf
            <input type="hidden" name="id" id="user_id" value="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="type">Category Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="">Select</option>
                            @foreach($All_Faq_Categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="question">Question <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="question" placeholder="Question" name="question" aria-label="Question">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                </div>
            
                <div class="col-sm-12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="answer">Answer <span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control" rows="3" placeholder="Answer" name="answer" aria-label="Answer" id="description" rows="10" cols="80"></textarea>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-start">
                <input class="btn btn-primary pull-right submit_button " type="submit" name="Save" value="Save">
                <button type="reset" class="btn btn-label-secondary  ms-3" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>
<!-- letter modal end-->
<div class="offcanvas offcanvas-end w-60" id="viewModal" aria-labelledby="offcanvasViewLabel" aria-modal="true" role="dialog">
    <div class="offcanvas-header">
        <h5 id="offcanvasViewLabel" class="offcanvas-title">View FAQs</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="view_type">Category Type:</label>
                    <div class="view_type"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="view_question">Question:</label>
                    <div class="view_question"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="view_answer">Answer:</label>
                    <div class="view_answer"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="view_answer">Created Date:</label>
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
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
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
        allow: [{ name: /.*/, attributes: true, classes: true, styles: true }]
    },
    htmlEmbed: {
        showPreviews: true
    },
    link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: { download: 'file' }
            }
        }
    },
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




   $(document).on("click", ".file-upload-browse", function () {
       var file = $(this).parent().parent().parent().find('.file-upload-default');
       file.trigger('click');
   });
   $(document).on("change", ".file-upload-default", function () {
       $(this).parent().find('.file-upload-info').val($(this).val().replace(/C:\\fakepath\\/i, ''));
       if($(this).val()){
           $(this).parent().find('.file-upload-info').attr('placeholder',$(this).val().replace(/C:\\fakepath\\/i, ''));
       }else{
           $(this).parent().find('.file-upload-info').attr('placeholder','Upload Image');
       }
   });
   $('input[name=image]').on('change', function(e){
       // Get the selected file
       var file = e.target.files[0];
       
       if (file) {
         // Create a FileReader to read the image data
         var reader = new FileReader();
   
         reader.onload = function(e) {
           // This function will be called when the reader finishes reading the file
           var imageData = e.target.result;
           // console.log('Image Data:', '#'+$(this).attr('name')+'_display img');
           $('#image_display img').attr('src',imageData);
           $('#image_display').show();
   
           // You can perform further actions with the image data here
         };
   
         // Read the file as a data URL (base64-encoded image)
         reader.readAsDataURL(file);
       }else{
           $('#image_display img').attr('src','');
           $('#image_display').hide();
       }
   });
       //listing data table
       $(document).ready(function() {
   
           var table = $('#listing_table').DataTable({
               pageLength: 20,
               lengthMenu: [
                   [10,20,50],
                   [10,20,50]
               ],
               sDom: '<"top"f<"close_button fa fa-times">>rt<"bottom table_bottom"lip><"clear">',
               bFilter:false, //hide defalt search box
   
               processing: true,
               serverSide: true,
               ajax: {
                   url: 'faq/list',
                   type: "get",
                   data: function (d) {
                           d.status = $('#status').val()
                           d.type = $('#type12').val()
                           d.question=$('#question_s').val()
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
                       data: 'question',
                       name: 'question'
   
                   },
                   {
                       targets: 2,
                       data: 'type',
                       name: 'type',
                       orderable: false,
   
                   },
                   {
                       targets: 3,
                       data: 'status',
                       name: 'status',
                       orderable: false,
                       searchable: false
                   },
                //    {
                //        targets: 4,
                //        data: 'order_sort',
                //        name: 'order_sort',
                //        orderable: false,
                //        searchable: false
                //    },
                   {
                       targets: 4,
                       data: 'created_at',
                       name: 'created_at'
   
                   },
                   //only those have manage_user permission will get access
                   {
                       targets: 5,
                       data: 'action',
                       name: 'action',
                       orderable: false,
                       searchable: false
                   }
               ],
               "aoColumnDefs": [{
                    "bSortable": false,
                    'aTargets': [-1,5]
                }, ],
                order: [
                    [0, 'desc']
                ]
           });
           $('#type12').on('change',function () {
               table.draw();
           });
           $('#status').on('change',function () {
               table.draw();
           });
   
           $('#question_s').keyup('change',function () {
               table.draw();
           });
           $('#reset_data').on('click',function () {
               $('#status').val('');
               $('#type12').val('');
               $('#question_s').val('');
   
               table.draw();
           });
           initialize_tooltip();
           table.on( 'search.dt', function () {
           if(table.search()==''){
               $('.close_button').hide();
           }else{
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
    if (editorInstance) {
        editorInstance.setData('');
    }


       //reset form
       $("#addEditForm")[0].reset();
       $('#offcanvasAddUserLabel').text('Add');
       //open modal
    //    $("#addEditModal").modal("show");
       //change modal title
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
    $('#offcanvasAddUserLabel').text('Update');
    // alert(id)
       $.ajax({
           type: "POST",
           url: "{{url('faq/get_by_id')}}",
           data: {
               id: id,
               _token: '{{csrf_token()}}'
           },
           success: function(data) {
               var response = JSON.parse(data);
               if (response.code == 200) {
                   var item = response.data;
                //    console.log(item)
                   var variables = response.config_val;
                   
                   //put  item details in all input fields
                   $("#addEditModal").find(".modal-title").text('Update');
                   $("#addEditModal").find("input[name='id']").val(item.id);
                   $("#addEditModal").find("select[name='type']").val(item.category);
                   $("#addEditModal").find("input[name='question']").val(item.question);
          
                   if (editorInstance) {
                        editorInstance.setData(item.answer); // Set the CKEditor content
                    } else {
                        console.error('CKEditor instance is not available.');
                    }
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
   if(!value){
       return true;
   }
   if (!value.match(/\.(jpg|jpeg|png|JPG|PNG|JPEG)$/i)) {
       return false;
   }
   return true;
   },'Only formats are allowed: jpeg, jpg, png');
   
   
   //add update item
   $("#addEditForm").validate({
       rules: {
   
           question: {
               required: true,
               maxlength:"200"
           },
           answer: {
               required: true,
              
           }
      
   
   
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
           $('.submitFrm').attr('disabled', true); //Disable the submit button
           //serialize form data
           // var formData = $("#addEditForm").serialize();
           var formData = new FormData($("#addEditForm")[0]);
           $.ajax({
               type: "POST",
               enctype: 'multipart/form-data',
               url: "{{url('faq/store')}}",
               data: formData,
               mimeType: "multipart/form-data",
               contentType: false,
               cache: false,
               processData: false,
               beforeSend: function () {
                   // $("#addEditForm").find('.submit_button').attr("disabled", true);
                   $('.loader').show();
               },
               success: function(data) {
                   // $("#addEditForm").find('.submit_button').attr("disabled", false);
                   $('.loader').hide();
                   var response = JSON.parse(data);
                   $('.submitFrm').attr('disabled', false); //Enable the submit button
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
                       setTimeout(function () {
                        window.location.href = "{{url('faqs')}}";
                    },3000);
                   } else {
                       toastr.error(response.msg, "error");
                   }
               },
           });
           return false;
       }
   });
   
   
       // view item
 function viewItem(id) 
{
    $.ajax({
        type: "POST",
        url: "{{url('faq/get_by_id')}}",
        data: {id: id, _token: '{{csrf_token()}}'},
        success: function(data) 
        {
            var response = JSON.parse(data);
            if (response.code == 200) 
            {
                var item = response.data;
                //set edit id
                console.log(item)
                
                // var typeText = "";
                // if (item.type == 0) {
                //     typeText = "General Questions";
                // } else if (item.type == 1) {
                //     typeText = "Your orders and account settings";
                // } else {
                //     typeText = "Unknown"; 
                // }
                $("#viewModal .view_type").text(item.category_name);
                $("#viewModal .view_question").text(item.question);
                $("#viewModal .view_answer").html(item.answer);
                // $("#viewModal .view_answer").text(item.answer);
                const createdAt = moment(item.created_at);
                $("#viewModal .view_date").text(createdAt.format("DD-MM-YYYY"));
                // Select the corresponding category option
                $('#type').val(item.category);

                //set modal title for update
                $("#viewModal").find(".modal-title").text('View');
            } 
            else 
            {
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
               var value = '0';
           }
           updateItemStatus(id = id, type = 'status', value = value);
   
       })
   });
   
   
   
   
      //deleteItem
   
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
   
   
   function removedata(id){
   $.ajax({
           type: "POST",
           url: "{{route('delete.faq')}}",
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
           url: "{{url('faq/update_status')}}",
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
@endpush
@endsection