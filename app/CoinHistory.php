<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinHistory extends Model
{
  protected $table =  "coin_histories";
  protected $fillable =  ["changed", "remaining"];

  public function user() {
    return $this->belongsTo("App\User", "user_id", "id");
  }
}
