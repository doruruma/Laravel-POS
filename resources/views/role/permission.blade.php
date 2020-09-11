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

    <div class="container">

      <div class="row">

        <div class="col-12">
          <div class="card" style="border-radius: 0%">
            <div class="card-header bg-light">
              <div class="d-flex justify-content-between">
                <button class="btn px-4 btn-flat btn-create btn-sm btn-success" data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i> Add Role</button>
              </div>
            </div>
            <form action={{ route('role.update-permission', $role->id) }} method="POST">
            <div class="card-body">

                @csrf

                <table class="table table-borderless">
                  <thead class="text-muted">
                    <th>Menu</th>
                    <th class="text-center">Grant</th>
                    <th class="text-center">Deny</th>
                  </thead>
                  <tbody>
                    @foreach ($menus as $menu)
                      <tr>
                        <td>{{ $menu->menu }}</td>
                        <td class="text-center">
                          <div class="icheck-primary">
                            <input type="radio" name="{{ $menu->id }}" id="{{ $menu->id }}" value="{{ $menu->id }}" {{ RoleHelper::check($role->id, $menu->id) }}>
                            <label for="{{ $menu->id }}"></label>
                          </div>
                        </td>
                        <td class="text-center">
                          <div class="icheck-danger">
                            <input type="radio" name="{{ $menu->id }}" id="deny{{ $menu->id }}" value="deny.{{ $menu->id }}" {{ RoleHelper::uncheck($role->id, $menu->id) }}>
                            <label for="deny{{ $menu->id }}"></label>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
            </div>
            </form>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection