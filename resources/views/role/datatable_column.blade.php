<center>
  <a href={{ route('role.permission', $roles->id) }} class="btn btn-sm btn-flat btn-success"><i class="fas fa-tools"></i></a>
  <button class="btn btn-sm btn-edit btn-flat btn-info" data-id="{{ $roles->id }}" data-toggle="modal" data-target="#modal-edit"><i class="far fa-edit"></i></button>
  <form action={{ route('role.delete', ['role' => $roles]) }} method="POST" class="d-inline">
    @csrf @method('DELETE')
    <button class="btn btn-sm btn-delete btn-flat btn-danger"><i class="far fa-trash-alt"></i></button>
  </form>
</center>