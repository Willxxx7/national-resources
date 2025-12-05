<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $john = Customer::firstWhere('cust_email', 'john.doe@mail.com');

        // 1. Confirmed Order
        $order = $john->orders()->create([
            'order_date' => now()->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'confirmed'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 1, 'pic_size_id' => 1, 'pic_qty' => 2
        ]);
        $order->orderPictures()->create([
            'pic_id' => 5, 'pic_size_id' => 3, 'pic_qty' => 2
        ]);

        // 2. Confirmed Order
        $order = $john->orders()->create([
            'order_date' => now()->subDays(20)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'confirmed'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 15, 'pic_size_id' => 4, 'pic_qty' => 5
        ]);
        $order->orderPictures()->create([
            'pic_id' => 9, 'pic_size_id' => 4, 'pic_qty' => 10
        ]);

        // 3. Paid Order
        $order = $john->orders()->create([
            'order_date' => now()->addWeeks(2)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'paid'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 16, 'pic_size_id' => 3, 'pic_qty' => 1
        ]);
        $order->orderPictures()->create([
            'pic_id' => 5, 'pic_size_id' => 3, 'pic_qty' => 2
        ]);
        $order->orderPictures()->create([
            'pic_id' => 7, 'pic_size_id' => 1, 'pic_qty' => 10
        ]);

        // 4. Paid Order
        $order = $john->orders()->create([
            'order_date' => now()->addDays(20)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'paid'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 20, 'pic_size_id' => 7, 'pic_qty' => 10
        ]);

        // 5. Cancelled Order
        $order = $john->orders()->create([
            'order_date' => now()->subMonth(2)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'cancelled'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 15, 'pic_size_id' => 5, 'pic_qty' => 5
        ]);
        $order->orderPictures()->create([
            'pic_id' => 13, 'pic_size_id' => 6, 'pic_qty' => 1
        ]);
        $order->orderPictures()->create([
            'pic_id' => 7, 'pic_size_id' => 1, 'pic_qty' => 10
        ]);

        // 6. Cancelled Order
        $order = $john->orders()->create([
            'order_date' => now()->addDays(24)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'cancelled'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 24, 'pic_size_id' => 3, 'pic_qty' => 12
        ]);

        // 7. Confirmed Order
        $order = $john->orders()->create([
            'order_date' => now()->subDays(5)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'confirmed'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 8, 'pic_size_id' => 2, 'pic_qty' => 3
        ]);

        // 8. Paid Order
        $order = $john->orders()->create([
            'order_date' => now()->addDays(10)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'paid'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 12, 'pic_size_id' => 4, 'pic_qty' => 6
        ]);

        // 9. Cancelled Order
        $order = $john->orders()->create([
            'order_date' => now()->subDays(15)->toDateString(),
            'order_note' => fake()->optional()->text(maxNbChars: 50),
            'order_status' => 'cancelled'
        ]);
        $order->orderPictures()->create([
            'pic_id' => 3, 'pic_size_id' => 2, 'pic_qty' => 4
        ]);
        $order->orderPictures()->create([
            'pic_id' => 10, 'pic_size_id' => 5, 'pic_qty' => 2
        ]);
    }
}
