@extends('layouts.app')

@section('title', 'Laravel POS | Cashier')

@section('script')
<script>
  $(document).ready(function() {

    $('.cashier').addClass('active')

    $('.btn-add-cart').click(function(evt) {
      evt.preventDefault()
      $.ajax({
        url: $(this).parent().attr('action'),
        data: $(this).parent().serialize(),
        dataType: 'JSON',
        method: 'POST',
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
              <div class="card-footer" style="height:50px; background:#fff">
                <form action={{ route('cart.store', $product->id) }} method="post" class="d-inline">
                  @csrf <button class="btn btn-sm btn-default text-success btn-add-cart"><i class="fas fa-cart-plus"></i></button>
                </form>
                <button class="btn btn-sm btn-default text-info btn-checkout"><i class="fas fa-check"></i></button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      @endforeach

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