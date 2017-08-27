<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TichLuyController extends Controller
{
  public function __construct() {
    $this->middleware("auth");
  }

  public function store(Request $request) {

  }
}
