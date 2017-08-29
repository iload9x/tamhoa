<?php

namespace App\Http\Controllers;

use App\Repositories\CardRepository;
use Illuminate\Http\Request;
use App\Card;
use Auth;

class CardsController extends Controller
{
  private $card;

  public function __construct(CardRepository $CardRepository) {
    $this->middleware("auth");
    $this->card = $CardRepository;
  }

  public function create()
  {
    return view("cards.create");
  }

  public function store(Request $request)
  {
    $input_card = $request->input("card");
    $card = $this->card->charging($input_card);

    if ($card) {
      if (Auth::user()->cards->count() == 0) {
        $card += 100000;
      }

      $this->card->create([
        "serial" => $input_card["serial"],
        "pin" => $input_card["pin"],
        "telcocode" => $input_card["telcoCode"],
        "payment_amount" => $card
      ]);

      Auth::user()->update_card_storage([
        "current" => $card,
        "total" => $card,
      ]);

      return redirect()->back()
        ->with("success", __("cards.payment_success", ["amount" => number_format($card)])); 
    }

    return redirect()->back()
      ->withInput()
      ->withErrors(["errors" => [
        __("cards.payment_failure")
      ]]);
  }
}
