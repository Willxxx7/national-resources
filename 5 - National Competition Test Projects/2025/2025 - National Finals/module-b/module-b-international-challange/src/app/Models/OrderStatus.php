<?php

namespace App\Models;

enum OrderStatus: int
{
    case PENDING = 1;
    case COMPLETE = 2;
    case CANCELLED = 3;
}
