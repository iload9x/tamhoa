@extends("layouts.application")
@section("title", __("cards.create.title"))
@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading">
  <span class="name">@lang("cards.create.name")</span>
  </div>
  <div class="panel-body payment">
    <form action="{{ route('cards.store') }}" method="POST"
      class="form-horizontal group-border-dashed create-card-form">
      {{ csrf_field() }}
      @include("layouts._error_alert")
      @include("layouts._success_alert")
      <div class="form-group{{ $errors->has('telcoCode') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("cards.create.telco"):</label>
        <div class="col-sm-6">
          <select required name="card[telcocode]"
            class="select_server form-control input-sm">
            <option value="">----@lang("cards.create.telco")----</option>
            <option value="VTT">Thẻ Vietel</option>
            <option value="VMS">Thẻ Mobifone</option>
            <option value="VNP">Thẻ Vinaphone</option>
            <option value="MGC">Thẻ Megacard</option>
            <option value="FPT">Thẻ Gate</option>
            <option value="ZING">Thẻ ZING</option> 
            <option value="ONC">Thẻ Oncash</option> 
          </select>
          @if ($errors->has("telcoCode"))
            <span class="help-block">
              <strong>{{ $errors->first("telcoCode") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('serial') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("cards.create.serial"):</label>
        <div class="col-sm-6">
          <input type="text" name="card[serial]" class="form-control input-sm"
            autofocus="" required data-parsley-minlength="6"
            data-parsley-maxlength="20"
            value="{{ old('card')['serial'] }}">
          @if ($errors->has("serial"))
            <span class="help-block">
              <strong>{{ $errors->first("serial") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">@lang("cards.create.pin"):</label>
        <div class="col-sm-6">
          <input type="text" name="card[pin]" class="form-control input-sm"
            required data-parsley-minlength="6" data-parsley-maxlength="20"
            value="{{ old('card')['pin'] }}">
          @if ($errors->has("pin"))
            <span class="help-block">
              <strong>{{ $errors->first("pin") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-space btn-success btn-ok">@lang("buttons.payment")</button>
          <button type="reset" class="btn btn-space btn-default">@lang("buttons.cancel")</button>
        </div>
      </div>
    </form>
    @include("cards._histories")
  </div>
</div>
@endsection

@section("javascript")
<script>
  $(document).ready(function() {
    $('body').on('click', '.pagination a', function() {
      $thisbutton = $(this);
      var page = $thisbutton.attr('href');

      $.ajax({
        url: page,
        type: 'GET',
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (result) {
          if (result.status) {
            $thisbutton.parents('.card_histories').replaceWith(result.html);
          }
        }
      });

      return false;
    });
  });
</script>
@endsection
