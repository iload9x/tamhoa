<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
  public function find_by($colunm, $value) {
    return User::where($colunm, $value)->first();
  }
}
