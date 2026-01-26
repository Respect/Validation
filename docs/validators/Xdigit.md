<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Xdigit

- `Xdigit()`
- `Xdigit(string ...$additionalChars)`

Validates whether the input is an hexadecimal number or not.

```php
v::xdigit()->assert('abc123');
// Validation passes successfully
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->assert('0x1f');
// → "0x1f" must only contain hexadecimal digits
```

## Templates

### `Xdigit::TEMPLATE_STANDARD`

|       Mode | Template                                             |
| ---------: | :--------------------------------------------------- |
|  `default` | {{subject}} must only contain hexadecimal digits     |
| `inverted` | {{subject}} must not only contain hexadecimal digits |

### `Xdigit::TEMPLATE_EXTRA`

|       Mode | Template                                                               |
| ---------: | :--------------------------------------------------------------------- |
|  `default` | {{subject}} must contain hexadecimal digits and {{additionalChars}}    |
| `inverted` | {{subject}} must not contain hexadecimal digits or {{additionalChars}} |

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

- [Alnum](Alnum.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [HexRgbColor](HexRgbColor.md)
