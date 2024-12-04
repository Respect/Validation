# PrimeNumber

- `PrimeNumber()`

Validates a prime number

```php
v::primeNumber()->isValid(7); // true
```

## Templates

`PrimeNumber::TEMPLATE_STANDARD`

| Mode       | Template                            |
|------------|-------------------------------------|
| `default`  | {{name}} must be a prime number     |
| `inverted` | {{name}} must not be a prime number |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Factor](Factor.md)
- [Fibonacci](Fibonacci.md)
- [Multiple](Multiple.md)
- [PerfectSquare](PerfectSquare.md)
