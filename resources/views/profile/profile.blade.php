@extends('layouts.app')

@section('title', 'Laravel POS | Edit Profile')

@section('script')
<script>
  $(document).ready(function() {

    $('.profile').addClass('active')

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
          <h1>Edit Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
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
          <div class="card">
            <div class="card-body">
              <form action={{ route('profile.update-profile') }} method="POST" enctype="multipart/form-data">

                @csrf @method('PATCH')

                <div class="form-row mb-3">
                  <label for="image" class="col-form-label col-2">Image</label>
                  <div class="col-3">
                    <img src={{ asset('dist/img/profile/' . Auth::user()->image) }} alt="" class="img-thumbnail">
                  </div>
                </div>

                <div class="form-row mb-3">
                  <div class="col-10 offset-2">
                    <input type="file" name="image" id="image"><br>
                    <small class="text-muted">{{ $errors->first('image') }}</small>                  
                  </div>
                </div>

                <div class="form-row mb-3">
                  <label for="name" class="col-form-label col-2">Name</label>
                  <div class="col-10">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? Auth::user()->name }}" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                  </div>
                </div>

                <div class="form-row mb-3">
                  <label for="email" class="col-form-label col-2">Email</label>
                  <div class="col-10">
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') ?? Auth::user()->email }}" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-4 offset-2">
                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                  </div>
                </div>
                
              </form>
            </div>
            <div class="card-footer">

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