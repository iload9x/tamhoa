<li><a target="__blank" href="{{ route('home') }}" class="active">@lang("others.menu_home")</a></li>
<li><a href="#chatbox">@lang("others.menu_chat_box")</a></li>
<li><a target="__blank" href="{{ route('coin.create') }}">@lang("others.menu_coin")</a></li>
<li><a target="__blank" href="{{ route('cards.create') }}">@lang("others.menu_payment")</a></li>
<li><a target="__blank" href="{{ route('event.tichluy') }}">@lang("others.card_storage")</a></li>
<li><a target="__blank" href="https://www.facebook.com/game.mth">@lang("others.menu_support")</a></li>
<li>
	<marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5">
		<strong>Sự kiện: </strong>
		<span style="color: #dc4310; font-weight: bold;">Nạp thẻ <u>lần đầu trong ngày</u> nhận ngay 100.000 tích lũy!.</span>
    	<a href="{{ route('cards.create')}}" target="__blank">Nạp ngay</a>
    </marquee>
</li>
