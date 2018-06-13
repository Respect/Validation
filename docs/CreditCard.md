# CreditCard

- `CreditCard()`
- `CreditCard(string $brand)`

Validates a credit card number.

```php
v::creditCard()->validate('5376 7473 9720 8720'); // true
v::creditCard()->validate('5376-7473-9720-8720'); // true
v::creditCard()->validate('5376.7473.9720.8720'); // true

v::creditCard('American_Express')->validate('340316193809364'); // true
v::creditCard('Diners_Club')->validate('30351042633884'); // true
v::creditCard('Discover')->validate('6011000990139424'); // true
v::creditCard('JCB')->validate('3566002020360505'); // true
v::creditCard('Mastercard')->validate('5376747397208720'); // true
v::creditCard('Visa')->validate('4024007153361885'); // true
```

The current supported brands are:

- American Express (`'American_Express'` or `CreditCard::AMERICAN_EXPRESS`)
- Diners Club (`'Diners_Club'` or `CreditCard::DINERS_CLUB`)
- Discover (`'Discover'` or `CreditCard::DISCOVER`)
- JCB (`'JCB'` or `CreditCard::JCB`)
- Mastercard (`'American_Express'` or `CreditCard::MASTERCARD`)
- Visa (`'Visa'` or `CreditCard::VISA`)

It ignores any non-numeric characters, use [Digit](Digit.md),
[NoWhitespace](NoWhitespace.md), or [Regex](Regex.md) when appropriate.

```php
v::digit()->creditCard()->validate('5376747397208720'); // true
```

## Changelog

Version | Description
--------|-------------
  1.1.0 | Allow the define credit card brand
  0.3.9 | Created

***
See also:

- [Digit](Digit.md)
- [Luhn](Luhn.md)
- [NoWhitespace](NoWhitespace.md)
