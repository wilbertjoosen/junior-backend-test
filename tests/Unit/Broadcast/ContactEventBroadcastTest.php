<?php

namespace Tests\Unit\Broadcast;

use App\Events\ContactCreated;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactEventBroadcastTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_created_broadcast_payload()
    {
        $contact = Contact::factory()->create();

        $event = new ContactCreated($contact);

        $payload = $event->broadcastWith();
        $this->assertEquals($payload,  $contact->only(['name','email','phone','id']));
    }

    public function test_broadcast_on_channel()
    {
        $contact = new Contact(['id' => 1]);
        $event = new ContactCreated($contact);

        $this->assertEquals('contacts', $event->broadcastOn()->name);
    }
}
