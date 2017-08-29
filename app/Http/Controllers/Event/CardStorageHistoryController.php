<?php

namespace App\Http\Controllers\Event;

use App\Repositories\CardStorageLevelRepository;
use App\Repositories\PlayerRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Cookie;
use Validator;

class CardStorageHistoryController extends Controller
{
  private $card_storage_level;

  public function __construct(CardStorageLevelRepository $CardStorageLevel) {
    $this->middleware("auth");
    $this->card_storage_level = $CardStorageLevel;
  }

  public function store(Request $request) {
    $errors = $this->validator($request);
    $server = $request->input("server");
    $level = $request->level;
    $card_storage_level = $this->card_storage_level->find_by("level", $level);

    if (count($errors) || !$card_storage_level) {
      return redirect()->back()->withErrors($errors);
    }

    // cap nhat lai diem tich luy cua user
    $this->card_storage_level->update_card_storage("level", $level);
    // insert vat pham vao server
    $player = new PlayerRepository($server);
    $player->insert_into_userprop($card_storage_level->prop_items(), Auth::user()->enter_account());
    $player->insert_into_userequip($card_storage_level->equip_items(), Auth::user()->enter_account());
    Cookie::queue("waiting_for_update_" . $server, time() + 60 * 5 , 5);

    return redirect()->back()->with("success", __("others.alert_received_reward_item_success"));
  }

  private function validator($request) {
    $validator = Validator::make($request->all(),[
      "server" => "required",
      "level" => "required|numeric|max:10000000",
    ]);
    if ($validator->fails()){
      return $validator->messages()->messages();
    }

    $player = new PlayerRepository($request->input("server"));
    $errors = array();

    if (!$player->find_by("userName", Auth::user()->enter_account())) {
      $errors["errors"][] = __("servers.server_not_exists_player");
    }

    if (!Auth::user()->card_storage->count() || Auth::user()->card_storage->current < $request->level) {
      $errors["errors"][] = __("others.greater_my_card_storage");
    }

    return $errors;
  }
}
