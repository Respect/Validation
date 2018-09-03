# PostalCode

- `PostalCode(string $countryCode)`

Validates a postal code according to the given country code.

```php
v::postalCode('BR')->isValid('02179000'); // true
v::postalCode('BR')->isValid('02179-000'); // true
v::postalCode('US')->isValid('02179-000'); // false
v::postalCode('US')->isValid('55372'); // true
v::postalCode('PL')->isValid('99-300'); // true
```

Message template for this validator includes `{{countryCode}}`.

Extracted from [GeoNames](http://www.geonames.org/).

## Changelog

Version | Description
--------|-------------
  0.7.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
