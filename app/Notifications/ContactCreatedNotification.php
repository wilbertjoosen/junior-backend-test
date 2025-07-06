<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Contact;

class ContactCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Contact $contact) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Created')
            ->greeting('Hello!')
            ->line("A new contact was created:")
            ->line("Name: {$this->contact->name}")
            ->line("Email: {$this->contact->email}")
            ->line("Phone: {$this->contact->phone}")
            ->action('View Contact', route('contacts.show', $this->contact));
    }
}
