<?php

namespace App\Filters;

use App\Filters\QueryFilter;

final class OrderFilter extends QueryFilter
{
    // return confirmed orders only
    public function confirmed(): void
    {
        $this->builder->where('order_status', 'confirmed');
    }

    // return paid orders only
    public function paid(): void
    {
        $this->builder->where('order_status', 'paid');
    }

    // return cancelled orders only
    public function cancelled(): void
    {
        $this->builder->where('order_status', 'cancelled');
    }
}
