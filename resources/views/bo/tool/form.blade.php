@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Tool Product" :with_back="true">
      <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif
        <x-bo.form-input
          name="name"
          label="Tool Name"
          value="{{ $model->name ?? '' }}"
        />
        <x-bo.form-input
          name="image_"
          label="Tool Logo"
          value="{{ $model->name ?? '' }}"
          type="file"
        >
          <span>Max size 1 mb, allowed extension jpg, jpeg, png</span>
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