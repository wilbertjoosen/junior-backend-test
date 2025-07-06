<?php

namespace App\Actions\Contact;

use App\DTOs\ContactData;
use App\Models\Contact;
use App\Services\ContactService;

class UpdateContact
{
    public function __construct(protected ContactService $service) {}

    /**
     * Handle the update of an existing contact.
     *
     * @param Contact $contact
     * @param ContactData $data
     * @return Contact
     */
    public function handle(Contact $contact, ContactData $data): Contact
    {
        return $this->service->update($contact, $data);
    }
}

