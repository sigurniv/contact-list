<?php

namespace App\Domain\Contact\Repository;


use App\Domain\Contact\Model\Contact;
use Illuminate\Support\Collection;

interface IContactRepository
{
    public function save(Contact $contact): Contact;

    public function getForUser(int $userId): Collection;

    public function findForUserById(int $userId, int $contactId): ?Contact;

    public function findForUserByPhone(int $userId, string $phone): ?Contact;

    public function deleteForUserById(int $userId, int $contactId): bool;
}
