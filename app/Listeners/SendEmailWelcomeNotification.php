<?php

namespace App\Listeners;

use App\Notifications\User\SendWelcomeMessage;
use Illuminate\Auth\Events\Verified;

class SendWelcomeEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
		$event->user->notify(new SendWelcomeMessage);
    }
}