@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Payout" :with_back="true">
      <div class="mb-3">
        <b>Name</b> : {{ $model->admin->name ?? "" }}
      </div>
      <div class="mb-3">
        <b>Email</b> : {{ $model->admin->email ?? "" }}
      </div>
      <div class="mb-3">
        <b>Payout Request Amount</b> : {{ $model->amount ?? "" }}
      </div>
      <div class="mb-3">
        <b>Account Type</b> : {{ $model->account_type ?? "" }}
      </div>
      <div class="mb-3">
        <b>Account ID</b> : {{ $model->account_number ?? "" }}
      </div>
      <div class="mb-3">
        <b>Payout Request Amount</b> : {{ $model->amount ?? "" }}
      </div>
      <div class="mb-3">
        <b>Status</b> :
        @if ($model->status == "pending")
          <span class="badge badge-pill bg-warning">Pending</span>
        @endif
        @if ($model->status == "on-process")
          <span class="badge badge-pill bg-info">on-process</span>
        @endif
        @if ($model->status == "success")
          <span class="badge badge-pill bg-success">Success</span>
        @endif
        @if ($model->status == "reject")
          <span class="badge badge-pill bg-danger">Reject</span>
        @endif
      </div>
      <div class="mb-3">
        <b>CreatedAt</b> : {{ $model->created_at->format("d/m/Y H:i:s") ?? "" }}
      </div>
      <div class="mb-3">
        <b>UpdatedAt</b> : {{ $model->updated_at->format("d/m/Y H:i:s") ?? "" }}
      </div>
      @if (auth()->guard("admin")->user()->role === "administrator")
        <div class="mt-3">
          <a href="{{ route("bo.payouts.edit", \Crypt::encryptString($model->id)) }}" class="btn btn-outline-success">Edit Data</a>
        </div>
      @endif
    </x-bo.card>
  </x-bo.wrapper>
@endsection