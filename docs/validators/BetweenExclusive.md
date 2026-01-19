<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# BetweenExclusive

- `BetweenExclusive(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values, exclusively.

```php
v::betweenExclusive(10, 20)->assert(10);
// → 10 must be greater than 10 and less than 20

v::betweenExclusive('a', 'e')->assert('c');
// Validation passes successfully

v::betweenExclusive(new DateTime('yesterday'), new DateTime('tomorrow'))->assert(new DateTime('today'));
// Validation passes successfully

v::betweenExclusive(0, 100)->assert(100);
// → 100 must be greater than 0 and less than 100

v::betweenExclusive('a', 'z')->assert('a');
// → "a" must be greater than "a" and less than "z"
```

Validation makes comparison easier, check out our supported [comparable values](../comparable-values.md).

## Templates

### `BetweenExclusive::TEMPLATE_STANDARD`

| Mode       | Template                                                                    |
| ---------- | --------------------------------------------------------------------------- |
| `default`  | {{subject}} must be greater than {{minValue}} and less than {{maxValue}}    |
| `inverted` | {{subject}} must not be greater than {{minValue}} or less than {{maxValue}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `maxValue`  | The minimum value passed to the validator.                       |
| `minValue`  | The maximum value passed to the validator.                       |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

---

See also:

- [Between](Between.md)
- [DateTime](DateTime.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
