@extends('layouts.auth.register.app')

@section('styles')

<style>
  .btn-login-sosmed {
    display: flex;
  }

  .btn-login-sosmed p {
    margin: 0 auto;
  }

  .google-svg {
    width: 1rem;
    height: 1rem;
    margin-top: 5px;
  }
</style>

@endsection

@section('content')

  @livewire('auth.register-user')

@endsection
