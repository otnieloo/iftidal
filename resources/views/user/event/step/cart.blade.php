<div class="card">
  <div class="card-header">
    <h3 class="card-title">Product Cart</h3>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table text-nowrap text-md-nowrap mb-0">
        <thead>
          <tr style="background: #FFE8A3;">
            <th class="text-center"><input type="checkbox"></th>
            <th>Product</th>
            <th class="text-center">Variation</th>
            <th class="text-center">Unit Price</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Total Price</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">
              <input type="checkbox">
            </td>
            <td>
              <div class="d-flex flex-wrap gap-3 align-items-center">
                <img src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                  class="avatar avatar-xxl br-7" alt="person-image">
                <div>Product Name</div>
              </div>
            </td>
            <td class="text-center">Variaton A</td>
            <td class="text-center">
              <div>
                <span class="fw-bold">RM</span>
                54.55
              </div>
            </td>
            <td class="text-center">
              <div class="d-flex align-items-center justify-content-center">
                <div class="qty-button">-</div>
                <input type="text" data-max="10" class="form-control qty-input">
                <div class="qty-button">+</div>
              </div>
            </td>
            <td class="text-center">
              <div>
                <span class="fw-bold">RM</span>
                54.55
              </div>
            </td>
            <td class="text-center">
              <i class="fa-solid fa-trash"></i>
            </td>
          </tr>


        </tbody>
      </table>


    </div>

    <div class="row py-5 voucher-container">
      <div class="col-12">
        <div class="d-flex gap-3 justify-content-end align-items-center">
          <div><i class="fa-solid fa-ticket fs-3"></i></div>
          <div>Voucher / Promo</div>
          <input type="text" class="form-control" placeholder="Enter Code" style="width: 15%;">
        </div>
      </div>


      <div class="col-12 border-top-dashed py-3 mt-3">
        <div class="d-flex gap-3 justify-content-end align-items-center">
          <div class="fs-6">Discount</div>
          <div>-RM 00</div>
        </div>
      </div>

      <div class="col-12 border-top-dashed py-3 mt-3">
        <div class="d-flex gap-3 justify-content-end align-items-center">
          <div class="fs-6">Total (0 product)</div>
          <div class="text-secondary fw-bold fs-6">-RM 00</div>
        </div>
      </div>


    </div>

    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-warning" style="color:black;">Checkout</button>
    </div>


  </div>


</div>