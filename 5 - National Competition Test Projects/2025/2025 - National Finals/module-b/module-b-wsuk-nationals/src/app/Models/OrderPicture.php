<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPicture extends BaseModel
{
    protected $table = 'order_pictures';

    /**
     * Composite primary keys are not supported by Eloquent by default.
     * Therefore, we set the incrementing property to false.
     */
    public $incrementing = false;

    /**
     * Composite primary keys are not supported by Eloquent by default.
     * Therefore, we set the primary key to null.
     */
    protected $primaryKey = null;

    protected $fillable = [
        'order_id',
        'pic_id',
        'pic_size_id',
        'pic_qty'
    ];

    /**
     * An OrderPicture belongs to an Order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * An OrderPicture belongs to a Picture.
     */
    public function picture(): BelongsTo
    {
        return $this->belongsTo(Picture::class, 'pic_id', 'pic_id');
    }

    /**
     * An OrderPicture belongs to a PictureSize.
     */
    public function pictureSize(): BelongsTo
    {
        return $this->belongsTo(PictureSize::class, 'pic_size_id', 'pic_size_id');
    }
}
