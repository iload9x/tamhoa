<div class="row post-item">
  <div class="col-md-3 left">
    <a href="">
      <img src="/{{ \App\Helpers\AssetHelper::path() }}avatars/{{ $post->avatar }}" alt="">
    </a>
  </div>
  <div class="col-md-9 right">
    <p class="title">
      <span><a href="{{ route('posts.show', [str_slug($post->name, '-'), $post]) }}"><b>{{ $post->name }}</b></a></span>
      <span class="pull-right">
        <span>{{ $post->created_at->diffForHumans() }}</span>
      </span>
    </p>
    <p class="desc">
      {{ str_limit(strip_tags($post->content), 350) }}
    </p>
  </div>
  @if(Auth::check() && Auth::user()->is_admin())
    <div class="col-md-12 post-tool-bar">
      <span class="pull-right">
        <button type="button"  data-toggle="dropdown" class="btn btn-default">
          <i class="icon mdi mdi-globe"></i>
        </button>
        <ul role="menu" class="dropdown-menu">
          <li><a>@lang("others.public")</a></li>
          <li><a>@lang("others.hide")</a></li>
        </ul>
        <button type="button" class="btn btn-default">
          <i class="icon mdi mdi-edit"></i>
        </button>
        <button type="button" class="btn btn-default">
          <i class="icon mdi mdi-delete"></i>
        </button>
      </span>
    </div>
  @endif
</div>
