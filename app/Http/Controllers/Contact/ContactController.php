<?php

namespace App\Http\Controllers\Contact;


use App\Domain\Contact\Action\ContactCreateAction;
use App\Domain\Contact\Action\DeleteContactAction;
use App\Domain\Contact\Action\GetContactAction;
use App\Domain\Contact\Action\GetContactListAction;
use App\Domain\Contact\Action\UpdateContactAction;
use App\Domain\Contact\DTO\ContactDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
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

        return view('contact.index')->with([
            'contacts' => $userContacts
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @param GetContactAction $getContactAction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(
        $id,
        Request $request,
        GetContactAction $getContactAction
    )
    {
        $contact = $getContactAction->handle($request->user()->id, $id);
        if (!$contact) {
            return redirect()->route('dashboard')->withErrors([
                'contact' => trans('contact.not-found')
            ]);
        }

        return view('contact.show')->with([
            'contact' => $contact
        ]);
    }

    /**
     * @param Request $request
     * @param ContactCreateAction $contactCreateAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(
        Request $request,
        ContactCreateAction $contactCreateAction
    )
    {
        try {
            $contactDTO = ContactDTO::fromRequest($request);
            $contactCreateAction->handle($contactDTO);
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->validator);
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * @param Request $request
     * @param DeleteContactAction $deleteContactAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(
        Request $request,
        DeleteContactAction $deleteContactAction
    )
    {
        $contactId = null;
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'contact') !== false) {
                $contactId = str_replace('contact', '', $key);
                break;
            }
        }

        $deleteContactAction->handle($request->user()->id, $contactId);
        return redirect()->route('dashboard');
    }

    public function update(
        $id,
        Request $request,
        UpdateContactAction $updateContactAction
    )
    {
        try {
            $updateContactAction->handle($id, ContactDTO::fromRequest($request));
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->validator);
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }

        return redirect()->route('dashboard');
    }
}
