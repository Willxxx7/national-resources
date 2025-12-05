<?php

namespace Database\Seeders;

use App\Models\OrderPicture;
use Illuminate\Database\Seeder;

class OrderPictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderPicture::create([
            'order_id' => 1,
            'pic_id' => 5,
            'pic_size_id' => 1,
            'pic_qty' => 5,
        ]);

        OrderPicture::create([
            'order_id' => 1,
            'pic_id' => 7,
            'pic_size_id' => 3,
            'pic_qty' => 2,
        ]);

        OrderPicture::create([
            'order_id' => 2,
            'pic_id' => 1,
            'pic_size_id' => 4,
            'pic_qty' => 10,
        ]);

        OrderPicture::create([
            'order_id' => 2,
            'pic_id' => 2,
            'pic_size_id' => 2,
            'pic_qty' => 10,
        ]);
    }
}
