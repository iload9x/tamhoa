@extends("layouts.application")
@section("title", "Trang chủ")
@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading">HOẠT ĐỘNG HÀNG NGÀY
    @if(Auth::check() && Auth::user()->is_admin())
      @include("home._modal_post")
      <span class="pull-right">
        <button data-toggle="modal" data-target="#md-colored"
          class="btn btn-success">Thêm bài mới</button>
      </span>
    @endif
  </div>
  <div class="panel-body">
    @if($posts->count())
      @foreach($posts as $post)
        @include("posts._post_item")
      @endforeach
    @endif
    {{ $posts->links() }}
  </div>
</div>
@endsection
