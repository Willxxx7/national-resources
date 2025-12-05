<?php

namespace Database\Seeders;

use App\Models\Customer;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CustomerSeeder::class,
            CategorySeeder::class,
            PictureSizeSeeder::class,
            EventSeeder::class,
            EventAccessSeeder::class,
            PictureSeeder::class,
            OrderSeeder::class
        ]);
    }
}
