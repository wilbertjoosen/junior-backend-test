<?php

namespace Tests\Unit\Notifications;

use App\Events\ContactCreated;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\ContactCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ContactNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_created_notification_is_sent()
    {
        Notification::fake();

        $user = User::factory()->create();
        $this->actingAs($user);

        $contact = Contact::factory()->create();

        event(new ContactCreated($contact));

        Notification::assertSentTo($user, ContactCreatedNotification::class);
    }
}
