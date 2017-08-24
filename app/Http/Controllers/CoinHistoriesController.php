<?php

namespace App\Http\Controllers;
use DB;
use Validator;
use Illuminate\Http\Request;
use App\Repositories\PlayerRepository;
use App\Server;
use App\GameServer;
use App\CoinHistory;
use Auth;

class CoinHistoriesController extends Controller
{

    public function __construct()
    {
      $this->middleware("auth");
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

      $validator = Validator::make($request->all(),[
        "server" => "required",
        "quantity" => "required|numeric|min:1|max:100000000",
      ]);

      $validator->after(function($validator) {
        $player = new PlayerRepository(request()->input("server"));

        if (!$player->find_by("userName", Auth::user()->email)) {
          $validator->errors()->add("player", "Máy chủ hiện tại chưa tạo nhân vật!");
        }

        if (request()->quantity > Auth::user()->coin) {
          $validator->errors()->add("coin", "Vượt quá số coin bạn hiện có!");
        }
      });

      if ($validator->fails())
        return redirect()->route("coin.create")->withErrors($validator->messages());
      $player = new PlayerRepository($server);
      //insert coin thanh knb
      Auth::user()->update_coin($quantity);
      Auth::user()->coin_histories()
        ->save(new CoinHistory([
          "changed" => $quantity,
          "remaining" => Auth::user()->coin
        ]
      ));
      $player->insert_into_userorder($quantity, Auth::user()->email);

      return redirect()->route("coin.create");
    }

    public function show($id)
    {
      //
    }

    public function edit($id)
    {
      //
    }

    public function update(Request $request, $id)
    {
      //
    }

    public function destroy($id)
    {
      //
    }
}
