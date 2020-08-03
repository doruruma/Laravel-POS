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
        processing: true,
        serverSide: true,
        ajax: '/purchases/get-supplier',
        columns: [
          // { data: '#', name: 'data' },
          { data: 'name', name: 'name' },
          { data: 'address', name: 'address' },
          { data: 'phone', name: 'phone' },
          { data: 'action', content: 'a' }
        ]
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
          <div class="card mb-5">
            <div class="card-body">
              <button class="btn btn-sm btn-success btn-choose-supplier" style="border-radius: 0%" data-toggle="modal" data-target="#modal-supplier">Choose Supplier</button>
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
            <table class="table-supplier table table-hover table-bordered table-striped">
              <thead>
                {{-- <th>#</th> --}}
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Action</th>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer" style="border:none">
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.Modal Supplier -->

</div>
<!-- /.content-wrapper -->
@endsection