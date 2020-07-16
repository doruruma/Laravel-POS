@extends('layouts.app')

@section('title', 'Laravel POS | Cashier')

@section('script')
<script>
  $(document).ready(function() {

    $('.cashier').addClass('active')

    $(document).on('click', '.btn-add-cart', function() {
      console.log($(this).parent().serialize())
      $.ajax({
        url: $(this).data('route'),
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
        }
      })      
    })

    $('#inputSearchItem').keyup(function() {
      $.ajax({
        url: $(this).data('route'),
        method: 'GET',
        data: { searchKey: $(this).val() },
        success: function(res) {
          $('.product-list').html(res)
        }
      })
    })

    // Ajax search Customer
    $('#inputSearchCustomer').keyup(function() {
      $.ajax({
        url: $(this).data('route'),
        method: 'GET',
        data: { searchKey: $(this).val() },
        success: function(res) {
          $('.customers-list-group').html(res)
        }
      })
    })
    // End Ajax search Customer

    // Product ajax paginate
    $(document).on('click', '.product-paginate .pagination a', function(evt) {
      fetchData(evt, '/cashier/paginate-product?page=', $(this).attr('href').split('page=')[1], '.product-list')
    })
    // End Product ajax paginate

    // Customer ajax paginate
    $(document).on('click', '.customer-paginate .pagination a', function(evt) {
      fetchData(evt, '/cashier/paginate-customer?page=', $(this).attr('href').split('page=')[1], '.customer-list')
    })
    // End Customer ajax paginate

    function fetchData(evt, url, page, target) {
      evt.preventDefault()
      $.ajax({
        url: url + page,
        method: 'GET',
        success: function(res) {
          $(target).html(res)
        }
      })
    }


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

              {{-- Input Search Item --}}
              <div class="form-group mb-2">
                <input type="text" name="search" id="inputSearchItem" data-route={{ route('product.search') }} class="form-control form-control-sm" placeholder="Search Item ...">
              </div>
              {{-- ./Input Search Item --}}

              <hr>

              <div class="product-list">
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
                <div class="product-paginate">{{ $products->links() }}</div>
              </div>

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
            <h5 class="modal-title" id="exampleModalLabel">Choose Customer Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body px-5">

            {{-- nav tabs --}}
            <ul class="nav nav-tabs nav-fill" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" role="tab" href="#existingCustomer">Existing Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" role="tab" href="#newCustomer">New Customer</a>
              </li>
            </ul>
            {{-- ./nav tabs --}}

            {{-- tab content --}}
            <div class="tab-content" id="tab-content">
              
              <div class="tab-pane fade show active" id="existingCustomer" role="tabpanel">

                {{-- Input Search Customer --}}
                <div class="form-group mt-5">
                  <input type="text" name="search" id="inputSearchCustomer" data-route={{ route('customer.search') }} class="form-control form-control-sm" placeholder="Search ...">
                </div>
                {{-- ./Input Search Customer --}}

                <div class="customer-list">
                  <div class="list-group mb-2">
                    @foreach ($customers as $customer)
                      <a href="#" class="list-group-item list-group-item-action" style="">
                        {{ $customer->email }} <br>
                        <small>{{ $customer->name }} - {{ $customer->phone }}</small>
                      </a>
                    @endforeach
                  </div>
                  <div class="customer-paginate">{{ $customers->links() }}</div>
                </div>

              </div>

              <div class="tab-pane fade" id="newCustomer" role="tabpanel">

                <div class="form-group mt-5">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" class="form-control form-control-sm">
                  <small class="text-danger email-error"></small>
                </div>
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
            {{-- ./tab content --}}

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