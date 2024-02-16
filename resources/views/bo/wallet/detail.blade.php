@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Detail Wallet" :with_back="true">
      <div class="mb-3">
        <b>Name</b> : {{ $model->admin->name ?? "" }}
      </div>
      <div class="mb-3">
        <b>Email</b> : {{ $model->admin->email ?? "" }}
      </div>
      <div class="mb-3">
        <b>Amount</b> : {{ $model->amount ?? "" }} USD
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