<?php

namespace Serkanosna\LaravelTrValidator\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TurkishIban implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->isValid((string) $value)) {
            $fail('Girilen :attribute geçerli bir Türkiye IBAN numarası değil.');
        }
    }

    private function isValid(string $value): bool
    {
        $iban = strtoupper(str_replace(' ', '', $value));

        if (! preg_match('/^TR[0-9]{2}[0-9A-Z]{22}$/', $iban)) {
            return false;
        }

        $rearranged = substr($iban, 4).substr($iban, 0, 4);

        $numeric = '';
        foreach (str_split($rearranged) as $char) {
            $numeric .= ctype_alpha($char) ? (string) (ord($char) - 55) : $char;
        }

        $remainder = 0;
        foreach (str_split($numeric) as $digit) {
            $remainder = ($remainder * 10 + (int) $digit) % 97;
        }

        return $remainder === 1;
    }
}
