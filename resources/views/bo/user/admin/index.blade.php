{{-- <img src="{{ Storage::disk('google')->url('bg/filename.png') }}" alt="" style="width: 400px; height: auto;"> --}}
@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Admin" :with_route="$route">
      <livewire:admin-table />
    </x-bo.card>
  </x-bo.wrapper>
@endsection