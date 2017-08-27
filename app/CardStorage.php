<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardStorage extends Model
{
  protected $table = "card_storage";
  protected $fillable = ["current", "total"];

  public function user() {
    return $this->belongsTo("App\User");
  }
}
