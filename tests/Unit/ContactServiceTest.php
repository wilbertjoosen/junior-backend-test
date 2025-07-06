<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\DTOs\ContactData;

class ContactServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_contact()
    {
        $service = app(ContactService::class);
        $data = new ContactData(name: 'John Doe', email: 'john@example.com', phone: '1234567890');
        $contact = $service->store($data);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertDatabaseHas('contacts', ['email' => 'john@example.com']);
    }
}
