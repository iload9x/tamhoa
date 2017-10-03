<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
  public function run()
  {
    DB::table("configs")->delete();
    DB::table("configs")->insert([
      [
        "group" =>  "web",
        "keyword" => "banner",
        "description" => "Banner at home",
        "value" => "http://tamhoa2.top/public/avatars/baner.jpg",
        "type" => "text"
      ],
      [
        "group" =>  "game",
        "keyword" => "ip",
        "description" => "IP Server",
        "value" => "103.75.182.197",
        "type" => "text"
      ],
    ]);
  }
}
