@if ($product ?? null)
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-3 col-md-12 px-5">
        <div>
          <div class="card custom-card overflow-hidden">
            <div>
              <a href="javascript:void(0)"><img src="{{ $product->product_image }}"
                  style="height: 115px; width: 100%; object-fit: cover" alt="img" class="cover-image br-7 w-100"></a>
            </div>
          </div>
          <div class="card">
            <div>
              <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">

                @foreach ($product->product_images as $image)

                <div class="item">
                  <div class="card custom-card overflow-hidden mb-0 ">
                    <a href="#">
                      <img src="{{ $image->product_image }}" style="width: 54ps; height: 54px;" class="w-100" alt="img">
                    </a>
                  </div>
                </div>

                @endforeach

              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-lg-9 col-md-12">
        <h3 class="fw-bold">{{ $product->product_name }}</h3>
        <div class="product-gallery-rats d-flex">
          <ul class="product-gallery-rating ">
            <li>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
            </li>
          </ul>
          <div class="label-rating ms-2 d-flex gap-2">
            <div class="text-secondary">79</div>
            <div>|</div>
            <div>
              <span class="fw-bold">45</span>
              <span class="text-muted">Ratings</span>
            </div>
          </div>
        </div>

        <div>
          <h3 class="text-secondary fw-bold mt-3">RM {{ number_format($product->product_capital_price) }}</h3>
        </div>

        {{-- <div class="form-group mt-4">
          <div class="row">
            <div class="col-lg-2 col-md-12">
              <label class="form-label" for="event_type_id">{{ __('Variation')}}</label>
            </div>
            <div class="col-lg-3 col-md-12">
              <select name="event_type_id" id="event_type_id" class="form-control form-select default-select">
                <option value="0">Select Type Of Event</option>
                <option value="blue">Red</option>
                <option value="red">Blue</option>
              </select>
            </div>
          </div>
        </div> --}}

        <div class="form-group mt-4">
          <div class="row">
            <div class="col-lg-2 col-md-12">
              <label class="form-label" for="event_type_id">{{ __('Quantity')}}</label>
            </div>
            <div class="col-lg-3 col-md-12">
              <div class="d-flex align-items-center justify-content-start">
                <div class="qty-button">-</div>
                <input type="number" class="form-control qty-input">
                <div class="qty-button">+</div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex" style="gap:.5rem;">
          <button class="btn btn-gray">Later</button>
          <button class="btn btn-info">Add to cart</button>
        </div>
      </div>


    </div>
  </div>
</div>

<div class="card">
  <div class="card-body px-5">
    <div class="row">
      <div class="col-12">
        <h4 class="fw-bold">Product Description</h4>

        <p>{{ $product->product_description }}</p>

      </div>
    </div>
  </div>
</div>
@endif

@if ($vendor ?? null)

<div class="card">
  <div class="card-body px-5">
    <div class="row">
      <div class="col-12">
        <div class="row align-items-center">
          <div class="col-lg-5 col-md-12 d-flex" style="gap:1rem;">
            <img src="{{ $vendor->logo }}" onerror="CORE.onerrorProfileVendor(this)"
              style="width: 60px;height:60px;object-fit:cover" alt="">
            {{-- <div style="width: 60px;height:60px;background:skyblue;border-radius:7px;"></div> --}}
            <div>
              <h3 class="fw-bold" style="margin-bottom: 0;">{{ $vendor->company_name }}</h3>
              <div class="text-muted">{{ $vendor->category->parent_category }} : {{ $vendor->category->vendor_category
                }}</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-12">
            <div class="d-flex" style="gap:.5rem;">
              <button class="btn btn-warning">Follow</button>
              <button class="btn btn-info">Chat</button>
            </div>
          </div>

          <div class="col-lg-4 col-md-12 d-flex justify-content-between">
            <div class="text-center">
              <i class="ri-shopping-bag-line"></i>
              <div class="text-muted">Listing</div>
              <div class="text-secondary">25</div>
            </div>

            <div class="text-center">
              <i class="ri-shopping-bag-line"></i>
              <div class="text-muted">Listing</div>
              <div class="text-secondary">25</div>
            </div>

            <div class="text-center">
              <i class="ri-shopping-bag-line"></i>
              <div class="text-muted">Listing</div>
              <div class="text-secondary">25</div>
            </div>

            <div class="text-center">
              <i class="ri-shopping-bag-line"></i>
              <div class="text-muted">Listing</div>
              <div class="text-secondary">25</div>
            </div>
          </div>

        </div>


      </div>
    </div>
  </div>
</div>

@endif

<div class="card">
  <div class="card-body px-5">
    <h4 class="fw-bold">Rating & Reviews</h4>

    <div class="row container-review">
      <div class="col-lg-2 col-md-12 mb-4">
        <div class="d-flex align-items-center gap-1">
          <h3 class="text-secondary">4.9</h3>
          <h5 class="text-muted">/ 5</h5>
        </div>

        <h6 class="d-inline fw-bold">45</h6>
        <h6 class="d-inline text-muted">Ratings</h6>

        <div class="text-warning fs-14">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa-solid fa-star-half-stroke"></i>
          <i class="fa-regular fa-star"></i>
        </div>
      </div>


      <div class="col-lg-4 col-md-12">
        <div class="d-flex flex-wrap align-items-center gap-2">
          <div class="text-warning fs-14">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <i class="fa-regular fa-star"></i>
          </div>

          <div class="progress progress-md progress-container">
            <div class="progress-bar bg-primary w-20 progress-sub-container"></div>
          </div>

          <div class="text-muted">29</div>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
          <div class="text-warning fs-14">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <i class="fa-regular fa-star"></i>
          </div>

          <div class="progress progress-md progress-container">
            <div class="progress-bar bg-primary w-20 progress-sub-container"></div>
          </div>

          <div class="text-muted">29</div>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
          <div class="text-warning fs-14">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <i class="fa-regular fa-star"></i>
          </div>

          <div class="progress progress-md progress-container">
            <div class="progress-bar bg-primary w-20 progress-sub-container"></div>
          </div>

          <div class="text-muted">29</div>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
          <div class="text-warning fs-14">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <i class="fa-regular fa-star"></i>
          </div>

          <div class="progress progress-md progress-container">
            <div class="progress-bar bg-primary w-20 progress-sub-container"></div>
          </div>

          <div class="text-muted">29</div>
        </div>

      </div>

    </div>


    <div class="row container-review py-5 px-5 ">
      <div class="col-11">
        <div class="row">

          <div class="col-lg-1 col-md-12 mb-4">
            <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
              class="avatar avatar-md rounded-circle me-3" alt="person-image">

          </div>
          <div class="col-lg-9 col-md-12 ">
            <h4 class="text-muted">User 1</h4>
            <div class="text-warning fs-14">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
              <i class="fa-regular fa-star"></i>
            </div>

            <div class="text-muted">
              February 31 2025 | 12:00 | Variaton : Type 1
            </div>

            <div class="fs-6 text-muted">"Product name 1 is good smooth and comfortable. Perfect for daily
              use
              Perfect for
              daily use Perfect for daily use"</div>

            <div class="d-flex gap-2 mt-4">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
            </div>

          </div>

        </div>
      </div>



      <div class="col-1 d-flex justify-content-end">
        <i class="fa-regular fa-thumbs-up fs-2"></i>
      </div>

    </div>


    <div class="row container-review py-5 px-5 ">
      <div class="col-11">
        <div class="row">

          <div class="col-lg-1 col-md-12 mb-4">
            <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
              class="avatar avatar-md rounded-circle me-3" alt="person-image">

          </div>
          <div class="col-lg-9 col-md-12 ">
            <h4 class="text-muted">User 1</h4>
            <div class="text-warning fs-14">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
              <i class="fa-regular fa-star"></i>
            </div>

            <div class="text-muted">
              February 31 2025 | 12:00 | Variaton : Type 1
            </div>

            <div class="fs-6 text-muted">"Product name 1 is good smooth and comfortable. Perfect for daily
              use
              Perfect for
              daily use Perfect for daily use"</div>

            <div class="d-flex gap-2 mt-4">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
            </div>

          </div>

        </div>
      </div>



      <div class="col-1 d-flex justify-content-end">
        <i class="fa-regular fa-thumbs-up fs-2"></i>
      </div>

    </div>

    <div class="row container-review py-5 px-5 ">
      <div class="col-11">
        <div class="row">

          <div class="col-lg-1 col-md-12 mb-4">
            <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
              class="avatar avatar-md rounded-circle me-3" alt="person-image">

          </div>
          <div class="col-lg-9 col-md-12 ">
            <h4 class="text-muted">User 1</h4>
            <div class="text-warning fs-14">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
              <i class="fa-regular fa-star"></i>
            </div>

            <div class="text-muted">
              February 31 2025 | 12:00 | Variaton : Type 1
            </div>

            <div class="fs-6 text-muted">"Product name 1 is good smooth and comfortable. Perfect for daily
              use
              Perfect for
              daily use Perfect for daily use"</div>

            <div class="d-flex gap-2 mt-4">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
              <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                class="avatar avatar-xl br-7" alt="person-image">
            </div>

          </div>

        </div>
      </div>



      <div class="col-1 d-flex justify-content-end">
        <i class="fa-regular fa-thumbs-up fs-2"></i>
      </div>

    </div>


    <div>
      <div class="row px-5 py-4">
        <div class="col-lg-2 col-md-12">
          <div class="d-flex align-items-center gap-2">
            <span class="text-muted">Show</span>
            <input type="number" class="form-control">
            <span class="text-muted">entries</span>

          </div>
        </div>
        <div class="col-lg-10 col-md-12">
          <div class="d-flex align-items-center justify-content-end gap-2">
            <span class="text-muted">Show 4 to 4 of 4 entries</span>
            <button class="btn btn-gray btn-sm">Previous</button>
            <button class="btn btn-gray btn-sm">Next</button>

          </div>
        </div>
      </div>

    </div>

  </div>
</div>