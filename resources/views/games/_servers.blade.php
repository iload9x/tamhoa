<div class="row">
  @if(count($servers))
    @foreach($servers as $server)
      <div class="col-md-4" style="margin-bottom: 10px;">
        <a href="{{ $server->url }}" class="btn btn-block btn-success">{{ $server->name }}</a>
      </div>
    @endforeach
  @else
  <div class="col-md-12 text-center" style="margin-bottom: 10px;">
    Không có server nào.
  </div>
  @endif
</div>
