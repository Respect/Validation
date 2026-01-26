<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Blank

- `Blank()`

Validates if the given input is a blank value (`null`, zeros, empty strings or empty arrays, recursively).

We recommend you to check [Comparing empty values](../comparing-empty-values.md) for more details.

```php
v::blank()->assert(' ');
// Validation passes successfully

v::blank()->assert(0);
// Validation passes successfully

v::blank()->assert(false);
// Validation passes successfully

v::blank()->assert(['', ' ', '0.0', []]);
// Validation passes successfully

v::blank()->assert(new stdClass());
// Validation passes successfully
```

It's similar to [Falsy](Falsy.md), but way stricter.

## Templates

### `Blank::TEMPLATE_STANDARD`

|       Mode | Template                      |
| ---------: | :---------------------------- |
|  `default` | {{subject}} must be blank     |
| `inverted` | {{subject}} must not be blank |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description                                 |
| ------: | :------------------------------------------ |
|   3.0.0 | Renamed to `Blank` and changed the behavior |
|   1.0.0 | Created as `NotBlank`                       |

## See Also

- [Falsy](Falsy.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [Spaced](Spaced.md)
- [Undef](Undef.md)
- [UndefOr](UndefOr.md)
