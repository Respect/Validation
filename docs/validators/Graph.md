<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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

|       Mode | Template                                                              |
| ---------: | :-------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of printable non-spacing characters     |
| `inverted` | {{subject}} must not consist only of printable non-spacing characters |

### `Graph::TEMPLATE_EXTRA`

|       Mode | Template                                                                                     |
| ---------: | :------------------------------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of printable non-spacing characters or {{additionalChars}}     |
| `inverted` | {{subject}} must not consist only of printable non-spacing characters or {{additionalChars}} |

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

- [Printable](Printable.md)
- [Punct](Punct.md)
