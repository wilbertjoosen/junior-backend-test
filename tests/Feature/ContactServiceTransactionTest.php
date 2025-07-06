<?php

namespace Tests\Feature;

use App\DTOs\ContactData;
use App\Services\ContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactServiceTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_is_rolled_back_on_exception()
    {
        $this->expectException(\Exception::class);

        $mock = $this->partialMock(ContactService::class, function ($mock) {
            $mock->shouldAllowMockingProtectedMethods();
        });

        $mock->shouldReceive('store')->andThrow(new \Exception('Simulated failure'));

        $contactData = new ContactData('Jane', 'jane@example.com', '1234567890');
        $mock->store($contactData);

        $this->assertDatabaseMissing('contacts', [
            'email' => 'jane@example.com'
        ]);
    }
}
