# CurrencyCode

- `CurrencyCode()`
- `CurrencyCode("alpha-3"|"numeric" $set)`

Validates an [ISO 4217][] currency code.

**This rule requires [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] to be installed.**

```php
v::currencyCode()->validate('GBP'); // true
```

This rule supports the two [ISO 4217][] sets:

- `alpha-3`
- `numeric`

## Categorization

- ISO codes
- Localization

## Changelog

Version | Description
--------|-------------
  3.0.0 | Require [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][]
  2.0.0 | Became case-sensitive
  1.0.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [SubdivisionCode](SubdivisionCode.md)

[ISO 4217]: http://en.wikipedia.org/wiki/ISO_4217
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
