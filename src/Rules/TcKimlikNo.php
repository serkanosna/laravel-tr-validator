<?php

namespace Serkanosna\LaravelTrValidator\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TcKimlikNo implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->isValid((string) $value)) {
            $fail('Girilen :attribute geçerli bir T.C. Kimlik Numarası değil.');
        }
    }

    private function isValid(string $value): bool
    {
        if (! preg_match('/^[1-9][0-9]{10}$/', $value)) {
            return false;
        }

        $digits = array_map('intval', str_split($value));

        $oddSum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8];
        $evenSum = $digits[1] + $digits[3] + $digits[5] + $digits[7];

        $tenthDigit = ((($oddSum * 7) - $evenSum) % 10 + 10) % 10;

        if ($tenthDigit !== $digits[9]) {
            return false;
        }

        $eleventhDigit = array_sum(array_slice($digits, 0, 10)) % 10;

        return $eleventhDigit === $digits[10];
    }
}
