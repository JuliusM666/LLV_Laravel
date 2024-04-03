<?php

namespace App\Listeners;

use App\Events\LocationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NewLocation;

class SendLocationCreatedNotifications implements ShouldQueue
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
    public function handle(LocationCreated $event): void
    {
       
        foreach (User::whereNot('isAdmin', True)->cursor() as $user) {

            $user->notify(new NewLocation($event->location));

        }
    }
}
