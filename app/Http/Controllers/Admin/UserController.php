<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function __construct() {
    $this->middleware("is_admin");
  }

  public function check_email() {
    return response()->json(["status" => true]);
  }
}
