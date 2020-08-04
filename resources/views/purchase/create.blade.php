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
      $.ajax({
        url: '/purchases/get-supplier-by-id/' + id,
        method: 'GET',
        success: function(res) {
          $('#modal-supplier').modal('hide')
          $('.list-group-supplier').html(res)
          $('.section-item').removeClass('d-none')
        }
      })
    })

    $('.btn-add-row').click(function() {
      $.ajax({
        url: '/purchases/get-table-item',
        success: function(res) {
          $('.table-item').append(res)
        }
      })
    })

    $(document).on('click', '.btn-remove-row', function() {
      $(this).parent().parent().remove()
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

                <!-- Item Table -->
                <div class="col-12 d-none section-item">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th></th>
                      </thead>
                      <tbody class="table-item">
                        @include('purchase.table_item')
                      </tbody>
                    </table>
                  </div>
                  <button style="border-radius:0%" class="btn btn-sm btn-info btn-add-row"><i class="fas fa-plus"></i> Show More</button>
                </div>
                <!-- /.Item Table -->

              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

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