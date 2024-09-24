<div class="table-responsive">
    <table class="table table-bordered text-nowrap border-bottom" id="tableProduct">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Sales</th>
                <th>Unit Price</th>
                <th>Stock</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>


@push('script')


<script>
    CORE.dataTableServer("tableProduct", "/app/products/get");
</script>


@endpush