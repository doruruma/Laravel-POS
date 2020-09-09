<center>
  <button class="btn btn-sm my-1 btn-edit btn-flat btn-info" data-id="{{ $products->id }}" data-toggle="modal" data-target="#modal-edit"><i class="far fa-edit"></i></button>
  <form action={{ route('product.delete', ['product' => $products]) }} method="POST" class="d-inline">
    @csrf @method('DELETE')
    <button class="btn btn-sm my-1 btn-delete btn-flat btn-danger"><i class="far fa-trash-alt"></i></button>
  </form>
</center>