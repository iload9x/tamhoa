<div class="be-loading">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th style="">@lang("admin.user")</th>
        <th class="number">@lang("admin.total_card_amount")</th>
        <th>@lang("admin.latest_time")</th>
        <th class="actions"></th>
      </tr>
    </thead>
    <tbody>
      @if($top_cards->count())
        @foreach($top_cards as $top_card)
          <tr>
            <td class="user-avatar">
              <img src="/{{ \App\Helpers\AssetHelper::path() }}assets/img/avatar6.png"
                alt="Avatar">{{ $top_card->user->email }}</td>
            <td class="number">{{ $top_card->total }}</td>
            <td>---</td>
            <td class="actions">
              <a href="#" class="icon">
                <i class="mdi mdi-github-alt"></i>
              </a>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td class="text-center" colspan="4">Không có dữ liệu!</td>
        </tr>
      @endif
    </tbody>
  </table>
  <div class="text-center">{{ $top_cards->links() }}</div>
  <div class="be-spinner">
    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
      <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
    </svg>
  </div>
</div>
