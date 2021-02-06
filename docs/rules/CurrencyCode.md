# CurrencyCode

- `CurrencyCode()`
- `CurrencyCode(string $set)`

Validates an [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code like GBP or EUR.

```php
v::currencyCode()->validate('GBP'); // true
v::currencyCode('alpha-3')->validate('EUR'); // true
v::currencyCode('numeric')->validate('840'); // true
```

This rule uses data from [sokil/php-isocodes][].

## Categorization

- ISO codes
- Localization

## Changelog

Version | Description
--------|-------------
  2.2.0 | Allow to use different sets
  2.0.0 | Became case-sensitive
  1.0.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [SubdivisionCode](SubdivisionCode.md)

[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
