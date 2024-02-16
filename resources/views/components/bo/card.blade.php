@props(['title' => '', 'sub_title' => '', 'with_back' => false, 'with_route' => null])

<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-description">{{ $sub_title }}</p>
      </div>
      @if($with_route != null)
        <x-bo.button
          title="Create Data"
          color="primary"
          icon="plus"
          as="link"
          url="{{ $with_route }}"
        />
      @endif

      @isset($addon)
        {{ $addon }}
      @endisset

      @if($with_back)
        <x-bo.button
          title="Back"
          color="primary"
          icon="left-arrow-alt"
          as="link"
          url="{{ url()->previous() }}"
        />
      @endif
    </div>
    <div>
      {{ $slot }}
    </div>
  </div>
</div>