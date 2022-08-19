<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->sendMailable($user, StudentAddedEmail::class);
    }

    private function sendMailable(User $user, $mailable)
    {
        $user = User::findOrFail($user->id)->first();

        \Mail::to($teacher->email)->send(
            new $mailable($teacher, $student)
        );
    }
}
