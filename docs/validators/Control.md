<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Control

- `Control()`
- `Control(string ...$additionalChars)`

Validates if all of the characters in the provided string, are control
characters.

```php
v::control()->assert("\n\r\t");
// Validation passes successfully
```

## Templates

### `Control::TEMPLATE_STANDARD`

|       Mode | Template                                         |
| ---------: | :----------------------------------------------- |
|  `default` | {{subject}} must only contain control characters |
| `inverted` | {{subject}} must not contain control characters  |

### `Control::TEMPLATE_EXTRA`

|       Mode | Template                                                                 |
| ---------: | :----------------------------------------------------------------------- |
|  `default` | {{subject}} must only contain control characters and {{additionalChars}} |
| `inverted` | {{subject}} must not contain control characters or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                       |
| ------: | :-------------------------------- |
|   2.0.0 | Renamed from `Cntrl` to `Control` |
|   0.5.0 | Created                           |

## See Also

- [Alnum](Alnum.md)
- [Printable](Printable.md)
- [Punct](Punct.md)
- [Space](Space.md)
