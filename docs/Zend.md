# Zend

- `v::zend(mixed $validator)`

Use Zend validators inside Respect\Validation flow. Messages
are preserved.

```php
v::zend('Hostname')->validate('google.com');
```

Respect\Validation supports version >=2.0.3 of Zend\Validator.

***
See also:

  * [Sf](Sf.md)
