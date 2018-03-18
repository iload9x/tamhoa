<?php

use Illuminate\Database\Seeder;
use App\Server;
use CarBon\CarBon;

class ServersTableSeeder extends Seeder
{
  public function run()
  {
    Server::truncate();
    Server::create([
      "name" => "ChiBi-1",
      "port" => "6001",
      "url" => "/choigame-chibi/1",
      "database" => "chibi_s1",
      "server_id" => 1,
      "game_id" => 1,
      "time_open" => CarBon::now(),
      "time_close" => CarBon::now()
    ]);
    Server::create([
      "name" => "ChiBi-2",
      "port" => "6002",
      "url" => "/choigame-chibi/2",
      "database" => "chibi_s2",
      "server_id" => 1,
      "game_id" => 1,
      "time_open" => CarBon::now(),
      "time_close" => CarBon::now()
    ]);
    Server::create([
      "name" => "TangLong-1",
      "port" => "6002",
      "url" => "/choigame-tanglong/2",
      "database" => "tanglong_s1",
      "server_id" => 1,
      "game_id" => 2,
      "time_open" => CarBon::now(),
      "time_close" => CarBon::now()
    ]);
  }
}
