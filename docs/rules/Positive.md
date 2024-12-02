# Positive

- `Positive()`

Validates whether the input is a positive number.

```php
v::positive()->isValid(1); // true
v::positive()->isValid(0); // false
v::positive()->isValid(-15); // false
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

- [Negative](Negative.md)
