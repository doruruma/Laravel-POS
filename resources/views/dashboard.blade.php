@extends('layouts.app')

@section('title', 'Laravel POS | Dashboard')

@section('script')
<script>
  $(document).ready(function() {
    $('.dashboard').addClass('active');
  })
</script>
@endsection

@section('content')
<!-- Content Wrapper -->
<div class="content-wrapper">

  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
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

        <div class="col-md-4">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>65</h3>
              <p>Suppliers</p>
            </div>
            <div class="icon">
              <i class="fas fa-people-carry"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>65</h3>
              <p>Products</p>
            </div>
            <div class="icon">
              <i class="fas fa-archive"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>12</h3>
              <p>Categories</p>
            </div>
            <div class="icon">
              <i class="fas fa-th"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection