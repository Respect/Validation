# PostalCode

- `v::postalCode(string $countryCode)`

Validates a postal code according to the given country code.

```php
v::postalCode('BR')->validate('02179000'); // true
v::postalCode('BR')->validate('02179-000'); // true
v::postalCode('US')->validate('02179-000'); // false
v::postalCode('US')->validate('55372'); // true
v::postalCode('PL')->validate('99-300'); // true
```

Message template for this validator includes `{{countryCode}}`.

Extracted from [GeoNames](http://www.geonames.org/).

***
See also:

  * [CountryCode](CountryCode.md)
