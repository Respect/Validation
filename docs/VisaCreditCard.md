# VisaCreditCard

- `v::VisaCreditCard()`

Validates a credit card number.

```php
v::VisaCreditCard()->validate('5376 7473 9720 8720'); //true
```

It ignores any non-digit chars, so use `->digit()` when appropriate.

```php
v::digit()->VisaCreditCard()->validate('5376747397208720'); //true
```
