<div class="table-responsive">
  <table class="table table-bordered text-nowrap border-bottom" id="tableProduct">
    <thead>
      <tr>
        <th>
          <div class="form-check form-check-sm">
            <input class="form-check-input" type="checkbox" id="checkAll" />
          </div>
        </th>
        <th>Product (s)</th>
        <th data-orderable="false"></th>
        <th>Sales</th>
        <th>Unit Price</th>
        <th>Stock</th>
        <th>Variation</th>
        <th data-orderable="false">Status</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

</div>


@push('script')
<script>
  CORE.dataTableServer("tableProduct", "/vendor/products/get");
</script>
@endpush
