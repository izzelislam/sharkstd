@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <x-bo.card title="Blog" :with_back="true">
      <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif
        
        <x-bo.form-input
          name="title"
          label="Blog Title"
          value="{{ $model->title ?? '' }}"
        />

        <x-bo.form-input
          name="image_cover_"
          type="file"
          label="Cover Image"
          value="{{ $model->name ?? '' }}"
        >
        <span>Max size 2mb, allowed extension : jpg,jpeg and png. </span>
        </x-bo.form-input>

        <x-bo.form-select
          label="Blog Category"
          name="blog_category_id"
          :default="[
            'label' => $model->blogCategory->name ?? '',
            'value' => $model->category_id ?? ''
          ]"
          :options="$categories"
        />


        <div class="my-3">
          <label for="" class="mb-2">Content</label>
          <textarea id="elm1" name="content">{{ $model->content ?? "" }}</textarea>
        </div>  

        <div>
          <x-bo.button
            color="success"
            title="Submit"
          />
        </div>
      </form>
    </x-bo.card>
  </x-bo.wrapper>
@endsection

@push("addon-script")
  <!--tinymce js-->
  <script src="/admin/assets/plugins/tinymce/tinymce.min.js"></script>

  <!-- init js -->
  <script src="/admin/assets/plugins/tinymce/form-editor.init.js"></script>
@endpush