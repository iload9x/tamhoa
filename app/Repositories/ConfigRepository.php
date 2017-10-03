<?php

namespace App\Repositories;

use App\Config;

class ConfigRepository
{
  public function group($name) {
    return Config::where("group", $name)->get();
  }

  public function keyword($name) {
    return Config::where("keyword", $name)->first();
  }
}
