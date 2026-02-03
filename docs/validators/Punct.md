<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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

|       Mode | Template                                             |
| ---------: | :--------------------------------------------------- |
|  `default` | {{subject}} must contain only punctuation characters |
| `inverted` | {{subject}} must not contain punctuation characters  |

### `Punct::TEMPLATE_EXTRA`

|       Mode | Template                                                                     |
| ---------: | :--------------------------------------------------------------------------- |
|  `default` | {{subject}} must contain only punctuation characters and {{additionalChars}} |
| `inverted` | {{subject}} must not contain punctuation characters or {{additionalChars}}   |

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

- [Control](Control.md)
- [Graph](Graph.md)
- [Printable](Printable.md)
