@extends("layouts.application")

@section("content")
<div class="panel panel-border-color panel-border-color-success">
  <div class="panel-heading">ĐỔI XU</div>
  <div class="panel-body doi-xu" username="{{ Auth::user()->email }}">
    <form action="{{ route('coin.store') }}" style="border-radius: 0px;"
      class="form-horizontal group-border-dashed" method="POST">
      {{ csrf_field() }}
      @if($errors->has('coin'))
      <div class="form-group{{ $errors->has('coin') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
          @if ($errors->has("coin"))
            <span class="help-block">
              <strong>{{ $errors->first("coin") }}</strong>
            </span>
          @endif
        </div>
      </div>
      @endif
      <div class="form-group{{ $errors->has('server') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Chọn server:</label>
        <div class="col-sm-6">
          <select name="server" class="select_server form-control input-sm">
            <option value="">----Chọn máy chủ----</option>
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
        <label class="col-sm-3 control-label">Tên nhân vật:</label>
        <div class="col-sm-6">
          <input type="text" value="Chưa tạo nhân vật"
            class="form-control input-sm player-name" readonly >
          @if ($errors->has("player"))
            <span class="help-block">
              <strong>{{ $errors->first("player") }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Nhập số lượng:</label>
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
          <button type="submit" class="btn btn-space btn-success btn-ok" disabled="">Đồng ý</button>
          <button type="reset" class="btn btn-space btn-default">Hủy</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
