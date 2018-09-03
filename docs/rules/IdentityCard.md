# IdentityCard

- `IdentityCard(string $countryCode)`

Validates Identity Card numbers according to the defined country.

```php
v::identityCard('PL')->isValid('AYW036733'); // true
v::identityCard('PL')->isValid('APH505567'); // true
v::identityCard('PL')->isValid('APH 505567'); // false
v::identityCard('PL')->isValid('AYW036731'); // false
```

For now this rule only accepts Polish Identity Card numbers (Dowód Osobisty).

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [Pesel](Pesel.md)
- [SubdivisionCode](SubdivisionCode.md)
- [Vatin](Vatin.md)
