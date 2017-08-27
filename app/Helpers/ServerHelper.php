<?php

namespace App\Helpers;

use App\Server;

class ServerHelper
{
  public static function list_server() {
    return Server::not_blocked_orderby_created()->limit(5)->get();
  }

  public static function all() {
    return Server::all();
  }
}
