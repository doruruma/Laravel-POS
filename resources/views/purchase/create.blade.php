@extends('layouts.app')

@section('title', 'Laravel POS | Register Purchase Data')

@section('plugin')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('script')
<script>
  $(document).ready(function() {

    $('.purchase').addClass('active');

    $('.btn-close-alert').click(function() {
      $('.alert').addClass('d-none')
    })

    $('.btn-choose-supplier').click(function() {
      $('.table-supplier').DataTable({
        retrieve: true,
        serverSide: true,
        processing: true,
        ajax: '/purchases/get-suppliers',
        columns: [
          { data: 'name', name: 'name' },
          { data: 'phone', name: 'phone' },
          { data: 'address', name: 'address' },
          { data: 'Action', name: 'action' },
        ]
      })
    })

    $(document).on('click', '.btn-check-supplier', function() {
      let id = $(this).data('id')
      $('.input-supplier-id').val(id)
      $.ajax({
        url: '/purchases/get-supplier-by-id/' + id,
        method: 'GET',
        success: function(res) {
          $('#modal-supplier').modal('hide')
          $('.list-group-supplier').html(res)
          $('.section-purchase').removeClass('d-none')
        }
      })
    })

    $('.btn-add-row').click(function() {
      $.ajax({
        url: '/purchases/get-table-product',
        success: function(res) {
          $('.table-purchase tbody').append(res)
        }
      })
    })

    $(document).on('click', '.btn-remove-row', function() {
      $(this).parent().parent().remove()
    })

    let index = 0
    $(document).on('click', '.input-product-id', function() {   
      // Get the <tr> index  
      index = $(this).parent().parent().index()
      $('#modal-product').modal('show')
      $('.table-product').DataTable({
        retrieve: true,
        serverSide: true,
        processing: true,
        ajax: '/purchases/get-products',
        columns: [
          { data: 'name', name: 'name' },
          { data: 'Action', name: 'action' },
        ]
      })
    })

    $(document).on('click', '.btn-check-product', function() {
      index += 1
      var selector = ".section-purchase tbody tr:nth-child(" + index + ")"
      $(selector + ' .input-product-id').data('value', $(this).data('id')).val($(this).data('name'))
      $('#modal-product').modal('toggle')
    })

    $('.btn-submit').click(function(evt) {
      evt.preventDefault()
      $.ajax({
        url: $(this).data('route'),
        method: 'POST',
        dataType: 'JSON',
        data: $('.section-purchase form').serialize() + '&product_id[]=' + $('.input-product-id').data('value'),
        success: function (res) {
          $('.alert').addClass('d-none');
        },
        error: function (res)  {
          if(res.status == 422) {
            $('.alert .alert-content').html("")
            $('.alert').addClass('show').removeClass('d-none')
            res.responseJSON.forEach(element => {
              $('.alert .alert-content').append("<div>" + element + "</div>")
            });
          }
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
          <h1>New Purchase Data</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('purchase') }}">Purchase</a></li>
            <li class="breadcrumb-item active">New Purchase Data</li>
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

          <!-- Alerts -->
          <div class="alert animated bounceIn shadow-sm alert-light bg-white alert-dismissible d-none" role="alert">
            <div class="alert-content text-danger"></div>
            <button type="button" class="close btn-close-alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- /.Alerts -->

          <div class="card mb-5">
            <div class="card-body">
              <div class="row">

                <!-- Button Choose Supplier -->
                <div class="col-12 py-1">
                  <button class="btn btn-sm btn-success btn-choose-supplier" style="border-radius: 0%" data-toggle="modal" data-target="#modal-supplier">Choose Supplier</button>
                </div>
                <!-- /.Button Choose Supplier -->

                <!-- Supplier Textfied -->
                <div class="col-12 py-1">
                  <ul class="list-group list-group-supplier">
                    <li class="list-group-item text-center py-4 text-muted">No Supplier Selected</li>
                  </ul>
                  <hr>
                </div>
                <!-- /.Supplier Textfied -->

                <!-- Table Product -->
                <div class="col-12 d-none section-purchase">
                  <form action="{{ route('purchase.store') }}" method="POST">
                  <div class="table-responsive">
                    <table class="table table-bordered table-purchase">
                      <thead>
                        <th>Item</th>
                        <th>Price (Rp)</th>
                        <th>Qty</th>
                        <th></th>
                      </thead>
                      <tbody>
                        @csrf
                        <input type="hidden" name="supplier_id" id="input-supplier-id" class="input-supplier-id">
                        @include('purchase.table_product')
                      </tbody>
                    </table>
                  </div>
                  <button type="button" style="border-radius:0%" class="btn btn-sm btn-info btn-add-row"><i class="fas fa-plus"></i> Show More</button>
                  <hr>
                  <button type="submit" style="border-radius:0%" class="btn btn-block btn-primary btn-submit" data-route="{{ route('purchase.store') }}">Submit</button>
                </form>
                </div>
                <!-- /.Table Product -->

              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

  <!-- Modal Product -->
  <div class="modal" tabindex="-1" role="dialog" id="modal-product">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Choose Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <div class="table-responsive">
              <table class="table-product table table-hover table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.Modal Product -->

  <!-- Modal Supplier -->
  <div class="modal" tabindex="-1" role="dialog" id="modal-supplier">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Choose Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <div class="table-responsive">
              <table class="table-supplier table table-hover table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.Modal Supplier -->

</div>
<!-- /.content-wrapper -->
@endsection