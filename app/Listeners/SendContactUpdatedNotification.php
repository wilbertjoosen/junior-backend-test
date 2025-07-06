<?php

namespace App\Listeners;

use App\Events\ContactUpdated;
use App\Notifications\ContactUpdatedNotification;

class SendContactUpdatedNotification
{
    public function handle(ContactUpdated $event): void
    {
        auth()->user()?->notify(new ContactUpdatedNotification($event->contact));
    }
}
