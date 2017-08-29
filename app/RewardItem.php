<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardItem extends Model
{
  public function item() {
    return $this->hasOne("App\Item", "item_id", "item_id");
  }
}
