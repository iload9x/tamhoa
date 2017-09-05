<div class="panel panel-border-color panel-border-color-success post-item"
  post-id="{{ $post->id }}">
  <div class="panel-heading header-post-detail">
    <span class="post-name">{{ $post->name }}</span>
  </div>
  <div class="panel-body post-detail">
    <div class="row" style="margin-bottom: 5px;">
      @include("posts._buttons")
    </div>
    <p>
      <a href="{{ route('categories.show', [str_slug($post->category->name, '-'), $post->category]) }}">
        <span class="category-name">{{ $post->category->name }}</span>
      </a>
      <span class="pull-right time-created">{{ $post->created_at->diffForHumans() }}</span>
    </p>
    <div class="post-content">
      {!! $post->content !!}
    </div>
    <div class="post-buttons" style="display: none;">
      <button class="btn btn-primary post-update">@lang("buttons.update")</button>
      <button class="btn btn-default post-cancel">@lang("buttons.cancel")</button>
    </div>
  </div>
</div>
