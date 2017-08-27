<?php

namespace App\Repositories;

use App\TichLuy;
use Auth;

class TichLuyRepository
{
  public function updateOrCreate($tich_luy) {
    return Auth::user()->tich_luy()->update([
      "current" => $this->select_tichluy_info()->current + $tich_luy["current"],
      "total" => $this->select_tichluy_info()->total + $tich_luy["total"]
    ]);
  }

  private function select_tichluy_info() {
    $user = Auth::user();
    if ($user->tich_luy()->count()) {
      return $user->tich_luy;
    }
    $user->tich_luy()->create(["current" => 0, "total" => 0]);
    return $user->tich_luy;
  }
}
