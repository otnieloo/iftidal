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
              <div class="container">
                <h1 style="text-align: center">AMBOI.MY</h1>
                <h4 style="color:gray; text-align: center;">Your account must be verified! Please check your email!</h4>
              </div>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

@endsection
