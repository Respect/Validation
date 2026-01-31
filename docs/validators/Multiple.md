<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Multiple

- `Multiple(int $multipleOf)`

Validates if the input is a multiple of the given parameter

```php
v::intVal()->multiple(3)->assert(9);
// Validation passes successfully
```

## Templates

### `Multiple::TEMPLATE_STANDARD`

|       Mode | Template                                             |
| ---------: | :--------------------------------------------------- |
|  `default` | {{subject}} must be a multiple of {{multipleOf}}     |
| `inverted` | {{subject}} must not be a multiple of {{multipleOf}} |

## Template placeholders

| Placeholder  | Description                                                      |
| ------------ | ---------------------------------------------------------------- |
| `multipleOf` |                                                                  |
| `subject`    | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [Even](Even.md)
- [Odd](Odd.md)
