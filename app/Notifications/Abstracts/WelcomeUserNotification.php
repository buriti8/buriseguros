<?php

namespace App\Notifications\Abstracts;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WelcomeUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = [];

        if($notifiable instanceof User) {
            $channels[] = 'mail';
        }

        return $channels;
    }
}
