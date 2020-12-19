<?php

namespace App\Domain\Contact\Action;


use App\Domain\Contact\DTO\ContactDTO;
use App\Domain\Contact\Model\Contact;
use App\Domain\Contact\Repository\IContactRepository;

/**
 * Class ContactCreateAction
 * @package App\Domain\Contact\Action
 */
final class ContactCreateAction
{
    private $contactRepository;

    /**
     * ContactCreateAction constructor.
     * @param IContactRepository $contactRepository
     */
    public function __construct(IContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param ContactDTO $contactDTO
     * @return Contact
     * @throws \Exception
     */
    public function handle(ContactDTO $contactDTO): Contact
    {
        $contact = $this->contactRepository->findForUserByPhone(
            $contactDTO->getUserId(),
            $contactDTO->getPhone()->value()
        );

        if ($contact) {
            throw new \Exception(trans('contact.exists'));
        }

        $contact = new Contact([
            'name'     => $contactDTO->getName(),
            'phone'    => $contactDTO->getPhone()->value(),
            'userId'   => $contactDTO->getUserId(),
            'favorite' => false
        ]);

        $this->contactRepository->save($contact);
        return $contact;
    }
}
