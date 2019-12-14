<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Percentage implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strpos($value, '%') !== false) {
            $value = rtrim($value, '%');
        } else {
            return false;
        }
        return preg_match("/(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A valid percentage is required. eg.10%';
    }
}
