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
          $('.toast').toast('show')
          $('.toast-body').html(res.message)
          console.log(res)
        }
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
                        <button class="btn btn-sm btn-default text-info btn-checkout"><i class="fas fa-check"></i></button>
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

  </section>
  <!-- /.Main content -->
  
  <!-- Toast -->
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000" style="position: absolute; top: 10px; right: 10px; z-index:9999">
    <div class="toast-header">
      <i class="mr-2 fas fa-bell text-info"></i>
      <strong class="mr-5">Operation Successfull</strong>
      <i class="fas fa-check text-info"></i>
    </div>
    <div class="toast-body">
      Item(s) successfully added to cart
    </div>
  </div>
  <!-- /.Toast -->

</div>
<!-- /.content-wrapper -->
@endsection