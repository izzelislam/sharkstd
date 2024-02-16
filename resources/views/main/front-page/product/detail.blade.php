@extends("main.layouts.app")

@section("content")
<main role="main">
  <div class="wrapper">

      @include("main.front-page.product.section.breadcrumb")

      <section>
          <div class="container">
              <div class="row">
                  <div class="col-md-7 col-lg-9">
                      <div class="product-info">

                          <!-- Item Img Slider -->
                          <div class="swiper-container rounded border">
                              <div class="swiper-wrapper">
                                @foreach ($product->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ Storage::url($image->image) }}" alt="{{ $image->image }}">
                                </div>
                                @endforeach
                              </div>
                              <!-- Add Pagination -->
                              <div class="swiper-pagination"></div>
                          </div>
                      </div>
                      <div class="product-description-text pr-lg-2 mt-3">
                          <h1 class="mt-4 mb-4">
                            {!! $product->name ?? "" !!}
                          </h1>
                          <div>
                            {!! $product->describtion ?? "" !!}
                          </div>
                      </div>
                      <hr />
                      <section class="my-5">
                          <div class="row mb-4 d-flex justify-content-between">
                              <div class="col-md-8">
                                  <h6 class="mb-2">Exclusive Products</h6>
                                  <p>Checkout our latest products digital assets.</p>
                              </div>
                              <div class="col-md-4">
                                  <a href="#" class="btn btn-link float-right">Explore all → </a>
                              </div>
                          </div>
                          <div class="row">
                            @forelse ( $products as $font )
                              <x-main.product-card :data="$font" :col="4"/>
                            @empty
                              <div class="text-center">
                                <b><i>Product Empty</i></b>
                              </div>
                            @endforelse
                          </div>
                      </section>
                  </div>

                  <!-- edn: Col 9 -->
                  @include("main.front-page.product.section.sidebar")
              </div>
          </div>
      </section>
  </div>
</main>
@endsection