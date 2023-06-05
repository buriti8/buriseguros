<?php

namespace App\Jobs;

use App\Mail\MailContactForm;
use App\Models\ContactForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $contact_form;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ContactForm $contact_form)
    {
        $this->contact_form = $contact_form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('juan.buritica@asesorsura.com')->send(new MailContactForm($this->contact_form));
    }
}
