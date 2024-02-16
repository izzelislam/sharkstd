
@props([
  'label', 
  'name', 
  'value', 
  'placeholder' => '', 
  'rows'        =>"3", 
])

<div class="mb-3">
  <label class="form-label">{{ $label }}</label>
  <textarea
    name        ="{{ $name }}"
    class       ="form-control @error($name) is-invalid @enderror"
    placeholder ="{{ $placeholder }}"
    rows        ="{{ $rows }}">
    {{ $attributes }}
    {{  old($name, $value ?? null) }}
  </textarea>
  <div id="{{ $name }}" class="form-text">{{ $slot }}</div>
  @error($name)
    <span class="invalid-feedback">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
