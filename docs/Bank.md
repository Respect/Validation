# Bank

- `v::bank(string $countryCode)`

Validates a bank.

```php
v::bank("de")->validate("70169464"); // true
v::bank("de")->validate("12345"); // false
```

These country codes are supported:

 * "de" (Germany) - You must add `"malkusch/bav": "~1.0"` to your `require` property on composer.json file.

***
See also:

  * [BankAccount](BankAccount.md)
  * [Bic](Bic.md)
