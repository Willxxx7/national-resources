<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Picture extends BaseModel
{
    protected $table = 'pictures';

    protected $guarded = [];

    protected $primaryKey = 'pic_id';

    protected $casts = [
        'pic_upload_date' => 'datetime',
        'pic_is_active' => 'boolean',
    ];

    protected $attributes = [
        'pic_is_active' => true,
    ];

    protected static function booted()
    {
        self::created(function (Picture $picture) {
            // Count how many pictures exist for this event (including the current one)
            $count = Picture::where('event_id', $picture->event_id)->count();
            $locator = "E{$picture->event_id}P{$count}";
            $picture->update([
                'pic_locator' => $locator
            ]);
        });
    }

    /**
     * A Picture belongs to an Event.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    /**
     * A Picture may appear in many order pictures.
     */
    public function orderPictures(): HasMany
    {
        return $this->hasMany(OrderPicture::class, 'pic_id', 'pic_id');
    }
}
