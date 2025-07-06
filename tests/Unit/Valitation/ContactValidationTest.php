<?php
namespace Tests\Feature\Validation;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class ContactValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
        // Authenticate user
        $this->actingAs(User::factory()->create());
    }

    public function test_name_is_required()
    {
        $response = $this->from('/contacts/create')->post('/contacts', [
            // name missing
            'email' => 'test@example.com',
            'phone' => '1234567890',
        ]);

        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors('name');
    }

    public function test_email_must_be_valid_and_unique()
    {
        Contact::factory()->create(['email' => 'test@example.com']);

        $response = $this->from('/contacts/create')->post('/contacts', [
            'name' => 'Test Name',
            'email' => 'invalid-email',
            'phone' => '1234567890',
        ]);

        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors('email');

        // Also check for uniqueness
        $response = $this->from('/contacts/create')->post('/contacts', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'phone' => '1234567890',
        ]);

        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors('email');
    }

    public function test_phone_must_be_min_10_chars()
    {
        $response = $this->from('/contacts/create')->post('/contacts', [
            'name' => 'Test Name',
            'email' => 'valid@example.com',
            'phone' => '1234',
        ]);

        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors('phone');
    }
}
