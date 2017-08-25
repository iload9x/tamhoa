<?php

namespace App\Repositories;

use App\CoinHistory;
use Auth;

class CoinHistoryRepository
{
  public function create($CoinHistory) {
    Auth::user()->coin_histories()
      ->save(new CoinHistory($CoinHistory));
  }
}
