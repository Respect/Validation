<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# HexRgbColor

- `HexRgbColor()`

Validates weather the input is a hex RGB color or not.

```php
v::hexRgbColor()->assert('#FFFAAA');
// Validation passes successfully

v::hexRgbColor()->assert('#ff6600');
// Validation passes successfully

v::hexRgbColor()->assert('123123');
// Validation passes successfully

v::hexRgbColor()->assert('FCD');
// Validation passes successfully
```

## Templates

### `HexRgbColor::TEMPLATE_STANDARD`

|       Mode | Template                                |
| ---------: | :-------------------------------------- |
|  `default` | {{subject}} must be a hex RGB color     |
| `inverted` | {{subject}} must not be a hex RGB color |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                                 |
| ------: | :------------------------------------------ |
|   2.1.0 | Allow hex RGB colors to be case-insensitive |
|   2.0.0 | Allow hex RGB colors with 3 integers        |
|   0.7.0 | Created                                     |

## See Also

- [Xdigit](Xdigit.md)
