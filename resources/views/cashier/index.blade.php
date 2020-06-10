@extends('layouts.app')

@section('title', 'Laravel POS | Cashier')

@section('script')
<script>
  $(document).ready(function() {

    $('.cashier').addClass('active')

    $('.btn-add-cart').click(function() {
      $.ajax({
        url: $(this).data('route'),
        data: $(this).parent().serialize(),
        dataType: 'JSON',
        method: 'GET',
        success: function(res) {
          Swal.fire({
            position: 'top-end',
            toast: true,
            timerProgressBar: true,
            timer: 1500,
            text: res.message,
            icon: 'success'
          })
          console.log(res)
        }
      })      
    })

    $('.btn-checkout').click(function() {

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
          <h1>Item Transaction</h1>
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

    <div class="container">

      <div class="row">

        <div class="col-12">
          <div class="card shadow-none">
            <div class="card-body">
              <ul class="list-group">
                @foreach ($products as $product)
                  <li class="list-group-item py-3 d-flex justify-content-between align-items-center" style="border:none">
                    <div>
                      {{ $product->name }}
                      <small class="d-block text-muted">Rp {{ number_format($product->price) }}</small>
                      <small class="text-muted font-weight-bold">{{ $product->category->name }}</small>
                    </div>
                    <div class="ml-5">
                      <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                        <button class="btn btn-sm btn-default text-success btn-add-cart" data-route={{ route('cart.store', $product->id) }}><i class="fas fa-cart-plus"></i></button>
                        <button class="btn btn-sm btn-default text-info btn-checkout" data-toggle="modal" data-target="#modalCheckout"><i class="fas fa-check"></i></button>
                      </div>
                    </div>
                  </li>
                @endforeach  
              </ul>
            </div>
          </div>
        </div>

      </div>

    </div>

    {{-- Checkout Modal --}}
    <div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="border:none">
            <h5 class="modal-title" id="exampleModalLabel">Customer Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body px-5">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control form-control-sm">
              <small class="text-danger email-error"></small>
            </div>
            <div class="customer-form d-none">
              <hr>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control form-control-sm">
                <small class="text-danger name-error"></small>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" rows="5" class="form-control" style="resize:none"></textarea>
                <small class="text-danger address-error"></small>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control form-control-sm">
                <small class="text-danger phone-error"></small>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border:none">
            <button type="button" class="btn btn-sm btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
    {{-- ./Checkout Modal --}}

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection