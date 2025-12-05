<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Picture;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use SplFileInfo;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        foreach ($events as $event) {
            $files = Storage::disk('public')->files($event->event_folder_path);

            // track file index for the event for renaming
            $fileCounter = 1;

            foreach ($files as $filePath) {
                $fullPath = Storage::disk('public')->path($filePath);
                $file = new SplFileInfo($fullPath);

                $ext = $file->getExtension();

                // new name format: <event_id>_pic_<pic_index>
                $newName = 'event_' . $event->event_id . '_pic_' . $fileCounter . '.' . $ext;
                $newFilePath = $event->event_folder_path . '/' . $newName;

                Storage::disk('public')->move($filePath, $newFilePath);

                $event->pictures()->create([
                    'pic_name' => $newName,
                    'pic_upload_date' => Carbon::parse($event->event_date)->addDay()->toDateString(), // fake date -> assume pics were uploaded the day after the event
                    'pic_upload_note' => fake()->optional()->text(maxNbChars: 50),
                    'pic_is_active' => true,
                    'pic_path' => $newFilePath
                ]);

                $fileCounter++;
            }
        }
    }
}
