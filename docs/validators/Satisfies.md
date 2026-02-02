<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
-->

# Satisfies

- `Satisfies(callable $callback)`
- `Satisfies(callable $callback, mixed ...$arguments)`

Validates the input using the return of a given callable.

```php
v::satisfies(fn (int $input): bool => $input % 5 === 0,)->assert(10);
// Validation passes successfully
```

## Templates

### `Satisfies::TEMPLATE_STANDARD`

|       Mode | Template                      |
| ---------: | :---------------------------- |
|  `default` | {{subject}} must be valid     |
| `inverted` | {{subject}} must not be valid |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Callables

## Changelog

| Version | Description            |
| ------: | :--------------------- |
|   3.0.0 | Renamed to `Satisfies` |
|   0.3.9 | Created as `Callback`  |

## See Also

- [After](After.md)
- [CallableType](CallableType.md)
- [DateTime](DateTime.md)
