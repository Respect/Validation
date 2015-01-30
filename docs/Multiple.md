# Multiple

- `v::multiple(int $multipleOf)`

Validates if the input is a multiple of the given parameter

```php
v::int()->multiple(3)->validate(9); //true
```

See also:

  * [PrimeNumber](PrimeNumber.md)
