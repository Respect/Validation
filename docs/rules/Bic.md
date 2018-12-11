# Bic

- `v::bic(string $countryCode)`

Validates a BIC (Bank Identifier Code) for a given country.

```php
v::bic("de")->validate("VZVDDED1XXX"); // true
v::bic("de")->validate("VZVDDED1"); // true
```

Theses country codes are supported:

 * "de" (Germany) - You must add `"malkusch/bav": "~1.0"` to your `require` property on composer.json file.

***
See also:

  * [Bank](Bank.md)
  * [BankAccount](BankAccount.md)
  * [CreditCard](CreditCard.md)
