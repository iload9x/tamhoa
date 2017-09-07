<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading panel-heading-divider">
        <div class="tools">
          <span class="icon mdi mdi-chevron-down"></span>
          <span class="icon mdi mdi-refresh-sync"></span>
          <span class="icon mdi mdi-close"></span>
        </div>
        <span class="title">@lang("admin.chart")</span>
      </div>
      <div class="panel-body card-chart">
        <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-6">
            <div class="reportrange pull-right"><i class="mdi mdi-calendar"></i><span></span><b class="caret"></b></div>
          </div>
        </div>
        @include("admin.cards._chart_data")
      </div>
    </div>
  </div>
  @include("admin.cards._top_card")
</div>
