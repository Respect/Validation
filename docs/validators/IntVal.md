<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# IntVal

- `IntVal()`

Validates if the input is an integer, allowing leading zeros and other number bases.

```php
v::intVal()->assert('10');
// Validation passes successfully

v::intVal()->assert('089');
// Validation passes successfully

v::intVal()->assert(10);
// Validation passes successfully

v::intVal()->assert(0b101010);
// Validation passes successfully

v::intVal()->assert(0x2a);
// Validation passes successfully
```

This validator will consider as valid any input that PHP can convert to an integer,
but that does not contain non-integer values. That way, one can safely use the
value this validator validates, without having surprises.

```php
v::intVal()->assert(true);
// → `true` must be an integer value

v::intVal()->assert('89a');
// → "89a" must be an integer value
```

Even though PHP can cast the values above as integers, this validator will not
consider them as valid.

## Templates

### `IntVal::TEMPLATE_STANDARD`

|       Mode | Template                                 |
| ---------: | :--------------------------------------- |
|  `default` | {{subject}} must be an integer value     |
| `inverted` | {{subject}} must not be an integer value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Types

## Changelog

| Version | Description                                               |
| ------: | :-------------------------------------------------------- |
|   2.2.4 | Improved support for negative values with trailing zeroes |
|  2.0.14 | Allow leading zeros                                       |
|   1.0.0 | Renamed from `Int` to `IntVal`                            |
|   0.3.9 | Created as `Int`                                          |

## See Also

- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Finite](Finite.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [NumericVal](NumericVal.md)
