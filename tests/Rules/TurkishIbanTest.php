<?php

namespace Serkanosna\LaravelTrValidator\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Serkanosna\LaravelTrValidator\Rules\TurkishIban;
use Serkanosna\LaravelTrValidator\Tests\TestCase;

class TurkishIbanTest extends TestCase
{
    #[DataProvider('validIbans')]
    public function test_valid_iban_passes(string $value): void
    {
        $validator = Validator::make(['iban' => $value], ['iban' => new TurkishIban]);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidIbans')]
    public function test_invalid_iban_fails(string $value): void
    {
        $validator = Validator::make(['iban' => $value], ['iban' => new TurkishIban]);

        $this->assertFalse($validator->passes());
    }

    public static function validIbans(): array
    {
        return [
            ['TR330006100519786457841326'],
            ['tr33 0006 1005 1978 6457 8413 26'],
        ];
    }

    public static function invalidIbans(): array
    {
        return [
            'yanlis checksum' => ['TR340006100519786457841326'],
            'yanlis ulke kodu' => ['DE330006100519786457841326'],
            'kisa' => ['TR3300061005197864578413'],
            'gecersiz karakter' => ['TR33000610051978645784132!'],
        ];
    }
}
