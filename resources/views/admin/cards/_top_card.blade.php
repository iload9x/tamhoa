<div class="col-md-6">
  <div class="panel panel-default panel-table">
    <div class="panel-heading">
      <div class="tools dropdown">
        <span class="icon mdi mdi-download"></span>
        <a href="#" type="button" data-toggle="dropdown" class="dropdown-toggle">
          <span class="icon mdi mdi-more-vert"></span>
        </a>
        <ul role="menu" class="dropdown-menu pull-right">
          <li>
            <a href="#">Action</a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">Separated link</a>
          </li>
        </ul>
      </div>
      <div class="title">@lang("admin.top_card")</div>
    </div>
    <div class="panel-body table-responsive">
      @include("admin.cards._top_card_items")
    </div>
  </div>
</div>
