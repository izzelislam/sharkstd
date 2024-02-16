@extends("bo.layouts.app")

@section("content")
  <x-bo.wrapper>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <x-bo.card title="Detail Product">
          <div class="mb-3">
            <b>Name</b> : {{ $model->name ?? "" }}
          </div>
          <div class="mb-3">
            <b>Category</b> : {{ $model->productCategory->name ?? "" }}
          </div>
          <div class="mb-3">
            <b>File </b> <i class="fa fa-file"></i> : {{ explode("/", $model->file)[1] ?? "" }} <a target="blank" href=""><i>Download</i></a>
          </div>
          <div class="mb-3">
            <b>File Size </b>  : {{ $model->file_size ?? "" }}
          </div>
          <div class="mb-3">
            <b>Prise </b>  : <b>{{ $model->price ?? "" }} USD</b>
          </div>
          <div class="mb-3">
            <b>Promo </b>  : {{ $model->Promo ?? "" }} USD
          </div>
          <div class="mb-3">
            <b>Free Product</b> : 
            @if ($model->status == 1)
              <span class="badge badge-pill bg-success">Free Product</span>
            @endif
            @if ($model->status == 0)
              <span class="badge badge-pill bg-danger">Paid Product</span>
            @endif
          </div>
          <div class="mb-3">
            <b>Status</b> : 
            @if ($model->status == 1)
              <span class="badge badge-pill bg-success">Active</span>
            @endif
            @if ($model->status == 0)
              <span class="badge badge-pill bg-danger">Non-Active</span>
            @endif
          </div>

          <div class="mb-3">
            <b>Feature</b> : 
            <div class="d-flex flex-wrap">
              @foreach ($model->features as $feature)
                <span class="badge bg-primary me-2">{{ $feature->name }}</span>
              @endforeach
            </div>
          </div>

          <div class="mb-3">
            <b>Tool</b> : 
            <div class="d-flex flex-wrap">
              @foreach ($model->tools as $tool)
                <span class="badge bg-primary me-2">{{ $tool->name }}</span>
              @endforeach
            </div>
          </div>

          <div class="mb-3">
            <b>Compatible</b> : 
            <div class="d-flex flex-wrap">
              @foreach ($model->compatibles as $compatible)
                <span class="badge bg-primary me-2">{{ $compatible->name }}</span>
              @endforeach
            </div>
          </div>

          <div class="mb-3">
            <b>License</b> : 
            <div class="d-flex flex-wrap">
              @foreach ($model->licenses as $license)
                <span class="badge bg-primary me-2">{{ $license->name }}</span>
              @endforeach
            </div>
            <b><i><small>For more about license can click link below <a href="">License</a></small></i></b>
          </div>

          <div class="mb-3">
            <b>CreatedAt</b> : {{ $model->created_at->format("d/m/Y H:i:s") ?? "" }}
          </div>
          <div class="mb-3">
            <b>UpdatedAt</b> : {{ $model->updated_at->format("d/m/Y H:i:s") ?? "" }}
          </div>

          <div class="mb-3">
            <b>Describtion</b> : <hr> {!! $model->describtion ?? "" !!}
          </div>
          
          @empty($model->deleted_at)
            <div class="py-3">
              <a href="{{ route("bo.products.edit", $model->slug) }}" class="btn btn-success">Edit Product</a>
            </div>
          @endempty

        </x-bo.card>
      </div>
      <div class="col-12 col-md-6 col-lg-6">
        <x-bo.card title="Product Image" :with_back="true">
          @empty($model->deleted_at)
            <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Product Image</button>
          @endempty
          <div class="d-flex flex-wrap">
            @foreach ($model->images as $image )
              <div class="col-6 p-3">
                <img width="92%" class="rounded" src="{{ Storage::url($image->image) }}" alt="">
                <form action="{{ route('bo.products.images.destroy', \Crypt::encryptString($image->id)) }}" method="POST" class="d-inline">
                  @csrf
                  <button class="btn btn-danger btn-sm mt-2 me-3"><i class="fa fa-trash"></i></button> <span class="mt-2">{{ explode("/", $image->image)[1] }}</span>
                </form>
              </div>
            @endforeach
          </div>
        </x-bo.card>
      </div>
    </div>
  </x-bo.wrapper>
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Upload Product Images</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route("bo.products.images.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_p" value="{{ \Crypt::encryptString($model->slug) }}">
            <x-bo.form-input
              name="images[]"
              label="Product Image"
              value=""
              type="file"
              multiple
            >
            <div class="mt-3">
              <ul>
                <li>Maz size every image 3mb,</li>
                <li>Recomended resolution or dimention 950 x 500 px</li>
                <li>Allowed extenstion jpg, jpeg or png</li>
                <li>First file in order will be cover product image</li>
              </ul>
            </div>
            </x-bo.form-input>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection