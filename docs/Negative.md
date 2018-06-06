# Negative

- `Negative()`

Validates whether the input is a negative number.

```php
v::numericVal()->negative()->validate(-15); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Does not validate non-numeric values
  0.3.9 | Created

***
See also:

- [Positive](Positive.md)
