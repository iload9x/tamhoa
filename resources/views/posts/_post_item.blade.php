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
  @include("posts._buttons")
</div>
