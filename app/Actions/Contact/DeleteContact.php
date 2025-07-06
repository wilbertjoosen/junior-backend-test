<?php

namespace App\Actions\Contact;

use App\Services\ContactService;

class DeleteContact
{
    public function __construct(protected ContactService $service) {}

    /**
     * Handle the deletion of a contact.
     *
     * @param int $contact_id
     * @return bool|null
     */
    public function handle(int $contact_id): bool|null
    {
        return $this->service->delete($contact_id);
    }
}
