<?php

namespace Serkanosna\LaravelTrValidator\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TurkishLicensePlate implements ValidationRule
{
    private const LETTERS = 'ABCDEFGHIJKLMNOPRSTUVYZ';

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->isValid((string) $value)) {
            $fail('Girilen :attribute geçerli bir araç plakası değil.');
        }
    }

    private function isValid(string $value): bool
    {
        $plate = strtoupper(str_replace(' ', '', $value));

        $pattern = sprintf(
            '/^(0[1-9]|[1-7][0-9]|8[01])([%1$s]{1}[0-9]{4}|[%1$s]{2}[0-9]{2,4}|[%1$s]{3}[0-9]{2,3})$/',
            self::LETTERS
        );

        return (bool) preg_match($pattern, $plate);
    }
}
