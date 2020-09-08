@extends('layouts.app')

@section('title', 'Laravel POS | Profile')

@section('script')
<script>
  $(document).ready(function() {

    $('.profile').addClass('active')

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
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row justify-content-center">

        <div class="col-lg-10 col-sm-12">
          <div class="card">
            <div class="card-header text-muted border-bottom-0">
              User Profile
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-7">
                  <h2 class="lead"><b>{{ ucwords(Auth::user()->name) }}</b></h2>
                  <ul class="ml-4 mt-2 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="far fa-envelope"></i></span> Email: {{ Auth::user()->email }}</li>
                    <li class="small"><span class="fa-li"><i class="far fa-user"></i></span> Join at: {{ date('d M Y', strtotime(Auth::user()->created_at)) }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-cogs"></i></span> Role: {{ $role }}</li>
                  </ul>
                  <ul class="ml-1 mt-3 mb-0 fa-ul text-muted">
                    @php
                      $member_since = 'Just a Moment Ago';
                      if ($created->i > '0') {
                        $member_since = $created->i . ' Minutes Ago';
                      }
                      if($created->h > '0') {
                        $member_since = $created->h . ' Hours Ago';
                      }
                      if($created->d > '0') {
                        $member_since = $created->d . ' Days Ago';
                      }
                      if($created->m > '0') {
                        $member_since = $created->m . ' Months Ago';
                      }

                      $last_updated = 'Just a Moment Ago';
                      if ($updated->i > '0') {
                        $last_updated = $updated->i . ' Minutes Ago';
                      }
                      if($updated->h > '0') {
                        $last_updated = $updated->h . ' Hours Ago';
                      }
                      if($updated->d > '0') {
                        $last_updated = $updated->d . ' Days Ago';
                      }
                      if($updated->m > '0') {
                        $last_updated = $updated->m . ' Months Ago';
                      }
                    @endphp
                    <li class="small"><span class="fa-li"></span> Member Since: {{ $member_since }}</li>
                    <li class="small"><span class="fa-li"></span> Updated: {{ $last_updated }}</li>
                  </ul>

                </div>
                <div class="col-5 text-center">
                  <img src="{{ asset('dist/img/profile/' . Auth::user()->image) }}" alt="" class="img-thumbnail elevation-1">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-left">
                <a href={{ route('profile.edit') }} class="btn-sm">
                  Edit Profile
                </a>
                <a href={{ route('profile.password') }} class="btn-sm">
                  Change Password
                </a>
              </div>
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