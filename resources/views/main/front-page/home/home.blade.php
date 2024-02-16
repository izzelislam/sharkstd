@extends("main.layouts.app")

@section("content")
<div class="warpper">
    @include("main.front-page.home.section.hero")
    @include("main.front-page.home.section.popular-product")
    {{-- @include("main.front-page.home.section.featured") --}}
    @include("main.front-page.home.section.banner")
    @include("main.front-page.home.section.info")
</div>
@endsection