# Laravel TR Validator

Laravel projelerinde Türkiye'ye özgü verileri doğrulamak için hazır kurallar: **T.C. Kimlik No**, **IBAN**, **telefon numarası** ve **araç plakası**. Her kural gerçek algoritma/format kontrolü yapar — yalnızca "10 haneli mi" gibi yüzeysel bir kontrol değildir.

[![Tests](https://github.com/serkanosna/laravel-tr-validator/actions/workflows/tests.yml/badge.svg)](https://github.com/serkanosna/laravel-tr-validator/actions/workflows/tests.yml)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

## Neden bu paket?

T.C. Kimlik No veya IBAN gibi alanları her projede yeniden regex'leyip checksum hesaplamak yerine, doğru test edilmiş, tek bir yerden bakımı yapılan kurallar kullanmak için yazıldı.

## Gereksinimler

- PHP 8.2 veya üzeri
- Laravel 12

Laravel 10 ve 11 şu an itibarıyla resmi güvenlik desteği süresi dolmuş sürümler; Composer'ın güvenlik denetimi bu sürümlerin bağımlılıklarını kurulum sırasında zaten engelliyor. Bu paket, bakımı süren ve güvenlik yamaları almaya devam eden tek sürüm olan Laravel 12'yi hedefleyerek ilerliyor. İhtiyacınız eski bir Laravel sürümüyse lütfen bir issue açın, değerlendirelim.

## Kurulum

```bash
composer require serkanosna/laravel-tr-validator
```

## Kullanım

Laravel'in modern `ValidationRule` arayüzünü kullandığı için herhangi bir servis sağlayıcı kaydına ihtiyaç duymaz — doğrudan kural listesine ekleyin:

```php
use Serkanosna\LaravelTrValidator\Rules\TcKimlikNo;
use Serkanosna\LaravelTrValidator\Rules\TurkishIban;
use Serkanosna\LaravelTrValidator\Rules\TurkishPhoneNumber;
use Serkanosna\LaravelTrValidator\Rules\TurkishLicensePlate;

$request->validate([
    'tc_no'   => ['required', new TcKimlikNo],
    'iban'    => ['required', new TurkishIban],
    'telefon' => ['required', new TurkishPhoneNumber],
    'plaka'   => ['required', new TurkishLicensePlate],
]);
```

## Kurallar

### `TcKimlikNo`

11 haneli T.C. Kimlik Numarası'nı resmi checksum algoritmasıyla doğrular (sadece hane sayısını değil, kontrol basamaklarını da kontrol eder).

```php
'tc_no' => ['required', new TcKimlikNo],
```

### `TurkishIban`

`TR` ile başlayan 26 karakterlik IBAN'ı standart ISO 7064 (mod-97) algoritmasıyla doğrular. Boşluklu veya küçük harfli girişleri de kabul eder.

```php
'iban' => ['required', new TurkishIban],
```

### `TurkishPhoneNumber`

`+90`, `0090` veya `0` önekiyle ya da öneksiz girilen 10 haneli Türkiye telefon numaralarını (sabit hat + cep telefonu) kabul eder. Boşluk, tire ve parantez otomatik temizlenir.

```php
'telefon' => ['required', new TurkishPhoneNumber],
```

### `TurkishLicensePlate`

Türkiye araç plakası formatını (il kodu + harf grubu + rakam grubu) doğrular. Plakalarda kullanılmayan harfleri (Q, W, X ve Türkçe'ye özgü aksanlı harfler) reddeder.

```php
'plaka' => ['required', new TurkishLicensePlate],
```

## Test

```bash
composer install
vendor/bin/phpunit
```

## Kapsam dışı

`Vergi Kimlik No` (VKN) doğrulaması bilinçli olarak bu sürüme dahil edilmedi — algoritması net biçimde doğrulanıp güvenilir test verisiyle desteklenmeden pakete eklenmeyecek. İlerleyen bir sürümde gelebilir.

## Lisans

MIT. Detaylar için [LICENSE](LICENSE) dosyasına bakın.
