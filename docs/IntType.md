# IntType

- `v::intType()`

Validates whether the type of a value is integer.

```php
v::intType()->validate(42); // true
v::intType()->validate('10'); // false
```

***
See also:

  * [Digit](Digit.md)
  * [Finite](Finite.md)
  * [Infinite](Infinite.md)
  * [IntVal](IntVal.md)
  * [Numeric](Numeric.md)
