<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardStorageHistory extends Model
{
  protected $fillable = ["user_id"];

  public function scopeFind_by($query, $field, $value) {
    return $query->where($field, $value);
  }
}
