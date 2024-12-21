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
                <div class="border text-center">IMAGE</div>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 d-flex" style="gap:1rem;">
                        <div style="width: 120px;height:120px;background:blue;"></div>
                        <div>
                            <h2 class="fw-bolder vendor-modal-company-name">
                                Vendor Name
                            </h2>
                            <h5 class="text-muted" id="vendor-modal-category">Vendor Category</h5>
                            <h5 class="text-muted" id="vendor-modal-subcategory">Vendor Sub Category</h5>
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

                        <div class="row product-container" id="product-container">





                        </div>

                    </div>
                    <div class="tab-pane" id="tab21">
                        <p> Et harum quidem rerum facilis est et expedita distinctio.
                            Nam
                            libero tempore, cum soluta nobis est eligendi optio cumque
                            nihil
                            impedit quo minus id quod maxime placeat facere possimus,
                            omnis
                            voluptas assumenda est, omnis dolor repellendus. </p>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus
                            qui
                            blanditiis praesentium voluptatum deleniti atque corrupti
                            quos
                            dolores et quas molestias excepturi sint occaecati
                            cupiditate
                            non provident, similique sunt in culpa qui officia deserunt
                            mollitia animi, id est laborum et dolorum fuga.</p>
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




@push('script')

<!-- INTERNAL OWL CAROUSEL JS -->
<script src="{{asset('build/assets/plugins/owl-carousel/owl.carousel.js')}}"></script>
@vite('resources/assets/js/carousel.js')


<!-- GALLERY JS -->
<script src="{{asset('build/assets/plugins/gallery/picturefill.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lightgallery.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lightgallery-1.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-pager.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-autoplay.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-fullscreen.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-zoom.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-hash.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-share.js')}}"></script>

@endpush