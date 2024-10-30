<div>
    <!-- ROW -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between ">
                    <div>
                        <ul class="nav nav-pills nav-pills-circle" id="tabs_2" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link p-2 border m-2 {{ $all_order ? 'active show' : '' }}" id="tab1"
                                    data-bs-toggle="tab" href="#tabs_2_3" role="tab"
                                    aria-selected="{{ $all_order ? true : false }}" wire:click="change_tab(true)">
                                    <span class="nav-link-icon d-block">All Order</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border p-2 m-2 {{ !$all_order ? 'active show' : '' }}" id="tab2"
                                    data-bs-toggle="tab" href="#tabs_2_1" role="tab"
                                    aria-selected="{{ !$all_order ? true : false }}" wire:click="change_tab(false)">
                                    <span class="nav-link-icon d-block">New Order</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    @livewire('apps.users.orders.order')
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->
</div>



@push('script')
<script src="{{ asset('assets/js/apps/order.js') }}"></script>
@endpush