@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Payout" :with_back="true">
      <form action="{{ $route }}" method="POST">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif

        @if (auth()->guard("admin")->user()->role === "administrator")
          @if (empty($model))
            <x-bo.form-select
              label="User"
              name="admin_id"
              :default="[
                'label' => $model->admin->name ?? '',
                'value' => $model->admin_id ?? ''
              ]"
              :options="$users"
            />
          @endif
          @if (!empty($model))
            <x-bo.form-select
              label="Status"
              name="status"
              :default="[
                'label' => $model->status ?? '',
                'value' => $model->status ?? ''
              ]"
              :options="[
                'pending' => 'pending',
                'on-process' => 'on-process',
                'success' => 'success',
                'reject' => 'reject',
              ]"
            />
          @endif
        @endif

        <x-bo.form-input
          label="Amount"
          name="amount"
          type="number"
          value="{{ $model->amount ?? '' }}"
        >
          <b class="text-primary">Minimum payout request $10</b>
        </x-bo.form-input>

        <x-bo.form-input
          label="Account Type"
          name="account_type"
          value="{{ $model->account_type ?? '' }}"
        >
          <b class="text-primary">Ex. Dana, Ovo, ShopePay, GoPay bank account name etc</b>
        </x-bo.form-input>

        <x-bo.form-input
          label="Account ID"
          name="account_number"
          value="{{ $model->account_number ?? '' }}"
        >
         <b class="text-primary">Ex. ovo nummber, dana or bank number etc</b>
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