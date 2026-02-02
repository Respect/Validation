<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Space

- `Space()`
- `Space(string ...$additionalChars)`

Validates whether the input contains only whitespaces characters.

```php
v::space()->assert('    ');
// Validation passes successfully
```

## Templates

### `Space::TEMPLATE_STANDARD`

|       Mode | Template                                              |
| ---------: | :---------------------------------------------------- |
|  `default` | {{subject}} must consist only of space characters     |
| `inverted` | {{subject}} must not consist only of space characters |

### `Space::TEMPLATE_EXTRA`

|       Mode | Template                                                                     |
| ---------: | :--------------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of space characters or {{additionalChars}}     |
| `inverted` | {{subject}} must not consist only of space characters or {{additionalChars}} |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   0.5.0 | Created           |

## See Also

- [Control](Control.md)
