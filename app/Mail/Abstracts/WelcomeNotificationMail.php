<?php

namespace App\Mail\Abstracts;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class WelcomeNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->url = URL::to('/home');
        $this->from(config('mail.from.address'), config('mail.from.name'));
    }

    /**
     * @param MailerContract $mailer
     */
    public function send($mailer)
    {
        try {
            parent::send($mailer);
        } catch (\Exception $exception) {
            $this->failed($exception);
        }
    }

    /**
     * @param \Exception $exception
     */
    public function failed(\Exception $exception)
    {
        $message = $exception->getMessage();
        if ($failures = Mail::failures()) {
            $message .= "\r\n" . implode("\r\n", $failures);
        }
    }
}
