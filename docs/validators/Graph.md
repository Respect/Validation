<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Graph

- `Graph()`
- `Graph(string ...$additionalChars)`

Validates if all characters in the input are printable and actually creates
visible output (no white space).

```php
v::graph()->assert('LKM@#$%4;');
// Validation passes successfully
```

## Templates

### `Graph::TEMPLATE_STANDARD`

|       Mode | Template                                           |
| ---------: | :------------------------------------------------- |
|  `default` | {{subject}} must contain only graphical characters |
| `inverted` | {{subject}} must not contain graphical characters  |

### `Graph::TEMPLATE_EXTRA`

|       Mode | Template                                                                   |
| ---------: | :------------------------------------------------------------------------- |
|  `default` | {{subject}} must contain only graphical characters and {{additionalChars}} |
| `inverted` | {{subject}} must not contain graphical characters or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.5.0 | Created     |

## See Also

- [Printable](Printable.md)
- [Punct](Punct.md)
