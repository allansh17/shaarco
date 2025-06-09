
@extends('layouts/contentNavbarLayout')
@section('title', 'Product Features')
@section('content')


<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header justify-content-between">
             <h3> {{ __('Product Features')}}</h3>
          </div>
          <div class="card-body">
             <div class="row">
                <div class="col-sm-3 form-group">
                   <select name="status" id="status" class="form-control form-select">
                      <option value="">Select Status</option>
                      <option value="1">Active</option>
                      <option value="2">Inactive</option>
                   </select>
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
                                    data-bs-target="#addEditModal" onclick="addItem()">
                                    <span><i class="bx bx-plus me-0 me-sm-2"></i></span>
                                    <span class="d-none d-sm-inline-block">Add New</span>
                                </button>
                            </div>
                   </div>
                </div>
             </div>
             {{-- add model start--}}
             <div class="offcanvas offcanvas-end w-30" id="addEditModal" aria-labelledby="offcanvasAddUserLabel" aria-modal="true" role="dialog">
                <div class="offcanvas-header">
                   <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add</h5>
                   <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                   <form class="add-new-email-template pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addEditForm" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                      @csrf
                      <input type="hidden" name="id" id="lifestyle_id" value="0">
                      <div class="row">
                         <div class="col-sm-12">
                            <div class="mb-3 fv-plugins-icon-container">
                               <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                               <input type="text" class="form-control" id="name" placeholder="Name" name="name" aria-label="Name">
                               <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                         </div>
                        
                         <div class="col-sm-12">
                            <div class="mb-3 fv-plugins-icon-container">
                               <label class="form-label" for="image1">Image/Icon<span class="text-danger">*</span></label>
                               <input type="file" class="form-control" id="image1" name="image" aria-label="Image 1">
                               <small>Recommended image/Icon size: 1080x600 pixels. Supported formats: JPG,JPEG,PNG, GIF.</small>
                               <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 mb-3 ">
                               <div class="image-border-shap">
                                  <img style="display:none;" id="imagePreview1" src=""  class="logo-icon cursor-pointer" alt="logo icon">
                               </div>
                            </div>
                         </div>

                      <div class="col-12 d-flex justify-content-end">
                         <input class="btn btn-primary pull-right submit_button " type="submit" name="Save" value="Save">
                      </div>
                   </form>
                </div>
             </div>
             {{-- add model end--}}

          </div>
          <div class="table-responsive">
          <table id="listing_table" class="table">
             <thead>
                <tr>
                   <th>{{ __('##')}}</th>
                   <th>{{ __('Name')}}</th>
                   <th>{{ __('Image')}}</th>
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

@endsection

<!-- push external js -->
@push('scripts')



<script>
    
    //listing data table

    $(document).ready(function () {
        
            //listing data table ------------------------------------------------------ Start
            var table = $('#listing_table').DataTable({
                sDom: '<"top"f>rt<"bottom table_bottom"lip><"clear">',// shift selection box in footer
                bFilter:false, //hide defalt search box
                responsive: true,
                "bProcessing": true,
                "serverSide": true,
                "lengthMenu": [10, 50, 100, 500],
                ajax: {
                    url: "{{ url('/product_feature/list') }}",
                    data: function (d) {
                        d.status = $('#status').val()

                        d.name = $('#name_s').val()


                    }
                },
                "aoColumns": [{
                        mData: 'id'
                    },
                    {
                        mData: 'name'
                    },
    
                    {
                        mData: 'image'
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
                    'aTargets': [-1,5]
                }, ],
                order: [
                    [0, 'desc']
                ]
            });
      
        $('#status').on('change',function () {
            table.draw();
        });

        $('#name_s').keyup(function(){
            table.draw();
        });

        $('#reset_data').on('click',function () {

            $('#status').val('');

            $('#name_s').val('');

            table.draw();

        });

       
    });

    
function addItem() {
    
    $("#addEditForm")[0].reset();
    $('.image-border-shap').hide();
    $('#imagePreview1').hide();
    $('#offcanvasAddUserLabel').text('Add');

    // Clear validation error messages and classes
    $("#addEditForm").find('.is-invalid').removeClass('is-invalid');
    $("#addEditForm").find('.invalid-feedback').empty();
    $("#addEditForm").find(".error").remove();

    // Hide and clear the image preview
    $('#imagePreview').hide();
    $('#imagePreview').attr('src', '');
    // Set modal title and reset hidden input field for user id
    // $("#addEditModal").modal("show");
    $("#addEditModal").find(".modal-title").text('Add');
    $("#addEditModal").find("input[name='id']").val(0);
}



    // add coupon ------
    
$.validator.addMethod(
  "regex",
  function(value, element) {
    return value.match(/^[A-Z a-z]*$/);
  },
  "Only alphabates are allowed."
);


//add update item
$("#addEditForm").validate({
    rules: {
        
        name: {
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
    submitHandler: function (form) {
        //form.submit();
        var formData = new FormData($("#addEditForm")[0]);
        var url_up = "{{url('product_feature/store')}}";
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: url_up,
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#addEditForm").find('.submit_button').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $("#addEditForm").find('.submit_button').attr("disabled", false);
                $('.loader').hide();
                var response = JSON.parse(data);
                //console.log(response);
                if (response.code == 200) {
                    //show notification
                    //location.reload();
                    toastr.success(response.msg);
                    setTimeout(function () {
                    window.location.href = "{{url('product_feature')}}";
                        // body...
                    },3000);
                } else {
                    toastr.error(response.msg);
                    // $("#addEditForm").find('.submit_button').attr("disabled", true);
                }
            },
        });
        return false;
    }
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
            url: "{{route('delete.product_feature')}}",
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

    // update Item -----sarwan 

       //update item
   function updateItem(id) {
    // alert(id)
    $('#offcanvasAddUserLabel').text('Update');
    $('.image-border-shap').show();
     $('#imagePreview1').show();
    // alert(id)
       $.ajax({
           type: "POST",
           url: "{{url('product_feature/get_by_id')}}",
           data: {
               id: id,
               _token: '{{csrf_token()}}'
           },
           success: function(data) {
               var response = JSON.parse(data);
               if (response.code == 200) {
                var item = response.data.feature_detail;
                console.log(item)
                //    console.log(item_image)
                   var variables = response.config_val;
                   

                   //put  item details in all input fields
                   $("#addEditModal").find(".modal-title").text('Update');
                   $("#addEditModal").find("input[name='id']").val(item.id);
               
                   $("#addEditModal").find("input[name='name']").val(item.name);

                    var fileName = item.image;


                    // Create the image paths
                    var imagePath1 = '/uploads/product_feature/' + fileName;
           // Update the label text to show the selected file names
                    $("#addEditForm").find(".file-upload-info1").val(fileName).attr('placeholder', fileName);

// Create the <img> tags
                    var imgTag1 = $('<img>').attr('src', imagePath1).attr('alt', 'Image 1');

// Append the <img> tags to their respective containers
                    $("#addEditForm").find(".image-preview-container1").html(imgTag1);
                    // Show the image preview containers
                    $('#imagePreview1').show();
                    // Update the src attributes of the image preview elements
                    $('#imagePreview1').attr('src', (fileName!== null && fileName!== undefined && fileName!== "")? imagePath1:'uploads/lifestyle_gear/default/defaul_banner.png');
   
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

    // end

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
            url: "{{route('product_feature.status')}}",
            data: {
                id: id,
                type:type,
                value:value,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                var response = JSON.parse(data);
                if (response.code == 200) {
                    toastr.success(response.msg);
                } else {
                    toastr.error(response.msg);
                }
                //reload data table in case of delete item
                // if (type == 'delete') {
                    var active_page = $(".pagination").find("li.active a").text();
                    //reload datatable
                    $('#listing_table').dataTable().fnPageChange((parseInt(active_page)-1));
                // }

            },
        });
    }


</script>
@endpush
