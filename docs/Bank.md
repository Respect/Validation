# Bank

- `Bank(string $countryCode)`

Validates a bank.

```php
v::bank("de")->validate("70169464"); // true
v::bank("de")->validate("12345"); // false
```

These country codes are supported:

- "de" (Germany): Respect\Validation supports version >=1.1.0 of "malkusch/bav" for this rule.

## Changelog

Version | Description
--------|-------------
  0.8.0 | Created

***
See also:

- [BankAccount](BankAccount.md)
- [Bic](Bic.md)
