
@isset($aprove)
<form class="d-inline" action="{{ $aprove }}" method="POST">
  @csrf @method('PUT')
  <button class="btn btn-success btn-circle aprove-confirm">
    <i class="fas fa-check"></i>
  </button>
</form>
@endisset

@isset($reject)
<form class="d-inline" action="{{ $reject }}" method="POST">
  @csrf @method('DELETE')
  <button class="btn btn-danger btn-circle reject-confirm">
    <i class="fas fa-times"></i>
  </button>
</form>
@endisset

@isset($restore)
<form class="d-inline" action="{{ $restore }}" method="POST">
  @csrf @method('PUT')
  <button class="btn btn-warning btn-circle switch-status">
    <i class="fas fa-redo"></i>
  </button>
</form>
@endisset

@isset($edit)
<a href="{{ $edit }}" class="btn btn-warning btn-circle">
  <i class="fas fa-edit"></i>
</a>
@endisset

@isset($detail)
<a href="{{ $detail }}" class="btn btn-primary btn-circle mx-1">
  <i class="fa fa-eye"></i>
</a>
@endisset

@isset($delete)
<form  class="d-inline" action="{{ $delete }}" method="POST">
  @csrf @method('DELETE')
  <button type="submit" class="btn btn-danger btn-circle">
    <i class="fas fa-trash"></i>
  </button>
</form>
@endisset
