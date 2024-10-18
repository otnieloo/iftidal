@extends('layouts.auth.register.app')

@section('styles')

@endsection

@section('content')

<div class="page-content">
  <div class="container text-center text-dark">
    <div class="row">
      <div class="col-lg-4 d-block mx-auto">
        <div class="row">
          <div class="col-xl-12 col-md-12 col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="text-center mb-2">
                  <a class="header-brand1" href="{{url('index')}}">
                    <img src="{{asset('build/assets/images/brand/logo.png')}}" class="header-brand-img main-logo" alt="Sparic logo">
                    <img src="{{asset('build/assets/images/brand/logo-light.png')}}" class="header-brand-img darklogo" alt="Sparic logo">
                  </a>
                </div>
                <h3>Login</h3>
                <p class="text-muted">Sign In to your account</p>
                <div class="input-group mb-3">
                  <span class="input-group-addon bg-white"><i class="fa fa-user text-dark"></i></span>
                  <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="input-group mb-4">
                  <span class="input-group-addon bg-white"><i class="fa fa-unlock-alt text-dark"></i></span>
                  <input type="password" class="form-control" placeholder="Password">
                </div>
                <div class="row">
                  <div>
                    <a href="{{url('index')}}" class="btn btn-primary btn-block">Login</a>
                  </div>
                  <div class="col-12">
                    <a href="{{url('forgot-password')}}" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
                  </div>
                </div>
                <div class="mt-6 btn-list">
                  <button type="button" class="btn btn-icon btn-facebook"><i class="fa fa-facebook"></i></button>
                  <button type="button" class="btn btn-icon btn-google"><i class="fa fa-google"></i></button>
                  <button type="button" class="btn btn-icon btn-twitter"><i class="fa fa-twitter"></i></button>
                  <button type="button" class="btn btn-icon btn-dribbble"><i class="fa fa-dribbble"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

@endsection