<center>
  <button class="btn my-1 btn-flat btn-info btn-sm btn-edit" data-id="{{ $suppliers->id }}" data-toggle="modal" data-target="#modal-edit"><i class="far fa-edit"></i></button>
  <form action={{ route('supplier.delete', ['supplier' => $suppliers]) }} method="POST" class="d-inline">
    @csrf @method('DELETE')
    <button class="btn my-1 btn-flat btn-danger btn-sm btn-delete"><i class="far fa-trash-alt"></i></button>
  </form>
</center>