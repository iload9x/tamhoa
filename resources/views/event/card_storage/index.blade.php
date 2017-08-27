@extends("layouts.application")
@section("title", __("others.card_storage_title"))
@section("content")
@include("home._event_menu")
  <div class="panel panel-border-color panel-border-color-success">
    <div class="panel-heading">@lang("others.card_storage")</div>
    <div class="panel-body">
      @if($card_storage_levels->count())
        <form method="POST" action="{{ route('card_storage_histories.store') }}"
          class="card_storage_form">
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-8 text-center" style="color: #34a853;">
              @if(Session::has("success"))
                <strong>{{ Session::get("success") }}</strong>
              @endif
            </div>
            <div class="col-md-4">
              <select required name="server" class="form-control input-sm">
                <option value="">----@lang("servers.select_server")----</option>
                  @if(\App\Helpers\ServerHelper::all()->count())
                    @foreach(\App\Helpers\ServerHelper::all() as $server)
                      <option value="{{ $server->database }}">{{ $server->name }}</option>
                    @endforeach
                  @endif
              </select>
            </div>
          </div>
          {{ csrf_field() }}
          @foreach($card_storage_levels as $card_storage_level)
            @include("event.card_storage._item")
          @endforeach
        </form>
      @endif
    </div>
  </div>
@endsection
