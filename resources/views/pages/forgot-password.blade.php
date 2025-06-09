

<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}">

@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            
                <span class="app-brand-logo demo">
                    <img src="{{ asset('uploads/logo/'.company_logo()) }}" width="100%" height="100%" alt="Logo">
                </span>
              <span class="app-brand-text demo text-body fw-bold">{{ config('variables.templateName') }}</span>
          
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Forgot Password? 🔒</h4>
          <p class="mb-4">Enter your email and We will send you a link to reset password</p>
                 
          @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif
          <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Your username" autofocus name="email" value="{{ old('email') }}" required>
              @error('email')
              <span class="invalid-feedback" style="display: block;" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            </div>
          
           
            <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
          </form>
          <div class="text-center">
            <a href="{{url('/login')}}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection

