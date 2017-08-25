<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
    "name", "content", "avatar", "coin",
    "desc", "time_open", "time_close",
    "category_id",
  ];

  protected $dates = ["created_at"];

  public function category() {
    return $this->belongsTo("App\Category");
  }
}
