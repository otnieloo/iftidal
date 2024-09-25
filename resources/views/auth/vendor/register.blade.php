@extends('layouts.auth.register.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
  type="text/css" />

@endsection

@section('content')

<div class="page-content">
  <div class="container text-center text-dark">
    <!-- ROW -->
    <div class="row">
      <div class="col-lg-5 col-md-8 col-sm-12 mx-auto">
        <form action="{{ route('register.store.vendor') }}" method="POST" with-submit-crud>
          <div id="smartwizard">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="#step-1">
                  <div class="num">1</div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#step-2">
                  <span class="num">2</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#step-3">
                  <span class="num">3</span>
                </a>
              </li>

            </ul>

            <div class="tab-content">
              <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">

                <div class="card py-5">
                  <div class="card-body">
                    <div class="container">
                      <h1>AMBOI.MY</h1>
                      <h4 style="color:gray;">Create New Account</h4>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="typcn typcn-user-outline tx-24 lh--9 op-6"></i>
                          </div>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                      </div>

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
                          <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                        </div>
                      </div>


                      <div>
                        <label class="custom-control custom-checkbox ms-3 d-flex">
                          <input type="checkbox" class="custom-control-input" value="terms" name="terms">
                          <span class="custom-control-label ms-2">Agree the <a href="#">terms
                              and
                              policy</a></span>
                        </label>
                      </div>

                      <div class="d-flex">
                        <button type="button" class="btn btn-block btn-warning next">Register</button>
                      </div>


                      <div class="mt-5">
                        Already have an account? <a href="{{ route('login') }}">Sign in</a>
                      </div>


                    </div>
                  </div>
                </div>

              </div>
              <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                <div class="card py-5">
                  <div class="card-body">
                    <div class="container">
                      <h1>AMBOI.MY</h1>
                      <h4 style="color:gray;">Vendors Category</h4>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="typcn typcn-user-outline tx-24 lh--9 op-6"></i>
                          </div>
                          <input type="text" class="form-control" name="company_name" id="vendor_name"
                            placeholder="Vendor Name">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="typcn typcn-th-large-outline tx-24 lh--9 op-6"></i>
                          </div>
                          <input type="text" class="form-control" name="company_legal_number" id="company_legal_number"
                            placeholder="Vendor SSM Number">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="typcn typcn-minus-outline tx-24 lh--9 op-6"></i>
                          </div>
                          <select name="vendor_type_id" id="vendor_type_id" class="form-control form-select select2">
                            <option value="0">Select Type of Entities</option>
                            @foreach ($vendor_types as $vendor_type)
                            <option value="{{ $vendor_type->id }}">{{
                              $vendor_type->vendor_type }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>


                      <div class="d-flex align-items-center justify-content-between" style="gap:1rem;">
                        <button type="button" class="btn btn-secondary button-wizzard prev">Back</button>
                        <button type="button" class="btn btn-warning button-wizzard next">Next</button>
                      </div>

                    </div>
                  </div>
                </div>



              </div>
              <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                <div class="card py-5">
                  <div class="card-body">
                    <div class="container">
                      <h1>AMBOI.MY</h1>
                      <h4 style="color:gray;">Insert Vendor Information</h4>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="typcn typcn-minus-outline tx-24 lh--9 op-6"></i>
                          </div>
                          <select name="vendor_category_id" id="vendor_category_id"
                            class="form-control form-select select2">
                            <option value="0">Select Category</option>
                            @foreach ($vendor_categories as $vendor_category)
                            <option value="{{ $vendor_category->id }}">{{
                              $vendor_category->vendor_category }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="typcn typcn-minus-outline tx-24 lh--9 op-6"></i>
                          </div>
                          <select name="vendor_business_id" id="vendor_business_id"
                            class="form-control form-select select2">
                            @foreach ($vendor_bussinesses as $vendor_bussiness)
                            <option value="{{ $vendor_bussiness->id }}">{{
                              $vendor_bussiness->vendor_business }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="d-flex justify-content-center mb-3">
                        {!! htmlFormSnippet() !!}
                      </div>

                      <div class="d-flex align-items-center justify-content-between" style="gap:1rem;">
                        <button type="button" class="btn btn-secondary button-wizzard prev">Back</button>
                        <button type="submit" class="btn btn-warning button-wizzard next">Submit</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </form>



      </div>
    </div>
    <!-- END ROW -->
  </div>
</div>



@endsection
@section('scripts')

<!-- FORM-WIZARD JS -->
<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript">
</script>
<script src="{{ asset('assets/js/apps/register.js') }}"></script>
@endsection
