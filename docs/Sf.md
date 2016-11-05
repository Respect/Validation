# Sf

- `v::sf(string $validator)`

Use Symfony2 validators inside Respect\Validation flow. Messages
are preserved.

```php
v::sf('Time')->validate('15:00:00');
```

Respect\Validation supports version >=3.0.0 of Symfony Validator.

***
See also:

  * [Zend](Zend.md)
