<?php
namespace App\Services;

use App\Contracts\ContactRepositoryInterface;
use App\DTOs\ContactData;
use App\Events\ContactCreated;
use App\Events\ContactUpdated;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function __construct(
        protected ContactRepositoryInterface $contact_repository
    ) {}

    public function store(ContactData $data): Contact
    {
        return DB::transaction(function () use ($data) {
            $contact = $this->contact_repository->create($data->toArray());

            event(new ContactCreated($contact));

            return $contact;
        });
    }

    public function update(Contact $contact, ContactData $data): Contact
    {
        return DB::transaction(function () use ($contact, $data) {
            $contact = $this->contact_repository->update($contact, $data->toArray());

            event(new ContactUpdated($contact));

            return $contact;
        });
    }

    public function delete(int $contact_id): bool|null
    {
        return DB::transaction(function () use ($contact_id) {
            $contact = $this->contact_repository->findById($contact_id);

            if (!$contact) {
                throw new \Exception('Contact not found.');
            }

            return $this->contact_repository->delete($contact);
        });
    }
}

