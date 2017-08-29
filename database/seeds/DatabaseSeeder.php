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
        // $this->call(UsersTableSeeder::class);
      $props = array(
        "10000" => array(
          "30000" => 200, //Cường hóa tinh
          "80008" => 100, //Chân khí đan
          "1234579" => 1, //Túi quà Chí Tôn
          "1234580" => 1 //500.000.000 EXP.
        ),
        "20000" => array(
          "30000" => 500, //Cường hóa tinh
          "80008" => 200, //Chân khí đan
          "70001" => 200, //Tọa ky luyện thú đan.
          "32023" => 20, //Thần Chú Vương Đỉnh
          "32026" => 20, //Sử thi Vương Đỉnh
          "32027" => 20, //Chí tôn Vương Đỉnh
          "32028" => 20, //Nghijh Thiên Vương Đỉnh
          "32029" => 20, //Vô Lượng Vương Đỉnh
          "1234579" => 3, //Túi quà Chí Tôn
          "1234580" => 1, //500.000.000 EXP.
          "1234586" => 1 //THUI BAO THACH VIEM DE
        ),
        "50000" => array(
          "30000" => 700, //Cường hóa tinh
          "80008" => 300, //Chân khí đan
          "70001" => 300, //Tọa ky luyện thú đan.
          "32023" => 50, //Thần Chú Vương Đỉnh
          "32026" => 50, //Sử thi Vương Đỉnh
          "32027" => 50, //Chí tôn Vương Đỉnh
          "32028" => 50, //Nghijh Thiên Vương Đỉnh
          "32029" => 50, //Vô Lượng Vương Đỉnh
          "1234579" => 7, //Túi quà Chí Tôn
          "1234578" => 2, //Túi quà Hỗn Thiên
          "110014" => 1, //PET HÀNG LONG TÔN GIẢ
          "1234580" => 2, //500.000.000 EXP.
          "1234586" => 2 //THUI BAO THACH VIEM DE
        ),
        "100000" => array(
          "30000" => 700, //Cường hóa tinh
          "80008" => 500, //Chân khí đan
          "70001" => 500, //Tọa ky luyện thú đan.
          "32023" => 100, //Thần Chú Vương Đỉnh
          "32026" => 100, //Sử thi Vương Đỉnh
          "32027" => 100, //Chí tôn Vương Đỉnh
          "32028" => 100, //Nghijh Thiên Vương Đỉnh
          "32029" => 100, //Vô Lượng Vương Đỉnh
          "1234579" => 15, //Túi quà Chí Tôn
          "1234578" => 4, //Túi quà Hỗn Thiên
          "110014" => 1, //PET HÀNG LONG TÔN GIẢ
          "1234580" => 3, //500.000.000 EXP.
          "1234586" => 2 //THUI BAO THACH VIEM DE
        ),
        "200000" => array(
          "30000" => 999, //Cường hóa tinh
          "80008" => 999, //Chân khí đan
          "70001" => 999, //Tọa ky luyện thú đan.
          "32023" => 200, //Thần Chú Vương Đỉnh
          "32026" => 200, //Sử thi Vương Đỉnh
          "32027" => 200, //Chí tôn Vương Đỉnh
          "32028" => 200, //Nghijh Thiên Vương Đỉnh
          "32029" => 200, //Vô Lượng Vương Đỉnh
          "1234579" => 30, //Túi quà Chí Tôn
          "1234578" => 10, //Túi quà Hỗn Thiên
          "110014" => 1, //PET HÀNG LONG TÔN GIẢ
          "140037" => 1, //THẦN BINH 1
          "1234580" => 5, //500.000.000 EXP.
          "1234586" => 3 //THUI BAO THACH VIEM DE
        ),
        "300000" => array(
          "30000" => 999, //Cường hóa tinh
          "80008" => 999, //Chân khí đan
          "70001" => 999, //Tọa ky luyện thú đan.
          "32023" => 300, //Thần Chú Vương Đỉnh
          "32026" => 300, //Sử thi Vương Đỉnh
          "32027" => 300, //Chí tôn Vương Đỉnh
          "32028" => 300, //Nghijh Thiên Vương Đỉnh
          "32029" => 300, //Vô Lượng Vương Đỉnh
          "1234579" => 40, //Túi quà Chí Tôn
          "1234578" => 15, //Túi quà Hỗn Thiên
          "110014" => 1, //PET HÀNG LONG TÔN GIẢ
          "1234572" => 1, //THẦN BINH 2
          "1234580" => 7, //500.000.000 EXP.
          "1234570" => 1, //Trabg bị + 30.
          "1234586" => 3 //THUI BAO THACH VIEM DE
        ),
        "500000" => array(
          "30000" => 999, //Cường hóa tinh
          "80008" => 999, //Chân khí đan
          "70001" => 999, //Tọa ky luyện thú đan.
          "32023" => 500, //Thần Chú Vương Đỉnh
          "32026" => 500, //Sử thi Vương Đỉnh
          "32027" => 500, //Chí tôn Vương Đỉnh
          "32028" => 500, //Nghijh Thiên Vương Đỉnh
          "32029" => 500, //Vô Lượng Vương Đỉnh
          "1234579" => 65, //Túi quà Chí Tôn
          "1234578" => 30, //Túi quà Hỗn Thiên
          "110014" => 1, //PET HÀNG LONG TÔN GIẢ
          "1234573" => 1, //THẦN BINH 3
          "1234580" => 15, //500.000.000 EXP.
          "1234570" => 2, //Trabg bị + 30.
          "1234586" => 5 //THUI BAO THACH VIEM DE

        ),
        "1000000" => array(
          "30000" => 999, //Cường hóa tinh
          "80008" => 999, //Chân khí đan
          "70001" => 999, //Tọa ky luyện thú đan.
          "32023" => 999, //Thần Chú Vương Đỉnh
          "32026" => 999, //Sử thi Vương Đỉnh
          "32027" => 999, //Chí tôn Vương Đỉnh
          "32028" => 999, //Nghijh Thiên Vương Đỉnh
          "32029" => 999, //Vô Lượng Vương Đỉnh
          "1234579" => 65, //Túi quà Chí Tôn
          "1234578" => 65, //Túi quà Hỗn Thiên
          "110014" => 1, //PET HÀNG LONG TÔN GIẢ
          "1234573" => 1, //THẦN BINH 3
          "1234571" => 1, //Túi trang bị hỏa thần lv 90
          "1234580" => 45, //500.000.000 EXP.
          "1234570" => 3, //Trabg bị + 30.
          "1234586" => 10 //THUI BAO THACH VIEM DE
        )
      );

      $items = [
        "30000" => ["quanlity" => 1, "name" => "Cường hóa tinh"],
        "80008" => ["quanlity" => 1, "name" => "Chân khí đan"],
        "70001" => ["quanlity" => 2, "name" => "Tọa ky luyện thú đan"],
        "32023" => ["quanlity" => 2, "name" => "Thần Chú Thần Chú Đỉnh"],
        "32026" => ["quanlity" => 2, "name" => "Sử thi Thần Chú Đỉnh"],
        "32027" => ["quanlity" => 4, "name" => "Chí tôn Thần Chú Đỉnh"],
        "32028" => ["quanlity" => 4, "name" => "Nghịch Thiên Thần Chú Đỉnh"],
        "32029" => ["quanlity" => 4, "name" => "Vô Lượng Thần Chú Đỉnh"],
        "1234579" => ["quanlity" => 4, "name" => "Túi bảo thạch Chí Tôn"],
        "1234578" => ["quanlity" => 5, "name" => "Túi bảo thạch Hỗn Thiên"],
        "110014" => ["quanlity" => 4, "name" => "PET Hàng Long Tôn Giả"],
        "1234572" => ["quanlity" => 5, "name" => "Thần binh cấp 2"],
        "1234573" => ["quanlity" => 5, "name" => "Thần binh cấp 3"],
        "1234571" => ["quanlity" => 5, "name" => "Túi Trang Bị [Hỏa Thần] Lv 90"],
        "1234580" => ["quanlity" => 4, "name" => "500.000.000 EXP"],
        "1234570" => ["quanlity" => 5, "name" => "Trang bị ngẫu nhiên +30"],
        "1234586" => ["quanlity" => 5, "name" => "Túi bảo thạch Viêm Đế"]
      ];

      foreach ($items as $item_id => $value) {
        Item::insert([
          "item_id" => $item_id,
          "quanlity" => $value["quanlity"],
          "name" => $value["name"]
        ]);
      }

      foreach ($props as $level => $items) {
        $card_storage_level = CardStorageLevel::where(["level" => $level])->first();
        if ($card_storage_level) {
          foreach ($items as $item_id => $quantity) {
            $card_storage_level->reward_items()->create([
              "item_id" => $item_id,
              "item_type" => 0,
              "quantity" => $quantity,
            ]);
          }
        }
      }
    }
}
