# PostalCode

- `PostalCode(string $countryCode, bool $formatted = false)`

Validates whether the input is a valid postal code or not.

```php
v::postalCode('BR')->isValid('02179000'); // true
v::postalCode('BR')->isValid('02179-000'); // true
v::postalCode('US')->isValid('02179-000'); // false
v::postalCode('US')->isValid('55372'); // true
v::postalCode('PL')->isValid('99-300'); // true
```

By default, `PostalCode` won't validate the format (puncts, spaces), unless you pass `$formatted = true`:


```php
v::postalCode('BR', true)->isValid('02179000'); // false
v::postalCode('BR', true)->isValid('02179-000'); // true
```

Message template for this validator includes `{{countryCode}}`.

Extracted from [GeoNames](http://www.geonames.org/).

## Categorization

- Localization
- Strings

## Changelog

Version | Description
--------|-------------
  2.3.0 | Add option to validate formatting
  2.2.4 | Cambodian postal codes now support 5 and 6 digits
  0.7.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [Iban](Iban.md)
