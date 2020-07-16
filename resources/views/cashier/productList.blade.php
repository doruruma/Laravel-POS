@if ($result->isEmpty())
    
<div class="col-12">
  <div class="h1 text-center text-muted d-block" style="position:relative; top:100px">
    <i class="fas fa-file fa-lg"></i>
    <p>Oops! Product Not Found</p>
  </div>
</div>

@else

<ul class="list-group">
  @foreach ($result as $product)
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
<div class="product-paginate">{{ $result->links() }}</div>

@endif
