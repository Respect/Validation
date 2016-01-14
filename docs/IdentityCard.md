# IdentityCard

- `v::identityCard(string $countryCode)`

Validates Identity Card numbers according to the defined country.

```php
v::identityCard('PL')->validate('AYW036733'); // true
v::identityCard('PL')->validate('APH505567'); // true
v::identityCard('PL')->validate('APH 505567'); // false
v::identityCard('PL')->validate('AYW036731'); // false
```

For now this rule only accepts Polish Identity Card numbers (Dowód Osobisty).

***
See also:

  * [Bank](Bank.md)
  * [Pesel](Pesel.md)
  * [SubdivisionCode](SubdivisionCode.md)
