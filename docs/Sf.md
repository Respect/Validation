# Sf

- `Sf(string $validatorName)`

Use Symfony2 validators inside Respect\Validation flow. Messages
are preserved.

```php
v::sf('Time')->validate('15:00:00');
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Upgraded support to version >=3.0.0 of Symfony Validator
  0.3.9 | Created

***
See also:

- [Zend](Zend.md)
