<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

final class ModelResolver
{
    /**
     * Resolves an id ($instance) into a model defined in $modelClass
     * @param string|int|Model $instance
     * @param string $modelClass
     * @return Model
     */
    public static function resolve(string|int|Model $instance, string $modelClass): Model
    {
        return $instance instanceof $modelClass ? $instance : $modelClass::find($instance);
    }

}
