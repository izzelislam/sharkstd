@props([
  'label', 
  'name', 
  'value', 
  'readonly', 
  'type'        => 'text', 
  'placeholder' => '',
])

<div class="mb-3">
  <label for="{{ $name }}" class="form-label">{{ $label }}</label>
  <input 
    id              ="{{ $name }}" 
    class           ="form-control @error($name) is-invalid @enderror" 
    aria-describedby="{{ $name }}"
    placeholder     ="{{ $placeholder }}"
    type            ="{{ $type }}" 
    name            ="{{ $name }}"
    value           ="{{ old($name, $value ?? null) }}"
    {{ $readonly ?? '' }} {{ $attributes }}
  >
  <div id="{{ $name }}" class="form-text">{{ $slot }}</div>
  @error($name)
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>
