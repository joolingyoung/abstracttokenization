<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Currency implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    /**
	 * Generate an example value that satisifies the validation rule.
	 *
	 * @param none.
	 * @return string.
	 *
	 **/
    /**
     * Determine if the validation rule passes.
     *
     * 2. The maximum number of digits before the decimal point.
     * 3. The maximum number of digits after the decimal point.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        if (preg_match("/^[+-]?[0-9]{1,3}(?:,?[0-9]{3})*\.[0-9]{2}$/", $value)) {
            return true;
        } else {
            $a = $value;
            strpos($a, '$') !== false ? $a = ltrim($a, '$') : '';
            if(preg_match("/[a-z]/i", $a)){
                return false;
            }
            $a = sprintf("%.2f", $a);
            return preg_match("/^[+-]?[0-9]{1,3}(?:,?[0-9]{3})*\.[0-9]{2}$/", $a);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A monetary figure is required e.g. $34.00';
    }
}
