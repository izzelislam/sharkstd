@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Detail Blog" :with_back="true">
      <div class="mb-3">
        <b>Title</b> : {{ $model->title ?? "" }}
      </div>
      <div class="mb-3">
        <b>Category</b> : {{ $model->title ?? "" }}
      </div>
      <div class="mb-3">
        <b>Author</b> : {{ $model->title ?? "" }}
      </div>
      <div class="mb-3">
        <b>Image Cover</b> :
        <div class="">
          <img class="w-50 rounded-xl" src="{{ Storage::url($model->image_cover) }}" alt="">
        </div>
      </div>
      <div class="mb-3">
        <b>content</b> : {!! $model->content ?? "" !!}
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