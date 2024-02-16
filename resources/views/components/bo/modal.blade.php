@props(['title' => '', 'modelID' => '', 'is_backdrop' => false])

@if(!$is_backdrop)
<div {{ $attributes }} class="modal fade" id="largeModal{{ $modelID }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3{{ $modelID }}">{{ $title }}</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal" 
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>
@endif

@if ($is_backdrop)
  <div {{ $attributes }} class="modal fade" id="largeModal{{ $modelID }}" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="backDropModalTitle">Modal title</h5>
          {{-- <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button> --}}
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Save</button>
        </div> --}}
      </form>
    </div>
  </div>
@endif