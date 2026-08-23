<?php

namespace Serkanosna\LaravelTrValidator\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TurkishPhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $normalized = preg_replace('/[\s()\-]/', '', (string) $value);

        if (! preg_match('/^(?:\+90|0090|0)?[1-9][0-9]{9}$/', $normalized)) {
            $fail('Girilen :attribute geçerli bir Türkiye telefon numarası değil.');
        }
    }
}
