<?php

namespace App\Domain\Contact\DTO;


use App\Domain\Contact\VO\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class ContactDTO
{
    private $name;
    private $phone;
    private $userId;

    /**
     * @var bool
     */
    private $isFavorite;

    /**
     * ContactDTO constructor.
     * @param string $name
     * @param Phone $phone
     * @param int $userId
     * @param bool $isFavorite
     * @throws ValidationException
     */
    public function __construct(string $name, Phone $phone, int $userId, bool $isFavorite)
    {
        $this->validate($name, $phone);

        $this->name   = $name;
        $this->phone  = $phone;
        $this->userId = $userId;
        $this->isFavorite = $isFavorite;
    }

    /**
     * @param string $name
     * @param Phone $phone
     * @throws ValidationException
     */
    private function validate(string $name, Phone $phone)
    {

        $validator = Validator::make(
            [
                'name'  => $name,
                'phone' => $phone,
            ],
            [
                'name'  => 'required|max:255',
                'phone' => 'required',
            ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }


    /**
     * @param Request $request
     * @return ContactDTO
     * @throws ValidationException
     */
    public static function fromRequest(Request $request): self
    {
        return new self(
            (string)$request->get('name'),
            new Phone($request->get('phone')),
            $request->user()->id,
            (bool)$request->get('favorite') ?? false
        );
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        return $this->isFavorite;
    }
}
