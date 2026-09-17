# Değişiklik Günlüğü

Bu dosyanın biçimi [Keep a Changelog](https://keepachangelog.com/tr/1.1.0/) temel alınarak tutulur.
Sürüm numaralandırması [Semantic Versioning](https://semver.org/lang/tr/) kurallarına uyar.

## [1.0.0] - 2026-09-17

İlk kararlı sürüm.

### Eklendi

- `TcKimlikNo` — 11 haneli T.C. Kimlik Numarasını resmî checksum algoritmasıyla doğrular; yalnızca hane sayısına bakmaz, kontrol basamaklarını da hesaplar.
- `TurkishIban` — `TR` ile başlayan 26 karakterlik IBAN'ı ISO 7064 (mod-97) algoritmasıyla doğrular. Boşluklu ve küçük harfli girişleri kabul eder.
- `TurkishPhoneNumber` — `+90`, `0090`, `0` önekli veya öneksiz 10 haneli sabit hat ve cep telefonu numaralarını doğrular. Boşluk, tire ve parantez temizlenir.
- `TurkishLicensePlate` — il kodu + harf grubu + rakam grubu biçimindeki araç plakalarını doğrular. Plakalarda kullanılmayan harfleri (Q, W, X ve aksanlı harfler) reddeder.
- PHP 8.2 ve 8.3 üzerinde Laravel 12 ile çalışan GitHub Actions test iş akışı.

### Notlar

- Kurallar Laravel'in `ValidationRule` arayüzünü kullanır; servis sağlayıcı kaydı gerekmez.
- Vergi Kimlik No (VKN) doğrulaması bilinçli olarak kapsam dışı bırakıldı. Algoritma net biçimde doğrulanıp güvenilir test verisiyle desteklenmeden eklenmeyecek.

[1.0.0]: https://github.com/serkanosna/laravel-tr-validator/releases/tag/v1.0.0
