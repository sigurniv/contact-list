<?php

namespace App\Domain\Contact\VO;


use App\Domain\Contact\Rule\PhoneRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class Phone
{
    private $phone;

    public function value(): string
    {
        return $this->phone;
    }

    /**
     * Email constructor.
     * @param string $phone
     * @throws ValidationException
     */
    public function __construct(?string $phone)
    {
        $validator = Validator::make(['phone' => $phone], [
            'phone' => new PhoneRule(),
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->phone = $phone;
    }
}
