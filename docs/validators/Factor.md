<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Factor

- `Factor(int $dividend)`

Validates if the input is a factor of the defined dividend.

```php
v::factor(0)->assert(5);
// Validation passes successfully

v::factor(4)->assert(2);
// Validation passes successfully

v::factor(4)->assert(3);
// → 3 must be a factor of 4
```

## Templates

### `Factor::TEMPLATE_STANDARD`

| Mode       | Template                                                  |
| ---------- | --------------------------------------------------------- |
| `default`  | {{subject}} must be a factor of {{dividend&#124;raw}}     |
| `inverted` | {{subject}} must not be a factor of {{dividend&#124;raw}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `dividend`  |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description |
| ------: | ----------- |
|   1.0.0 | Created     |

---

See also:

- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [NumericVal](NumericVal.md)
- [PerfectSquare](PerfectSquare.md)
- [PrimeNumber](PrimeNumber.md)
