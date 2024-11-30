<div class="table-responsive">
  <table class="table table-bordered text-nowrap border-bottom" id="tableService">
    <thead>
      <tr>
        <th>
          <div class="form-check form-check-sm">
            <input class="form-check-input" type="checkbox" id="checkAll" />
          </div>
        </th>
        <th>Service (s)</th>
        <th data-orderable="false"></th>
        <th>Sales</th>
        <th>Session Price</th>
        <th>Slot</th>
        <th>Level</th>
        <th data-orderable="false">Status</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

</div>


@push('script')
<script>
  CORE.dataTableServer("tableService", "/app/services/get");
</script>
@endpush
