<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public  function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_user_can_view_contacts_list()
    {
        Contact::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->get('/contacts');
        $response->assertStatus(200);
    }

    public function test_user_can_create_contact()
    {
        $data = [
            'name' => 'Test Contact',
            'email' => 'test@example.com',
            'phone' => '1234567890',
        ];

        $response = $this->actingAs($this->user)->post('/contacts', $data);
        $response->assertRedirect('/contacts');
        $this->assertDatabaseHas('contacts', $data);
    }

    public function test_user_can_update_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->user)->put("/contacts/{$contact->id}", [
            'name' => 'Updated Name',
            'email' => $contact->email,
            'phone' => $contact->phone,
        ]);

        $response->assertRedirect('/contacts');
        $this->assertDatabaseHas('contacts', ['name' => 'Updated Name']);
    }

    public function test_user_can_delete_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('contacts.destroy', ['contact' => $contact->id]));
        $response->assertRedirect('/contacts');
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    public function test_user_can_view_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->user)->get(route('contacts.show', ['contact' => $contact->id]));
        $response->assertStatus(200);
    }

    public function test_delete_contact_returns_404_when_not_found()
    {
        $response = $this->actingAs($this->user)->delete(route('contacts.destroy', ['contact' => 999]));

        $response->assertStatus(404);
    }

    public function test_edit_contact_returns_404_when_not_found()
    {
        $response = $this->actingAs($this->user)->get(route('contacts.edit', ['contact' => 999]));

        $response->assertStatus(404);
    }

    public function test_view_contact_returns_404_when_not_found()
    {
        $response = $this->actingAs($this->user)->get(route('contacts.show', ['contact' => 999]));

        $response->assertStatus(404);
    }

    public function test_guest_cannot_view_contacts_list()
    {
        Contact::factory()->count(3)->create();

        $response = $this->get('/contacts');
        $response->assertRedirect('/login');
    }

    public function test_guest_canot_delete_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->delete("/contacts/{$contact->id}");
        $response->assertRedirect('/login');
    }

    public function test_guest_canot_create_contact()
    {
        $data = [
            'name' => 'Test Contact',
            'email' => 'test@example.com',
            'phone' => '1234567890',
        ];

        $response = $this->post('/contacts', $data);
        $response->assertRedirect('/login');
    }


    public function test_guest_cannot_update_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->put("/contacts/{$contact->id}", [
            'name' => 'Updated Name',
            'email' => $contact->email,
            'phone' => $contact->phone,
        ]);

        $response->assertRedirect('/login');
    }

    public function test_guest_cant_view_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route('contacts.show', ['contact' => $contact->id]));
        $response->assertRedirect('/login');
    }

    public function test_invalid_email_validation_fails()
    {
        $response = $this->actingAs($this->user)->post(route('contacts.store'), [
            'name' => 'Test User',
            'email' => 'not-an-email',
            'phone' => '1234567890'
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_invalid_name_validation_fails()
    {
        $response = $this->actingAs($this->user)->post(route('contacts.store'), [
            'name' => 'Te',
            'email' => 'valid@gmail.com',
            'phone' => '1234567890'
        ]);

        $response->assertSessionHasErrors(['name']);
    }
}
