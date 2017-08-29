<?php

Auth::routes();

Route::get("/", "HomeController@index")->name("home");

Route::resource("coin", "CoinHistoriesController", ["only" => [
  "create", "store"
], "names" => [
  "create" => "coin.create",
  "store" => "coin.store"
]]);

Route::resource("posts", "PostsController", ["only" => [
  "store"
], "names" => [
  "store" => "posts.store"
]]);

Route::resource("categories", "CategoriesController", ["only" => [
  "store"
], "names" => [
  "store" => "categories.store"
]]);

Route::resource("cards", "CardsController", ["only" => [
  "store", "create"
], "names" => [
  "create" => "cards.create",
  "store" => "cards.store"
]]);

Route::group(["namespace" => "Game", "prefix" => "game"], function() {
  Route::resource("players", "PlayerController");
  Route::resource("choi-game", "PlayGameController", ["only" => [
    "show"
  ], "names" => [
    "show" => "playgame.show"
  ]]);
});

Route::group(["namespace" => "Event", "prefix" => "event"], function() {
  Route::get("tichluy", "CardStorageController@index")->name("event.tichluy");
  Route::post("card_storage_histories", "CardStorageHistoryController@store")
    ->name("card_storage_histories.store");
});

Route::group(["namespace" => "Event", "prefix" => "event"], function() {
  Route::get("tichluy", "CardStorageController@index")->name("event.tichluy");
  Route::post("card_storage_histories", "CardStorageHistoryController@store")
    ->name("card_storage_histories.store");
});

//custom routes

Route::get("bai-viet/{slug}.{id}.html", "PostsController@show")->name("posts.show");
Route::get("the-loai/{slug}.{id}.html", "CategoriesController@show")->name("categories.show");
