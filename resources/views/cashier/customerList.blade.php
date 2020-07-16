<div class="list-group mb-2">
  @foreach ($result as $res)
  <a href="#" class="list-group-item list-group-item-action" style="">
    {{ $res->email }} <br>
    <small>{{ $res->name }} - {{ $res->phone }}</small>
  </a>
  @endforeach
</div>
<div class="customer-paginate">{{ $result->links() }}</div>