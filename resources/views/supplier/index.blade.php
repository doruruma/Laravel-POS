@extends('layouts.app')

@section('title', 'Laravel POS | Suppliers')

@section('script')
<script>
  $(document).ready(function() {

    $('.supplier').addClass('active')

    $('.btn-delete').click(function(evt) {
      evt.preventDefault()
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Yakin Hapus Data?',
        icon: 'warning',
        showCancelButton: true
      }).then((res) => {
        res.value ? $(this).parent().submit() : false
      })
    })

    $('.btn-edit').click(function() {
      $('#form-edit .text-danger').html('')
      $('#form-edit').attr('action', '/suppliers/' + $(this).data('id'))
      $.ajax({
        url: '/api/suppliers/' + $(this).data('id'),
        method: 'GET',
        dataType: 'JSON',
        success: function(res) {
          $('#modal-edit #name').val(res.name)
          $('#modal-edit #email').val(res.email)
          $('#modal-edit #address').val(res.address)
          $('#modal-edit #phone').val(res.phone)
        }
      })
    })

    $('#form-edit').submit(function(evt) {
      evt.preventDefault();
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
            document.location.href = '/suppliers'
          })
        },
        error: function(res) {
          if (res.status == 422) {
            $('#form-edit .name-error').html(res.responseJSON.name)
            $('#form-edit .address-error').html(res.responseJSON.address)
            $('#form-edit .phone-error').html(res.responseJSON.phone[0])
          }
        }
      })
    })

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
          <h1>Suppliers List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Suppliers</li>
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
                <button style="border-radius: 0%" class="btn px-4 btn-create btn-sm btn-success" data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i> Register New Suppliers</button>
                <button style="border-radius: 0%" class="btn px-4 btn-sm btn-success"><i class="fas fa-print"></i></button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th class="text-center text-primary"><i class="fas fa-cogs"></i></th>
                  </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($suppliers as $supplier)
                    <tr>
                      <th>{{ $i }}</th>
                      <td>{{ ucwords($supplier->name) }}</td>
                      <td>{{ $supplier->address }}</td>
                      <td>{{ $supplier->phone }}</td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-edit text-info" data-id="{{ $supplier->id }}" data-toggle="modal" data-target="#modal-edit"><i class="far fa-edit"></i></button>
                        <form action={{ route('supplier.delete', ['supplier' => $supplier]) }} method="POST" class="d-inline">
                          @csrf @method('DELETE')
                          <button class="btn btn-sm btn-delete text-danger"><i class="far fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              {{ $suppliers->links() }}
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
          <h5 class="modal-title">Edit the supplier data</h5>
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
                <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                <small class="text-danger name-error"></small>
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" rows="6" style="resize:none"></textarea>
                <small class="text-danger address-error"></small>
              </div>

              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" autocomplete="off">
                <small class="text-danger phone-error"></small>
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

  <!-- Create Modal -->
  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border:none">
          <h5 class="modal-title">Register Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-5">
            <form action={{ route('supplier.store') }} method="POST" id="form-create">
            
              @csrf

              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                <small class="text-danger name-error"></small>
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" rows="6" style="resize:none"></textarea>
                <small class="text-danger address-error"></small>
              </div>

              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" autocomplete="off">
                <small class="text-danger phone-error"></small>
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
  <!-- /.Create Modal -->

</div>
<!-- /.content-wrapper -->
@endsection