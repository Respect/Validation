# CountryCode

- `v::countryCode()`

Validates an ISO country code like US or BR.

```php
v::countryCode()->validate('BR'); // true
```

This rules uses data from [iso-codes][].

***
See also:

  * [CurrencyCode](CurrencyCode.md)
  * [LanguageCode](LanguageCode.md)
  * [PostalCode](PostalCode.md)
  * [SubdivisionCode](SubdivisionCode.md)
  * [Tld](Tld.md)


[iso-codes]: https://salsa.debian.org/iso-codes-team/iso-codes
