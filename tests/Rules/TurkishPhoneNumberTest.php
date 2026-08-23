<?php

namespace Serkanosna\LaravelTrValidator\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Serkanosna\LaravelTrValidator\Rules\TurkishPhoneNumber;
use Serkanosna\LaravelTrValidator\Tests\TestCase;

class TurkishPhoneNumberTest extends TestCase
{
    #[DataProvider('validNumbers')]
    public function test_valid_phone_number_passes(string $value): void
    {
        $validator = Validator::make(['phone' => $value], ['phone' => new TurkishPhoneNumber]);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidNumbers')]
    public function test_invalid_phone_number_fails(string $value): void
    {
        $validator = Validator::make(['phone' => $value], ['phone' => new TurkishPhoneNumber]);

        $this->assertFalse($validator->passes());
    }

    public static function validNumbers(): array
    {
        return [
            'bosluksuz cep' => ['05321234567'],
            'ulke kodu ile' => ['+905321234567'],
            'bosluklu' => ['0532 123 45 67'],
            'sabit hat' => ['02121234567'],
            'ulke onekiyle sifirsiz' => ['5321234567'],
        ];
    }

    public static function invalidNumbers(): array
    {
        return [
            'onekten sonra sifirla basliyor' => ['00512345678'],
            'kisa' => ['05321234'],
            'harf iceriyor' => ['0532abc4567'],
        ];
    }
}
