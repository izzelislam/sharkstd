@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="License Product" :with_back="true">
      <form action="{{ $route }}" method="POST">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif
        <x-bo.form-input
          name="name"
          label="License Name"
          value="{{ $model->name ?? '' }}"
        />
        <x-bo.form-textarea
          name="describtion"
          label="Describtion"
          value="{{ $model->describtion ?? '' }}"
        />
        <x-bo.form-input
          name="price"
          label="Price"
          type="number"
          value="{{ $model->price ?? '' }}"
        >
          <span>Price in USD ($) Currency</span>
        </x-bo.form-input>
        <div>
          <x-bo.button
            color="success"
            title="Submit"
          />
        </div>
      </form>
    </x-bo.card>
  </x-bo.wrapper>
@endsection