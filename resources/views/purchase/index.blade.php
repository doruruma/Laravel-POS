@extends('layouts.app')

@section('title', 'Laravel POS | Suppliers')

@section('script')
<script>
  $(document).ready(function() {

    $('.purchase').addClass('active')

    $('.btn-create').click(function() {
      $('#form-create .text-danger').html('')
    })

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
            document.location.href = '/suppliers'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            $('#form-create .name-error').html(res.responseJSON.name)
            $('#form-create .address-error').html(res.responseJSON.address)
            $('#form-create .phone-error').html(res.responseJSON.phone[0])
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
          <h1>Stock Purchase</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Stock Purchase</li>
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
          <div class="card" style="border-radius: 0%">
            <div class="card-header bg-light">
              <div class="d-flex justify-content-between">
                <button style="border-radius: 0%" class="btn px-4 btn-create btn-sm btn-success" data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i> New Purchase</button>
                {{-- <button style="border-radius: 0%" class="btn px-4 btn-sm btn-success"><i class="fas fa-print"></i></button> --}}
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>Total</th>
                    <th class="text-center text-primary"><i class="fas fa-cogs"></i></th>
                  </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($purchases as $purchase)
                    <tr>
                      <th>{{ $i }}</th>
                      <td>{{ date('d-m-Y', strtotime($purchase->created_at)) }}</td>
                      <td>{{ $purchase->supplier->name }}</td>
                      <td>Rp {{ number_format($purchase->total) }}</td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-success btn-detail" data-toggle="modal" data-target="#modal-detail" style="border-radius:0%"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-primary btn-print" style="border-radius:0%"><i class="fas fa-print"></i></button>
                      </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              {{ $purchases->links() }}
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
  <!-- /.Main content -->

  <!-- Create Modal -->
  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">New Purchase</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <form action="" method="POST" id="form-create">
            
              @csrf

              <div class="form-group">
                <label for="name">Suppliers</label>
                <select name="supplier" id="supplier" class="form-control">
                  <option value="" selected disabled>Choose Suppliers</option>
                  @foreach ($suppliers as $supplier)
                    <option value={{ $supplier->id }}>{{ $supplier->name }}</option>
                  @endforeach
                </select>
                <small class="text-danger name-error"></small>
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="resize:none"></textarea>
                <small class="text-danger description-error"></small>
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <!-- /.Create Modal -->

</div>
<!-- /.content-wrapper -->
@endsection