# IntVal

- `IntVal()`

Validates if the input is an integer.

```php
v::intVal()->validate('10'); // true
v::intVal()->validate(10); // true
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Renamed from `Int` to `IntVal`
  0.3.9 | Created as `Int`

***
See also:

- [Digit](Digit.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [NumericVal](NumericVal.md)
