# Vatin

- `v::vatin(string $countryCode)`

Validates VAT identification number according to the defined country.

```php
v::vatin('PL')->validate('1645865777'); // true
v::vatin('PL')->validate('1645865778'); // false
v::vatin('PL')->validate('1234567890'); // false
v::vatin('PL')->validate('164-586-57-77'); // false
v::vatin('PL')->validate('164-58-65-777'); // false
```

For now this rule only accepts Polish VAT identification number (NIP).

***
See also:

  * [Bank](Bank.md)
  * [IdentityCard](IdentityCard.md)
  * [Pesel](Pesel.md)
  * [SubdivisionCode](SubdivisionCode.md)
