# BankAccount

- `v::bankAccount(string $countryCode, string $bank)`

Validates a bank account for a given bank.

```php
v::bankAccount("de", "70169464")->validate("1112"); // true
v::bankAccount("de", "70169464")->validate("1234"); // false
```

These country codes are supported:

 * "de" (Germany) - You must add `"malkusch/bav": "~1.0"` to your `require` property on composer.json file.

***
See also:

  * [Bank](Bank.md)
  * [Bic](Bic.md)
