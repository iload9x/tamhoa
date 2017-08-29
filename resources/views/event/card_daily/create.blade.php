@extends("layouts.application")
@section("title", __("others.payment_daily_title"))
@section("content")
  @include("home._event_menu")
  <div class="panel panel-border-color panel-border-color-success">
    <div class="panel-heading">@lang("others.payment_daily")</div>
    <div class="panel-body">
      <form method="POST" action="{{ route('card_daily.store') }}"
        class="card_storage_form">
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-8 text-center">
            @if(Session::has("success"))
              <strong style="color: #34a853;">{{ Session::get("success") }}</strong>
            @endif
            @if($errors->has("errors"))
              <strong style="color: red;">{{ $errors->first("errors") }}</strong>
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
        <ul class="list-group">
          @if($props)
            @foreach($props->get() as  $prop)
              <li class="list-group-item item_quanlity_{{ $prop->item->quanlity }}">
                <b>{{ $prop->item->name }} </b>
                <span class="badge">{{ $prop->quantity }}</span>
              </li>
            @endforeach
          @endif
        </ul>
        @include("event.card_daily._buttons")
      </form>
    </div>
  </div>
@endsection
