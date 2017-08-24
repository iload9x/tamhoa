@extends("layouts.application")
@section("title", "Nạp thẻ")
@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading">
  <span class="name">NẠP THẺ</span>
  </div>
  <div class="panel-body payment">
    <form action="{{ route('cards.store') }}" method="POST"
      class="form-horizontal group-border-dashed create-card-form">
      {{ csrf_field() }}
      @if($errors->has('card'))
      <div class="form-group{{ $errors->has('card') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
          @if ($errors->has("card"))
            <span class="help-block">
              <strong>{{ $errors->first("card") }}</strong>
            </span>
          @endif
        </div>
      </div>
      @endif
      @if(Session::has("success"))
      <div class="form-group has-success">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
            <span class="help-block">
              <strong>{{ Session::get('success') }}</strong>
            </span>
        </div>
      </div>
      @endif
      <div class="form-group{{ $errors->has('telcoCode') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Chọn nhà mạng:</label>
        <div class="col-sm-6">
          <select required name="card[telcoCode]"
            class="select_server form-control input-sm">
            <option value="">----Chọn nhà mạng----</option>
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
        <label class="col-sm-3 control-label">Serial:</label>
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
        <label class="col-sm-3 control-label">Mã thẻ:</label>
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
          <button type="submit" class="btn btn-space btn-success btn-ok">Nạp thẻ</button>
          <button type="reset" class="btn btn-space btn-default">Hủy</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
