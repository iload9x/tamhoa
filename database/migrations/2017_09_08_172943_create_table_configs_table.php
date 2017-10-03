<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfigsTable extends Migration
{

  public function up()
  {
    Schema::create("configs", function (Blueprint $table) {
      $table->increments("id");
      $table->string("group");
      $table->string("keyword");
      $table->string("description");
      $table->string("value");
      $table->string("type");

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists("configs");
  }
}
