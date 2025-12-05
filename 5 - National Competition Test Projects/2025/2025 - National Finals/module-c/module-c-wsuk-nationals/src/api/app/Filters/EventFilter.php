<?php

namespace App\Filters;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

final class EventFilter extends QueryFilter
{
    // filter events by city
    public function city(string $city)
    {
        return $this->builder->whereLike('event_city', '%' . $city . '%');
    }

    // filter events by EXACT date
    public function date(string $date)
    {
        return $this->builder->whereDate('event_date', '=', $date);
    }

    // from date (inclusive)
    public function from(string $date)
    {
        return $this->builder->whereDate('event_date', '>=', $date);
    }

    // to date (exclusive)
    public function to(string $date)
    {
        return $this->builder->whereDate('event_date', '<', $date);
    }

    public function search(string $value)
    {
        return $this->builder->where(function (Builder $query) use ($value) {
            return $query->whereLike('event_city', '%' . $value . '%')
                ->orWhereLike('event_name', '%' . $value . '%');
        });
    }

    // sort by date
    public function sort(string $option)
    {
        if ($option == "desc") {
            return $this->builder->orderByDesc('event_date');
        } elseif ($option == "asc") {
            return $this->builder->orderBy('event_date');
        } else {
            return $this->builder;
        }
    }

    public function name(string $name)
    {
        return $this->builder->whereLike('event_name', '%' . $name . '%');
    }

    // filter by category id
    public function cat(string $id)
    {
        return $this->builder->where('cat_id', $id);
    }

    // include event pictures in the result
    public function pictures()
    {
        return $this->builder->with('pictures');
    }
}
