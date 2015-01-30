# PostalCode

- `v::postalCode(string $countryCode)`

Validates a postal code according to the given country code.

```php
v::numeric()->postalCode('BR')->validate('02179000'); //true
v::numeric()->postalCode('BR')->validate('02179-000'); //true
v::numeric()->postalCode('US')->validate('02179-000'); //false
```

Extracted from [GeoNames](http://www.geonames.org/).

See also:

  * [CountryCode](CountryCode.md)
