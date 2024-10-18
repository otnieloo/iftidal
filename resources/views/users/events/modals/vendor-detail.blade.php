@push('script')

<style>
  .tabs-menu-body {
    border: none !important;
  }
</style>
@endpush


<div class="card">

  <div class="card-body">
    <div class="row product-cart">
      <div class="col-lg-12">
        <div class="border text-center">{{ __("Vendor Detail") }}</div>
      </div>

      <div class="col-lg-12 mt-4">
        <div class="row">
          <div class="col-lg-6 col-md-12 d-flex" style="gap:1rem;">
            <div style="width: 120px;height:120px;background:blue;"></div>
            <div>
              <h2 class="fw-bolder">{{ $vendor->vendor_name }}</h2>
              <h5 class="text-muted">{{ $vendor->category->parent_category }}</h5>
              <h5 class="text-muted">{{ $vendor->category->vendor_category }}</h5>
            </div>
          </div>

          <div class="col-lg-6 col-md-12 mt-5">

            <div class="row">
              <div class="col-6 d-flex">
                <div class="text-muted">Listing</div>
                <div class="listing-text">: 25</div>
              </div>

              <div class="col-6 d-flex">
                <div class="text-muted">Followers</div>
                <div class="listing-text">: 15.5k</div>
              </div>
            </div>

            <div class="row">
              <div class="col-6 d-flex">
                <div class="text-muted">Listing</div>
                <div class="listing-text">: 25</div>
              </div>

              <div class="col-6 d-flex">
                <div class="text-muted">Followers</div>
                <div class="listing-text">: 15.5k</div>
              </div>
            </div>

            <div class="row">
              <div class="col-6 d-flex">
                <div class="text-muted">Listing</div>
                <div class="listing-text">: 25</div>
              </div>

              <div class="col-6 d-flex">
                <div class="text-muted">Followers</div>
                <div class="listing-text">: 15.5k</div>
              </div>
            </div>

          </div>


          <div class="col-12 mt-4">
            <button class="btn btn-warning">Follow</button>
            <button class="btn btn-primary">Chat</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="card">

  <div class="card-body">
    <input type="hidden" id="listDataProduct" value="{{ json_encode($product_details) }}">
    <div class="panel panel-primary">
      <div class="tab-menu-heading">
        <div class="tabs-menu ">
          <!-- Tabs -->
          <ul class="nav panel-tabs">
            <li class=""><a href="#tab011" class="active" data-bs-toggle="tab">Product</a></li>
            <li><a href="#tab21" data-bs-toggle="tab">Service</a></li>
            <li><a href="#tab31" data-bs-toggle="tab">Gallery</a></li>
            <li><a href="#tab41" data-bs-toggle="tab">Review</a></li>
          </ul>
        </div>
      </div>
      <div class="panel-body tabs-menu-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tab011">

            <div class="row product-container">

              @foreach ($products as $item)
                <div class="col-lg-3 product-cart">
                  <div>
                    <div class="card custom-card overflow-hidden">
                      <div>
                        {{-- <a href="javascript:void(0)"><img src="{{asset('build/assets/images/photos/28.jpg')}}" alt="img" class="cover-image br-7 w-100"></a> --}}
                        <a href="javascript:void(0)"><img id="previewImageProduct{{ $item->id }}" src="{{ $item->product_image }}" style="height: 115px; width: 100%; object-fit: cover" alt="img" class="cover-image br-7 w-100"></a>
                      </div>
                    </div>
                    <div class="card">
                      <div>
                        <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                          @foreach ($item->product_images as $image)

                            <div class="item">
                              <div class="card custom-card overflow-hidden mb-0 ">
                                <a href="#">
                                  <img onclick="Order.changeImageProduct('{{ $image->product_image }}', 'previewImageProduct{{ $item->id }}')" src="{{ $image->product_image }}" style="width: 54ps; height: 54px;" class="w-100" alt="img">
                                </a>
                              </div>
                            </div>

                          @endforeach

                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="text-center">
                    <h6 class="fw-bold">{{ $item->product_name }}</h6>
                    <div>{{ $item->product_description }}</div>
                  </div>

                  <div class="d-flex mt-3 justify-content-between">
                    <div>
                      <div class="fw-bold">RM {{ $item->product_sell_price }}</div>
                      <div style="width: 100px;">per unit</div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end">
                      <div class="qty-button">-</div>
                      <input type="number" id="inputQty{{ $item->id }}" data-id="{{ $item->id }}" data-max="{{ $item->product_stock }}" max="{{ $item->product_stock }}" class="form-control qty-input">
                      <div class="qty-button">+</div>
                    </div>
                  </div>

                  <div class="d-flex mt-3 justify-content-between">
                    <div class="fw-bold">Total</div>
                    <div>RM <span id="totalPriceProduct{{ $item->id }}">0</span></div>
                  </div>

                  <div class="d-flex" style="gap:.5rem;">
                    <button class="btn btn-gray" onclick="Livewire.emit('show_product', '{{ $item->id }}')" style="width: 100%;">Detail</button>
                    <button class="btn btn-info" onclick="Order.addToCart('{{ $item->id }}')" style="width: 100%;">Add to cart</button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          <div class="tab-pane" id="tab21">
            @foreach ($services as $item)
              <div class="col-lg-3 product-cart">
                <div>
                  <div class="card custom-card overflow-hidden">
                    <div>
                      {{-- <a href="javascript:void(0)"><img src="{{asset('build/assets/images/photos/28.jpg')}}" alt="img" class="cover-image br-7 w-100"></a> --}}
                      <a href="javascript:void(0)"><img id="previewImageProduct{{ $item->id }}" src="{{ $item->product_image }}" style="height: 115px; width: 100%; object-fit: cover" alt="img" class="cover-image br-7 w-100"></a>
                    </div>
                  </div>
                  <div class="card">
                    <div>
                      <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @foreach ($item->product_images as $image)

                          <div class="item">
                            <div class="card custom-card overflow-hidden mb-0 ">
                              <a href="#">
                                <img onclick="Order.changeImageProduct('{{ $image->product_image }}', 'previewImageProduct{{ $item->id }}')" src="{{ $image->product_image }}" style="width: 54ps; height: 54px;" class="w-100" alt="img">
                              </a>
                            </div>
                          </div>

                        @endforeach

                      </div>
                    </div>
                  </div>

                </div>

                <div class="text-center">
                  <h6 class="fw-bold">{{ $item->product_name }}</h6>
                  <div>{{ $item->product_description }}</div>
                </div>

                <div class="d-flex mt-3 justify-content-between">
                  <div>
                    <div class="fw-bold">RM {{ $item->product_sell_price }}</div>
                    <div style="width: 100px;">per unit</div>
                  </div>

                  <div class="d-flex align-items-center justify-content-end">
                    <div class="qty-button">-</div>
                    <input type="number" id="inputQty{{ $item->id }}" data-id="{{ $item->id }}" max="{{ $item->product_stock }}" class="form-control qty-input">
                    <div class="qty-button">+</div>
                  </div>
                </div>

                <div class="d-flex mt-3 justify-content-between">
                  <div class="fw-bold">Total</div>
                  <div>RM <span id="totalPriceProduct{{ $item->id }}">0</span></div>
                </div>

                <div class="d-flex" style="gap:.5rem;">
                  <button class="btn btn-gray" onclick="Livewire.emit('show_product', '{{ $item->id }}')" style="width: 100%;">Detail</button>
                  <button class="btn btn-info" onclick="Order.addToCart('{{ $item->id }}')" style="width: 100%;">Add to cart</button>
                </div>
              </div>
            @endforeach
          </div>
          <div class="tab-pane" id="tab31">
            <p>Temporibus autem quibusdam et aut officiis debitis aut rerum
              necessitatibus saepe eveniet ut et voluptates repudiandae
              sint
              et molestiae non recusandae</p>
            <p> Et harum quidem rerum facilis est et expedita distinctio.
              Nam
              libero tempore, cum soluta nobis est eligendi optio cumque
              nihil
              impedit quo minus id quod maxime placeat facere possimus,
              omnis
              voluptas assumenda est, omnis dolor repellendus. </p>
          </div>
          <div class="tab-pane" id="tab41">
            <p>On the other hand, we denounce with righteous indignation and
              dislike men who are so beguiled and demoralized by the
              charms of
              pleasure of the moment, so blinded by desire</p>
            <p>Nam libero tempore, cum soluta nobis est eligendi optio
              cumque
              nihil impedit quo minus id quod maxime placeat facere
              possimus,
              omnis voluptas assumenda est, omnis dolor repellendus.
              Temporibus autem quibusdam et aut officiis debitis aut rerum
              necessitatibus </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
