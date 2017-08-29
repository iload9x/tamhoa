<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Server;
use Auth;

class PlayGameController extends Controller
{
  public function __construct() {
    $this->middleware("auth");
  }

  public function show($id) {
    $server = Server::find($id);
    if ($server) {
      $info_server = [
        "enterAccount" => Auth::user()->enter_account(),
        "ip" => "127.0.0.1",
        "port" => $server->port
      ];
      return view("layouts.playgame", ["info_server" => $info_server]);
    }
    return redirect()->back();
  }
}
