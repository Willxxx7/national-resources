<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPicture extends Model
{
    protected $table = 'order_pictures';
    protected $primaryKey = null;
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    /*
     * Define relationships
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class, 'pic_id', 'pic_id');
    }

    public function pictureSize()
    {
        return $this->belongsTo(PictureSize::class, 'pic_size_id', 'pic_size_id');
    }
}
