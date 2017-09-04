<?php

namespace App\Repositories;

use App\CardDailyItem;
use Auth;

class CardDailyItemRepository
{
  public function all_props() {
    return CardDailyItem::all_props();
  }
}
