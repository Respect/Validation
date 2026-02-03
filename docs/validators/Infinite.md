<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Infinite

- `Infinite()`

Validates if the input is an infinite number.

```php
v::infinite()->assert(INF);
// Validation passes successfully
```

## Templates

### `Infinite::TEMPLATE_STANDARD`

|       Mode | Template                                   |
| ---------: | :----------------------------------------- |
|  `default` | {{subject}} must be an infinite number     |
| `inverted` | {{subject}} must not be an infinite number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.0.0 | Created     |

## See Also

- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Factor](Factor.md)
- [Finite](Finite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NumericVal](NumericVal.md)
