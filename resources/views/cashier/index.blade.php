@extends('layouts.app')

@section('title', 'Laravel POS | Cashier')

@section('script')
<script>
  $(document).ready(function() {

    $('.cashier').addClass('active')

    // Add Cart
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
    // End Add Cart

    // New Customer Form
    $('#form-create').submit(function(evt) {
      evt.preventDefault()
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        method: 'POST',
        success: function(res) {
          Swal.fire({
            title: 'SUCCESS',
            text: 'Berhasil Tambah Data',
            icon: 'success'
          }).then((res) => {
            document.location.href = '/customers'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            $('#form-create .name-error').html(res.responseJSON.name)
            $('#form-create .email-error').html(res.responseJSON.email)
            $('#form-create .address-error').html(res.responseJSON.address)
            $('#form-create .phone-error').html(res.responseJSON.phone[0])
          }
        }
      })
    })
    $('.modal').on('hide.bs.modal' ,function() {
      $('#form-create .name-error').html('')
      $('#form-create .email-error').html('')
      $('#form-create .address-error').html('')
      $('#form-create .phone-error').html('')
    })
    // End New Customer Form

    // Ajax search Product
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
    // End Ajax search Product

    // Ajax search Customer
    $('#inputSearchCustomer').keyup(function() {
      $.ajax({
        url: $(this).data('route'),
        method: 'GET',
        data: { searchKey: $(this).val() },
        success: function(res) {
          $('.customer-list').html(res)
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

    // Existing Customer Transaction
    $('.customer-list-group').click(function(evt) {
      evt.preventDefault()
      $('#modalCheckout').modal('hide')
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
              <!-- Input Search Item -->
              <div class="form-group mb-2">
                <input type="text" name="search" id="inputSearchItem" data-route={{ route('product.search') }} class="form-control form-control-sm" placeholder="Search Item ...">
              </div>
              <!-- ./Input Search Item -->
              <hr>
              <div class="product-list">
                @include('cashier.productList')
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

    <!-- Checkout Modal -->
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

            <!-- nav tabs -->
            <ul class="nav nav-tabs nav-fill" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" role="tab" href="#existingCustomer">Existing Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" role="tab" href="#newCustomer">New Customer</a>
              </li>
            </ul>
            <!-- ./nav tabs -->

            <!-- tab content -->
            <div class="tab-content" id="tab-content">
              
              <!-- Existing Customer -->
              <div class="tab-pane fade show active" id="existingCustomer" role="tabpanel">
                <!-- Input Search Customer -->
                <div class="form-group mt-5">
                  <input type="text" name="search" id="inputSearchCustomer" data-route={{ route('customer.search') }} class="form-control form-control-sm" placeholder="Search ...">
                </div>
                <!-- ./Input Search Customer -->
                <div class="customer-list">
                  @include('cashier.customerList')
                </div>
              </div>
              <!-- ./Existing Customer -->

              <!-- New Customer -->
              <div class="tab-pane fade" id="newCustomer" role="tabpanel">
                <form action={{ route('customer.store') }} method="POST" id="form-create">
                  @csrf
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
                  <hr>
                  <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- ./New Customer -->

            </div>
            <!-- ./tab content -->

          </div>
        </div>
      </div>
    </div>
    <!-- ./Checkout Modal -->


    <!-- Transaction Modal -->
    
    <!-- ./Transaction Modal -->

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection