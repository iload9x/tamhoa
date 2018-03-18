<?php

use Illuminate\Database\Seeder;
use App\Game;

class GamesTableSeeder extends Seeder
{
  public function run() {
    Game::truncate();

    //id = 1
    Game::create([
      "name" => "CHIBI",
      "description" => "Game chi bi hay nhat viet con me no nam",
      "link" => "http://localhost:8000/chibigame",
      "avatar" => "http://vietgame.online/public/img/vodao.jpg"
    ]);

    //id = 2
    Game::create([
      "name" => "TANG LONG",
      "description" => "Game chi bi hay nhat viet con me no nam",
      "link" => "http://localhost:8000/TangLongGame",
      "avatar" => "http://vietgame.online/public/img/vodao.jpg"
    ]);

    //id = 3
    Game::create([
      "name" => "DAO KIEM VO SONG",
      "description" => "Game chi bi hay nhat viet con me no nam",
      "link" => "http://localhost:8000/dkvs",
      "avatar" => "http://vietgame.online//public/img/logo_DKVS.png"
    ]);
  }
}
