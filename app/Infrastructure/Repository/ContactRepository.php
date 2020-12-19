<?php

namespace App\Infrastructure\Repository;


use App\Domain\Contact\Model\Contact;
use App\Domain\Contact\Repository\IContactRepository;
use Illuminate\Support\Collection;

class ContactRepository implements IContactRepository
{
    public function save(Contact $contact): Contact
    {
        $contact->save();
        return $contact;
    }

    public function getForUser(int $userId): Collection
    {
        return Contact::where('userId', $userId)->get();
    }


    public function findForUserById(int $userId, int $contactId): ?Contact
    {
        return Contact::where('id', $contactId)->where('userId', $userId)->first();
    }

    public function findForUserByPhone(int $userId, string $phone): ?Contact
    {
        return Contact::where('userId', $userId)
            ->where('phone', $phone)
            ->first();
    }

    public function deleteForUserById(int $userId, int $contactId): bool
    {
        return Contact::where('id', $contactId)->where('userId', $userId)->delete();
    }
}
