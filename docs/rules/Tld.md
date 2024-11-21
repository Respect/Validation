# Tld

- `Tld()`

Validates whether the input is a top-level domain.

```php
use Respect\Validation\Validator as v;

v::tld()->validate('com'); // true
v::tld()->validate('ly'); // true
v::tld()->validate('org'); // true
v::tld()->validate('COM'); // true
```

## Categorization

- Internet

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [Domain](Domain.md)
- [Ip](Ip.md)
- [MacAddress](MacAddress.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [SubdivisionCode](SubdivisionCode.md)
