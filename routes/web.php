<?php

Auth::routes();

Route::get("/", "HomeController@index")->name("home");

Route::resource("coin", "CoinHistoriesController", ["names" => [
    "create" => "coin.create",
    "store" => "coin.store"
]]);

Route::resource("posts", "PostsController", ["names" => [
    "show" => "posts.show",
    "store" => "posts.store"
]]);

Route::resource("categories", "CategoriesController", ["names" => [
    "show" => "categories.show",
    "store" => "categories.store"
]]);

Route::resource("cards", "CardsController", ["names" => [
    "create" => "cards.create",
    "show" => "cards.show",
    "store" => "cards.store"
]]);

Route::group(["namespace" => "Game", "prefix" => "game"], function() {
  Route::resource("players", "PlayerController");
});
