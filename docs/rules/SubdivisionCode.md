# SubdivisionCode

- `SubdivisionCode(string $countryCode)`

Validates subdivision country codes according to [ISO 3166-2][].

The `$countryCode` must be a country in [ISO 3166-1 alpha-2][] format.

```php
v::subdivisionCode('BR')->validate('SP'); // true
v::subdivisionCode('US')->validate('CA'); // true
```

This rule uses data from [sokil/php-isocodes][].

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
- [Tld](Tld.md)

[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[ISO 3166-1 alpha-2]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 "ISO 3166-1 alpha-2"
[ISO 3166-2]: http://en.wikipedia.org/wiki/ISO_3166-2 "ISO 3166-2"
