<?php

namespace Serkanosna\LaravelTrValidator\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Serkanosna\LaravelTrValidator\Rules\TurkishLicensePlate;
use Serkanosna\LaravelTrValidator\Tests\TestCase;

class TurkishLicensePlateTest extends TestCase
{
    #[DataProvider('validPlates')]
    public function test_valid_plate_passes(string $value): void
    {
        $validator = Validator::make(['plate' => $value], ['plate' => new TurkishLicensePlate]);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidPlates')]
    public function test_invalid_plate_fails(string $value): void
    {
        $validator = Validator::make(['plate' => $value], ['plate' => new TurkishLicensePlate]);

        $this->assertFalse($validator->passes());
    }

    public static function validPlates(): array
    {
        return [
            'tek harf' => ['34A1234'],
            'iki harf' => ['06AB123'],
            'uc harf' => ['35ABC12'],
            'bosluklu ve kucuk harf' => ['34 ab 123'],
        ];
    }

    public static function invalidPlates(): array
    {
        return [
            'gecersiz il kodu' => ['82AB123'],
            'yasakli harf' => ['34QW123'],
            'rakam yok' => ['34ABC'],
            'format bozuk' => ['ABCDEFG'],
        ];
    }
}
