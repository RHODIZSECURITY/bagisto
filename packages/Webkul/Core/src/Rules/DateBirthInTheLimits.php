<?php

namespace Webkul\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class DateBirthInTheLimits implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) return;

        // Convertir el valor a una fecha para validación
        try {

            if (!Carbon::createFromFormat(config('app.only_date_format'), $value)->isValid()) {
                $fail(__('rhodiz_config::app.validation.date_bad_format'));
                return;
            }

            $birthDate = new \DateTime($value);

        } catch (\Exception $e) {
            $fail(__('rhodiz_config::app.validation.date_bad_format'));
            return;
        }

        // Fecha mínima permitida (01-01-1900)
        $minDate = new \DateTime('1900-01-01');

        // Fecha máxima permitida (hoy)
        $maxDate = new \DateTime();

        if ($birthDate > $maxDate) {
            $fail(__('rhodiz_config::app.validation.date_after_max'));
            return;
        }

        // Validar si la fecha está en el rango
        if ($birthDate < $minDate) {
            $fail(__('rhodiz_config::app.validation.date_before_min', ['date_min' => $minDate->format('m/d/Y')]));
        }
    }
}
