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

  public function insert_into_userprop($list_item, $enteraccount) {
    $player = $this->find_by("userName", $enteraccount);
    if ($player && $list_item->count()) {
      foreach ($list_item->get() as $item) {
        $this->table("userprops")->insert([
          "backpack" => 0,
          "baseId" => $item->item_id,
          "binding" => 1,
          "count" => $item->quantity,
          "expiration" => null,
          "positionId" => 37,
          "quality" => 0,
          "discardTime" => null,
          "playerId" => $player->playerId
        ]);
      }
    }
  }

  public function insert_into_userequip($list_item, $enteraccount) {
    $player = $this->find_by("userName", $enteraccount);
    if ($player && $list_item->count()) {
      foreach ($list_item->get() as $item) {
        $this->table("userequip")->insert([
          "backpack" => 2,
          "baseId" => $item->item_id,
          "binding" => 1,
          "bress" => 0,
          "shenwuTempo" => 0,
          "count" => 1,
          "positionId" => 25,
          "quality" => 4,
          "attributes" => "2_1102_500|1_1106_2222|3_1303_10000",
          "cleanBressDate" => date("Y-m-d-H-i-s"),
          "currentEndure" => "600",
          "currentMaxEndure" => "600",
          "holeAttributes" => "5_-1|2_-1|1_-1|3_-1|4_-1",
          "playerId" => $player->playerId,
          "starLevel" => $item->quantity
        ]);
      }
    }
  }

  private function table($table) {
    return DB::table("{$this->database}.{$table}");
  }
}
