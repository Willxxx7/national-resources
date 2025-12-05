<?php

namespace Database\Seeders;

use App\Models\EventAccess;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entries = [
            // event 16
            ['cust_id' => 2, 'event_id' => 16],
            ['cust_id' => 7, 'event_id' => 16],

            // event 17
            ['cust_id' => 8, 'event_id' => 17],
            ['cust_id' => 5, 'event_id' => 17],
            ['cust_id' => 4, 'event_id' => 17],

            // event 18
            ['cust_id' => 6, 'event_id' => 18],
            ['cust_id' => 4, 'event_id' => 18],
            ['cust_id' => 3, 'event_id' => 18],

            // event 19
            ['cust_id' => 1, 'event_id' => 19],
            ['cust_id' => 8, 'event_id' => 19],
            ['cust_id' => 5, 'event_id' => 19],

            // event 20
            ['cust_id' => 6, 'event_id' => 20],

            // event 21
            ['cust_id' => 6, 'event_id' => 21],
            ['cust_id' => 1, 'event_id' => 21],
            ['cust_id' => 4, 'event_id' => 21],
            ['cust_id' => 3, 'event_id' => 21],

            // event 22
            ['cust_id' => 5, 'event_id' => 22],
            ['cust_id' => 8, 'event_id' => 22],
            ['cust_id' => 6, 'event_id' => 22],
            ['cust_id' => 1, 'event_id' => 22],

            // event 23
            ['cust_id' => 3, 'event_id' => 23],
            ['cust_id' => 6, 'event_id' => 23],

            // event 24
            ['cust_id' => 1, 'event_id' => 24],
            ['cust_id' => 6, 'event_id' => 24],
            ['cust_id' => 7, 'event_id' => 24],
            ['cust_id' => 8, 'event_id' => 24],
            ['cust_id' => 5, 'event_id' => 24],

            // event 25
            ['cust_id' => 3, 'event_id' => 25],
            ['cust_id' => 4, 'event_id' => 25],

            // event 26
            ['cust_id' => 1, 'event_id' => 26],
            ['cust_id' => 2, 'event_id' => 26],
            ['cust_id' => 3, 'event_id' => 26],
            ['cust_id' => 4, 'event_id' => 26],
            ['cust_id' => 5, 'event_id' => 26],
            ['cust_id' => 6, 'event_id' => 26],
            ['cust_id' => 7, 'event_id' => 26],
            ['cust_id' => 8, 'event_id' => 26],

            // event 27
            ['cust_id' => 5, 'event_id' => 27],

            // event 28
            ['cust_id' => 8, 'event_id' => 28],
            ['cust_id' => 4, 'event_id' => 28],
            ['cust_id' => 6, 'event_id' => 28],

            // event 29
            ['cust_id' => 2, 'event_id' => 29],
            ['cust_id' => 7, 'event_id' => 29],

            // event 30
            ['cust_id' => 3, 'event_id' => 30],
            ['cust_id' => 1, 'event_id' => 30],
            ['cust_id' => 4, 'event_id' => 30],

            //event 31
             ['cust_id' => 1, 'event_id' => 31],
        ];

        foreach ($entries as $entry) {
            if ($entry['event_id'] === 31) {
                $plainCode = 'TestCode123';
            } else {
                $plainCode = Str::random(10);
            }

            EventAccess::create([
                'event_id' => $entry['event_id'],
                'access_code' => encrypt($plainCode),
                'access_granted_date' => fake()->dateTimeBetween('-5 months'),
                'is_active' => true,
            ]);
        }
    }
}
