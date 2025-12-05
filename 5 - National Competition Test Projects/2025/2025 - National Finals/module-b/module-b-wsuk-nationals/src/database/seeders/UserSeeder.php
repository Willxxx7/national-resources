<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the first admin user
        User::factory()->create([
            'name' => 'Admin User1',
            'email' => 'admin1@admin.com',
            'password' => 'Password1',
            'suspended_at' => null,
        ]);

        // Create the second admin user
        User::factory()->create([
            'name' => 'Admin User2',
            'email' => 'admin2@admin.com',
            'password' => 'Password2',
            'suspended_at' => now(),
        ]);
    }
}
