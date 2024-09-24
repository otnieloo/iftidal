<div class="table-responsive">
    <table class="table table-bordered text-nowrap border-bottom" id="tableService">
        <thead>
            <tr>
                <th>No</th>
                <th>Service (s)</th>
                <th>Sales</th>
                <th>Session Price</th>
                <th>Slot</th>
                <th>Level</th>
                <th>Status</th>
                <th>Action</th>
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