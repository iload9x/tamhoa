<div class="col-sm-9">
  <div class="panel panel-default panel-table">
    <div class="panel-heading">@lang("admin.list_card")
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
    </div>
    <div class="panel-body">
      @include("admin.cards._items")
    </div>
  </div>
</div>
