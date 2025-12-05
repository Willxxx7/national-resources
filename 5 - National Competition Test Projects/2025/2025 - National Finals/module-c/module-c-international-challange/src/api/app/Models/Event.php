<?php

namespace App\Models;

use App\Enums\EventType;
use App\Filters\QueryFilter;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $primaryKey = 'event_id';
    protected $table = 'events';
    protected $guarded = [];

    protected static function booted(): void
    {
        self::created(function (Event $event) {
            // create a folder for the event after it is created
            $type = $event->event_type == "PUBLIC" ? "public" : "private";
            $folderPath = $type.'_events/'. Str::slug($event->event_name, '_');
            if (Storage::disk('public')->makeDirectory($folderPath)) {
                $event->update([
                    'event_folder_path' => $folderPath
                ]);
            } else {
                throw new Exception('Error at creating folder for ' . $event->event_name);
            }
        });
    }

    /*
     * Custom query scopes
     */
    public function scopePrivate(Builder $builder): Builder
    {
        // return all private events
        return $builder->where('event_type', EventType::PRIVATE->name);
    }

    public function scopePublic(Builder $builder): Builder
    {
        // return all public events
        return $builder->where('event_type', EventType::PUBLIC->name);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /*
     * Define relationships
     */
    public function pictures()
    {
        return $this->hasMany(Picture::class, 'event_id', 'event_id');
    }

    public function eventAccesses()
    {
        return $this->hasMany(EventAccess::class, 'event_id', 'event_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'cat_id');
    }

    /*
     * Define attributes
     */
    public function getIsPrivateAttribute(): bool
    {
        return $this->event_type === EventType::PRIVATE->name;
    }

    public function getIsPublicAttribute(): bool
    {
        return $this->event_type === EventType::PUBLIC->name;
    }
}
