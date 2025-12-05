<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PictureSize extends Model
{
    protected $primaryKey = 'pic_size_id';
    protected $table = 'picture_sizes';
    protected $guarded = [];
    public $timestamps = false;

    /*
     * Define relationships
     */
    public function orderPictures()
    {
        return $this->hasMany(OrderPicture::class, 'pic_size_id', 'pic_size_id');
    }
}
