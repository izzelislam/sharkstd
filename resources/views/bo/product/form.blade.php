@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    @if (session("error"))
    <div class="alert alert-danger" role="alert">
      {{ session("error") }}
    </div>
    @endif
    <x-bo.card title="Form Product" :with_back="true">
      <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (!empty($model))
          @method("PUT")
        @endif
        
        <x-bo.form-input
          name="name"
          label="Product Name"
          value="{{ $model->name ?? '' }}"
        />

        <x-bo.form-select
          label="Product Category"
          name="product_category_id"
          :default="[
            'label' => $model->productCategory->name ?? '',
            'value' => $model->product_category_id ?? ''
          ]"
          :options="$categories"
        />

        <x-bo.form-input
          name="price"
          label="Price"
          type="number"
          value="{{$model->price ?? ''}}"
        >
          <span class="text-primary">Price in USD curency</span>
        </x-bo.form-input>

        <x-bo.form-input
          name="promo"
          label="Promo Price"
          type="number"
          value="{{$model->promo ?? ''}}"
        >
          <span class="text-primary">Fill if you will aply a promo price</span>
        </x-bo.form-input>

        <x-bo.form-input
          name="file_"
          label="File"
          type="file"
          value=""
        >
          <span class="text-primary">Max file 20 mb, and please compres to : .zip .rar before upload </span>
        </x-bo.form-input>

        <x-bo.form-input
          name="file_size"
          label="File Size"
          type="number"
          value="{{ $model->file_size ?? '' }}"
        >
          <span class="text-primary">File size in mb</span>
        </x-bo.form-input>

        <x-bo.form-select-multiple
          label="Compatible File"
          name="compatible_ids[]"
          id="compatibles"
          :default="[ ...Util::pluckId($model->compatibles ?? '')]"
          :options="$compatibles"
        />

        <x-bo.form-select-multiple
          label="Tool available to use"
          name="tool_ids[]"
          id="tools"
          :default="[...Util::pluckId($model->tools ?? '')]"
          :options="$tools"
        />

        <x-bo.form-select-multiple
          label="Feature the product"
          name="feature_ids[]"
          id="features"
          :default="[...Util::pluckId($model->features ?? '') ]"
          :options="$features"
        />

        <x-bo.form-select-multiple
          label="Product License"
          name="license_ids[]"
          id="licenses"
          :default="[...Util::pluckId($model->licenses ?? '') ]"
          :options="$licenses"
        >
          <span class="text-primary">For more information about license click link below <a href=""><b><i></i>License</b></a></span>
        </x-bo.form-select-multiple>

        <x-bo.form-select
          label="Is Free Product ?"
          name="is_free"
          :default="[
            'label' => !empty($model) ? ($model->is_free == 1 ? 'Free Product' : 'Paid Product') : '',
            'value' => $model->is_free ?? ''
          ]"
          :options="[
            1 => 'Free Product',
            0 => 'Paid Product'
          ]"
        />

        <x-bo.form-select
          label="Status"
          name="status"
          :default="[
            'label' => !empty($model) ? ($model->status == 1 ? 'Active' : 'Non-Active') : '',
            'value' => $model->status ?? ''
          ]"
          :options="[
            1 => 'Active',
            0 => 'Non-Active'
          ]"
        />

        <div class="my-3">
          <label for="" class="mb-2">Describtion</label>
          <textarea id="elm1" name="describtion">{{ $model->describtion ?? "" }}</textarea>
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

@push("addon-style")
<link href="/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endpush

@push("addon-script")
  <!--tinymce js-->
  <script src="/admin/assets/plugins/tinymce/tinymce.min.js"></script>

  <!-- init js -->
  <script src="/admin/assets/plugins/tinymce/form-editor.init.js"></script>

  <script src="/admin/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
  <script src="/admin/assets/plugins/select2/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
        $('#features').select2();
    })

    $(document).ready(function() {
        $('#tools').select2();
    })

    $(document).ready(function() {
        $('#compatibles').select2();
    })

    $(document).ready(function() {
        $('#licenses').select2();
    })
  </script>
@endpush
