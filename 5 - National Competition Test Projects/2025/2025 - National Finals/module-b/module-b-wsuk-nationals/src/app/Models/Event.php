<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends BaseModel
{
    protected $table = 'events';

    protected $primaryKey = 'event_id';

    protected $guarded = [];

    protected $casts = [
        'event_type' => EventType::class,
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        self::created(function (Event $event) {
            // create a folder for the event after it is created
            $type = $event->event_type->value;
            if (!$event->event_folder_path) {
                // if doesn't exist (user didn't enter one) auto generate from event name
                $folderPath = $type . '_events/' . Str::slug($event->event_name, '_');
            } else {
                // turn the user entered folder path into a valid path slug
                $folderPath = $type . '_events/' . Str::slug($event->event_folder_path, '_');
            }

            if (Storage::disk('public')->makeDirectory($folderPath)) {
                $event->update([
                    'event_folder_path' => $folderPath
                ]);
            } else {
                throw new Exception('Error at creating folder for ' . $event->event_name);
            }
        });
    }


    /**
     * An Event can have many Pictures.
     */
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class, 'event_id', 'event_id');
    }

    /**
     * An Event can have many event access records.
     */
    public function eventAccesses(): HasMany
    {
        return $this->hasMany(EventAccess::class, 'event_id', 'event_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id', 'cat_id');
    }

    public function getDateTimeAttribute(): Carbon
    {
        return Carbon::parse(sprintf('%s %s', $this->event_date, $this->event_time));
    }
}
