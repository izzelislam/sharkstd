{{-- <img src="{{ Storage::disk('google')->url('bg/filename.png') }}" alt="" style="width: 400px; height: auto;"> --}}
@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="License Product" :with_route="$route">
      <livewire:license-table />
    </x-bo.card>
  </x-bo.wrapper>
@endsection