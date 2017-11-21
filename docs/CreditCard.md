# CreditCard

- `CreditCard()`
- `CreditCard(string $brand)`

Validates a credit card number.

```php
v::creditCard()->isValid('5376 7473 9720 8720'); // true

v::creditCard('American Express')->isValid('340316193809364'); // true
v::creditCard('Diners Club')->isValid('30351042633884'); // true
v::creditCard('Discover')->isValid('6011000990139424'); // true
v::creditCard('JCB')->isValid('3566002020360505'); // true
v::creditCard('Master')->isValid('5376747397208720'); // true
v::creditCard('Visa')->isValid('4024007153361885'); // true
```

The current supported brands are:

- American Express
- Diners Club
- Discover
- JCB
- MasterCard
- Visa

It ignores any non-digit chars, so use `->digit()` when appropriate.

```php
v::digit()->creditCard()->isValid('5376747397208720'); // true
```

## Changelog

Version | Description
--------|-------------
  1.1.0 | Allow the define credit card brand
  0.3.9 | Created

***
See also:

- [Luhn](Luhn.md)
