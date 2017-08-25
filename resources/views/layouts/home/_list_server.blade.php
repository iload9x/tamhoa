<div class="list-server">
  <div class="panel panel-border-color panel-border-color-success">
    <div class="panel-heading">@lang("servers.list_title")</div>
    <div class="panel-body">
      <ul class="server">
        @if(\App\Helpers\ServerHelper::list_server()->count())
          @foreach(\App\Helpers\ServerHelper::list_server() as $server)
            <li>
              <a href="#{{ $server->server_id }}">
                {{ $server->name }}<span class="pull-right hot">@lang("others.txt_hot")</span>
              </a>
            </li>
          @endforeach
        @endif
      </ul>
    </div>
  </div>
</div>
