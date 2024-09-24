<div>

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label">{{ __('Category') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <select name="product_category_id" id="product_category_id" wire:model="product_category_id" class="form-control">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->category }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_subcategory_id">{{ __('Sub Category') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <select name="product_subcategory_id" wire:model="product_subcategory_id" id="product_subcategory_id" class="form-control">
            @foreach ($subcategories as $sub_category)
              <option value="{{ $sub_category->id }}">{{ $sub_category->category }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>

</div>
