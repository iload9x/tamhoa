<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CardStorageLevel;
use App\RewardItem;
use App\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call(CategoriesTableSeeder::class);
       $this->call(GamesTableSeeder::class);
       $this->call(ServersTableSeeder::class);
    }
}
