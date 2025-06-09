@extends('layouts/blankLayout')

@section('title', 'Login')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <span class="app-brand-logo demo">
              <img src="{{ asset('uploads/logo/'.company_logo()) }}" width="100%" height="100%" alt="Logo">
          </span>
        </div>
          <!-- /Logo -->
          <h4 class="mb-2">Welcome to {{env('APP_NAME')}}! 👋</h4>
          <p class="mb-4">Please sign-in to your account </p>

          <form id="formAuthentication" id="myForm" class="mb-3"  method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input id="email" type="text" placeholder="Email Address " class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
              {{-- @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror --}}
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="{{url('password/forget')}}">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" >
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100 submit_button" type="submit">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection

@push('scripts')
<script>
  let errors = @json($errors->all());
  if (errors.length > 0) {
    errors.forEach(function(error) {
      toastr.error(error);
    });
  }
</script>
<script>



$(document).ready(function() {
  $.validator.addMethod("email_val", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter a valid email address.');

  $('#formAuthentication').validate({
    rules: {
      email: {
        required: true,
        email_val:true,
        // email: true
      },
      password: {
        required: true,
        minlength: 8
      }
    },
    messages: {
      email: {
        required: "Please enter your email",
        email: "Invalid email address"
      },
      password: {
        required: "Please enter your password",
        minlength: "Password must be at least 8 characters"
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
   
          $("#formAuthentication").find('.submit_button').attr("disabled", true);
          $('.loader').show();
  
        form.submit();
    //   var formData = $(form).serialize();
    //   $.ajax({
    //     type: 'POST',
    //     url: '{{ route('login') }}',
    //     data: formData,
    //     contentType: false,
    //     cache: false,
    //     processData: false,
    //     beforeSend: function() {
    //       $("#formAuthentication").find('.submit_button').attr("disabled", true);
    //       $('.loader').show();
    //     },
    //     success: function(data) {
    //       $("#formAuthentication").find('.submit_button').attr("disabled", false);
    //       $('.loader').hide();
    //       var response = JSON.parse(data);
    //       if (response.status == 200) {
    //         $.notify(response.msg, "success");
    //         window.location.href = '{{url("dealer/dashboard")}}';
    //       } else {
    //         $.notify(response.msg, "error");
    //       }
    //     },
    //     error: function(xhr, status, error) {
    //       console.log(xhr.responseText);
    //     }
    //   });
    }
  });
});
  </script>
@endpush
  

