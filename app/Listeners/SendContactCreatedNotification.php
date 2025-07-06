<?php

namespace App\Listeners;

use App\Events\ContactCreated;
use App\Notifications\ContactCreatedNotification;

class SendContactCreatedNotification
{
    public function handle(ContactCreated $event): void
    {
        if (auth()->check()) {
            auth()->user()->notify(new ContactCreatedNotification($event->contact));
        }
    }
}
