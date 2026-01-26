<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# NumericVal

- `NumericVal()`

Validates whether the input is numeric.

```php
v::numericVal()->assert(-12);
// Validation passes successfully

v::numericVal()->assert('135.0');
// Validation passes successfully
```

This validator doesn't validate if the input is a valid number, for that
purpose use the [Number](Number.md) validator.

## Templates

### `NumericVal::TEMPLATE_STANDARD`

|       Mode | Template                                |
| ---------: | :-------------------------------------- |
|  `default` | {{subject}} must be a numeric value     |
| `inverted` | {{subject}} must not be a numeric value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Types

## Changelog

| Version | Description                            |
| ------: | :------------------------------------- |
|   2.0.0 | Renamed from `Numeric` to `NumericVal` |
|   0.3.9 | Created as `Numeric`                   |

## See Also

- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Factor](Factor.md)
- [Finite](Finite.md)
- [FloatType](FloatType.md)
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [Number](Number.md)
- [ScalarVal](ScalarVal.md)
- [Uppercase](Uppercase.md)
