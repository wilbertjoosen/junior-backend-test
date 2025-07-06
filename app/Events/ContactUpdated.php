<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class ContactUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Contact $contact) {}

    public function broadcastOn(): Channel
    {
        return new Channel('contacts');
    }

    public function broadcastAs(): string
    {
        return 'contact.updated';
    }

    public function broadcastWith(): array
    {
        return [
            'id'    => $this->contact->id,
            'name'  => $this->contact->name,
            'email' => $this->contact->email,
            'phone' => $this->contact->phone,
        ];
    }
}
