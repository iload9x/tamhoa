@extends("layouts.application")
@section("title", __("others.home_title"))
@section("content")
@include("home._event_menu")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading">@lang("others.daily_activity")
    @if(Auth::user() && Auth::user()->is_admin())
      @include("home._modal_post")
      <span class="pull-right">
        <button data-toggle="modal" data-target="#md-colored"
          class="btn btn-success">@lang("posts.new_post")</button>
      </span>
    @endif
  </div>
  <div class="panel-body">
    <div>
      <div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
        <div class="icon">
          <span class="mdi mdi-info-outline"></span>
        </div>
        <div class="message">
          <button type="button" data-dismiss="alert" aria-label="Close" class="close">
            <span aria-hidden="true" class="mdi mdi-close"></span>
          </button>
          <strong>Sự kiện: </strong> Nạp thẻ lần đầu nhận ngay 100.000 điểm tích lũy.
          <a href="{{ route('cards.create')}}">Nạp ngay</a>
        </div>
      </div>
    </div>
    @if($posts->count())
      @foreach($posts as $post)
        @include("posts._post_item")
      @endforeach
    @endif
    {{ $posts->links() }}
  </div>
</div>
@endsection
