<div class="list-group">
  @foreach ($result as $res)
  <a href="#" class="list-group-item list-group-item-action" style="">
    {{ $res->email }} <br>
    <small>{{ $res->name }} - {{ $res->phone }}</small>
  </a>
  @endforeach
</div>