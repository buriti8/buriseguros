<?php

namespace App\Listeners;

use App\Customer;
use App\Events\UserSaved as Event;
use App\Jobs\SendWelcomeNotification;
use App\RoleBase;
use App\User;

class UserSaved
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Event $event)
    {
        /* if ($event->user && !$event->user->is_admin) {
            $event->user->syncRoles(RoleBase::SEARCH);
        }

        if ($event->user->wasRecentlyCreated && $event->user->hasRole(RoleBase::SEARCH)) {
            SendWelcomeNotification::dispatch($event->user)->delay(now()->addSeconds(1));
        } */
    }
}
