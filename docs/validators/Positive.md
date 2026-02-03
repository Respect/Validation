<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Positive

- `Positive()`

Validates whether the input is a positive number.

```php
v::positive()->assert(1);
// Validation passes successfully

v::positive()->assert(0);
// → 0 must be a positive number

v::positive()->assert(-15);
// → -15 must be a positive number
```

## Templates

### `Positive::TEMPLATE_STANDARD`

|       Mode | Template                                  |
| ---------: | :---------------------------------------- |
|  `default` | {{subject}} must be a positive number     |
| `inverted` | {{subject}} must not be a positive number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description                          |
| ------: | :----------------------------------- |
|   2.0.0 | Does not validate non-numeric values |
|   0.3.9 | Created                              |

## See Also

- [Negative](Negative.md)
