# Fibonacci

 - `v::fibonacci()`

Validates whether the input follows the Fibonacci integer sequence.

```php
v::fibonacci()->validate(1); // true
v::fibonacci()->validate('34'); // true
v::fibonacci()->validate(6); // false
```

***
See also:

  * [PrimeNumber](PrimeNumber.md)
  * [PerfectSquare](PerfectSquare.md)