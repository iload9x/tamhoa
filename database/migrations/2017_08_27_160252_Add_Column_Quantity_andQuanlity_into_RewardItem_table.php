<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnQuantityAndQuanlityIntoRewardItemTable extends Migration
{
  public function up()
  {
    Schema::table("reward_items", function (Blueprint $table) {
      $table->integer("quantity")->default(0);
      $table->integer("quanlity")->default(0);
    });
  }
}
