<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Printable

- `Printable()`
- `Printable(string ...$additionalChars)`

Similar to `Graph` but accepts whitespace.

```php
v::printable()->assert('LMKA0$% _123');
// Validation passes successfully
```

## Templates

### `Printable::TEMPLATE_STANDARD`

|       Mode | Template                                                  |
| ---------: | :-------------------------------------------------------- |
|  `default` | {{subject}} must consist only of printable characters     |
| `inverted` | {{subject}} must not consist only of printable characters |

### `Printable::TEMPLATE_EXTRA`

|       Mode | Template                                                                         |
| ---------: | :------------------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of printable characters or {{additionalChars}}     |
| `inverted` | {{subject}} must not consist only of printable characters or {{additionalChars}} |

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
- [Punct](Punct.md)
