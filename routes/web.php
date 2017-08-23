<?php

Auth::routes();

Route::get("/", "HomeController@index")->name("home");

Route::resource("coin", "CoinHistoriesController", ["names" => [
    "create" => "coin.create",
    "store" => "coin.store"
]]);

Route::group(["namespace" => "Game", "prefix" => "game"], function() {
  Route::resource("players", "PlayerController");
});
