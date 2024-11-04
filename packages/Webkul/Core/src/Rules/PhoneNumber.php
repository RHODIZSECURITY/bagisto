<?php

namespace Webkul\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * This regular expression allows phone numbers with the following conditions:
         * - The phone number can start with an optional "+" sign.
         * - After the "+" sign, there should be one or more digits.
         */
         $regex = '/^(\+1\s?)?(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/';
         if (!preg_match($regex, $value)) {
            $fail('core::validation.phone-number')->translate();
         }
    }
}
