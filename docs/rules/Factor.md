# Factor

- `v::factor(int $dividend)`

Validates if the input is a factor of the defined dividend.

```php
v::factor(0)->validate(5); // true
v::factor(4)->validate(2); // true
v::factor(4)->validate(3); // false
```

***
See also:

  * [Digit](Digit.md)
  * [Finite](Finite.md)
  * [Infinite](Infinite.md)
  * [Numeric](Numeric.md)
  * [PerfectSquare](PerfectSquare.md)
  * [PrimeNumber](PrimeNumber.md)
