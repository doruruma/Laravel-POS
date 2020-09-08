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

    <div class="container">

      <div class="row justify-content-center">

        <div class="col-sm-12" style="margin-top:50px">
          <div class="card">
            <div class="card-body px-5 py-5">
              <form action={{ route('profile.update-password') }} method="POST">

                @csrf @method('PATCH')

                <div class="form-group">
                  <label for="old">Old Password</label>
                  <input type="password" name="old" id="old" class="form-control form-control-sm" autocomplete="off">
                  <small class="text-danger">{{ $errors->first('old') }}</small>
                </div>

                <div class="form-group">
                  <label for="new">New Password</label>
                  <input type="password" name="new" id="new" class="form-control form-control-sm" autocomplete="off">
                  <small class="text-danger">{{ $errors->first('new') }}</small>
                </div>

                <div class="form-group">
                  <label for="new_confirmation">Confirm Password</label>
                  <input type="password" name="new_confirmation" id="new_confirmation" class="form-control form-control-sm" autocomplete="off">
                  <small class="text-danger">{{ $errors->first('new_confirmation') }}</small>
                </div>

                <hr>

                <div class="form-group">
                  <button type="submit" class="btn btn-block btn-primary">Save Changes</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection