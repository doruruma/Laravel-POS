@extends('layouts.app')

@section('title', 'Laravel POS | Products')

@section('plugin')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <script type="text/javascript" src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('script')
<script>
  $(document).ready(function() {

    $('.product').addClass('active');

    $('.table').DataTable({
      autoWidth: false,
      retrieve: true,
      processing: true,
      serverSide: true,
      ajax: '/products',
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'name', name: 'name' },
        { data: 'description', name: 'description' },
        { data: 'category', name: 'category' },
        { data: 'stock', name: 'stock' },
        { data: 'Price', name: 'Price' },
        { data: 'Action', name: 'Action', orderable: false, searchable: false },
      ]
    })

    $(document).on('click', '.btn-delete', function(evt) {
      evt.preventDefault();
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Yakin Hapus Data?',
        icon: 'warning',
        showCancelButton: true
      }).then((res) => {
        res.value ? $(this).parent().submit() : false
      })
    })

    $(document).on('click', '.btn-edit', function(evt) {
      $('#form-edit .text-danger').html('')
      $('#form-edit').attr('action', '/products/' + $(this).data('id'));
      $.ajax({
        url: '/api/products/' + $(this).data('id'),
        method: 'GET',
        dataType: 'JSON',
        success: function(res) {
          $('#modal-edit #name').val(res.name)
          $('#modal-edit #description').val(res.description)
          $('#modal-edit #category').val(res.category_id)
          $('#modal-edit #stock').val(res.stock)
          $('#modal-edit #price').val(res.price)
        }
      })
    })

    $('#form-edit').submit(function(evt) {
      evt.preventDefault()
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        method: 'POST',
        success: function(res) {
          Swal.fire({
            title: 'SUCCESS',
            text: 'Berhasil Update Data',
            icon: 'success'
          }).then((res) => {
            document.location.href = '/products'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            $('.name-error').html(res.responseJSON.name)
            $('.description-error').html(res.responseJSON.description)
            $('.stock-error').html(res.responseJSON.stock)
            $('.price-error').html(res.responseJSON.price)
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
          <h1>Products</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Product</li>
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
          <div class="card" style="border-radius:0%">
            <div class="card-header bg-light">
              <div class="d-flex justify-content-between">
                <a href="{{ route('product.create') }}" class="btn btn-flat px-4 btn-sm btn-success"><i class="fas fa-plus"></i> Add Product</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Stock</th>
                      <th>Price</th>
                      <th class="text-center text-primary"><i class="fas fa-cogs"></i></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

  <!-- Edit Modal -->
  <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <form action="" method="POST" id="form-edit">
            
              @csrf

              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
                <small class="text-danger name-error"></small>
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="resize:none"></textarea>
                <small class="text-danger description-error"></small>
              </div>

              <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="custom-select">
                  <option value="" selected disabled>Choose</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                <small class="text-danger category-error"></small>
              </div>

              <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control">
                <small class="text-danger stock-error"></small>
              </div>

              <div class="form-group">
                <label for="price">Price (Rp)</label>
                <input type="number" name="price" id="price" class="form-control">
                <small class="text-danger price-error"></small>
              </div>
            
          </div>
        </div>
        <div class="modal-footer" style="border:none">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <!-- /.Edit Modal -->

</div>
<!-- /.content-wrapper -->
@endsection