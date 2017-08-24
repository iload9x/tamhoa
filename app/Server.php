<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
  public function scopeNot_blocked_orderby_created($query) {
    return $query->where(["blocked" => 0])
      ->orderBy("created_at", "DESC");
  }
}
