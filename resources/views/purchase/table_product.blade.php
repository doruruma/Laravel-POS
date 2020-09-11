<tr>
  <td style="width: 40%">
    <input type="text" name="product[]" id="input-product" class="input-product form-control" data-id="" readonly>
    <small class="text-danger product_id-errors"></small>
    <input type="text" name="product_id[]" id="input-product-id" class="input-product-id d-none">
  </td>
  <td style="width: 20%">
    <input type="number" name="price[]" id="input-price" class="form-control input-price" required>
    <small class="text-danger price-errors"></small>
  </td>
  <td style="width: 10%">
    <input type="number" name="qty[]" id="input-qty" class="form-control input-qty" min="1" required>
    <small class="text-danger qty-errors"></small>
  </td>
  <td style="width: 20%">
    <p class="text-subtotal">Rp</p>
  </td>
  <td class="text-center">
    <button type="button" style="border-radius: 0%" class="btn btn-sm btn-danger btn-remove-row"><i class="fas fa-times"></i></button>
  </td>
</tr>