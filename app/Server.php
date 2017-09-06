<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
  protected $fillable = ["name", "port", "database", "time_close", "time_open", "server_id"];
  public function scopeNot_blocked_orderby_created($query) {
    return $query->where(["blocked" => 0])
      ->orderBy("created_at", "DESC");
  }
}
