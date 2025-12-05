<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            EventSeeder::class,
            CustomerSeeder::class,
            PictureSeeder::class,
            EventAccessSeeder::class,
            PictureSizeSeeder::class,
            OrderSeeder::class, // include order pictures
        ]);
    }
}
