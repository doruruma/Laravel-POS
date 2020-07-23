@extends('layouts.app')

@section('title', 'Laravel POS | Cart')

@section('script')
<script>
  $(document).ready(function() {

    $('.cart').addClass('active')

    const updateSubtotal = function(id, price, qty) {
      let subtotal = price * qty
      $('#' + id + '-subtotal').html(formatter.format(subtotal)).data('subtotal', subtotal)
    }

    const updateTotal = function(price, opt) {
      let currentTotal = $('.total').data('total')
      let newTotal = 0
      if (opt == '+') newTotal = currentTotal + price
      else newTotal = currentTotal - price
      $('.total').html(formatter.format(newTotal)).data('total', newTotal)
    }

    const formatter = new Intl.NumberFormat('id', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    })

    $('.btn-add-qty').click(function() {
      $.ajax({
        url: $(this).data('route'),
        method: 'GET',
        dataType: 'JSON',
        success: (res) => {
          $('#' + $(this).data('id') + '-text-qty').html('Qty: ' + res)
          updateSubtotal($(this).data('id'), $(this).data('price'), res)
          updateTotal($(this).data('price'), '+')
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
          updateSubtotal($(this).data('id'), $(this).data('price'), res)
          updateTotal($(this).data('price'), '-')
        },
        error: (res) => {
          Swal.fire({
            title: 'ERROR',
            text: res.responseJSON,
            icon: 'error',
            timer: 1000,
            timerProgressBar: true,
            showConfirmButton: false,
            allowOutsideClick: false
          })
        }
      })
    })

    $('.btn-delete-cart').click(function() {
      let action = $(this).data('route')
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Yakin Hapus Barang?',
        icon: 'warning',
        showCancelButton: true
      }).then((res) => {
        res.value ? $('.form-delete').attr('action', action).submit() : false
      })
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

    <!-- Container -->
    <div class="container">

      @if (session('cart')) 
        <div class="row mt-5">

          <div class="col-12">
            <div class="h5 text-muted font-weight-light">Items in Cart</div>
            <div class="card shadow-none">
              <div class="card-body">
                <ul class="list-group">
                @foreach (session('cart') as $cart)
                  <li class="list-group-item py-3 d-flex justify-content-between align-items-center" style="border:none">
                    <div>
                      {{ $cart['name'] }}
                      <small class="d-block text-muted">Price : Rp {{ number_format($cart['price']) }}</small>
                      <small class="text-muted subtotal" id="{{ $cart['id'] }}-subtotal" data-subtotal="">Rp {{ number_format($cart['price'] * $cart['qty']) }}</small>
                    </div>
                    <div class="text-muted ml-auto">
                      <small class="font-weight-bold" id="{{ $cart['id'] }}-text-qty">Qty: {{ $cart['qty'] }}</small>
                    </div>
                    <div class="ml-1">
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button class="btn btn-primary btn-add-qty" data-id={{ $cart['id'] }} data-price={{ $cart['price'] }} data-route={{ route('cart.add-qty', $cart['id']) }}><i class="fas fa-plus"></i></button>
                        <button class="btn btn-primary btn-min-qty" data-id={{ $cart['id'] }} data-price={{ $cart['price'] }} data-route={{ route('cart.min-qty', $cart['id']) }}><i class="fas fa-minus"></i></button>
                        <button data-route={{ route('cart.delete', $cart['id']) }} class="btn btn-default text-danger btn-delete-cart"><i class="fas fa-trash"></i></button>
                      </div>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
            </div>
            <hr>
            <div class="card shadow-none">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="text-muted">
                  Total : 
                </div>
                <div class="ml-auto text-muted total" data-total={{ $total }}>
                  Rp {{ number_format($total) }}
                </div>
              </div>
            </div>
            <button class="btn btn-success btn-block btn-lg">Checkout</button>
          </div>

          <!-- Delete Cart Form -->
          <form action="" method="POST" class="d-none form-delete">@csrf @method('DELETE')</form>
          <!-- ./Delete Cart Form -->

        </div>
          
          @else

          <div class="row justify-content-center">

            <div class="col-lg-12">
              <div class="card shadow-none mt-5">
                <div class="card-body">
                  <div class="h1 text-center text-muted d-block" style="margin-top:120px; margin-bottom:120px">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    <p>Oops! Empty Cart</p>
                  </div>
                </div>
              </div>
            </div>

          </div>

          @endif

    </div>
    <!-- ./Container -->

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection