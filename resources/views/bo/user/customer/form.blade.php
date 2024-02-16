@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Blog" :with_back="true">
      <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif
        
        <x-bo.form-input
          name="name"
          label="Customer Name"
          value="{{ $model->name ?? '' }}"
        />

        <x-bo.form-input
          name="email"
          label="Customer email"
          type="email"
          value="{{ $model->email ?? '' }}"
        />

        <x-bo.form-input
          name="postal_code"
          label="Postal Code"
          type="number"
          value="{{ $model->postal_code ?? '' }}"
        />

        <x-bo.form-textarea
          name="address"
          label="Address"
          value="{{ $model->address ?? '' }}"
        />

        <x-bo.form-input
          name="password"
          label="Password"
          type="password"
          value="{{''}}"
        />

        <x-bo.form-input
          name="password_confirmation"
          label="Confirm Password"
          type="password"
          value="{{ '' }}"
        />

        <x-bo.form-select
          label="Customer Status"
          name="status"
          :default="[
            'label' => !empty($model) ? ($model->status == 1 ? 'Active' : 'Non-Active') : '',
            'value' => $model->status ?? ''
          ]"
          :options="[
            1 => 'Avtive',
            0 => 'Non-Active'
          ]"
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
