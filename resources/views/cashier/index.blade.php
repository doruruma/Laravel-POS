@extends('layouts.app')

@section('title', 'Laravel POS | Cashier')

@section('script')
<script>
  $(document).ready(function() {
    $('.cashier').addClass('active');
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
            <li class="breadcrumb-item "><a href={{ route('dashboard') }}>Dashboard</a></li>
            <li class="breadcrumb-item active">Cashier</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      @foreach ($categories as $category)
        <div class="h5">{{ $category->name }}</div>
        <div class="row">
          @foreach ($category->products as $product)
          <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="card">
              <div class="card-body">
                <div class="d-block">{{ $product->name }}</div>
                <small class="text-muted">Rp {{ number_format($product->price, 0, '.', ",") }}</small>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      @endforeach

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection