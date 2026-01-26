<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# AlwaysValid

- `AlwaysValid()`

Validates any input as valid.

```php
v::alwaysValid()->assert('whatever');
// Validation passes successfully
```

## Templates

### `AlwaysValid::TEMPLATE_STANDARD`

|       Mode | Template                    |
| ---------: | :-------------------------- |
|  `default` | {{subject}} must be valid   |
| `inverted` | {{subject}} must be invalid |

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

- [AlwaysInvalid](AlwaysInvalid.md)
- [KeyExists](KeyExists.md)
- [PropertyExists](PropertyExists.md)
