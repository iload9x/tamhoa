<div class="card_histories">
  <table class="table">
    <thead>
      <tr>
        <th style="">Serial</th>
        <th style="">Mã thẻ</th>
        <th class="number">Mệnh giá</th>
        <th class="number">Nhà mạng</th>
        <th class="number">Xu nhận được</th>
        <th class="">Thời gian nạp</th>
      </tr>
    </thead>
    <tbody>
    @if($cards->count())
      @foreach($cards as $card)
        <tr>
          <td>{{ $card->serial }}</td>
          <td>{{ $card->pin }}</td>
          <td class="number">{{ number_format($card->amount) }} d</td>
          <td class="number">{{ $card->telcocode }}</td>
          <td class="number">{{ number_format($card->coin) }}</td>
          <td class="">{{ \Carbon\Carbon::parse($card->created_at)->toDateTimeString() }}</td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>
  {{ $cards->links() }}
</div>
