@extends('layouts.app')

@section('title', 'Laravel POS | Add Product')

@section('script')
<script>
  $(document).ready(function() {

    $('.product').addClass('active');

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
          <h1>Add Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product') }}">Products</a></li>
            <li class="breadcrumb-item active">Add Product</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="card mb-5">
        <div class="card-body">
          <form action="{{ route('product.store') }}" method="POST">
            
            @csrf

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{ old('name') }}">
              <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="resize:none">{{ old('description') }}</textarea>
              <small class="text-danger">{{ $errors->first('description') }}</small>
            </div>

            <div class="row">

              <div class="col-4">
                <div class="form-group">
                  <label for="category">Category</label>
                  <select name="category_id" id="category" class="custom-select">
                    <option value="" selected disabled>Choose</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('category_id') }}</small>
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
                  <small class="text-danger">{{ $errors->first('stock') }}</small>
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <label for="price">Price (Rp)</label>
                  <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
                  <small class="text-danger">{{ $errors->first('price') }}</small>
                </div>
              </div>

            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>
        </div>
        <div class="card-footer">
          Footer
        </div>
      </div>

    </div>

  </section>
  <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
@endsection