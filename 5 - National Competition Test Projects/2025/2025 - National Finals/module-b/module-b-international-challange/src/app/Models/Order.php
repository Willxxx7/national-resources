<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends BaseModel
{
    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'cust_id',
        'order_date',
        'order_note',
        'order_completed_at',
        'order_cancelled_at',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    public $timestamps = false;

    /**
     * An Order belongs to a Customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    }

    /**
     * An Order can have many OrderPicture records.
     */
    public function orderPictures(): HasMany
    {
        return $this->hasMany(OrderPicture::class, 'order_id', 'order_id');
    }

    /**
     * A status indicating the progress made on an order.
     */
    public function getOrderStatusAttribute(): OrderStatus
    {
        if ($this->order_completed_at) {
            return OrderStatus::COMPLETE;
        }

        if ($this->order_cancelled_at) {
            return OrderStatus::CANCELLED;
        }

        return OrderStatus::PENDING;
    }
}
