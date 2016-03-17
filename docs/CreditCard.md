# CreditCard

- `v::creditCard()`

Validates a credit card number.

```php
v::creditCard()->validate('5376 7473 9720 8720'); // true
```

It ignores any non-digit chars, so use `->digit()` when appropriate.

```php
v::digit()->creditCard()->validate('5376747397208720'); // true
```

***
See also:

  * [Bank](Bank.md)
  * [BankAccount](BankAccount.md)
  * [Bic](Bic.md)
