<?php

namespace App\Mail;

use App\Models\ContactForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $contact_form;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactForm $contact_form)
    {
        $this->contact_form = $contact_form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact_form', [
            'contact_form' => $this->contact_form,
        ])
            ->subject(__('contact_forms.subject', ['name' => $this->contact_form->name]))
            ->from(config('mail.from.address'), config('mail.from.name'));
    }
}
