# Numeric

- `v::numeric()`

Validates on any numeric value.

```php
v::numeric()->validate(-12); // true
v::numeric()->validate('135.0'); // true
```

***
See also:

  * [Digit](Digit.md)
  * [Factor](Factor.md)
  * [Finite](Finite.md)
  * [Infinite](Infinite.md)
  * [IntType](IntType.md)
  * [IntVal](IntVal.md)
