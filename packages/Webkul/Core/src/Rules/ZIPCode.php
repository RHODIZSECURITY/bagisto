<?php

namespace Webkul\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ZIPCode implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * Validates if $zipCode is a 5 digit number in the 12345 format.
         * Note that this simply checks to see if $zipCode is a 5 digit number, not necessarily a valid U.S. Zip Code.
         * Includes the optional zip+4 validation if a user decides to include that
         */
        if ( ! preg_match('/^[0-9]{5}$/', $value)) {
            $fail('core::validation.zip-code')->translate();
        }
    }
}
