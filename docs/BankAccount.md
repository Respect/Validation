# BankAccount

- `BankAccount(string $countryCode, string $bank)`

Validates a bank account for a given bank.

```php
v::bankAccount("de", "70169464")->validate("1112"); // true
v::bankAccount("de", "70169464")->validate("1234"); // false
```

These country codes are supported:

- "de" (Germany): Respect\Validation supports version >=1.1.0 of "malkusch/bav" for this rule.

## Changelog

Version | Description
--------|-------------
  0.8.0 | Created

***
See also:

- [Bank](Bank.md)
- [Bic](Bic.md)
