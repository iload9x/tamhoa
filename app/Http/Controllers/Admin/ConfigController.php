<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
  public function __construct() {
    $this->middleware("is_admin");
  }

  public function index() {
    return view("admin.configs.index");
  }
}
