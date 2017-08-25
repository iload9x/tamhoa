@if($errors->has("errors"))
<div class="form-group has-error">
  <label class="col-sm-3 control-label"></label>
  <div class="col-sm-6">
    @foreach($errors->get("errors") as $error)
      <span class="help-block">
        <strong>{{ $error }}</strong>
      </span>
    @endforeach
  </div>
</div>
@endif
