<center>
  <button class="btn my-1 btn-sm btn-edit btn-flat btn-info" data-id="{{ $categories->id }}" data-toggle="modal" data-target="#modal-edit"><i class="far fa-edit"></i></button>
  <form action={{ route('category.delete', ['category' => $categories]) }} method="POST" class="d-inline">
    @csrf @method('DELETE')
    <button class="btn my-1 btn-sm btn-delete btn-flat btn-danger"><i class="far fa-trash-alt"></i></button>
  </form>
</center>