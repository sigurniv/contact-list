<?php

namespace App\Domain\Contact\Rule;


use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_numeric($value) && strlen($value) === 10;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('contact.bad-phone-format');
    }
}
