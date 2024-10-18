<div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Product Cart</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table text-nowrap text-md-nowrap mb-0">
          <thead>
            <tr style="background: #FFE8A3;">
              <th class="text-center"><input type="checkbox" onclick="Livewire.emit('checked_all', this.checked ? true : false)"></th>
              <th>Product</th>
              {{-- <th class="text-center">Variation</th> --}}
              <th class="text-center">Unit Price</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Total Price</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order_products as $item)
              <tr>
                <td class="text-center">
                  <input type="checkbox" wire:model="product_ids" value="{{ $item['id'] }}" {{ in_array($item["id"], $product_ids) ? 'checked' : '' }}>
                </td>
                <td>
                  <div class="d-flex flex-wrap gap-3 align-items-center">
                    <img src="{{ $item['product']['product_image'] }}" class="avatar avatar-xxl br-7" alt="person-image">
                    <div>{{ $item['product_name'] }}</div>
                  </div>
                </td>
                {{-- <td class="text-center">Variaton A</td> --}}
                <td class="text-center">
                  <div>
                    <span class="fw-bold">RM</span>
                    {{ number_format($item['product_sell_price']) }}
                  </div>
                </td>
                <td class="text-center">
                  <div class="d-flex align-items-center justify-content-center">
                    <input type="text" class="form-control" wire:model.debounce.500ms="order_products.{{ $loop->index }}.qty">
                  </div>
                </td>
                <td class="text-center">
                  <div>
                    <span class="fw-bold">RM</span>
                    {{ number_format($item['total_sell_price']) }}
                  </div>
                </td>
                <td class="text-center">
                  <i class="fa-solid fa-trash"></i>
                </td>
              </tr>
            @endforeach
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
            <div>-RM {{ number_format(collect($order_products)->sum('product_discount_price')) }}</div>
          </div>
        </div>

        <div class="col-12 border-top-dashed py-3 mt-3">
          <div class="d-flex gap-3 justify-content-end align-items-center">
            <div class="fs-6">Total ({{ count($order_products) }} product)</div>
            <div class="text-secondary fw-bold fs-6">-RM {{ number_format(collect($order_products)->sum('grand_total')) }}</div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-warning" onclick="Livewire.emit('save_order')" style="color:black;">Checkout</button>
      </div>
    </div>
  </div>

</div>
