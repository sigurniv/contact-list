<?php

namespace App\Domain\Contact\Action;


use App\Domain\Contact\Repository\IContactRepository;

class DeleteContactAction
{
    private $contactRepository;

    public function __construct(IContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function handle(int $userId, int $contactId): bool
    {
        return $this->contactRepository->deleteForUserById($userId, $contactId);
    }
}
