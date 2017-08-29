<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("reward_items", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->integer("item_id");
            $table->integer("item_type")->default(0);
            $table->integer("card_storage_level_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("reward_items");
    }
}
