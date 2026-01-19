<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Number

- `Number()`

Validates if the input is a number.

```php
v::number()->assert(42);
// Validation passes successfully

v::number()->assert(acos(8));
// → `NaN` must be a valid number
```

> "In computing, NaN, standing for not a number, is a numeric data type value
> representing an undefined or unrepresentable value, especially in
> floating-point calculations." [Wikipedia](https://en.wikipedia.org/wiki/NaN)

## Templates

### `Number::TEMPLATE_STANDARD`

| Mode       | Template                           |
| ---------- | ---------------------------------- |
| `default`  | {{subject}} must be a valid number |
| `inverted` | {{subject}} must not be a number   |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description |
| ------: | ----------- |
|   2.0.0 | Created     |

---

See also:

- [Blank](Blank.md)
- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [Falsy](Falsy.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Undef](Undef.md)
