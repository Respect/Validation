<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# PrimeNumber

- `PrimeNumber()`

Validates a prime number

```php
v::primeNumber()->assert(7);
// Validation passes successfully
```

## Templates

### `PrimeNumber::TEMPLATE_STANDARD`

| Mode       | Template                               |
| ---------- | -------------------------------------- |
| `default`  | {{subject}} must be a prime number     |
| `inverted` | {{subject}} must not be a prime number |

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
- [Multiple](Multiple.md)
- [PerfectSquare](PerfectSquare.md)
