<div class="card-daily-buttons">
  @if(Auth::user()->card_daily_is_today())
    <button class="btn btn-success pull-right" disabled="">@lang("others.you_given")</button>
  @else
    @if(Auth::user()->card_is_today())
      <span class="pull-right">
        @lang("others.please_out_game")
        <button class="btn btn-success btn-card-daily-ok">@lang("buttons.can_receive")</button>
      </span>
    @else
      <button class="btn btn-danger pull-right" disabled="">@lang("others.not_payment_today")</button>
    @endif
  @endif
</div>
