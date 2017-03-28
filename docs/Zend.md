# Zend

- `Zend(mixed $validatorName)`

Use Zend validators inside Respect\Validation flow. Messages
are preserved.

```php
v::zend('Hostname')->validate('google.com');
```

Respect\Validation supports version >=2.0.3 of Zend\Validator.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Sf](Sf.md)
