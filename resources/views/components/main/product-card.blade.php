@props(["data" , "col" => 3])

<div class="col-md-{{ $col }}">
    <div class="card item-card h-100 border-0">
        <div class="item-card__image rounded">
            <a href="{{ route("fe.products.show", $data->slug) }}" class="swap-link">
                <img src="{{ Storage::url($data->images[0]->image) }}" class="img-fluid rounded" alt="">
            </a>
            <div class="hover-icons">
                <ul class="list-unstyled">
                    <li><a href="#"><i class="lar la-bookmark"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- end: Item card image -->
        <div class="card-body px-0 pt-3">
            <div class="d-flex justify-content-between align-items-start">
                <div class="item-title">
                    <a href="#">
                        <h3 class="h5 mb-0 text-truncate">{{ $data->name }}</h3>
                    </a>
                </div>
                @if ($data->is_free === 1)
                <div class="item-price">
                    <span class="text-success">Free</span>
                </div>
                @else
                <div class="item-price">
                    <span>${{ $data->price }}</span>
                </div>
                @if ($data->promo != null)
                    <div class="item-price">
                        <strike class="text-danger">${{ $data->price }}</strike>
                    </div>
                @endif
                @endif
            </div>
            <!-- end: Card info -->
            <div class="d-flex justify-content-start align-items-center item-meta">
                <div class="short-description mb-0">
                    <p class="mb-0 extension-text"><a href="#">{{ $data->productCategory->name }}</a></p>
                </div>
            </div>
            <!-- end: Card meta -->
        </div>
        <!-- edn:Card body -->
    </div>
    <!-- end: Card -->
</div>