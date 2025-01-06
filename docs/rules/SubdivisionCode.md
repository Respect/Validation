# SubdivisionCode

- `SubdivisionCode(string $countryCode)`

Validates subdivision country codes according to [ISO 3166-2][].

The `$countryCode` must be a country in [ISO 3166-1 alpha-2][] format.

```php
v::subdivisionCode('BR')->isValid('SP'); // true
v::subdivisionCode('US')->isValid('CA'); // true
```

This rules uses data from [iso-codes][].

## Categorization

- ISO codes
- Localization

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [CurrencyCode](CurrencyCode.md)
- [KeyValue](KeyValue.md)
- [Nip](Nip.md)
- [Pesel](Pesel.md)
- [PolishIdCard](PolishIdCard.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [Tld](Tld.md)

[iso-codes]: https://salsa.debian.org/iso-codes-team/iso-codes
[ISO 3166-1 alpha-2]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 "ISO 3166-1 alpha-2"
[ISO 3166-2]: http://en.wikipedia.org/wiki/ISO_3166-2 "ISO 3166-2"
