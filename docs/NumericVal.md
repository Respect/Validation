# NumericVal

- `v::numericVal()`

Validates on any numeric value.

```php
v::numericVal()->validate(-12); // true
v::numericVal()->validate('135.0'); // true
```

***
See also:

  * [Digit](Digit.md)
  * [Finite](Finite.md)
  * [Infinite](Infinite.md)
  * [IntVal](IntVal.md)
