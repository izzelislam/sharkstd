@props(['name' => '', 'label' => '', 'value'])

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<div class="mb-3 col-12 col-md-8 col-lg-8">
  <label for="">{{ $label }}</label>
  <textarea name="{{ $name }}" id="editor" rows="10">
    {{  old($name, $value ?? null) }}
  </textarea>
  {{-- <span>tetetettet</span> --}}
  @error($name)
    <span class="text-danger">
      <i><strong>{{ $message }}</strong></i>
    </span>
  @enderror
</div>

<script>
  $('#editor').summernote({
    codeviewFilter: false,
    codeviewIframeFilter: true,
    placeholder: '',
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>