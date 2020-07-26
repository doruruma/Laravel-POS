<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  {{-- Title --}}
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

  {{-- Other Plugins --}}
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href={{ asset('plugins/animatecss/animate.css') }}>

  {{-- Jquery --}}
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

  {{-- Main JS --}}
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>

  {{-- SweetAlert 2 --}}
  <link rel="stylesheet" href={{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}>
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">

  @include('layouts.navbar')

  @include('layouts.sidebar')

  @yield('content')

  @include('layouts.footer')

  @yield('script')

  <script>
    $(document).ready(function(){

      $('.btn-logout').click(function(){
        Swal.fire({
          title: 'Konfirmasi',
          text: 'Yakin Ingin Keluar Aplikasi?',
          icon: 'warning',
          showCancelButton: true
        }).then((res) => {
          res.value ? $('#form-logout').submit() : false
        })
      })

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