<?php

namespace App\Models;

enum EventType: string
{
    case PRIVATE = 'private';
    case PUBLIC = 'public';
}
