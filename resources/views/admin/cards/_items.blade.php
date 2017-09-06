<div class="list-card be-loading">
  <table class="table table-striped table-borderless">
    <thead>
      <tr>
        <th style="">@lang("admin.card_serial")</th>
        <th class="">@lang("admin.card_pin")</th>
        <th class="">@lang("admin.card_amount")</th>
        <th class="">@lang("admin.card_telcocode")</th>
        <th class="">@lang("admin.user")</th>
        <th class="">@lang("admin.time_created")</th>
        <th class="actions"></th>
      </tr>
    </thead>
    <tbody class="no-border-x">
      @if($cards->count())
        @foreach($cards as $card)
          <tr class="card-item" card-id="{{ $card->id }}" card-url="{{ route('admin.cards.destroy', $card) }}">
            <td>
              {{ $card->serial }}
            </td>
            <td class="">
             {{ $card->pin }}
            </td>
            <td class="">
              {{ $card->amount }}
            </td>
            <td class="">
              {{ $card->telcocode }}
            </td>
            <td class="">
              {{ $card->user->name }}
            </td>
            <td class="">
              {{ $card->created_at }}
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
  <div class="text-center">{{ $cards->links() }}</div>
  <div class="be-spinner">
    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
      <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
    </svg>
  </div>
</div>
