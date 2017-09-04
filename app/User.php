<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\CardStorage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      "name", "email", "password", "coin",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      "password", "remember_token",
    ];

    public function coin_histories() {
      return $this->hasMany("App\CoinHistory");
    }
    public function posts() {
      return $this->hasMany("App\Post");
    }

    public function cards() {
      return $this->hasMany("App\Card");
    }

    public function card_storage() {
      return $this->hasOne("App\CardStorage");
    }

    public function card_storage_histories() {
      return $this->hasMany("App\CardStorageHistory");
    }

    public function card_daily() {
      return $this->hasMany("App\CardDaily");
    }

    public function card_daily_is_today() {
      $card_daily = $this->card_daily()->latest()->first();

      if ($card_daily) {
        $dt = Carbon::parse($card_daily->created_at);
        return $dt->isToday();
      }
      return false;
    }

    public function card_is_today() {
      $card = $this->cards()->latest()->first();

      if ($card) {
        $dt = Carbon::parse($card->created_at);
        return $dt->isToday();
      }
      return false;
    }

    public function update_coin($coin) {
      return $this->update(["coin" => $this->coin + (int)$coin]);
    }

    public function decrease_card_storage($card_storage) {
      if ($this->card_storage()->count()) {
        $this->card_storage()->update([
          "current" => $this->card_storage->current + (int)$card_storage["current"],
          "total" => $this->card_storage->total + $card_storage["total"]
        ]);

        return true;
      }

      return false;
    }

    public function increase_card_storage($card_storage) {
      if ($this->card_storage()->count()) {
        $this->card_storage()->update([
          "current" => $this->card_storage->current + (int)$card_storage["current"],
          "total" => $this->card_storage->total + $card_storage["total"]
        ]);
      } else {
        $this->card_storage()->create([
          "current" => $card_storage["current"],
          "total" => $card_storage["total"]
        ]);

      }

      return false;
    }

    public function is_admin() {
      return $this->role == 1;
    }

    public function enter_account() {
      return $this->email;
    }
}
