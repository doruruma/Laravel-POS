@extends('layouts.app')

@section('title', 'Laravel POS | Suppliers')

@section('script')
<script>
  $(document).ready(function() {

    $('.purchase').addClass('active')

    // $('.btn-create').click(function() {
    //   $('#form-create .text-danger').html('')
    // })

    $('.btn-detail').click(function() {
      $.ajax({
        url: $(this).data('route'),
        success: function(res) {
          $('#modal-detail .purchase-detail').html(res)
        }
      })
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
                <a href="{{ route('purchase.create') }}" style="border-radius: 0%" class="btn px-4 btn-create btn-sm btn-success"><i class="fas fa-plus"></i> New Purchase</a>
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
                        <button class="btn btn-sm btn-success btn-detail" data-id={{ $purchase->id }} data-route={{ route('purchase.detail', $purchase->id) }} data-toggle="modal" data-target="#modal-detail" style="border-radius:0%"><i class="fas fa-eye"></i></button>
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

  <!-- Detail Model -->
  <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Purchase Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5 purchase-detail">

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.Detail Model -->

</div>
<!-- /.content-wrapper -->
@endsection