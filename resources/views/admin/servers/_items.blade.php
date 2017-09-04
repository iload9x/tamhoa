<div class="list-server be-loading">
  <table class="table table-striped table-borderless">
    <thead>
      <tr>
        <th style="">@lang("admin.server_name")</th>
        <th class="number">@lang("admin.server_port")</th>
        <th class="number">@lang("admin.server_id")</th>
        <th class="">@lang("admin.server_database")</th>
        <th class="">@lang("admin.time_open")</th>
        <th class="">@lang("admin.time_close")</th>
        <th class="actions"></th>
      </tr>
    </thead>
    <tbody class="no-border-x">
      @if($servers->count())
        @foreach($servers as $server)
          <tr class="server-item" server-id="{{ $server->id }}" server-url="{{ route('admin.servers.destroy', $server) }}">
            <td>
              <a href="#" class="my-editable" data-title="@lang('admin.server_name')">{{ $server->name }}</a>
            </td>
            <td class="number">
              <a href="#" class="my-editable" data-type="text" data-name="port"
                data-title="@lang('admin.server_port')">{{ $server->port }}</a>
            </td>
            <td class="number">
              <a href="#" class="my-editable" data-title="@lang('admin.server_id')">{{ $server->server_id }}</a>
            </td>
            <td class="">
              <a href="#" class="my-editable" data-title="@lang('admin.server_database')">{{ $server->database }}</a>
            </td>
            <td class="">
              <a href="#" class="my-editable" data-title="@lang('admin.time_open')">{{ $server->time_open }}</a>
            </td>
            <td class="">
              <a href="#" class="my-editable" data-title="@lang('admin.time_close')">{{ $server->time_close }}</a>
            </td>
            <td class="actions">
              <a href="#" class="icon"><i class="mdi mdi-delete btn-delete"></i></a>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="7" class="text-center">Không có dữ liệu.</td>
        </tr>
      @endif
    </tbody>
  </table>
  <div class="text-center">{{ $servers->links() }}</div>
  <div class="be-spinner">
    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
      <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
    </svg>
  </div>
</div>
