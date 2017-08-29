@extends("layouts.application")
@section("title", __("others.register_title"))
@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading">
  <span class="name">@lang("others.register_title")</span>
  </div>
  <div class="panel-body payment">
    <form action="{{ route('register') }}" method="POST"
      class="form-horizontal group-border-dashed create-card-form">
      {{ csrf_field() }}
      @include("layouts._error_alert")
      @include("layouts._success_alert")
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("others.name"):</label>
        <div class="col-sm-6">
          <input type="text" name="name" class="form-control input-sm"
            autofocus="" required data-parsley-minlength="6"
            data-parsley-maxlength="50"
            value="{{ old('name') }}">
          @if ($errors->has("name"))
            <span class="help-block">
              <strong>{{ $errors->first("name") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("others.txt_email"):</label>
        <div class="col-sm-6">
          <input type="email" name="email" class="form-control input-sm"
            required data-parsley-minlength="6" data-parsley-maxlength="50"
            value="{{ old('email') }}">
          @if ($errors->has("email"))
            <span class="help-block">
              <strong>{{ $errors->first("email") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("others.txt_password"):</label>
        <div class="col-sm-6">
          <input type="password" name="password" class="form-control input-sm"
            required data-parsley-minlength="6" data-parsley-maxlength="50"
            value="{{ old('password') }}">
          @if ($errors->has("password"))
            <span class="help-block">
              <strong>{{ $errors->first("password") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">@lang("others.txt_password_confirmation"):</label>
        <div class="col-sm-6">
          <input type="password" name="password_confirmation" class="form-control input-sm"
            required data-parsley-minlength="6" data-parsley-maxlength="50"
            value="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-space btn-success">@lang("buttons.register")</button>
          <button type="reset" class="btn btn-space btn-default">@lang("buttons.cancel")</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

