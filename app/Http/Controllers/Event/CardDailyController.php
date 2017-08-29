<?php

namespace App\Http\Controllers\Event;

use App\Repositories\CardDailyItemRepository;
use App\Repositories\PlayerRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CardDailyItem;
use Auth;
use Validator;

class CardDailyController extends Controller
{
  private $card_daily_items;

  public function __construct(CardDailyItemRepository $CardDailyItemRepository) {
    $this->middleware("auth");
    $this->card_daily_items = $CardDailyItemRepository;
  }

  public function create() {
    $props  = $this->card_daily_items->all_props();

    return view("event.card_daily.create", ["props" => $props]);
  }

  public function store(Request $request) {
    $errors = $this->validator($request);
    $server = $request->input("server");

    if (count($errors)) {
      return redirect()->back()->withErrors($errors);
    }

    if (!Auth::user()->card_daily_is_today() && Auth::user()->card_is_today()) {
      Auth::user()->card_daily()->create([]);

      $props  = $this->card_daily_items->all_props();
      //insert item into server game
      $player = new PlayerRepository($server);
      $player->insert_into_userprop($props, Auth::user()->enter_account());

      return redirect()->back()->with("success", __("others.alert_received_reward_item_success"));
    }
    return redirect()->back();
  }

  private function validator($request) {
    $validator = Validator::make($request->all(),[
      "server" => "required",
    ]);
    if ($validator->fails()){
      return $validator->messages()->messages();
    }

    $player = new PlayerRepository($request->input("server"));
    $errors = array();

    if (!$player->find_by("userName", Auth::user()->enter_account())) {
      $errors["errors"][] = __("servers.server_not_exists_player");
    }
    return $errors;
  }
}
