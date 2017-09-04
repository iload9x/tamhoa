<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardDailyItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("card_daily_items", function (Blueprint $table) {
      $table->increments("id");
      $table->integer("item_id");
      $table->integer("item_type")->default(0);
      $table->integer("quantity")->default(0);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists("card_daily_items");
  }
}
