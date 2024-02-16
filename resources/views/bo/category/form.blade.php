@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Product Category" :with_back="true">
      <form action="{{ $route }}" method="POST">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif
        <x-bo.form-input
          name="name"
          label="Category Name"
          value="{{ $model->name ?? '' }}"
        />
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