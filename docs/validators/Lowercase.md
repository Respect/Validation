<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Lowercase

- `Lowercase()`

Validates whether the characters in the input are lowercase.

```php
v::stringType()->lowercase()->assert('xkcd');
// Validation passes successfully
```

## Templates

### `Lowercase::TEMPLATE_STANDARD`

|       Mode | Template                                               |
| ---------: | :----------------------------------------------------- |
|  `default` | {{subject}} must consist only of lowercase letters     |
| `inverted` | {{subject}} must not consist only of lowercase letters |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   0.3.9 | Created           |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Uppercase](Uppercase.md)
