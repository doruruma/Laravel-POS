<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laravel POS | Log in</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

  {{-- Other Plugins --}}
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  {{-- Jquery --}}
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

  {{-- Main JS --}}
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>

  {{-- SweetAlert 2 --}}
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

</head>
<body class="hold-transition login-page">

<div class="swal" data-type="{{ Session::get('type') }}" data-message="{{ Session::get('message') }}"></div>

<div class="login-box" style="margin-top:-90px">
  <div class="login-logo">
    <p><b>Laravel</b>POS</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('postLogin') }}" method="POST">

        @csrf

        <div class="form-group mb-3">
          <div class="input-group">
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>

        <div class="form-group mb-3">
          <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <small class="text-danger d-block">{{ $errors->first('password') }}</small>
        </div>

        <div class="row justify-content-center">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>

      </form>

      {{-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}

      <p class="mt-3 text-center">
        <small><a href="register.html" class="text-center">Register a new membership</a></small>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script>
  $(document).ready(function(){
    
    let swal = $('.swal').data('type')
    let message = $('.swal').data('message')
    if (swal) {
      Swal.fire({
        title: swal.toUpperCase(),
        text: message,
        icon: swal
      })
    }
    
  })
</script>

</body>
</html>
