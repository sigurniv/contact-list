<?php

namespace App\Http\Controllers\Contact;


use App\Domain\Contact\Action\ContactCreateAction;
use App\Domain\Contact\Action\DeleteContactAction;
use App\Domain\Contact\Action\GetContactAction;
use App\Domain\Contact\Action\GetContactListAction;
use App\Domain\Contact\Action\UpdateContactAction;
use App\Domain\Contact\DTO\ContactDTO;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiContactController extends ApiController
{
    /**
     * Get list of user contacts
     * @param Request $request
     * @param GetContactListAction $getUserContactListAction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function get(
        Request $request,
        GetContactListAction $getUserContactListAction
    )
    {
        $userContacts = $getUserContactListAction->handle($request->user()->id);
        return $this->respond($userContacts);
    }

    /**
     * Get user contact by id
     * @param $id
     * @param Request $request
     * @param GetContactAction $getContactAction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function find(
        $id,
        Request $request,
        GetContactAction $getContactAction
    )
    {
        $errors  = [];
        $contact = $getContactAction->handle($request->user()->id, $id);
        if (!$contact) {
            $errors[] = trans('contact.not-found');
        }

        return $this->respond($contact, $errors);
    }

    /**
     * Add new user contact
     * @param Request $request
     * @param ContactCreateAction $contactCreateAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(
        Request $request,
        ContactCreateAction $contactCreateAction
    )
    {
        $errors  = [];
        $contact = null;

        try {
            $contactDTO = ContactDTO::fromRequest($request);
            $contact    = $contactCreateAction->handle($contactDTO);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
        } catch (\Exception $exception) {
            $errors[] = $exception->getMessage();
        }

        return $this->respond($contact, $errors);
    }

    /**
     * Delete existing user contact
     * @param Request $request
     * @param DeleteContactAction $deleteContactAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(
        $id,
        Request $request,
        DeleteContactAction $deleteContactAction
    )
    {
        $deleteContactAction->handle($request->user()->id, $id);
        return $this->respond(['success' => true]);
    }

    /**
     * Update existing contact
     * @param $id
     * @param Request $request
     * @param UpdateContactAction $updateContactAction
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        $id,
        Request $request,
        UpdateContactAction $updateContactAction
    )
    {
        $contact = null;
        $errors  = [];

        try {
            $contact = $updateContactAction->handle($id, ContactDTO::fromRequest($request));
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
        } catch (\Exception $exception) {
            $errors[] = $exception->getMessage();
        }


        return $this->respond($contact, $errors);
    }
}
