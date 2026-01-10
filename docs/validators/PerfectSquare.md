# PerfectSquare

- `PerfectSquare()`

Validates whether the input is a perfect square.

```php
v::perfectSquare()->assert(25); // (5*5)
// Validation passes successfully

v::perfectSquare()->assert(9); // (3*3)
// Validation passes successfully
```

## Templates

### `PerfectSquare::TEMPLATE_STANDARD`

| Mode       | Template                                        |
| ---------- | ----------------------------------------------- |
| `default`  | {{subject}} must be a perfect square number     |
| `inverted` | {{subject}} must not be a perfect square number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Factor](Factor.md)
- [Fibonacci](Fibonacci.md)
- [PrimeNumber](PrimeNumber.md)
