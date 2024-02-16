@props([
	'label', 
	'name', 
	'value',
  'id' => '', 
	'options', 
	'default', 
]) {{-- options format: [id => 'name'] (created using pluck) --}}


<div class="mb-3">
  <label for="{{ $id }}">{{ $label }}</label>
  <select 
    id	 ="{{ $id }}" 
    name ={{ $name }}
    class="select2 select2-multiple form-select	@error($name)	is-invalid @enderror" 
    multiple="multiple"
    {{ $attributes }}
  >
    @foreach ($options as $optionId => $optionName)
      <option
        value="{{ $optionId }}"
        @if (count($default) > 0)
          @if(in_array($optionId, $default))
            selected
          @endif
        @endif
      >
        {{ $optionName }}
      </option>
    @endforeach
  </select>
  <div class="mt-2">{{ $slot }}</div>
  <small class="form-text text-muted">select one.</small>
	@error($name)
		<span class="invalid-feedback">
			{{ $message }}
		</span>
	@enderror
</div>