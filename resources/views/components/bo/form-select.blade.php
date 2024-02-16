@props([
	'label', 
	'name', 
	'value', 
	'options', 
	'default', 
]) {{-- options format: [id => 'name'] (created using pluck) --}}


<div class="mb-3">
  <label for="select{{ $name }}">{{ $label }}</label>
  <select 
		class=" form-select	@error($name)	is-invalid @enderror"
		id	 ="select{{ $name }}" 
		name ={{ $name }}
		{{ $attributes }}
		>
		@isset($default)
    	    <option value="{{ $default['value'] }}" class="d-none" selected>{{ $default['label'] }}</option>
		@endisset
		@foreach ($options as $optionId => $optionName)
			<option
				value="{{ $optionId }}"
				@if((string)$optionId === (string)old($name, $value ?? null))
					selected
				@endif
			>
        {{ $optionName }}
			</option>
		@endforeach
  </select>

  <small class="form-text text-muted">select one.</small>
	@error($name)
		<span class="invalid-feedback">
			{{ $message }}
		</span>
	@enderror
</div>
