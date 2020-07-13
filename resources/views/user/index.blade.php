@extends('layouts.app')

@section('title', 'Laravel POS | Users')

@section('script')
<script>
  $(document).ready(function() {

    $('.user').addClass('active');

    $('.btn-delete').click(function(evt) {
      evt.preventDefault();
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
      $('#form-edit').attr('action', '/users/' + $(this).data('id'))
      $.ajax({
        url: '/api/users/' + $(this).data('id'),
        method: 'GET',
        dataType: 'JSON',
        success: function(res) {
          $('#modal-edit #role').val(res.role_id)
        }
      })
    })

    $('#form-edit').submit(function(evt) {
      evt.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'JSON',
        method: 'POST',
        success: function(res) {
          Swal.fire({
            title: 'SUCCESS',
            text: 'Berhasil Update Data',
            icon: 'success'
          }).then((res) => {
            document.location.href = '/users'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            console.log(res.role)
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
        dataType: 'JSON',
        method: 'POST',
        success: function(res) {
          Swal.fire({
            title: 'SUCCESS',
            text: 'Berhasil Tambah Data',
            icon: 'success'
          }).then((res) => {
            document.location.href = '/users'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            $('#form-create .name-error').html(res.responseJSON.name)
            $('#form-create .email-error').html(res.responseJSON.email)
            $('#form-create .password-error').html(res.responseJSON.password)
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
          <h1>Users List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="d-flex mb-2">
        <button class="btn mx-1 btn-create btn-sm btn-primary" data-toggle="modal" data-target="#modal-create">Add User</button>
        <button class="btn px-3 mx-1 btn-sm btn-primary"><i class="fas fa-print"></i></button>
      </div>

      <div class="card">
        <div class="card-body">
          <table class="table table-borderless">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center text-primary"><i class="fas fa-cogs"></i></th>
              </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($users as $user)
                <tr>
                  <th>{{ $i }}</th>
                  <td>{{ ucwords($user->name) }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role->role }}</td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-edit text-info" data-id="{{ $user->id }}" data-toggle="modal" data-target="#modal-edit"><i class="far fa-edit"></i></button>
                    <form action={{ route('user.delete', ['user' => $user]) }} method="POST" class="d-inline">
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
          Footer
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
          <h5 class="modal-title">Change Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <form action="" method="POST" id="form-edit">
            
              @csrf

              <div class="form-group">
                <select class="custom-select" name="role_id" id="role">
                  @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                  @endforeach
                </select>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <form action={{ route('user.store') }} method="POST" id="form-create">
            
              @csrf

              <input type="hidden" name="image" value="default_profile.png">

              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                <small class="text-danger name-error"></small>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" autocomplete="off">
                <small class="text-danger email-error"></small>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <small class="text-danger password-error"></small>
              </div>

              <div class="form-group">
                <label for="role">Role</label>
                <select class="custom-select" name="role_id" id="role">
                  <option value="" selected disabled>Choose Role</option>
                  @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                  @endforeach
                </select>
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