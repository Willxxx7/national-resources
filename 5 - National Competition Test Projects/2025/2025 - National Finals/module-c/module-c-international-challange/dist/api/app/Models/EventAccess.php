<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventAccess extends Model
{
    protected $table = 'event_accesses';
    protected $primaryKey = null;
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    /*
     * Define relationships
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
