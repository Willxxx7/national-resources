<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Event;
use App\Models\EventAccess;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventAccessSeeder extends Seeder
{
    public function run(): void
    {
        // event access for event 16 - smith family portraits
        EventAccess::create([
            'cust_id' => 2,
            'event_id' => 16,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 7,
            'event_id' => 16,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 17
        EventAccess::create([
            'cust_id' => 8,
            'event_id' => 17,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 5,
            'event_id' => 17,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 4,
            'event_id' => 17,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 18
        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 18,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 4,
            'event_id' => 18,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 3,
            'event_id' => 18,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 19
        EventAccess::create([
            'cust_id' => 1,
            'event_id' => 19,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 8,
            'event_id' => 19,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 5,
            'event_id' => 19,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 20
        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 20,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 21
        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 21,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 1,
            'event_id' => 21,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 4,
            'event_id' => 21,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 3,
            'event_id' => 21,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 22
        EventAccess::create([
            'cust_id' => 5,
            'event_id' => 22,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 8,
            'event_id' => 22,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 22,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 1,
            'event_id' => 22,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 23
        EventAccess::create([
            'cust_id' => 3,
            'event_id' => 23,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);
        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 23,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 24
        EventAccess::create([
            'cust_id' => 1,
            'event_id' => 24,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 24,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 7,
            'event_id' => 24,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 8,
            'event_id' => 24,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 5,
            'event_id' => 24,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);


        // event 25
        EventAccess::create([
            'cust_id' => 3,
            'event_id' => 25,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 4,
            'event_id' => 25,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 26
        EventAccess::create([
            'cust_id' => 1,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 2,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 3,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 4,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 5,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 7,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 8,
            'event_id' => 26,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 27
        EventAccess::create([
            'cust_id' => 5,
            'event_id' => 27,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 28
        EventAccess::create([
            'cust_id' => 8,
            'event_id' => 28,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 4,
            'event_id' => 28,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 28,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 29
        EventAccess::create([
            'cust_id' => 2,
            'event_id' => 29,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 7,
            'event_id' => 29,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        // event 30
        EventAccess::create([
            'cust_id' => 3,
            'event_id' => 30,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 1,
            'event_id' => 30,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 4,
            'event_id' => 30,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

        EventAccess::create([
            'cust_id' => 6,
            'event_id' => 30,
            'access_code' => Str::random(10),
            'access_granted_date' => now(),
            'is_active' => true
        ]);

    }
}
