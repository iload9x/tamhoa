<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDailyItem extends Model
{
  public function item() {
    return $this->hasOne("App\Item", "item_id", "item_id");
  }

  public function scopeAll_props($query) {
    return $query->where("item_type", 0);
  }
}
