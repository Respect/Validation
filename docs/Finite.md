# Finite

- `v::finite()`

Validates if the input is a finite number.

```php
v::finite()->validate('10'); // true
v::finite()->validate(10); // true
```

***
See also:

  * [Digit](Digit.md)
  * [Infinite](Infinite.md)
  * [IntVal](IntVal.md)
  * [Numeric](Numeric.md)
