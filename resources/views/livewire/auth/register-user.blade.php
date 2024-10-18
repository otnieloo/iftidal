<div>

  <div class="page-content">
    <div class="container">

      <div class="row">
        <div class="col-md-5 mx-auto">

          <form action="{{ route('register.user.store') }}" method="POST" with-submit-crud>
            @csrf

            <div class="card py-5">
              <div class="card-body">
                <div class="container text-center">
                  <h1>AMBOI.MY</h1>
                  <h3>Register</h3>
                  <p class="text-muted">Sign Up to your account</p>

                  @if (!$register_manual)

                    <a href="{{ route('login.google') }}" class="btn btn-block btn-light">
                      <div class="btn-login-sosmed">
                        <svg class="google-svg" xmlns="http://www.w3.org/2000/svg" width="2443" height="2500"
                          preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                          <path fill="#4285F4"
                            d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027">
                          </path>
                          <path fill="#34A853"
                            d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1">
                          </path>
                          <path fill="#FBBC05"
                            d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782">
                          </path>
                          <path fill="#EB4335"
                            d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251">
                          </path>
                        </svg>
                        <p class="mb-0 mr-auto">
                          Continue with google
                        </p>
                      </div>
                    </a>

                    <button wire:click="set_manual" type="button" class="btn btn-block btn-light">
                      <div class="btn-login-sosmed">
                        <i class="fa-solid fa-envelope fa-lg" style="margin-top: 5px;"></i>
                        <p class="mb-0 mr-auto">
                          Continue with email
                        </p>
                      </div>
                    </button>

                    <h5 class="text-center my-4">OR</h5>

                    <div class="row">
                      <div class="col-md-6">
                        <a href="{{ route('login.google') }}" class="btn btn-block btn-light">
                          <div class="btn-login-sosmed">
                            <svg class="google-svg" xmlns="http://www.w3.org/2000/svg" width="2443" height="2500" preserveAspectRatio="xMidYMid"
                              viewBox="0 0 256 262">
                              <path fill="#4285F4"
                                d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027">
                              </path>
                              <path fill="#34A853"
                                d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1">
                              </path>
                              <path fill="#FBBC05"
                                d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782">
                              </path>
                              <path fill="#EB4335"
                                d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251">
                              </path>
                            </svg>
                            <p class="mb-0 mr-auto">
                              Apple
                            </p>
                          </div>
                        </a>
                      </div>
                      <div class="col-md-6">
                        <a href="{{ route('login.google') }}" class="btn btn-block btn-light">
                          <div class="btn-login-sosmed">
                            <svg class="google-svg" xmlns="http://www.w3.org/2000/svg" width="2443" height="2500" preserveAspectRatio="xMidYMid"
                              viewBox="0 0 256 262">
                              <path fill="#4285F4"
                                d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027">
                              </path>
                              <path fill="#34A853"
                                d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1">
                              </path>
                              <path fill="#FBBC05"
                                d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782">
                              </path>
                              <path fill="#EB4335"
                                d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251">
                              </path>
                            </svg>
                            <p class="mb-0 mr-auto">
                              Facebook
                            </p>
                          </div>
                        </a>
                      </div>
                    </div>

                  @endif

                  @if ($register_manual)
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-text">
                          <i class="typcn typcn-user tx-24 lh--9 op-6"></i>
                        </div>
                        <input type="text" class="form-control" name="name" wire:model.lazy="name" placeholder="Name">
                      </div>
                      @error('name')
                        <small class="text-danger text-start d-block mr-auto">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-text">
                          <i class="typcn typcn-mail tx-24 lh--9 op-6"></i>
                        </div>
                        <input type="email" class="form-control" name="email" wire:model.lazy="email" id="email" placeholder="Email">
                      </div>
                      @error('email')
                        <small class="text-danger text-start d-block mr-auto">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-text">
                          <i class="typcn typcn-lock-closed-outline tx-24 lh--9 op-6"></i>
                        </div>
                        <input type="password" class="form-control" name="password" wire:model.lazy="password" id="password" placeholder="Password">
                      </div>
                      @error('password')
                        <small class="text-danger text-start d-block mr-auto">{{ $message }}</small>
                      @enderror
                    </div>

                    <button class="btn btn-block btn-warning next" {{ $errors->any() ? 'disabled' : '' }}>Register</button>
                  @endif

                </div>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>

</div>
