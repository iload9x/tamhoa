<div class="list-server">
  <div class="panel panel-border-color panel-border-color-success">
    <div class="panel-heading">
      <span>@lang("servers.list_title")</span>
      @if(Auth::check() && Auth::user()->is_admin())
      <span class="pull-right color-34a853">
        <i class="mdi mdi-plus-square"></i>
      </span>
      @endif
    </div>
    <div class="panel-body">
      <ul class="server">
        @if(\App\Helpers\ServerHelper::list_server()->count())
          @foreach(\App\Helpers\ServerHelper::list_server() as $server)
            <li>
              <a href="{{ $server->url }}">
                {{ $server->name }}<span class="pull-right hot">@lang("others.txt_hot")</span>
              </a>
            </li>
          @endforeach
        @endif
      </ul>
    </div>
  </div>
</div>
