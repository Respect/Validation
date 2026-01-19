<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Fibonacci

- `Fibonacci()`

Validates whether the input follows the Fibonacci integer sequence.

```php
v::fibonacci()->assert(1);
// Validation passes successfully

v::fibonacci()->assert('34');
// Validation passes successfully

v::fibonacci()->assert(6);
// → 6 must be a valid Fibonacci number
```

## Templates

### `Fibonacci::TEMPLATE_STANDARD`

| Mode       | Template                                         |
| ---------- | ------------------------------------------------ |
| `default`  | {{subject}} must be a valid Fibonacci number     |
| `inverted` | {{subject}} must not be a valid Fibonacci number |

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
|   1.1.0 | Created     |

---

See also:

- [PerfectSquare](PerfectSquare.md)
- [PrimeNumber](PrimeNumber.md)
