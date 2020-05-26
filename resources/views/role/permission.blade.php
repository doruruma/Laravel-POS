@extends('layouts.app')

@section('title', 'Laravel POS | Permission')

@section('script')
<script>
  $(document).ready(function() {

    $('.role').addClass('active');

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
          <h1>Permission</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href={{ route('role') }}>Roles</a></li>
            <li class="breadcrumb-item active">Permission {{ $role->role }}</li>
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
        <button class="btn mx-1 btn-create btn-sm btn-primary" data-toggle="modal" data-target="#modal-create">Add Role</button>
        <button class="btn px-3 mx-1 btn-sm btn-primary"><i class="fas fa-print"></i></button>
      </div>

      <div class="card">
        <div class="card-body">
          <form action={{ route('role.update-permission', $role->id) }} method="POST">

            @csrf

            <table class="table table-bordered">
              <thead class="text-muted">
                <th>Menu</th>
                <th class="text-center"><i class="fas fa-cogs"></i></th>
              </thead>
              <tbody>
                @foreach ($menus as $menu)
                  <tr>
                    <td>{{ $menu->menu }}</td>
                    <td class="text-center">
                      <div class="icheck-sunflower">
                        <input type="checkbox" name="accesses[]" id="{{ $menu->id }}" value="{{ $menu->id }}" {{ RoleHelper::check($role->id, $menu->id) }}>
                        <label for="{{ $menu->id }}"></label>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit" class="mt-3 btn btn-primary">Save Changes</button>
          </form>
        </div>
        <div class="card-footer">
          Footer
        </div>
      </div>

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection