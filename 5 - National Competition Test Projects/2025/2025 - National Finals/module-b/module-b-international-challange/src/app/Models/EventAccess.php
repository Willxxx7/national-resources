<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventAccess extends BaseModel
{
    protected $table = 'event_accesses';

    /**
     * Composite primary keys are not supported by Eloquent by default.
     * Therefore, we set the incrementing property to false.
     */
    public $incrementing = false;

    public $primaryKey = 'event_access_id';

    protected $fillable = [
        'event_id',
        'cust_id',
        'access_code',
        'access_granted_date',
        'last_used_date',
        'use_count',
        'is_active'
    ];

    protected $casts = [
        'access_granted_date' => 'date',
        'last_used_date' => 'datetime',
        'use_count' => 'integer',
        'is_active' => 'boolean',
    ];


    /**
     * An EventAccess belongs to an Event.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    //    /**
    //     * An EventAccess belongs to a Customer.
    //     */
    //    public function customer(): BelongsTo
    //    {
    //        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    //    }
}
