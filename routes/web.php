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
  "store", "update", "destroy"
], "names" => [
  "store" => "posts.store",
  "update" => "posts.update",
  "destroy" => "posts.destroy"
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

Route::resource("chat-box", "chatboxController", ["only" => [
  "index", "store"
], "names" => [
  "index" => "chatbox.index",
  "store" => "chatbox.store"
]]);

Route::group(["namespace" => "Game", "prefix" => "game"], function() {
  Route::resource("players", "PlayerController");
  Route::resource("choi-game", "PlayGameController", ["only" => [
    "show"
  ], "names" => [
    "show" => "playgame.show"
  ]]);

  Route::get("old/{id}", "PlayGameController@play_old");
});

Route::group(["namespace" => "Event", "prefix" => "event"], function() {
  Route::get("tichluy", "CardStorageController@index")->name("event.tichluy");
  Route::post("card_storage_histories", "CardStorageHistoryController@store")
    ->name("card_storage_histories.store");

  Route::get("nap-the-hang-ngay",  "CardDailyController@create")->name("card_daily.create");
  Route::post("nap-the-hang-ngay",  "CardDailyController@store")->name("card_daily.store");
});

Route::group(["namespace" => "Event", "prefix" => "event"], function() {
  Route::get("tichluy", "CardStorageController@index")->name("event.tichluy");
  Route::post("card_storage_histories", "CardStorageHistoryController@store")
    ->name("card_storage_histories.store");
});

//custom routes

Route::get("payment/napthe", "CardsController@create");
Route::get("bai-viet/{slug}.{id}.html", "PostsController@show")->name("posts.show");
Route::get("the-loai/{slug}.{id}.html", "CategoriesController@show")->name("categories.show");

//-------------------------ADMIN-----------------------------------------

Route::group(["namespace" => "Admin", "prefix" => "admin"], function() {
  Route::get("/", "HomeController@index")->name("admin");
  Route::get("check-email", "UserController@check_email")->name("admin.check_email");

  Route::resource("servers", "ServerController", ["except" => [
    "create", "edit", "show"
  ], "names" => [
    "index" => "admin.servers.index",
    "store" => "admin.servers.store",
    "destroy" => "admin.servers.destroy",
    "update" => "admin.servers.update"
  ]]);

  Route::resource("cards", "CardController", ["only" => [
    "index", "store", "destroy"
  ], "names" => [
    "index" => "admin.cards.index",
    "store" => "admin.cards.store",
    "destroy" => "admin.cards.destroy",
    "update" => "admin.cards.update"
  ]]);

  Route::resource("configs", "ConfigController", ["only" => [
    "index", "store", "destroy"
  ], "names" => [
    "index" => "admin.configs.index",
    "store" => "admin.configs.store",
    "destroy" => "admin.configs.destroy",
    "update" => "admin.configs.update"
  ]]);

});
