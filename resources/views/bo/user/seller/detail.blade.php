@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Detail Seller" :with_back="true">
      <div class="mb-3">
        <b>Name</b> : {{ $model->name ?? "" }}
      </div>
      <div class="mb-3">
        <b>Email</b> : {{ $model->email ?? "" }}
      </div>
      <div class="mb-3">
        <b>Status</b> : 
        @if ($model->status == 1)
          <span class="badge badge-pill bg-success">Active</span>
        @endif
        @if ($model->status == 0)
          <span class="badge badge-pill bg-danger">Non-Active</span>
        @endif
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