@extends("layouts.application")
@section("title", __("coins.create.title"))
@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading">@lang("coins.create.name")</div>
  <div class="panel-body doi-xu" username="{{ Auth::user()->email }}">
    <form action="{{ route('coin.store') }}" style="border-radius: 0px;"
      class="form-horizontal group-border-dashed create-coin-form" method="POST">
      {{ csrf_field() }}
      @include("layouts._error_alert")
      @include("layouts._success_alert")
      <div class="form-group{{ $errors->has('server') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("servers.select_server"):</label>
        <div class="col-sm-6">
          <select name="server" class="select_server form-control input-sm" required="">
            <option value="">----@lang("servers.select_server")----</option>
            @if($servers->count())
              @foreach($servers as $server)
              <option value="{{ $server->database }}">{{ $server->name }}</option>
              @endforeach
            @endif
          </select>
          @if ($errors->has("server"))
            <span class="help-block">
              <strong>{{ $errors->first("server") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('player') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("players.name"):</label>
        <div class="col-sm-6">
          <input type="text" value="@lang('players.not_create_player')"
            class="form-control input-sm player-name" readonly >
          @if ($errors->has("player"))
            <span class="help-block">
              <strong>{{ $errors->first("player") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("others.enter_quantity"):</label>
        <div class="col-sm-6">
          <input type="number" name="quantity" value="0"
            class="form-control input-sm">
          @if ($errors->has("quantity"))
            <span class="help-block">
              <strong>{{ $errors->first("quantity") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-space btn-success btn-ok" disabled="">@lang("buttons.agree")</button>
          <button type="reset" class="btn btn-space btn-default">@lang("buttons.cancel")</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
