<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends BaseModel
{
    protected $table = 'customers';

    protected $primaryKey = 'cust_id';

    protected $fillable = [
        'cust_fname',
        'cust_lname',
        'cust_email',
        'cust_phone',
        'cust_addr1',
        'cust_addr2',
        'cust_postcode'
    ];

    /**
     * A Customer can have many Orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'cust_id', 'cust_id');
    }

    /**
     * A Customer can have many EventAccess records.
     */
    public function eventAccesses(): HasMany
    {
        return $this->hasMany(EventAccess::class, 'cust_id', 'cust_id');
    }

    public function getCustNameAttribute(): string
    {
        return sprintf("%s %s", $this->cust_fname, $this->cust_lname);
    }
}
