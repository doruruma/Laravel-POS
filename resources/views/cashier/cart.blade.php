@extends('layouts.app')

@section('title', 'Laravel POS | Cart')

@section('script')
<script>
  $(document).ready(function() {

    $('.cart').addClass('active')

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
          <h1>Cart</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item "><a href={{ route('dashboard') }}>Dashboard</a></li>
            <li class="breadcrumb-item active">Cart</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      @if (session('cart'))       
        <div class="row">

          <div class="col-12">
            <div class="card">
              <ul class="list-group">
              @foreach (session('cart') as $cart)
                <li class="list-group-item d-flex justify-content-between align-items-center" style="border:none">
                  <div>
                    {{ $cart['name'] }}
                    <small class="d-block text-muted">Price : Rp {{ number_format($cart['price']) }}</small>
                  </div>
                  <div class="text-muted ml-auto">
                    <small>Qty: {{ $cart['qty'] }}</small>
                  </div>
                  <div class="ml-1">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <button class="btn"><i class="fas fa-plus"></i></button>
                      <button class="btn"><i class="fas fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="ml-1">
                    <button class="btn btn-sm text-danger"><i class="fas fa-trash"></i></button>
                  </div>
                </li>
              @endforeach
              </ul>
            </div>
          </div>

        </div>
      @endif

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection