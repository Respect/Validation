# Base

- `Base(string $base)`

Validate numbers in any base, even with non regular bases.

```php
v::base(2)->validate('011010001'); // true
v::base(3)->validate('0120122001'); // true
v::base(8)->validate('01234567520'); // true
v::base(16)->validate('012a34f5675c20d'); // true
v::base(2)->validate('0120122001'); // false
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [BaseAccount](BaseAccount.md)
