@extends('layouts.app')

@section('title', 'Laravel POS | Roles')

@section('script')
<script>
  $(document).ready(function() {

    $('.role').addClass('active')

    $('.btn-delete').click(function(evt) {
      evt.preventDefault()
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Yakin Hapus Data?',
        icon: 'warning',
        showCancelButton: true
      }).then((res) => {
        res.value ? $(this).parent().submit() : false
      })
    })

    $('.btn-edit').click(function() {
      $('#form-edit .text-danger').html('')
      $('#form-edit').attr('action', '/roles/' + $(this).data('id'))
      $.ajax({
        url: '/api/roles/' + $(this).data('id'),
        method: 'GET',
        dataType: 'JSON',
        success: function(res) {
          $('#modal-edit #role').val(res.role)
        }
      })
    })

    $('#form-edit').submit(function(evt) {
      evt.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        method: 'POST',
        success: function(res) {
          Swal.fire({
            title: 'SUCCESS',
            text: 'Berhasil Update Data',
            icon: 'success'
          }).then((res) => {
            document.location.href = '/roles'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            $('#form-edit .role-error').html(res.responseJSON.role)
          }
        }
      })
    })

    $('.btn-create').click(function() {
      $('#form-create .text-danger').html('')
    })

    $('#form-create').submit(function(evt) {
      evt.preventDefault()
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        method: 'POST',
        success: function(res) {
          Swal.fire({
            title: 'SUCCESS',
            text: 'Berhasil Tambah Data',
            icon: 'success'
          }).then((res) => {
            document.location.href = '/roles'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            $('#form-create .role-error').html(res.responseJSON.role)
          }
        }
      })
    })

  })
</script>
@endsection

@section('content')
<!-- Content Wrapper -->
<div class="content-wrapper">

  <div class="swal" data-type="{{ Session::get('type') }}" data-message="{{ Session::get('message') }}"></div>

  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Roles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Roles</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container">
    
      <div class="row">

        <div class="col-12">
          <div class="card" style="border-radius:0%">
            <div class="card-header bg-light">
              <div class="d-flex justify-content-between">
                <button style="border-radius:0%" class="btn px-4 btn-create btn-sm btn-success" data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i> Create New Role</button>
                <button style="border-radius:0%" class="btn px-4 btn-sm btn-success"><i class="fas fa-print"></i></button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th class="text-center text-primary"><i class="fas fa-cogs"></i></th>
                  </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($roles as $role)
                    <tr>
                      <th>{{ $i }}</th>
                      <td>{{ $role->role }}</td>
                      <td class="text-center">
                        <a href={{ route('role.permission', $role->id) }} class="btn btn-sm text-success"><i class="fas fa-tools"></i></a>
                        <button class="btn btn-sm btn-edit text-info" data-id="{{ $role->id }}" data-toggle="modal" data-target="#modal-edit"><i class="far fa-edit"></i></button>
                        <form action={{ route('role.delete', ['role' => $role]) }} method="POST" class="d-inline">
                          @csrf @method('DELETE')
                          <button class="btn btn-sm btn-delete text-danger"><i class="far fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              {{ $roles->links() }}
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

  <!-- Edit Modal -->
  <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Change Role Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <form action="" method="POST" id="form-edit">
            
              @csrf

              <div class="form-group">
                <label for="role">Name</label>
                <input type="text" name="role" id="role" class="form-control">
                <small class="text-danger role-error"></small>
              </div>
            
          </div>
        </div>
        <div class="modal-footer" style="border:none">
          <button type="submit" class="btn btn-primary rounded btn-sm"><i class="fas fa-check"></i></button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <!-- /.Edit Modal -->

  <!-- Create Modal -->
  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Add Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <form action={{ route('role.store') }} method="POST" id="form-create">
            
              @csrf

              <div class="form-group">
                <label for="role">Name</label>
                <input type="text" name="role" id="role" class="form-control" autocomplete="off">
                <small class="text-danger role-error"></small>
              </div>

          </div>
        </div>
        <div class="modal-footer" style="border:none">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <!-- /.Create Modal -->

</div>
<!-- /.content-wrapper -->
@endsection