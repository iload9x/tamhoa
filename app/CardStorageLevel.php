<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardStorageLevel extends Model
{
  public function reward_items() {
    return $this->hasMany("App\RewardItem");
  }

  public function prop_items() {
    return $this->reward_items()->where(["item_type" => 0]);
  }

  public function equip_items() {
    return $this->reward_items()->where(["item_type" => 1]);
  }

  public function card_storage_histories() {
    return $this->hasMany("App\CardStorageHistory");
  }
}
