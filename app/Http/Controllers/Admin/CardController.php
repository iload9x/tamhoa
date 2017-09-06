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

    for ($i = -15; $i <= 0; $i ++) {
      $chart_data[CarBon::today()->addDay($i)->format("d/m")]
        = $this->card->whereBetween("created_at",
          [CarBon::today()->addDay($i), CarBon::today()->addDay($i + 1)])->sum("amount");
    }

    for ($i = -15; $i <= 0; $i ++) {
      $chart_data_last_month[CarBon::today()->addMonth(-1)->addDay($i)->format("d/m")]
        = $this->card->whereBetween("created_at",
          [CarBon::today()->addMonth(-1)->addDay($i), CarBon::today()->addMonth(-1)->addDay($i + 1)])->sum("amount");
    }

    if ($request->ajax()) {
      return response()->json([
        "status" => true,
        "html" => view("admin.cards._items", ["cards" => $cards])->render()
      ]);
    }
    return view("admin.cards.index", ["cards" => $cards, "chart_data" => 
      ["this_month" => $chart_data, "last_month" => $chart_data_last_month]]);
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
