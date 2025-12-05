<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseModel
{
    protected $table = 'categories';

    protected $fillable = ['cat_name'];

    protected $primaryKey = 'cat_id';

    /**
     * A Category can have many Pictures.
     */
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class, 'cat_id', 'cat_id');
    }
}
