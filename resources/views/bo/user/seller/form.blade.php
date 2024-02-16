@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Seller" :with_back="true">
      <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif
        
        <x-bo.form-input
          name="name"
          label="Seller Name"
          value="{{ $model->name ?? '' }}"
        />

        <x-bo.form-input
          name="email"
          label="Seller email"
          type="email"
          value="{{ $model->email ?? '' }}"
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
          label="Seller Status"
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
