<?php

namespace App\Repositories;

use App\Card;
use Auth;

class CardRepository
{
  public function create($card) {
    Auth::user()->cards()->save(new Card([
      "serial" => $card["serial"],
      "pin" => $card["pin"],
      "amount" => $card["payment_amount"],
      "telcocode" => $card["telcocode"],
      "coin" => $this->rate_coin($card["payment_amount"])
    ]));

    Auth::user()->update_coin($this->rate_coin($card["payment_amount"]));
  }

  public function rate_coin($payment_amount = 0) {
    return 10 * $payment_amount;
  }
}
