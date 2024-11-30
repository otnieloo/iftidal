<div>
  <!-- ROW -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between ">
          <div>
            <ul class="nav nav-pills nav-pills-circle" id="tabs_2" role="tablist">

              <li class="nav-item">
                <a class="nav-link p-2 border m-2 {{ $is_product ? 'active show' : '' }}" id="tab1" data-bs-toggle="tab"
                  href="#tabs_2_3" role="tab" aria-selected="{{ $is_product ? true : false }}"
                  wire:click="change_tab(true)">
                  <span class="nav-link-icon d-block">Product</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link border p-2 m-2 {{ !$is_product ? 'active show' : '' }}" id="tab2"
                  data-bs-toggle="tab" href="#tabs_2_1" role="tab" aria-selected="{{ !$is_product ? true : false }}"
                  wire:click="change_tab(false)">
                  <span class="nav-link-icon d-block">Service</span>
                </a>
              </li>
            </ul>
          </div>


          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">{{__('Add
            Product') }}</button>

        </div>


        <div class="card-body">
          @if($is_product)
            @livewire('apps.vendors.products.index-product')
          @else
            @livewire('apps.vendors.products.index-service')
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- END ROW -->
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label>Type</label>
          <select name="type" id="type" class="form-control">
            <option value="products">Produk</option>
            <option value="services">Service</option>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="changepagebutton" class="btn btn-primary">Choose</button>
      </div>
    </div>
  </div>
</div>


@push('script')

<!-- SELECT2 JS -->
<script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>
@vite('resources/assets/js/select2.js')

<!-- DATA TABLE JS -->
<script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
@vite('resources/assets/js/table-data.js')


<script>
  const changeButton = document.getElementById('changepagebutton');

    const type = document.getElementById('type')


    changeButton.addEventListener('click', function(){
        const link = `${CORE.baseUrl}/vendor/${type.value}/create`
        window.location.href = link;
    })


    window.addEventListener('refresh-datatable', event => {
        const isProduct = event.detail.is_product;
        if(isProduct){
            CORE.dataTableServer("tableProduct", "/vendor/products/get");
        }else {
            CORE.dataTableServer("tableService", "/vendor/services/get");
        }
    })

</script>


@endpush
