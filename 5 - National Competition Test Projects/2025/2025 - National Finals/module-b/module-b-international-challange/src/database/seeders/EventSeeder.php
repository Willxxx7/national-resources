<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->public();

        $this->private();
    }

    private function public(): void
    {
        Event::create([
            'event_id' => 1,
            'event_name' => 'Portsmouth Graduation 2025',
            'cat_id' => 1, // graduation
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Portsmouth',
            'event_date' => '2025-07-01',
            'event_time' => '14:00:00',
            'event_note' => 'Open to public. Photos available by student name.',
        ]);

        Event::create([
            'event_id' => 2,
            'event_name' => 'Summer Dog Show',
            'cat_id' => 10, // pet events
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Chichester',
            'event_date' => '2025-08-10',
            'event_time' => '12:00:00',
            'event_note' => 'Open event. Pet owners can search by dog name.',
        ]);

        Event::create([
            'event_id' => 3,
            'event_name' => 'Bournemouth Dance Finals',
            'cat_id' => 3, // competition
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Bournemouth',
            'event_date' => '2025-09-03',
            'event_time' => '16:00:00'
        ]);

        Event::create([
            'event_id' => 4,
            'event_name' => 'Vintage Car Rally',
            'event_type' => EventType::PUBLIC,
            'cat_id' => 2, // festival
            'event_city' => 'Brighton',
            'event_date' => '2025-08-05',
            'event_time' => '13:00:00',
            'event_note' => 'Free for all. Classics and modern cars.',
        ]);

        Event::create([
            'event_id' => 5,
            'event_name' => 'Community Art Festival',
            'cat_id' => 2, // festival
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Portsmouth',
            'event_date' => '2025-07-22',
            'event_time' => '10:00:00',
            'event_note' => 'Local artists exhibit works.',
        ]);

        Event::create([
            'event_id' => 6,
            'event_name' => 'Hastings Beach BBQ',
            'event_type' => EventType::PUBLIC,
            'cat_id' => 13, // community
            'event_city' => 'Hastings',
            'event_date' => '2025-07-19',
            'event_time' => '18:00:00'
        ]);

        Event::create([
            'event_id' => 7,
            'event_name' => 'Public Open Mic Night',
            'event_type' => EventType::PUBLIC,
            'cat_id' => 13, // community
            'event_city' => 'Reading',
            'event_date' => '2025-07-12',
            'event_time' => '20:00:00',
            'event_note' => 'Singers and poets welcome.',
        ]);

        Event::create([
            'event_id' => 8,
            'event_name' => 'Science Expo',
            'cat_id' => 2, // festival
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Oxford',
            'event_date' => '2025-08-15',
            'event_time' => '11:00:00'
        ]);

        Event::create([
            'event_id' => 9,
            'event_name' => 'Food Truck Fiesta',
            'cat_id' => 2, // festival
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Southampton',
            'event_date' => '2025-07-28',
            'event_time' => '12:00:00',
            'event_note' => 'Try 20+ food vendors.',
        ]);

        Event::create([
            'event_id' => 10,
            'event_name' => 'Marathon Finish Line',
            'cat_id' => 3, // competition
            'event_type' => EventType::PUBLIC,
            'event_city' => 'London',
            'event_date' => '2025-10-01',
            'event_time' => '14:00:00',
            'event_note' => 'Public cheering area and photos.',
        ]);

        Event::create([
            'event_id' => 11,
            'event_name' => 'Photography Walk',
            'cat_id' => 12, // photography walks
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Bath',
            'event_date' => '2025-06-30',
            'event_time' => '09:00:00'
        ]);

        Event::create([
            'event_id' => 12,
            'event_name' => 'Community Fireworks Night',
            'cat_id' => 11, // seasonal
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Exeter',
            'event_date' => '2025-11-05',
            'event_time' => '19:00:00',
            'event_note' => 'Free entry, bring blankets.',
        ]);

        Event::create([
            'event_id' => 13,
            'event_name' => 'Portsmouth Food Festival',
            'cat_id' => 2, // festival
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Portsmouth',
            'event_date' => '2025-07-18',
            'event_time' => '12:00:00',
            'event_note' => 'Open to all. Food stalls and live music.',
        ]);

        Event::create([
            'event_id' => 14,
            'event_name' => 'University Open Day',
            'cat_id' => 7, // school events
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Southampton',
            'event_date' => '2025-09-14',
            'event_time' => '10:00:00',
            'event_note' => 'For prospective students and families.',
        ]);

        Event::create([
            'event_id' => 15,
            'event_name' => 'Charity Fun Run',
            'cat_id' => 8, // charity
            'event_type' => EventType::PUBLIC,
            'event_city' => 'Guildford',
            'event_date' => '2025-08-20',
            'event_time' => '09:30:00'
        ]);
    }

    private function private(): void
    {
        Event::create([
            'event_id' => 16,
            'event_name' => 'Smith Family Portraits',
            'cat_id' => 4, // private session
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Southampton',
            'event_date' => '2025-06-15',
            'event_time' => '10:30:00',
            'event_note' => 'Private booking. Access restricted to family.',
        ]);

        Event::create([
            'event_id' => 17,
            'event_name' => 'Olivia & Marcus Wedding',
            'cat_id' => 5, // wedding/engagement
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Winchester',
            'event_date' => '2025-06-28',
            'event_time' => '15:00:00',
        ]);

        Event::create([
            'event_id' => 18,
            'event_name' => 'St. Mary’s Year 11 Prom',
            'cat_id' => 7, // school events
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Guildford',
            'event_date' => '2025-07-05',
            'event_time' => '19:00:00',
            'event_note' => 'Private school prom. Code required to access photos.',
        ]);

        Event::create([
            'event_id' => 19,
            'event_name' => 'Jones Family Reunion',
            'cat_id' => 4, // private session
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Oxford',
            'event_date' => '2025-07-14',
            'event_time' => '13:30:00',
        ]);

        Event::create([
            'event_id' => 20,
            'event_name' => 'Corporate Headshots',
            'cat_id' => 9, // corporate
            'event_type' => EventType::PRIVATE,
            'event_city' => 'London',
            'event_date' => '2025-08-01',
            'event_time' => '09:00:00',
            'event_note' => 'Photoshoot for internal use only.',
        ]);

        Event::create([
            'event_id' => 21,
            'event_name' => 'Lucy’s 18th Birthday',
            'cat_id' => 4, // private session
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Reading',
            'event_date' => '2025-09-10',
            'event_time' => '18:00:00',
            'event_note' => 'Private garden party celebration.',
        ]);

        Event::create([
            'event_id' => 22,
            'event_name' => 'Wilson Engagement Party',
            'cat_id' => 5, // wedding/engagement
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Bath',
            'event_date' => '2025-08-12',
            'event_time' => '17:00:00'
        ]);

        Event::create([
            'event_id' => 23,
            'event_name' => 'Model Portfolio Shoot',
            'cat_id' => 4, // private session
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Brighton',
            'event_date' => '2025-07-25',
            'event_time' => '14:00:00',
            'event_note' => 'Booked model sessions only.',
        ]);

        Event::create([
            'event_id' => 24,
            'event_name' => 'Harris Baby Shower',
            'cat_id' => 4, // private session
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Bristol',
            'event_date' => '2025-06-27',
            'event_time' => '15:00:00',
            'event_note' => 'Photos shared only with attendees.',
        ]);

        Event::create([
            'event_id' => 25,
            'event_name' => 'Studio Christmas Session',
            'cat_id' => 11, // seasonal
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Southampton',
            'event_date' => '2025-12-12',
            'event_time' => '11:00:00',
        ]);

        Event::create([
            'event_id' => 26,
            'event_name' => 'Pet Portraits Day',
            'cat_id' => 10, // pet events
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Portsmouth',
            'event_date' => '2025-07-03',
            'event_time' => '10:00:00',
            'event_note' => 'Private bookings only.',
        ]);

        Event::create([
            'event_id' => 27,
            'event_name' => 'Graduation Photos Retake',
            'cat_id' => 1, // graduation
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Guildford',
            'event_date' => '2025-07-15',
            'event_time' => '14:00:00',
            'event_note' => 'Only for students who missed main event.',
        ]);

        Event::create([
            'event_id' => 28,
            'event_name' => 'Client Branding Session',
            'cat_id' => 9, // corporate
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Oxford',
            'event_date' => '2025-09-03',
            'event_time' => '09:00:00',
        ]);

        Event::create([
            'event_id' => 29,
            'event_name' => 'Family Christmas Portraits',
            'cat_id' => 11, // seasonal
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Chichester',
            'event_date' => '2025-12-03',
            'event_time' => '13:00:00',
            'event_note' => 'Access via family login only.',
        ]);

        Event::create([
            'event_id' => 30,
            'event_name' => 'Engagement Shoot – Priya & Jay',
            'cat_id' => 5, // wedding & engagement
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Winchester',
            'event_date' => '2025-10-12',
            'event_time' => '15:00:00'
        ]);
        Event::create([
            'event_id' => 31,
            'event_name' => 'Private-Test-Event',
            'cat_id' => 13, // community
            'event_type' => EventType::PRIVATE,
            'event_city' => 'Cardiff',
            'event_date' => '2025-11-27',
            'event_time' => '00:00:00'
        ]);
    }
}
