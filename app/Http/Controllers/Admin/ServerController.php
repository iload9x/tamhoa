<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ServerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerController extends Controller
{
  private $server;

  public function __construct(ServerRepository $ServerRepository) {
    $this->middleware("is_admin");
    $this->server = $ServerRepository;
  }

  public function  index(Request $request) {
    $servers = $this->server->latest_paginate(10);
    if ($request->ajax()) {
      return response()->json([
        "status" => true,
        "html" => view("admin.servers._items", ["servers" => $servers])->render()
      ]);
    }

    return view("admin.servers.index", ["servers" => $servers]);
  }

  public function update(Request $request, $id) {

  }

  public function store(Request $request) {
    $server = $request->input("server");

    if ($request->ajax() && $server) {
      $this->server->create($request->input("server"));
      $servers = $this->server->latest_paginate(10);

      return response()->json([
        "status" => true,
        "html" => view("admin.servers._items", ["servers" => $servers])->render()
      ]);
    }
  }

  public function destroy($id) {
    $server = $this->server->find($id);

    if ($server) {
      $server->delete();
      $servers = $this->server->latest_paginate(10);

      return response()->json([
        "status" => true,
        "html" => view("admin.servers._items", ["servers" => $servers])->render()
      ]);
    }
    return response()->json(["status" => false]);
  }
}
