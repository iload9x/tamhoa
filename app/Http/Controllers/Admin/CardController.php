<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CardRepository;
use App\Repositories\UserRepository;
use CarBon\CarBon;
use App\Card;

class CardController extends Controller
{
  private $card;

  public function __construct(CardRepository $CardRepository, UserRepository $UserRepository) {
    $this->middleware("is_admin");
    $this->card = $CardRepository;
    $this->user = $UserRepository;
  }

  public function index(Request $request) {
    $cards = $this->card->latest_paginate(10);
    $chart_data = array();
    $chart_data_last_month = array();
    $start_date_string = $request->start_date ? $request->start_date : CarBon::today()->addDay(-15)->toDateTimeString();
    $end_date_string = $request->end_date ? $request->end_date : CarBon::today()->toDateTimeString();
    $start_date = CarBon::parse($start_date_string)->startOfDay();
    $end_date = CarBon::parse($end_date_string)->endOfDay();
    $label = array();
    $top_cards = $this->card->selectRaw("user_id, sum(amount) as total")
      ->with("user")->groupBy("user_id")->orderBy("total", "DESC")->paginate(7, ["*"], "top_card_page");

    for ($i = CarBon::parse($start_date_string); $i->between($start_date, $end_date); $i->addDay(1)) {
      array_push($label, $i->format("d/m"));
      $start_day = CarBon::parse($i->startOfDay()->toDateTimeString());
      $end_day = CarBon::parse($i->endOfDay()->toDateTimeString());

      array_push($chart_data, $this->card->whereBetween("created_at", [$start_day, $end_day])->sum("amount"));
    }
    if ($request->type == "chart") {
      return response()->json([
        "status" => true,
        "data" => $chart_data,
        "label" => $label,
        "html" => view("admin.cards._chart_data")->render()
      ]);
    }

    if ($request->ajax()) {
      if ($request->top_card_page) {
        return response()->json([
          "status" => true,
          "html" => view("admin.cards._top_card_items", ["top_cards" => $top_cards])->render()
        ]);
      }
      return response()->json([
        "status" => true,
        "html" => view("admin.cards._items", ["cards" => $cards])->render()
      ]);
    }
    return view("admin.cards.index", ["cards" => $cards, "top_cards" => $top_cards, "chart_data" => 
      ["this_month" => $chart_data, "last_month" => $chart_data_last_month, "label" => $label]]);
  }

  public function store(Request $request) {
    $user = $this->user->find_by("email", $request->email);
    $card = $request->input("card");

    if ($user) {
      $amount = $this->card->charging($card);

      if ($amount) {
        $card["amount"] = $amount;

        $this->card->create($user, $card);

        if ($user->cards->count() == 0) {
          $user->increase_card_storage([
            "current" => $amount + 100000,
            "total" => $amount,
          ]);
        } else {
          $user->increase_card_storage([
            "current" => $amount,
            "total" => $amount,
          ]);
        }

        $cards = $this->card->latest_paginate(10);

        return response()->json([
          "status" => true,
          "message" => __("cards.payment_success", ["amount" => number_format($amount)]),
          "html" => view("admin.cards._items", ["cards" => $cards])->render()
        ]);
      }
      return response()->json([
        "status" => false,
        "message" => __("cards.payment_failure")
      ]);
    }

    return response()->json([
      "status" => false,
      "message" => __("admin.user_not_exists")
    ]);
  }
}
