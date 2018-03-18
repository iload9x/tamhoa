<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
  public function run()
  {
    Category::truncate();
    Category::create(["name" => "Tin Tức"]);
    Category::create(["name" => "Sự Kiện"]);
  }
}
