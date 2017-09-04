@if(Auth::check() && Auth::user()->is_admin())
  <div class="col-md-12 post-tool-bar">
    <span class="pull-right">
      <button type="button"  data-toggle="dropdown" class="btn btn-default">
        <i class="icon mdi mdi-globe"></i>
      </button>
      <ul role="menu" class="dropdown-menu">
        <li class="post-status" value="1"><a>@lang("others.public")</a></li>
        <li class="post-status" value="0"><a>@lang("others.hide")</a></li>
      </ul>
      <button type="button" class="btn btn-default post-edit">
        <i class="icon mdi mdi-edit"></i>
      </button>
      <button type="button" class="btn btn-default post-delete"
        onclick="event.preventDefault();
        document.getElementById('delete-post').submit();">
        <i class="icon mdi mdi-delete"></i>
      </button>
      {{ Form::open(["method" => "DELETE", "route" => ["posts.destroy", $post], "id" => "delete-post"]) }}
      {{ Form::close() }}
    </span>
  </div>
@endif
