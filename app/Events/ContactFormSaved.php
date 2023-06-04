<?php

namespace App\Events;

use App\Models\ContactForm;
use Illuminate\Queue\SerializesModels;

class ContactFormSaved
{
    use SerializesModels;

    public $contact_form;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContactForm $contact_form)
    {
        $this->contact_form = $contact_form;
    }
}