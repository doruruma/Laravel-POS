<center>
  <button class="btn btn-flat btn-sm btn-success btn-detail" data-id={{ $purchases->id }} data-route={{ route('purchase.detail', $purchases->id) }} data-toggle="modal" data-target="#modal-detail"><i class="fas fa-eye"></i></button>
  <a href="{{ route('purchase.generate-detail-pdf', $purchases->id) }}" class="btn btn-flat btn-sm btn-primary btn-print"><i class="fas fa-print"></i></a>
</center>