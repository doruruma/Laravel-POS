@extends('layouts.app')

@section('title', 'Laravel POS | Cart')

@section('script')
<script>
  $(document).ready(function() {

    $('.cart').addClass('active')

    $('.btn-add-qty').click(function() {
      $.ajax({
        url: $(this).data('route'),
        method: 'GET',
        dataType: 'JSON',
        success: (res) => {
          console.log(res)
          $('#' + $(this).data('id') + '-text-qty').html('Qty: ' + res)
        }
      })
    })

    $('.btn-min-qty').click(function() {
      $.ajax({
        url: $(this).data('route'),
        method: 'GET',
        dataType: 'JSON',
        success: (res) => {
          $('#' + $(this).data('id') + '-text-qty').html('Qty: ' + res)
        },
        error: (res) => {
          Swal.fire({
            title: 'ERROR',
            text: res.responseJSON,
            icon: 'error'
          })
        }
      })
    })

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

    <div class="container">

      <div class="row mt-4">
        @if (session('cart'))       

          <div class="col-12">
            <div class="card">
              <ul class="list-group">
              @foreach (session('cart') as $cart)
                <li class="list-group-item py-3 d-flex justify-content-between align-items-center" style="border:none">
                  <div>
                    {{ $cart['name'] }}
                    <small class="d-block text-muted">Price : Rp {{ number_format($cart['price']) }}</small>
                  </div>
                  <div class="text-muted ml-auto">
                    <small class="font-weight-bold" id="{{ $cart['id'] }}-text-qty">Qty: {{ $cart['qty'] }}</small>
                  </div>
                  <div class="ml-1">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <button class="btn btn-primary btn-add-qty" data-id={{ $cart['id'] }} data-route={{ route('cart.add-qty', $cart['id']) }}><i class="fas fa-plus"></i></button>
                      <button class="btn btn-primary btn-min-qty" data-id={{ $cart['id'] }} data-route={{ route('cart.min-qty', $cart['id']) }}><i class="fas fa-minus"></i></button>
                      <button class="btn btn-default text-danger" data-route={{ route('cart.delete', $cart['id']) }}><i class="fas fa-trash"></i></button>
                    </div>
                  </div>
                </li>
              @endforeach
              </ul>
            </div>
          </div>
          
          @else

          <div class="col-12">
            <div class="h1 text-center text-muted d-block" style="position:relative; top:100px">
              <i class="fas fa-shopping-cart fa-lg"></i>
              <p>Oops! Empty Cart</p>
            </div>
          </div>

          @endif
        </div>

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection