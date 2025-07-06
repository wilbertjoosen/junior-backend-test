<?php
namespace App\Contracts;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function create(array $data): Contact;
    public function update(Contact $contact, array $data): Contact;
    public function delete(Contact $contact):  bool|null;
    public function findById(int $contact_id): ?Contact;
}
