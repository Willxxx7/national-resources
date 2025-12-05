<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'cat_id';
    protected $table = 'categories';
    protected $guarded = [];
    public $timestamps = false;

    /*
     * Define relationships
     */
    public function pictures()
    {
        return $this->hasMany(Picture::class, '_cat_id', 'cat_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'cat_id', 'cat_id');
    }
}
