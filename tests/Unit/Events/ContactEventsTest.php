<?php

namespace Tests\Unit\Events;

use Tests\TestCase;
use App\Models\Contact;
use App\DTOs\ContactData;
use App\Events\ContactCreated;
use App\Events\ContactUpdated;
use App\Services\ContactService;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_created_event_is_dispatched()
    {
        Event::fake();

        $data = new ContactData(
            name: 'Test',
            email: 'test@example.com',
            phone: '1234567890'
        );

        $service = app(ContactService::class);
        $service->store($data);

        Event::assertDispatched(ContactCreated::class);
    }

    public function test_contact_updated_event_is_dispatched()
    {
        Event::fake();

        $contact = Contact::factory()->create();
        $data = new ContactData(
            name: 'Updated',
            email: $contact->email,
            phone: $contact->phone
        );

        $service = app(ContactService::class);
        $service->update($contact, $data);

        Event::assertDispatched(ContactUpdated::class);
    }
}
