<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# AlwaysInvalid

- `AlwaysInvalid()`

Validates any input as invalid.

```php
v::not(v::alwaysInvalid())->assert('whatever');
// Validation passes successfully

v::alwaysInvalid()->assert('whatever');
// → "whatever" must be valid
```

## Templates

### `AlwaysInvalid::TEMPLATE_STANDARD`

|       Mode | Template                    |
| ---------: | :-------------------------- |
|  `default` | {{subject}} must be valid   |
| `inverted` | {{subject}} must be invalid |

### `AlwaysInvalid::TEMPLATE_SIMPLE`

|       Mode | Template               |
| ---------: | :--------------------- |
|  `default` | {{subject}} is invalid |
| `inverted` | {{subject}} is valid   |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.5.0 | Created     |

## See Also

- [AlwaysValid](AlwaysValid.md)
- [When](When.md)
