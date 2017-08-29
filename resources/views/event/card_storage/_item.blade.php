<div id="accordion-{{ $card_storage_level->id }}"
  class="panel-group accordion accordion card_storage_level"
  card-storage-level-id="{{ $card_storage_level->id }}">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title title-card-storage">
        <a data-toggle="collapse" data-parent="#accordion-{{ $card_storage_level->id }}"
          href="#collapse-{{ $card_storage_level->id }}"
          class="collapsed" aria-expanded="false">
          <i class="icon mdi mdi-chevron-down"></i>
          {{ number_format($card_storage_level->level) }} điểm tích lũy
        </a>
      </h4>
    </div>
    <div id="collapse-{{ $card_storage_level->id }}"
      class="panel-collapse collapse" aria-expanded="false">
      <div class="panel-body body-card-storage">
        <ul class="ul-style">
          @if($card_storage_level->prop_items()->count())
            @foreach($card_storage_level->prop_items as $prop_item)
              <li class="item_quanlity_{{ $prop_item->item->quanlity }}">
                <span class="mdi mdi-chevron-right"></span>
                <b>{{ $prop_item->quantity }} {{ $prop_item->item->name }}</b>
              </li>
            @endforeach
          @endif
          @if($card_storage_level->equip_items()->count())
            @foreach($card_storage_level->equip_items as $equip_item)
              <li class="item_quanlity_{{ $equip_item->item->quanlity }}">
                <span class="mdi mdi-chevron-right"></span>
                <b>{{ $equip_item->quantity }} {{ $equip_item->item->name }} (Trang bị)</b>
              </li>
            @endforeach
          @endif
        </ul>
        <div>
          @if(!Auth::user()->card_storage()->count()
            || Auth::user()->card_storage()->first()->current < $card_storage_level->level)
            <button class="btn btn-space btn-warning pull-right" disabled="">
              @lang("buttons.can_not_receive")
            </button>
          @else
              <button class="btn btn-space
                btn-primary pull-right btn-receive-reward-item"
                name="level" value="{{ $card_storage_level->level }}"
                type="submit">
                @lang("buttons.can_receive")
              </button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
