@extends('layouts.auth.register.app')

@section('content')

<div class="page-content">
  <div class="container">

    <div class="row">
      <div class="col-md-5 mx-auto">

        <form action="" method="POST" with-submit-crud>
          @csrf

          <div class="card py-5">
            <div class="card-body">
              <div class="container text-center">
                <h1>AMBOI.MY</h1>
                <h3>Login</h3>
                <p class="text-muted">Sign In to your account</p>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-text">
                      <i class="typcn typcn-mail tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-text">
                      <i class="typcn typcn-lock-closed-outline tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  </div>
                </div>

                <div class="d-flex">
                  <button class="btn btn-block btn-warning next">Login</button>
                </div>


                <div class="mt-5">
                  Don't have an account? <a href="{{ route('register.vendor.index') }}">Register as Vendor</a> or <a href="{{ route('register.user.index') }}">Register as User</a>
                </div>

              </div>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

{{-- <div class="row h-100">
  <div class="col-lg-5 col-12">
    <div id="auth-left">
      <div class="auth-logo">
        <a href="#"><img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo"></a>
      </div>
      <h1 class="auth-title">Log in.</h1>
      <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

      <form action="{{ route('login.store') }}" method="POST" with-submit-crud>
        @csrf

        <div class="form-group position-relative has-icon-left mb-4">
          <input type="text" name="email" class="form-control form-control-xl" placeholder="Email/Username">
          <div></div>
          <div class="form-control-icon">
            <i class="bi bi-person"></i>
          </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
          <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
          <div></div>
          <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
        </div>
        <div class="form-check form-check-lg d-flex align-items-end">
          <input class="form-check-input me-2" type="checkbox" name="remember_me" value="1" id="flexCheckDefault">
          <label class="form-check-label text-gray-600" for="flexCheckDefault">
            Keep me logged in
          </label>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
      </form>
    </div>
  </div>
  <div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">
    </div>
  </div>
</div> --}}

@endsection