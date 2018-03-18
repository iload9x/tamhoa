<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameIdIntoServersTable extends Migration
{
  public function up()
  {
    Schema::table("servers", function (Blueprint $table) {
      $table->integer("game_id");
    });
  }

  public function down()
  {
  }
}
