<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class PictureSize extends BaseModel
{
    protected $table = 'picture_sizes';

    protected $primaryKey = 'pic_size_id';

    protected $fillable = [
        'pic_size_label',
        'pic_size_width',
        'pic_size_height'
    ];

    /**
     * A PictureSize can be associated with many OrderPicture records.
     */
    public function orderPictures(): HasMany
    {
        return $this->hasMany(OrderPicture::class, 'pic_size_id', 'pic_size_id');
    }
}
