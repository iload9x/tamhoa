<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function __construct() {
      $this->middleware("auth", ["except" => ["show"]]);
    }

    public function show($id)
    {
      $category = Category::find($id);

      if ($category) {
        $posts = $category->posts()
          ->orderBy("created_at", "DESC")
          ->paginate(5);
        return view("categories.show",
          ["category" => $category, "posts" => $posts]);
      }
      return redirect()->back();
    }
}
