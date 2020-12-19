<?php

namespace App\Domain\Contact\Action;


use App\Domain\Contact\Model\Contact;
use App\Domain\Contact\Repository\IContactRepository;

final class GetContactAction
{
    /**
     * @var IContactRepository
     */
    private $contactRepository;

    public function __construct(IContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function handle(int $userId, int $contactId): ?Contact
    {
        return Contact::where('id', $contactId)->where('userId', $userId)->first();
    }

}
