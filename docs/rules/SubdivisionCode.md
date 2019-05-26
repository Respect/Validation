# SubdivisionCode

- `v::subdivisionCode(string $countryCode)`

Validates subdivision country codes according to [ISO 3166-2][].

The `$countryCode` must be a country in [ISO 3166-1 alpha-2][] format.

```php
v::subdivisionCode('BR')->validate('SP'); // true
v::subdivisionCode('US')->validate('CA'); // true
```

This rules uses data from [iso-codes][].

***
See also:

  * [CountryCode](CountryCode.md)
  * [CurrencyCode](CurrencyCode.md)
  * [IdentityCard](IdentityCard.md)
  * [KeyValue](KeyValue.md)
  * [Tld](Tld.md)

[iso-codes]: https://salsa.debian.org/iso-codes-team/iso-codes
[ISO 3166-1 alpha-2]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 "ISO 3166-1 alpha-2"
[ISO 3166-2]: http://en.wikipedia.org/wiki/ISO_3166-2 "ISO 3166-2"
