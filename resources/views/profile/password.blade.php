@extends('layouts.app')

@section('title', 'Laravel POS | Change Password')

@section('script')
<script>
  $(document).ready(function() {

    $('.password').addClass('active')

    $('#image').change(function() {
      $('.img-thumbnail').attr('src' , window.URL.createObjectURL(this.files[0]));
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
          <h1>Change Password</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
            <li class="breadcrumb-item active">Change Password</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-sm-12">
            <div class="card-body">
              <form action={{ route('profile.update-password') }} method="POST">

                @csrf @method('PATCH')

                <div class="form-row mb-3">
                  <label for="old" class="col-form-label col-lg-2 col-sm-12">Old Password</label>
                  <div class="col-lg-6 col-sm-12">
                    <input type="password" name="old" id="old" class="form-control" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('old') }}</small>
                  </div>
                </div>

                <div class="form-row mb-3">
                  <label for="new" class="col-form-label col-lg-2 col-sm-12">New Password</label>
                  <div class="col-lg-6 col-sm-12">
                    <input type="password" name="new" id="new" class="form-control" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('new') }}</small>
                  </div>
                </div>

                <div class="form-row mb-3">
                  <label for="new_confirmation" class="col-form-label col-lg-2 col-sm-12">Confirm Password</label>
                  <div class="col-lg-6 col-sm-12">
                    <input type="password" name="new_confirmation" id="new_confirmation" class="form-control" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('new_confirmation') }}</small>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-4 offset-2">
                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                  </div>
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