@extends("admin.layouts.application")
@section("title", __("admin.server_title"))
@section("content")
<div class="col-sm-6">
  <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">Basic Form
      <span class="panel-subtitle">This is the default bootstrap form layout</span>
    </div>
    <div class="panel-body">
      <form action="#" data-parsley-validate="" novalidate="">
        <div class="form-group">
          <label>User Name</label>
          <input type="text" name="nick" parsley-trigger="change"
            required="" placeholder="Enter user name" autocomplete="off" class="form-control input-sm">
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-space btn-primary">Submit</button>
          <button class="btn btn-space btn-default">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section("javascript")
  <script>
  $(document).ready(function() {
    
  });
  </script>
@endsection
