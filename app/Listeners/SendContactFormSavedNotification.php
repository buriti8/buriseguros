<?php

namespace App\Listeners;

use App\Events\ContactFormSaved;
use App\Jobs\SendContactForm;

class SendContactFormSavedNotification
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
    public function handle(ContactFormSaved $event)
    {
        if ($event->contact_form) {
            SendContactForm::dispatch($event->contact_form)->delay(now()->addSeconds(2));
        }
    }
}
