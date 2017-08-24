<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create("cards", function (Blueprint $table) {
        $table->increments("id");
        $table->string("serial");
        $table->string("pin");
        $table->string("amount");
        $table->string("telcocode");
        $table->integer("coin")->default(0);
        $table->integer("user_id");
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
      Schema::dropIfExists("card_histories");
    }
}
