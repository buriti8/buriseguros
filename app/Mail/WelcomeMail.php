<?php

namespace App\Mail;

use App\Mail\Abstracts\WelcomeNotificationMail;
use Illuminate\Support\Facades\Log;

class WelcomeMail extends WelcomeNotificationMail
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            return $this->markdown('emails.welcome')
                ->with('user', $this->user)
                ->with('url', $this->url)
                ->subject(__('Bienvenido'));
        } catch (\Exception $e) {
            Log::error('Error al enviar el correo de Bienvenida - ' . $e->getMessage());
        }
    }
}
