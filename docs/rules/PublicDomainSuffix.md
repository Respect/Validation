# PublicDomainSuffix

- `PublicDomainSuffix()`

Validates whether the input is a public ICANN domain suffix.

```php
v::publicDomainSuffix->isValid('co.uk'); // true
v::publicDomainSuffix->isValid('CO.UK'); // true
v::publicDomainSuffix->isValid('nom.br'); // true
v::publicDomainSuffix->isValid('invalid.com'); // false
```

This rule will not match top level domains such as `tk`. 
If you want to match either, use a combination with `Tld`:

```php
v::oneOf(v::tld(), v::publicDomainSuffix())->isValid('tk'); // true
```

## Categorization

- Internet

## Changelog

Version | Description
--------|-------------
  2.3.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [Domain](Domain.md)
- [Ip](Ip.md)
- [MacAddress](MacAddress.md)
- [SubdivisionCode](SubdivisionCode.md)
- [Tld](Tld.md)
