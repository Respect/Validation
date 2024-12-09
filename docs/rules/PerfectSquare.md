# PerfectSquare

- `PerfectSquare()`

Validates whether the input is a perfect square.

```php
v::perfectSquare()->isValid(25); // true (5*5)
v::perfectSquare()->isValid(9); // true (3*3)
```

## Templates

### `PerfectSquare::TEMPLATE_STANDARD`

| Mode       | Template                                     |
|------------|----------------------------------------------|
| `default`  | {{name}} must be a perfect square number     |
| `inverted` | {{name}} must not be a perfect square number |

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
- [PrimeNumber](PrimeNumber.md)
