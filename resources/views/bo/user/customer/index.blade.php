{{-- <img src="{{ Storage::disk('google')->url('bg/filename.png') }}" alt="" style="width: 400px; height: auto;"> --}}
@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Customer" :with_route="$route">
      <livewire:customer-table />
    </x-bo.card>
  </x-bo.wrapper>
@endsection