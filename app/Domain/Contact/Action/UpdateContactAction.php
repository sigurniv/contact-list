<?php

namespace App\Domain\Contact\Action;


use App\Domain\Contact\DTO\ContactDTO;
use App\Domain\Contact\Model\Contact;
use App\Domain\Contact\Repository\IContactRepository;

class UpdateContactAction
{
    /**
     * @var IContactRepository
     */
    private $contactRepository;

    public function __construct(IContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param int $contactId
     * @param ContactDTO $dto
     * @return Contact|null
     * @throws \Exception
     */
    public function handle(int $contactId, ContactDTO $dto): ?Contact
    {
        $contact = $this->contactRepository->findForUserById($dto->getUserId(), $contactId);
        if (!$contact) {
            throw new \Exception(trans('contact.not-found'));
        }


        $phone = $dto->getPhone()->value();
        if ($contact->phone !== $phone) {
            $existingContact = $this->contactRepository->findForUserByPhone(
                $dto->getUserId(),
                $phone
            );

            if ($existingContact) {
                throw new \Exception(trans('contact.exists'));
            }
        }


        $contact->phone    = $phone;
        $contact->favorite = $dto->isFavorite();
        $contact->name     = $dto->getName();

        $this->contactRepository->save($contact);
        return $contact;
    }
}
