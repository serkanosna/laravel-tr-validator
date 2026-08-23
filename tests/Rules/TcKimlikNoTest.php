<?php

namespace Serkanosna\LaravelTrValidator\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Serkanosna\LaravelTrValidator\Rules\TcKimlikNo;
use Serkanosna\LaravelTrValidator\Tests\TestCase;

class TcKimlikNoTest extends TestCase
{
    #[DataProvider('validNumbers')]
    public function test_valid_tc_kimlik_no_passes(string $value): void
    {
        $validator = Validator::make(['tc_no' => $value], ['tc_no' => new TcKimlikNo]);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidNumbers')]
    public function test_invalid_tc_kimlik_no_fails(string $value): void
    {
        $validator = Validator::make(['tc_no' => $value], ['tc_no' => new TcKimlikNo]);

        $this->assertFalse($validator->passes());
    }

    public static function validNumbers(): array
    {
        return [
            ['10000000146'],
        ];
    }

    public static function invalidNumbers(): array
    {
        return [
            'kisa' => ['1234567890'],
            'harf iceriyor' => ['1000000014a'],
            'sifirla basliyor' => ['01000000146'],
            'checksum yanlis' => ['10000000147'],
            'hepsi ayni rakam' => ['11111111111'],
        ];
    }
}
