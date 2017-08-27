@extends("layouts.post_image")
@section("title", $post->name)
@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading header-post-detail">
  <span class="name">{{ $post->name }}</span>
  </div>
  <div class="panel-body post-detail">
    <p>
      <a href="{{ route('categories.show', $post->category) }}">
        <span class="category-name">{{ $post->category->name }}</span>
      </a>
      <span class="pull-right time-created">{{ $post->created_at->diffForHumans() }}</span>
    </p>
    <div>
      {!! $post->content !!}
    </div>
  </div>
</div>
@endsection
