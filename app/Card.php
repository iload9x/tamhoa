<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
  protected $fillable = ["serial", "pin", "coin", "amount", "telcocode"];

  public function user() {
    return $this->belongsTo("App\User");
  }
}
