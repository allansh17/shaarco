

@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    
    <div class="authentication-inner">
        <div class="logo-centered">
            <a href=""><img max-width="250"  src="{{ asset('company_logo/') }}/{{(isset($company_detail->company_logo) && !empty($company_detail->company_logo) ? $company_detail->company_logo:'')}}" alt=""></a>
        </div>
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <h3>{{ __('Reset Password') }}</h3>
          <p>{{ __('Enter your new password.') }}</p>
          <form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
            <input type="hidden" name="token" value="{{ $token }}">
            @csrf
            <div class="mb-3 form-password-toggle">
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
            <div class="mb-3 form-password-toggle">
              <div class="input-group input-group-merge">
                <input id="confirm_password" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" >
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                 <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
               </div>
            </div>
            {{-- <div class="input-group input-group-merge">
                <input type="email" class="form-control d-none @error('email') is-invalid @enderror" placeholder="Your email address" name="email" value="{{ old('email')?old('email'):$email }}" required>
                <i class="ik ik-mail"></i>
            </div>
            @error('email')
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror --}}
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100 submitFrm" type="submit">Submit</button>
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

$(document).ready(function() {
  $('#formAuthentication').validate({
    rules: {
      password: {
        required: true,
        minlength: 8
      },
      password_confirmation: {
        required: true,
        minlength: 8,
        equalTo: {
          param: '#password'
        }
      }
    },
    messages: {
      password_confirmation: {
        minlength: "Password must be at least 8 characters",
        equalTo: "Please enter valid confirm password"
      },
      password: {
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
  });
});
  </script>
@endpush
  




