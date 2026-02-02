<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Punct

- `Punct()`
- `Punct(string ...$additionalChars)`

Validates whether the input composed by only punctuation characters.

```php
v::punct()->assert('&,.;[]');
// Validation passes successfully
```

## Templates

### `Punct::TEMPLATE_STANDARD`

|       Mode | Template                                                    |
| ---------: | :---------------------------------------------------------- |
|  `default` | {{subject}} must consist only of punctuation characters     |
| `inverted` | {{subject}} must not consist only of punctuation characters |

### `Punct::TEMPLATE_EXTRA`

|       Mode | Template                                                                           |
| ---------: | :--------------------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of punctuation characters or {{additionalChars}}     |
| `inverted` | {{subject}} must not consist only of punctuation characters or {{additionalChars}} |

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
- [Graph](Graph.md)
- [Printable](Printable.md)
