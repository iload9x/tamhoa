<div class="col-sm-4">
  <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">@lang("admin.new_server")
    </div>
    <div class="panel-body be-loading">
      <form action="{{ route('admin.servers.store') }}" data-parsley-validate="" novalidate=""
        class="new-server-form" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label>@lang("admin.server_name"):</label>
          <input type="text" name="server[name]" parsley-trigger="change" required=""
            placeholder="@lang('admin.server_name')" class="form-control input-sm"
            data-parsley-length="[6,50]" autofocus="">
        </div>
        <div class="form-group">
          <label>@lang("admin.server_port"):</label>
          <input type="number" name="server[port]" parsley-trigger="change"
            required=""
            data-parsley-length="[2,4]"
            placeholder="@lang('admin.server_port')" class="form-control input-sm">
        </div>
        <div class="form-group">
          <label>@lang("admin.server_id"):</label>
          <input type="number" name="server[server_id]" parsley-trigger="change"
            required=""
            data-parsley-length="[1,4]"
            placeholder="@lang('admin.server_id')" class="form-control input-sm">
        </div>
        <div class="form-group">
          <label>@lang("admin.server_database"):</label>
          <input type="text" name="server[database]" parsley-trigger="change"
            required=""
            data-parsley-length="[2,50]"
            placeholder="@lang('admin.server_database')" class="form-control input-sm">
        </div>
        <div class="form-group">
          <label>@lang("admin.time_open"):</label>
          <input type="text" name="server[time_open]" data-mask="datetime" parsley-trigger="change" required=""
            placeholder="DD/MM/YYYY HH:MM:SS" class="form-control input-sm">
        </div>
        <div class="form-group">
          <label>@lang("admin.time_close"):</label>
          <input type="text" name="server[time_close]" data-mask="datetime" parsley-trigger="change" required=""
            placeholder="DD/MM/YYYY HH:MM:SS" class="form-control input-sm">
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-space btn-primary">@lang("buttons.add")</button>
          <button class="btn btn-space btn-default btn-reset" type="reset">@lang("buttons.cancel")</button>
        </div>
      </form>
      <div class="be-spinner">
        <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
          <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
        </svg>
      </div>
    </div>
  </div>
</div>
