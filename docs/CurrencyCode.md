# CurrencyCode

- `v::currencyCode()`

Validates an [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code like GBP or EUR.

```php
v::currencyCode()->validate('GBP'); // true
```

***
See also:

  * [CountryCode](CountryCode.md)
  * [SubdivisionCode](SubdivisionCode.md)
