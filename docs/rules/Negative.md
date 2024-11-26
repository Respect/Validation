# Negative

- `Negative()`

Validates whether the input is a negative number.

```php
use Respect\Validation\Validator as v;

v::numericVal()->negative()->validate(-15); // true
```

## Categorization

- Math
- Numbers

## Changelog

Version | Description
--------|-------------
  2.0.0 | Does not validate non-numeric values
  0.3.9 | Created

***
See also:

- [Positive](Positive.md)
