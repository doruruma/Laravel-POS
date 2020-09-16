<tr>
  <td style="width: 40%">
    <input type="text" name="product[]" id="input-product" class="input-product form-control" data-id="" readonly>
    <input type="text" name="product_id[]" id="input-product-id" class="input-product-id d-none">
  </td>
  <td style="width: 20%">
    <input type="number" name="price[]" id="input-price" class="form-control input-price" required>
  </td>
  <td style="width: 15%">
    <center>
      <input type="number" name="qty[]" id="input-qty" class="d-none input-qty" value="1" min="1" required>
      <div class="btn-group" role="group" data-qty="1">
        <button type="button" class="btn btn-sm btn-qty">1</button>
        <button type="button" class="btn btn-min-qty btn-sm btn-info" data-route={{ route('purchase.min-qty') }}><i class="fas fa-xs fa-minus"></i></button>
        <button type="button" class="btn btn-add-qty btn-sm btn-info" data-route={{ route('purchase.add-qty') }}><i class="fas fa-xs fa-plus"></i></button>
      </div>
    </center>
  </td>
  <td style="width: 15%">
    <p class="text-subtotal">Rp</p>
  </td>
  <td class="text-center">
    <button type="button" class="btn btn-flat btn-sm btn-danger btn-remove-row"><i class="fas fa-times"></i></button>
  </td>
</tr>