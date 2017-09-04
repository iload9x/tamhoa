<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class PostsController extends Controller
{
  public function __construct()
  {
    $this->middleware("is_admin", ["except" => ["show"]]);
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

  public function show($slug, $id, Request $request)
  {
    $post = Post::with("category")->find($id);

    if ($post) {
      if ($request->ajax()) {
        return response()->json([
          "status" =>true,
          "html" => view("posts._detail", ["post" => $post])->render()
        ]);
      }
      return view("posts.show", ["post" => $post]);
    }
    return redirect()->back();
  }

  public function update($id, Request $request) {
    $post = Post::with("category")->find($id);
    $name = $request->name;
    $content = $request->content;
    $errors = $this->validator($request);

    if ($post && !count($errors) && $post->update(["name" => $name, "content" => $content])) {
      return response()->json([
        "status" =>true,
        "html" => view("posts._detail", ["post" => $post])->render()
      ]);
    }
    return response()->json([
      "status" =>false
    ]);
  }

  public function destroy($id) {
    $post = Post::find($id);
    if ($post) {
      $post->delete();
      return redirect()->route("home");
    }
    return redirect()->back();
  }

  private function validator($request) {
    $validator = Validator::make($request->all(),[
      "name" => "required|min:10",
      "content" => "required|min:10|max:100000000",
    ]);
    if ($validator->fails()){
      return $validator->messages()->messages();
    }

    return array();
  }
}
