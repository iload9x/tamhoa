<?php

namespace App\Repositories;

use App\Server;
use Auth;
use CarBon\CarBon;

class ServerRepository
{
  public function latest() {
    return Server::latest();
  }

  public function latest_paginate($per_page = 10) {
    return $this->latest()->paginate(10, ["*"], "server_page");
  }

  public function create($data) {
    $data["time_open"] = CarBon::parse($data["time_open"]);
    $data["time_close"] = CarBon::parse($data["time_close"]);

    return Server::create($data);
  }

  public function find($id) {
    return Server::find($id);
  }
}
