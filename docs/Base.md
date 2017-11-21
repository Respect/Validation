# Base

- `Base(string $base)`

Validate numbers in any base, even with non regular bases.

```php
v::base(2)->isValid('011010001'); // true
v::base(3)->isValid('0120122001'); // true
v::base(8)->isValid('01234567520'); // true
v::base(16)->isValid('012a34f5675c20d'); // true
v::base(2)->isValid('0120122001'); // false
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [BaseAccount](BaseAccount.md)
