# Multiple

- `v::multiple(int $multipleOf)`

Validates if the input is a multiple of the given parameter

```php
v::intVal()->multiple(3)->validate(9); // true
```

***
See also:

  * [Even](Even.md)
  * [Odd](Odd.md)
  * [PrimeNumber](PrimeNumber.md)
