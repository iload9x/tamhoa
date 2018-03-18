<div class="row">
  @if($games->count())
    @foreach($games as $game)
      <div class="col-md-4 game-item">
        <div class="panel panel-border-color panel-border-color-success">
          <div class="panel-heading">{{ $game->name }}</div>
          <div class="panel-body">
            <div class="content-game-item">
              <img src="{{ $game->avatar }}" style="width: 100%; height: 212px">
            </div>
            <a data-toggle="modal" data-target="#list-server" url="/games/{{ $game->id }}"
              class="show-list-server btn btn-block btn-success">CHƠI NGAY</a>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>
<style>
  .content-game-item {
    padding: 4px;
    border: 1px solid #34a853;
  }
</style>
<div id="list-server" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
  <div class="full-width modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="padding: 13px 20px;">
        <button type="button" data-dismiss="modal"
          aria-hidden="true" class="close">
          <span class="mdi mdi-close"></span>
        </button>
        <h3 class="modal-title">Danh sách máy chủ</h3>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
