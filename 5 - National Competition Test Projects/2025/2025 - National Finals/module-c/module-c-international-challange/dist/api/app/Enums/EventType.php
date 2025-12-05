<?php

namespace App\Enums;

/**
 * Enum type for events
 * Used in `event_type` column in `Events` table
 * `Private`: only accessible for customers with access code - see `EventAccess`
 * `Public`: accessible for everyone
 */
enum EventType: string
{
    case PUBLIC = "public";
    case PRIVATE = "private";
}
