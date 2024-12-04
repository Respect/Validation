# Fibonacci

- `Fibonacci()`

Validates whether the input follows the Fibonacci integer sequence.

```php
v::fibonacci()->isValid(1); // true
v::fibonacci()->isValid('34'); // true
v::fibonacci()->isValid(6); // false
```

## Templates

`Fibonacci::TEMPLATE_STANDARD`

| Mode       | Template                                      |
|------------|-----------------------------------------------|
| `default`  | {{name}} must be a valid Fibonacci number     |
| `inverted` | {{name}} must not be a valid Fibonacci number |

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
|   1.1.0 | Created     |

***
See also:

- [PerfectSquare](PerfectSquare.md)
- [PrimeNumber](PrimeNumber.md)
