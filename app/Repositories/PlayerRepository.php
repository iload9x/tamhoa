<?php

namespace App\Repositories;

use DB;

class PlayerRepository
{

  private $database;

  function __construct($database) {
    $this->database = $database;
  }

  public function find_by($name, $value) {
    $player = $this->table("player")->where($name, $value);
    if ($player->count())
      return $player->first();
    return false;
  }

  public function insert_into_userorder($golden, $userName) {
    return $this->table("userorder")->insert([
      "golden" => $golden,
      "serverId" => 1,
      "time" => date("Y-m-d H:i:s"),
      "userName" => $userName
    ]);
  }

  private function table($table) {
    return DB::table("{$this->database}.{$table}");
  }

}
