<?php

namespace App\Repositories;

use App\CardStorageLevel;
use App\Repositories\PlayerRepository;
use Auth;

class CardStorageLevelRepository
{
  private $card_storage_level;

  public function all() {
    return CardStorageLevel::all();
  }

  public function find($id) {
    return CardStorageLevel::find($id);
  }

  public function find_by($name, $value) {
    $card_storage_level = CardStorageLevel::where($name, $value);

    if ($card_storage_level->count())
      return $card_storage_level->first();
    return false;
  }

  public function update_card_storage($name, $value) {
    $card_storage_level = $this->find_by($name, $value);

    if ($card_storage_level) {
      Auth::user()->decrease_card_storage([
        "current" => -$card_storage_level->level,
        "total" => 0
      ]);
      return true;
    }

    return false;
  }

}
