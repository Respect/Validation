# NumericVal

- `NumericVal()`

Validates on any numeric value.

```php
v::numericVal()->isValid(-12); // true
v::numericVal()->isValid('135.0'); // true
```

This rule doesn't validate if the data is a valid number, for that purpose
use the [Number](Number.md) rule.

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
