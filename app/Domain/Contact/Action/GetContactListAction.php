<?php

namespace App\Domain\Contact\Action;


use App\Domain\Contact\Repository\IContactRepository;
use Illuminate\Support\Collection;

final class GetContactListAction
{
    private $contactRepository;

    public function __construct(IContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function handle(int $userId): Collection
    {
        return $this->contactRepository->getForUser($userId);
    }
}
