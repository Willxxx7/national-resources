<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Event;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Customer $customer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Customer $customer, Event $event): bool
    {
        return $event->is_public || $customer->eventAccesses()->where('event_id', $event->event_id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Customer $customer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Customer $customer, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Customer $customer, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Customer $customer, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Customer $customer, Event $event): bool
    {
        return false;
    }
}
