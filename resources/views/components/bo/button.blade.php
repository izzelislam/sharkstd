@props([
  'type' => 'submit', 
  'color' => 'primary', 
  'icon' => 'user', 
  'title' => '', 
  'as' => 'button', 
  'url' => ''
])

@if ($as == 'button')
  <button {{ $attributes }} type="{{ $type }}" class="btn btn-outline-{{ $color }} m-b-xs">
    {{ $title }}
  </button>
@endif

@if ($as == 'link')
<a {{ $attributes }}  href="{{ $url }}" class="btn btn-outline-{{ $color }} m-b-xs">
  <span class="tf-icons bx bx-{{ $icon }}"></span>&nbsp; {{ $title }}
</a>
@endif
