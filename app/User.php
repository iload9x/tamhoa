<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function update_coin($coin) {
      return $this->update(["coin" => $this->coin + (int)$coin]);
    }

    public function is_admin() {
      return $this->role == 1;
    }

    public function enter_account() {
      return $this->email;
    }
}
