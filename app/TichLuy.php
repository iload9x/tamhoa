<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TichLuy extends Model
{
  protected $table = "tich_luy";
  protected $fillable = ["current", "total"];

  public function user() {
    return $this->belongsTo("App\User");
  }
}
