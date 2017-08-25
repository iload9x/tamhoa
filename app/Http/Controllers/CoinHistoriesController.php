<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\PlayerRepository;
use App\Repositories\CoinHistoryRepository;
use App\Server;
use Auth;

class CoinHistoriesController extends Controller
{
    private $coin_history;

    public function __construct(CoinHistoryRepository $CoinHistoryRepository)
    {
      $this->middleware("auth");
      $this->coin_history = $CoinHistoryRepository;
    }

    public function create()
    {
      $servers = Server::not_blocked_orderby_created()->get();
      return view("coins.create", ["servers" => $servers]);
    }

    public function store(Request $request)
    {
      $quantity = request()->quantity;
      $server = request()->input("server");
      $errors = $this->validator($request);

      if (count($errors)) {
        return redirect()->back()->withErrors($errors);
      }
      $player = new PlayerRepository($server);
      //insert coin thanh knb
      Auth::user()->update_coin(-$quantity);
      $this->coin_history->create([
        "changed" => $quantity,
        "server_id" => 1,
        "remaining" => Auth::user()->coin
      ]);

      $player->insert_into_userorder($quantity, Auth::user()->email);
      return redirect()->back()->with("success", __("coins.coin_success", ["coin" => $quantity]));
    }

    private function validator($request) {
      $validator = Validator::make($request->all(),[
        "server" => "required",
        "quantity" => "required|numeric|min:1|max:100000000",
      ]);
      if ($validator->fails()){
        return $validator->messages()->messages();
      }

      $player = new PlayerRepository($request->input("server"));
      $errors = array();

      if (!$player->find_by("userName", Auth::user()->enter_account())) {
        $errors["errors"][] = __("servers.server_not_exists_player");
      }

      if ($request->quantity > Auth::user()->coin) {
        $errors["errors"][] = __("coins.greater_my_coin");
      }

      return $errors;
    }
}
