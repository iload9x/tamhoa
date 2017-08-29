<?php

namespace App\Http\Controllers\Event;

use App\Repositories\CardStorageLevelRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardStorageController extends Controller
{
  private $card_storage_level;

  public function __construct(CardStorageLevelRepository $CardStorageLevel) {
    $this->middleware("auth");
    $this->card_storage_level = $CardStorageLevel;
  }

  public function index() {
    $card_storage_levels = $this->card_storage_level->all();

    return view("event.card_storage.index", [
      "card_storage_levels" => $card_storage_levels
    ]);
  }
}
