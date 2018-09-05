# NumericVal

- `NumericVal()`

Validates whether the input is numeric.

```php
v::numericVal()->validate(-12); // true
v::numericVal()->validate('135.0'); // true
```

This rule doesn't validate if the input is a valid number, for that
purpose use the [Number](Number.md) rule.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Renamed from `Numeric` to `NumericVal`
  0.3.9 | Created as `Numeric`

***
See also:

- [Digit](Digit.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [IntVal](IntVal.md)
