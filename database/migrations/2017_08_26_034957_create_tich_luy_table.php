<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTichLuyTable extends Migration
{

  public function up()
  {
    Schema::create("tich_luy", function (Blueprint $table) {
      $table->increments("id");
      $table->integer("current")->default(0);
      $table->integer("total")->default(0);
      $table->integer("user_id");
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists("tich_luy");
  }
}
