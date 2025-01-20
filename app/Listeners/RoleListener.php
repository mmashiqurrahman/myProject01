<?php

namespace App\Listeners;

use App\Events\RoleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RoleListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RoleCreated $event): void
    {
        Log::info("The Event and its Listener are working fine. Role data: " . json_encode($event->role));
    }
}
