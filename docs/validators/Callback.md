<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Callback

- `Callback(callable $callback)`
- `Callback(callable $callback, mixed ...$arguments)`

Validates the input using the return of a given callable.

```php
v::callback(fn (int $input): bool => $input % 5 === 0,)->assert(10);
// Validation passes successfully
```

## Templates

### `Callback::TEMPLATE_STANDARD`

|       Mode | Template                    |
| ---------: | :-------------------------- |
|  `default` | {{subject}} must be valid   |
| `inverted` | {{subject}} must be invalid |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Callables

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [Call](Call.md)
- [CallableType](CallableType.md)
- [DateTime](DateTime.md)
- [FilterVar](FilterVar.md)
