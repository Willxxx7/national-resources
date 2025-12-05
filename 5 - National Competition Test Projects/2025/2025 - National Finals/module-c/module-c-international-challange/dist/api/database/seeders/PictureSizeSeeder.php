<?php

namespace Database\Seeders;

use App\Models\PictureSize;
use Illuminate\Database\Seeder;

class PictureSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['label' => '6x4', 'width' => 6.00, 'height' => 4.00, 'price' => 1.50],
            ['label' => '7x5', 'width' => 7.00, 'height' => 5.00, 'price' => 2.00],
            ['label' => '10x8', 'width' => 10.00, 'height' => 8.00, 'price' => 3.00],
            ['label' => '12x8', 'width' => 12.00, 'height' => 8.00, 'price' => 3.50],
            ['label' => 'A5', 'width' => 5.83, 'height' => 8.27, 'price' => 2.50],
            ['label' => 'A4', 'width' => 8.27, 'height' => 11.69, 'price' => 4.00],
            ['label' => 'A3', 'width' => 11.69, 'height' => 16.54, 'price' => 6.00],
            ['label' => 'Square 5x5', 'width' => 5.00, 'height' => 5.00, 'price' => 1.75],
            ['label' => 'Panoramic 12x4', 'width' => 12.00, 'height' => 4.00, 'price' => 3.25],
            ['label' => 'Passport Size', 'width' => 2.00, 'height' => 2.00, 'price' => 1.00],
        ];

        foreach ($sizes as $size) {
            PictureSize::create([
                'pic_size_label' => $size['label'],
                'pic_size_width' => $size['width'],
                'pic_size_height' => $size['height'],
                'pic_size_price' => $size['price'],
            ]);
        }
    }
}
