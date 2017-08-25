@if(Session::has("success"))
<div class="form-group has-success">
  <label class="col-sm-3 control-label"></label>
  <div class="col-sm-6">
      <span class="help-block">
        <strong>{{ Session::get("success") }}</strong>
      </span>
  </div>
</div>
@endif
