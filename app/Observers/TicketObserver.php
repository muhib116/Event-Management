<?php

namespace App\Observers;

use App\Models\EventTickets;

class TicketObserver
{
    /**
     * Handle the EventTickets "created" event.
     *
     * @param  \App\Models\EventTickets  $eventTickets
     * @return void
     */
    public function created(EventTickets $eventTickets)
    {
        $eventTickets->design()->create();
    }

    /**
     * Handle the EventTickets "updated" event.
     *
     * @param  \App\Models\EventTickets  $eventTickets
     * @return void
     */
    public function updated(EventTickets $eventTickets)
    {
        //
    }

    /**
     * Handle the EventTickets "deleted" event.
     *
     * @param  \App\Models\EventTickets  $eventTickets
     * @return void
     */
    public function deleted(EventTickets $eventTickets)
    {
        //
    }

    /**
     * Handle the EventTickets "restored" event.
     *
     * @param  \App\Models\EventTickets  $eventTickets
     * @return void
     */
    public function restored(EventTickets $eventTickets)
    {
        //
    }

    /**
     * Handle the EventTickets "force deleted" event.
     *
     * @param  \App\Models\EventTickets  $eventTickets
     * @return void
     */
    public function forceDeleted(EventTickets $eventTickets)
    {
        //
    }
}
