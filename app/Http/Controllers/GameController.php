<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller {
  public function show($id) {
    $game = Game::find($id);

    if ($game) {
      return response()->json([
        "status" => true,
        "html" => view("games._servers", ["servers" => $game->servers()->get()])->render()
      ]);
    }

    return response()->json(["status" => false]);
  }
}
