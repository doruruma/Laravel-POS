@if ($customers->isEmpty())
    
  <div class="col-12">
    <div class="h1 text-center text-muted d-block" style="margin-top: 100px; margin-bottom: 100px">
      <i class="fas fa-users fa-lg"></i>
      <p>No Customers Found</p>
    </div>
  </div>

@else

  <div class="list-group mb-2">
    @foreach ($customers as $res)
    <a href="#" class="list-group-item list-group-item-action customer-list-group" style="">
      {{ $res->email }} <br>
      <small>{{ $res->name }} - {{ $res->phone }}</small>
    </a>
    @endforeach
  </div>

  <div class="customer-paginate">{{ $customers->links() }}</div>

@endif