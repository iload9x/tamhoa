<?php

namespace App\Http\Controllers\Game;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\PlayerRepository;

class PlayerController extends Controller
{
  public function __construct() {
    $this->middleware("auth");
  }

  public function show($userName) {
    $database = request()->database;

    if (request()->ajax() && request()->database) {
      $player = new PlayerRepository($database);
      $player = $player->find_by("userName", $userName);
      if ($player) {
        return response()->json(["status" => true, "player" => $player]);
      }
    }

    return response()->json(["status" => false]);
  }
}
