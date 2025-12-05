<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $primaryKey = 'pic_id';
    protected $table = 'pictures';
    protected $guarded = [];
    public $timestamps = false;

    protected static function booted()
    {
        self::created(function (Picture $picture) {
            $locator = "E{$picture->event_id}P{$picture->pic_id}";
            $picture->update([
               'pic_locator' => $locator
            ]);
        });
    }


    /*
     * Define relationships
     */

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'cat_id');
    }

    public function orderPictures()
    {
        return $this->hasMany(OrderPicture::class, 'pic_id', 'pic_id');
    }
}
