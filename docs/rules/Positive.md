# Positive

- `Positive()`

Validates whether the input is a positive number.

```php
v::positive()->validate(1); // true
v::positive()->validate(0); // false
v::positive()->validate(-15); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Does not validate non-numeric values
  0.3.9 | Created

***
See also:

- [Negative](Negative.md)
