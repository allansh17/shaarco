@extends('layouts/contentNavbarLayout')
@section('title', 'View User Details')
@section('content')

<div class="card">
  <div class="card-header justify-content-between d-flex">
    <h3>{{ __('View User Details')}}</h3>
    <div class="pull-right">
      <a class="btn btn-primary" href="{{ url('customer') }}">
        <i class="ik ik-list"></i> List of User
      </a>
    </div>
  </div>
</div>

<section id="user-details">

  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-4 text-center text-sm-start gap-2">
      <div class="mb-2 mb-sm-0">
        <h4 class="mb-1">
          User ID #{{$customer_detail->id}}
        </h4>
        <p class="mb-0">
          {{ $customer_detail->created_at->format('Y-m-d') }}
        </p>
      </div>
      <button type="button" onclick="deleteItem('{{ $customer_detail->id }}')" class="btn btn-label-danger delete-customer">Delete User</button>
    </div>


    <div class="row">
      <!-- Customer-detail Sidebar -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- Customer-detail Card -->
        <div class="card mb-4">
          <div class="card-body">
            <div class="customer-avatar-section">
              <div class="d-flex align-items-center flex-column">
                <img class="img-fluid rounded my-3" src="{{ $customer_detail->image? asset('uploads/customer_profile_img/'. $customer_detail->image) : asset('uploads/default_image/default.png') }}" height="110" width="110" alt="User avatar">
                <div class="customer-info text-center">
                  <h4 class="mb-1">{{$customer_detail->first_name . ' ' .$customer_detail->last_name}}</h4>
                  <small>User ID #{{$customer_detail->id}}</small>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap mt-4 py-3">
              <div class="d-flex align-items-center gap-2">
                <div class="avatar">
                  <div class="avatar-initial rounded bg-label-primary"><i class="bx bx-cart-alt bx-sm"></i>
                  </div>
                </div>
                <div>
                  <h5 class="mb-0">{{$orders_count}}</h5>
                  <span>Inquirys</span>
                </div>
              </div>
              <!-- <div class="d-flex align-items-center gap-2">
                  <div class="avatar">
                    <div class="avatar-initial rounded bg-label-primary"><i class="bx bx-rupee bx-sm"></i>
                    </div>
                  </div>
                  <div>
                    <h5 class="mb-0">{{$total_spent}}</h5>
                    <span>Spent</span>
                  </div>
                </div> -->
            </div>

            <div class="info-container">
              <small class="d-block pt-4 border-top fw-normal text-uppercase text-muted my-3">DETAILS</small>
              <ul class="list-unstyled">
                <li class="mb-3">
                  <span class="fw-medium me-2">Full Name:</span>
                  <span>{{$customer_detail->first_name . ' ' .$customer_detail->last_name}}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-medium me-2">Email:</span>
                  <span>{{$customer_detail->email}}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-medium me-2">User Type:</span>
                  <span>{{ucfirst($customer_detail->user_type)}}</span>
                </li>
                {{--  --}}
                <li class="mb-3">
                  <span class="fw-medium me-2">Status:</span>
                  @if($customer_detail->status==1)
                  <span class="badge bg-label-success">Active</span>
                  @else
                  <span class="badge bg-label-danger">InActive</span>
                  @endif

                </li>
                <li class="mb-3">
                  <span class="fw-medium me-2">Contact:</span>
                  <span>{{$customer_detail->phone}}</span>
                </li>

                {{-- <li class="mb-3">
                    <span class="fw-medium me-2">Country:</span>
                    @foreach($address_details as $d)
                    <span>{{$d->country_name}}</span>
                @endforeach
                </li> --}}

              </ul>
              {{-- <div class="d-flex justify-content-center">
                  <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit Details</a>
      
                </div> --}}
            </div>
          </div>
        </div>

      </div>
      <!--/ Customer Sidebar -->


      <!-- Customer Content -->
      <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- Customer Pills -->
        <ul class="nav nav-pills flex-column flex-md-row mb-4">
          <li class="nav-item">
            <a class="nav-link active" href="#" id="overview-tab" onclick="product_view(this.id)">Overview</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="security-tab" onclick="product_view(this.id)">Security</a>
          </li>
          <!-- <li class="nav-item">
              <a class="nav-link" href="#" id = "address-tab" onclick="product_view(this.id)" >Address & Billing</a>
            </li> -->
          <!-- ... -->
        </ul>
        <!--/ Customer Pills -->

        <!-- / Customer cards -->


        <div class="row text-nowrap" id="cutomer">
          <!-- <div class="col-md-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-icon mb-3">
                    <div class="avatar">
                      <div class="avatar-initial rounded bg-label-warning"><i class="bx bx-star bx-sm"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-info">
                    <h4 class="card-title mb-3">Wishlist</h4>
                    <div class="d-flex align-items-end mb-1 gap-1">
                      <h4 class="text-warning mb-0">{{$whislist_count}}</h4>
                      <p class="mb-0">Items in wishlist</p>
                    </div>

                  </div>
                </div>
              </div>
            </div> -->
          <!-- <div class="col-md-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-icon mb-3">
                    <div class="avatar">
                      <div class="avatar-initial rounded bg-label-info"><i class="bx bxs-home bx-sm"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-info">
                    <h4 class="card-title mb-3">Addresses</h4>
                    <div class="d-flex align-items-end mb-1 gap-1">
                      <h4 class="text-info mb-0">{{$address_count}}</h4>
                      <p class="mb-0">Saved address</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
        </div>



        <!-- / customer cards end  -->

        <!-- / customer change password start  -->
        <div class="card mb-4 d-none" id="security-card">
          <h5 class="card-header">Change Password</h5>
          <div class="card-body">
            <form id="formChangePassword" class="fv-plugins-bootstrap5 fv-plugins-framework" method="POST">
              <input type="hidden" name="id" value={{$customer_detail->id}}>
              @csrf
              <div class="alert alert-warning" role="alert">
                <h6 class="alert-heading mb-2 pb-1">Ensure that these requirements are met</h6>
                <small>Minimum 8 characters long, uppercase &amp; symbol</small>
              </div>
              <div class="row">
                <div class="mb-3 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                  <label class="form-label" for="newPassword">New Password</label>
                  <div class="input-group input-group-merge has-validation">
                    <input class="form-control" type="password" id="Password" name="password" placeholder="············">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>

                <div class="mb-3 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                  <label class="form-label" for="confirmPassword">Confirm New Password</label>
                  <div class="input-group input-group-merge has-validation">
                    <input class="form-control" type="password" name="confirm_password" id="confirmPassword" placeholder="············">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 .submit-button">Change Password</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- / customer change password end  -->



      <!-- <div class="card card-action mb-4 d-none"  id="address-card">
            <div class="card-header align-items-center flex-wrap gap-3 py-4">
              <h5 class="card-action-title mb-0">Address Book</h5>
              <div class="card-action-element">
                <button class="btn btn-label-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewAddress" onclick="addItem()">Add new address</button>
              </div>
            </div>
            <div class="card-body">
              <div class="accordion accordion-flush accordion-arrow-left" id="ecommerceBillingAccordionAddress">
                <div class="accordion-item">
                  @foreach($address_details as $address)
                  <div class="accordion-header d-flex justify-content-between align-items-center flex-wrap flex-sm-nowrap" id={{$address->id}}>
                    <a class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ecommerceBillingAddressHome"  aria-expanded="false" aria-controls="headingHome" role="button">
                      <span>
                        <span class="d-flex gap-2 align-items-baseline">
                          @if($address->is_billingtype =='1')
                          <span class="badge bg-label-success">Delivery Address</span>
                          @else
                          <span class="badge bg-label-success">Billing Address</span>
                          @endif
                        </span>
                        <span class="mb-0 text-muted">{{$address->address}}</span>
                      </span>
                    </a>
                   
                    <button class="btn btn-sm btn-icon btn-danger btn-delete-address" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Address">
                      <i class="bx bx-trash"></i>
                    </button>
                  </div>
                  <div id="ecommerceBillingAddressHome" class="accordion-collapse collapse" data-bs-parent="#ecommerceBillingAccordionAddress">
                    <div class="accordion-body ps-4 ms-1">
                      <p class="mb-1">Pin Code:-{{$address->pin_code}},</p>
                      <p class="mb-1">City:-{{$address->city}},</p> 
                      <p class="mb-1">State:-{{$address->state}}</p>
                      <p class="mb-1">Country:-{{$address->country_name}}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div> -->



      <!-- / customer address end  -->
      <!-- Invoice table -->
      <div class="card  card-action mb-4" id="order_table">
        <div class="mb-3 mt-3">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="card-header d-flex flex-wrap py-3 py-sm-2">
              <div class="head-label text-center me-4 ms-1">
                <h5 class="card-title mb-0 text-nowrap">Inquirys</h5>
              </div>

            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th class="control sorting_disabled" rowspan="1" colspan="1" style="width: 8px;" aria-label=""></th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Order: activate to sort column ascending" aria-sort="descending">Inquiry</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 147px;" aria-label="Status: activate to sort column ascending">Message</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 112px;" aria-label="Date: activate to sort column ascending">Date</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 147px;" aria-label="Status: activate to sort column ascending">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($total_orders as $order)
                  <tr class="even">
                    <td class="control" tabindex="0" style=""></td>
                    <td class="sorting_1"><a href="app-ecommerce-order-details.html" class="fw-medium"><span>#{{$order->id}}</span></a></td>
                    <td><span class="text-nowrap">{{ \Illuminate\Support\Str::limit($order->message, 50) }}</span> </td>
                    <td><span class="text-nowrap"> {{ $order->created_at->format('m-d-Y') }}</span> </td>
                    @if($order->order_status =1)
                    <td><span class="badge bg-label-danger" text-capitalized="">Pending</span></td>
                    @elseif($order->order_status =2)
                    <td><span class="badge bg-label-success" text-capitalized="">Confirmed</span></td>
                    @elseif($order->order_status =3)
                    <td><span class="badge bg-label-info" text-capitalized="">Shipped</span></td>
                    @elseif($order->order_status =4)
                    <td><span class="badge bg-label-success" text-capitalized="">Delivered</span></td>
                    @elseif($order->order_status =5)
                    <td><span class="badge bg-label-danger" text-capitalized="">Cancel</span></td>
                    @endif

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
      <!-- /Invoice table -->
    </div>
    <!--/ Customer Content -->
  </div>

  <!-- Modal -->
  <!-- Add address Modal -->
  <div class="modal fade" id="addNewAddress" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3>Add Address</h3>
          </div>
          <form id="addaddressform" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" method="POST">
            <input type="hidden" name="id" value={{$customer_detail->id}}>
            @csrf
            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="form-label" for="modalEditUserFirstName">Name</label>
              <input type="text" id="modalEditUserFirstName" name="name" class="form-control" placeholder="John">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="form-label" for="modalEditUserLastName">State</label>
              <input type="text" id="modalEditUserLastName" name="state" class="form-control" placeholder="Rajasthan">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="form-label" for="modalEditUserName">City</label>
              <input type="text" id="modalEditUserName" name="city" class="form-control" placeholder="City">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="form-label" for="modalEditUserName">Pin Code</label>
              <input type="number" id="modalEditUserName" name="pin" class="form-control" placeholder="Pin Code">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>

            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="form-label" for="modalEditUserName">Address</label>
              <input type="text" id="modalEditUserName" name="address" class="form-control" placeholder="Address">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>

            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="form-label" for="modalEditUserStatus">Country</label>
              <select id="modalEditUserStatus" name="country" class="form-select" aria-label="Default select example">
                <option selected="">Select</option>
                @foreach($countries as $country)
                <option value={{$country->id}}>{{$country->country_name}}</option>
                @endforeach
              </select>
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="form-label" for="modalEditUserPhone">Phone Number</label>

              <input type="number" id="modalEditUserPhone" name="phone" class="form-control phone-number-mask" placeholder="+91 202 555 0111">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>

            </div>
            <div class="col-12 col-md-6 fv-plugins-icon-container">
              <label class="switch" style="margin-top:38px">
                <input type="checkbox" class="switch-input" name="bill">
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">Use as a billing address?</span>
              </label>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1 submit_button">Submit</button>
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
            <input type="hidden">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Edit User Modal -->


  <!-- /Modal -->
  </div>
</section>
@push('scripts')
<script>
  function addItem() {
    $("#addaddressform")[0].reset();
    // Clear validation error messages and classes
    $("#addaddressform").find('.is-invalid').removeClass('is-invalid');
    $("#addaddressform").find('.invalid-feedback').empty();
    $("#addaddressform").find(".error").remove();
    // Reset validation state
    var validator = $("#addaddressform").validate();
    validator.resetForm();
    //...
  }

  function product_view(id) {
    if (id == 'overview-tab') {
      $('#overview-tab').addClass('active')
      $('#security-tab').removeClass('active');
      $('#address-tab').removeClass('active');
      $('#order_table').removeClass('d-none');
      $('#cutomer').removeClass('d-none');
      $('#address-card').addClass('d-none');
      $('#security-card').addClass('d-none');

    } else if (id == 'security-tab') {
      $('#overview-tab').removeClass('active');
      $('#address-tab').removeClass('active');
      $('#security-tab').addClass('active')
      // alert('=================')
      $('#order_table').removeClass('d-none');
      $('#cutomer').addClass('d-none');
      $('#address-card').addClass('d-none');
      $('#security-card').removeClass('d-none');
    } else {
      $('#order_table').removeClass('d-none');
      $('#address-tab').addClass('active');
      $('#security-tab').removeClass('active');
      $('#overview-tab').removeClass('active');
      $('#order_table').removeClass('d-none');
      $('#cutomer').addClass('d-none');
      $('#address-card').removeClass('d-none');
      $('#security-card').addClass('d-none');
    }
  }


  $.validator.addMethod(
    "regex",
    function(value, element) {
      return value.match(/^[a-zA-Z ]*$/);
    },
    "Only alphabetic characters are allowed."
  );
  // $.validator.addMethod(
  //     "pin",
  //     function(value, element) {
  //         return value.match(/^[0-9]*$/);
  //     },
  //     "Only numbers are allowed."
  // );

  $.validator.addMethod(
    "address",
    function(value, element) {
      return value.match(/^[-a-zA-Z0-9., ]*$/);
    },
    "Special characters are not allowed."
  );

  $.validator.addMethod(
    "pincode",
    function(value, element) {
      return value.match(/^[a-zA-Z0-9 ]*$/);
    },
    "Special characters are not allowed."
  );

  $.validator.addMethod("customPassword", function(value, element) {
    // Use a regular expression to check if the input contains at least one number,
    // one lowercase letter, and one uppercase letter.
    if (value) {
      return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(value);
    } else {
      return true;
    }
  }, "Password must contain at least one uppercase, one lowercase ,one number, one special character and without spaces.");

  //add update item
  $("#formChangePassword").validate({
    rules: {
      password: {
        required: true,
        customPassword: true
      },
      confirm_password: {
        required: true,
        customPassword: true,
        equalTo: '#Password'

      },
    },
    messages: {
      confirm_password: {
        equalTo: 'Password and confirm password must be same.'
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
      var formData = new FormData($("#formChangePassword")[0]);
      var url_up = "{{url('customer/update_pass')}}";
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
          $("#formChangePassword").find('.submit_button').attr("disabled", true);
          $('.loader').show();
        },
        success: function(data) {
          $("#formChangePassword").find('.submit_button').attr("disabled", false);
          $('.loader').hide();
          var response = JSON.parse(data);
          //console.log(response);
          if (response.code == 200) {
            //show notification
            //location.reload();
            toastr.success(response.msg);
            setTimeout(function() {
              location.reload();
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





  $("#addaddressform").validate({
    rules: {
      name: {
        required: true,
        regex: true
      },
      state: {
        required: true,
        regex: true
      },

      city: {
        required: true,
        regex: true
      },
      pin: {
        required: true,
        // pin: true
      },
      phone: {
        required: true,
        minlength: 10,
        maxlength: 10
      },

      country: {
        required: true,
      },

      address: {
        required: true,
        address: true,
      }
    },
    messages: {
      phone: {
        minlength: 'Phone number should be of at least 10 digit',
        maxlength: 'Please enter valid phone number'
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
      var formData = new FormData($("#addaddressform")[0]);
      var url_up = "{{url('customer/add_address')}}";
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
          $("#addaddressform").find('.submit_button').attr("disabled", true);
          $('.loader').show();
        },
        success: function(data) {
          $("#addaddressform").find('.submit_button').attr("disabled", false);
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

  function removedata(id) {
    $.ajax({
      type: "POST",
      url: "{{route('delete.customer')}}",
      data: {
        id: id,
        _token: '{{csrf_token()}}'
      },
      success: function(data) {
        // console.log(data.success)
        toastr.success(data.success);
        setTimeout(function() {
          window.location.href = "{{url('customer')}}";
        }, 3000);
      },
    });
  }

  function deleteItem(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'You want to delete this customer!',
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



  // const navPills = document.querySelectorAll('.nav-pills li');
  // const overviewCard = document.querySelector('#overview-card');
  // const securityCard = document.querySelector('#security-card');
  // const addressCard = document.querySelector('#address-card');

  // navPills.forEach((pill) => {
  //   pill.addEventListener('click', (e) => {
  //     const targetTab = e.currentTarget.getAttribute('data-bs-target');

  //     overviewCard.classList.add('d-none');
  //     securityCard.classList.add('d-none');
  //     addressCard.classList.add('d-none');

  //     switch (targetTab) {
  //       case '#overview-tab':
  //         overviewCard.classList.remove('d-none');
  //         break;
  //       case '#security-tab':
  //         securityCard.classList.remove('d-none');
  //         break;
  //       case '#address-tab':
  //         addressCard.classList.remove('d-none');
  //         break;
  //     }
  //   });
  // });

  $(document).ready(function() {
    $('.btn-delete-address').on('click', function() {
      var addressId = $(this).closest('.accordion-header').attr('id');

      Swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete this address!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          removedata(addressId);
        }
      });
    });

    function removedata(addressId) {
      $.ajax({
        type: 'POST',
        url: "{{ url('/customer/delete-address') }}",

        data: {
          address_id: addressId,
          _token: '{{csrf_token()}}',

        },
        dataType: 'json',
        success: function(response) {
          if (response.code == 200) {
            toastr.success(response.msg);
            setTimeout(function() {
              window.location.reload();
            }, 3000);
          }
        }
      });
    }
  });
</script>

@endpush
@endsection