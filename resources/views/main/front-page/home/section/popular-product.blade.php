<div class="container">
  <div class="row mb-4 mt-5 d-flex justify-content-between align-items-center">
      <div class="col-md-8">
          <h5 class="mb-0">Picked Items</h5>
      </div>
  </div>

  <div class="row">
    @forelse ( $picked_products as $picked )
      <x-main.product-card :data="$picked"/>
    @empty
      <div class="text-center">
        <b><i>Product Empty</i></b>
      </div>
    @endforelse
  </div>

  <hr class="divider divider-fade">
  <div class="row mb-4 mt-3 d-flex justify-content-between align-items-center">
      <div class="col-md-8">
          <h5 class="mb-0">Popular Fonts</h5>
      </div>
      <div class="col-md-4"> <a href="#" class="btn btn-link float-right">Explore all <i class="las la-long-arrow-alt-right"></i> </a> </div>
  </div>
  <div class="row">
    
    @forelse ( $product_fonts as $font )
      <x-main.product-card :data="$font"/>
    @empty
      <div class="text-center">
        <b><i>Product Empty</i></b>
      </div>
    @endforelse
  </div>

  {{-- <hr class="divider divider-fade">
  <div class="row mb-4 mt-3 d-flex justify-content-between align-items-center">
      <div class="col-md-8">
          <h5 class="mb-0">Slide Template</h5>
      </div>
      <div class="col-md-4"> <a href="#" class="btn btn-link float-right">Explore all <i class="las la-long-arrow-alt-right"></i> </a> </div>
  </div>
  <div class="row">
    @for ($i=1; $i <= 4; $i++)
      <x-main.product-card/>
    @endfor
  </div> --}}
</div>