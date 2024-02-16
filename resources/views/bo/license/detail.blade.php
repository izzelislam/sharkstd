@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Detail License Product" :with_back="true">
      <div class="mb-3">
        <b>Name</b> : {{ $model->name ?? "" }}
      </div>
      <div class="mb-3">
        <b>Description</b> : {{ $model->describtion ?? "" }}
      </div>
      <div class="mb-3">
        <b>Price</b> : <b>$ {{ number_format($model->price) ?? "" }} USD</b>
      </div>
      <div class="mb-3">
        <b>CreatedAt</b> : {{ $model->created_at->format("d/m/Y H:i:s") ?? "" }}
      </div>
      <div class="mb-3">
        <b>UpdatedAt</b> : {{ $model->updated_at->format("d/m/Y H:i:s") ?? "" }}
      </div>
    </x-bo.card>
  </x-bo.wrapper>
@endsection