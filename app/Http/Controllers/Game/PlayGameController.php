<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Server;
use Cookie;
use Auth;

class PlayGameController extends Controller
{
  public function __construct() {
    $this->middleware("auth");
  }

  public function show($id) {
    $server = Server::where(["server_id" => $id])->first();
    if ($server) {
      $time_out = Cookie::get("waiting_for_update_" . $server->database);
      $time_open = strtotime($server->time_open) - time(); 
      if($time_open > 0) {
        return view("layouts._waiting_for_open_server",[
          "time_open" => $time_open
        ]);
      }

      if ($time_out) {
        return view("layouts._waiting_to_update",[
          "time_out" => $time_out - time()
        ]);
      }
      $info_server = [
        "title" => $server->name,
        "enterAccount" => Auth::user()->enter_account(),
        "ip" => "103.75.182.197",
        "port" => $server->port
      ];
      return view("layouts.playgame", ["info_server" => $info_server]);
    }
    return redirect()->back();
  }
}
