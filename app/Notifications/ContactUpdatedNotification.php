<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Contact;

class ContactUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public function __construct(public Contact $contact) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Contact Updated')
            ->line("Your contact info has been updated.")
            ->line("Name: {$this->contact->name}")
            ->line("Email: {$this->contact->email}")
            ->line("Phone: {$this->contact->phone}");
    }
}
