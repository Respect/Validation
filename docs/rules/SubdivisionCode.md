# SubdivisionCode

- `SubdivisionCode(string $countryCode)`

Validates subdivision country codes according to [ISO 3166-2][].

The `$countryCode` must be a country in [ISO 3166-1 alpha-2][] format.

**This rule requires [sokil/php-isocodes][] and [php-isocodes-db-only][] to be installed.**

```php
v::subdivisionCode('BR')->validate('SP'); // true
v::subdivisionCode('US')->validate('CA'); // true
```

## Categorization

- ISO codes
- Localization

## Changelog

Version | Description
--------|-------------
  3.0.0 | Require [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][]
  1.0.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [CurrencyCode](CurrencyCode.md)
- [LazyConsecutive](LazyConsecutive.md)
- [Nip](Nip.md)
- [Pesel](Pesel.md)
- [PolishIdCard](PolishIdCard.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [Tld](Tld.md)

[ISO 3166-1 alpha-2]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 "ISO 3166-1 alpha-2"
[ISO 3166-2]: http://en.wikipedia.org/wiki/ISO_3166-2 "ISO 3166-2"
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
