<?php

namespace App\Actions\Contact;

use App\Models\Contact;
use App\DTOs\ContactData;
use App\Services\ContactService;

class CreateContact
{
    public function __construct(protected ContactService $service) {}

    /**
     * Handle the creation of a new contact.
     *
     * @param ContactData $data
     * @return Contact
     */
    public function handle(ContactData $data): Contact
    {
        return $this->service->store($data);
    }
}
