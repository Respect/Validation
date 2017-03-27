# NumericVal

- `NumericVal()`

Validates on any numeric value.

```php
v::numericVal()->validate(-12); // true
v::numericVal()->validate('135.0'); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Renamed from `Numeric` to `NumericVal`
  0.3.9 | Created as `Numeric`

***
See also:

  * [Digit](Digit.md)
  * [Finite](Finite.md)
  * [Infinite](Infinite.md)
  * [IntVal](IntVal.md)
