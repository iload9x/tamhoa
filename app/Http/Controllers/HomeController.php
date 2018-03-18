<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Game;

class HomeController extends Controller
{
    public function index()
    {
      $posts = Post::orderBy("created_at", "DESC")->paginate(5);
      $categories = Category::orderBy("created_at", "DESC")->get();
      $games = Game::orderBy("created_at", "DESC")->get();

      return view("home.index", ["categories" => $categories, "posts" => $posts, "games" => $games]);
    }
}
