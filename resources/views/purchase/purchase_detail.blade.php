<table class="table table-hover table-bordered">
  
  <thead>
    <th>Item</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Subtotal</th>
  </thead>

  <tbody>
    @foreach ($details as $detail)
      <tr>
        <td>{{ $detail->product->name }}</td>
        <td>Rp {{ number_format($detail->product->price) }}</td>
        <td>{{ $detail->qty }}</td>
        <td>Rp {{ number_format($detail->subtotal) }}</td>
      </tr>
    @endforeach
  </tbody>

</table>

<button class="float-right btn btn-success h5" aria-disabled="true" disabled>
  Total : Rp {{ number_format($total) }}
</button>