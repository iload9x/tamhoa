<?php

namespace App\Http\Controllers;

use App\Repositories\CardRepository;
use App\Repositories\TichLuyRepository;
use Illuminate\Http\Request;
use Auth;

class CardsController extends Controller
{
  private $card, $tich_luy;

  public function __construct(CardRepository $CardRepository,
    TichLuyRepository $TichLuyRepository) {

    $this->middleware("auth");
    $this->card = $CardRepository;
    $this->tich_luy = $TichLuyRepository;
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
      $this->card->create([
        "serial" => $input_card["serial"],
        "pin" => $input_card["pin"],
        "telcocode" => $input_card["telcoCode"],
        "payment_amount" => $card
      ]);
      $this->tich_luy->updateOrCreate([
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
