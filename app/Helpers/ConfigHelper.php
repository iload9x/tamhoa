<?php

namespace App\Helpers;

use App\Repositories\ConfigRepository;

class ConfigHelper
{
  public static function get_keyword($keyword) {
    $config = new ConfigRepository;

    return $config->keyword($keyword);
  }
}
