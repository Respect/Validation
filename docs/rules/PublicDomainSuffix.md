# PublicDomainSuffix

- `PublicDomainSuffix()`

Validates whether the input is a public ICANN domain suffix.

```php
v::publicDomainSuffix->validate('co.uk'); // true
v::publicDomainSuffix->validate('CO.UK'); // true
v::publicDomainSuffix->validate('nom.br'); // true
v::publicDomainSuffix->validate('invalid.com'); // false
```

This rule will not match top level domains such as `tk`. 
If you want to match either, use a combination with `Tld`:

```php
v::oneOf(v::tld(), v::publicDomainSuffix())->validate('tk'); // true
```

## Categorization

- Internet

## Changelog

Version | Description
--------|-------------
  2.3.0 | Created

***
See also:

- [Tld](Tld.md)
- [CountryCode](CountryCode.md)
- [Domain](Domain.md)
- [Ip](Ip.md)
- [MacAddress](MacAddress.md)
- [SubdivisionCode](SubdivisionCode.md)
