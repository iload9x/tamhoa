<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth", ["except" => ["show"]]);
  }

  public function store(Request $request)
  {
    if (Auth::user()->is_admin()) {
      $file_name = date("Y-m-d-H-i-s") . $request->avatar->getClientOriginalName();
      $request->avatar->move("avatars", $file_name);

      Auth::user()->posts()->save(new Post([
        "name" => $request->post["name"],
        "desc" => "desc",
        "content" => $request->post["content"],
        "avatar" => $file_name,
        "category_id" => $request->post["category_id"],
      ]));
    }
    return redirect()->back();
  }

  public function show($slug, $id)
  {
    $post = Post::with("category")->find($id);
    if ($post) {
      return view("posts.show", ["post" => $post]);
    }
    return redirect()->back();
  }
}
