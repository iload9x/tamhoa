@extends("layouts.application")
@section("title", $category->name)
@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading header-category-detail">
  <span class="name">{{ $category->name }}</span>
  </div>
  <div class="panel-body category-detail">
    @if($posts->count())
      @foreach($posts as $post)
        @include("posts._post_item")
      @endforeach
    @endif
    {{ $posts->links() }}
  </div>
</div>
@endsection
