# Bic

- `Bic(string $countryCode)`

Validates a BIC (Bank Identifier Code) for a given country.

```php
v::bic("de")->validate("VZVDDED1XXX"); // true
v::bic("de")->validate("VZVDDED1"); // true
```

Theses country codes are supported:

- "de" (Germany): Respect\Validation supports version >=1.1.0 of "malkusch/bav" for this rule.

## Changelog

Version | Description
--------|-------------
  0.8.0 | Created

***
See also:

- [Bank](Bank.md)
- [BankAccount](BankAccount.md)
