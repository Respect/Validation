<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Digit

- `Digit()`
- `Digit(string ...$additionalChars)`

Validates whether the input contains only digits.

```php
v::digit(' ')->assert('020 612 1851');
// Validation passes successfully

v::digit()->assert('020 612 1851');
// → "020 612 1851" must consist only of digits (0-9)

v::digit()->assert('172.655.537-21');
// → "172.655.537-21" must consist only of digits (0-9)

v::digit('.', '-')->assert('172.655.537-21');
// Validation passes successfully
```

## Templates

### `Digit::TEMPLATE_STANDARD`

|       Mode | Template                                          |
| ---------: | :------------------------------------------------ |
|  `default` | {{subject}} must consist only of digits (0-9)     |
| `inverted` | {{subject}} must not consist only of digits (0-9) |

### `Digit::TEMPLATE_EXTRA`

|       Mode | Template                                                                 |
| ---------: | :----------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of digits (0-9) or {{additionalChars}}     |
| `inverted` | {{subject}} must not consist only of digits (0-9) or {{additionalChars}} |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Strings

## Changelog

| Version | Description                               |
| ------: | :---------------------------------------- |
|   3.0.0 | Templates changed                         |
|   2.0.0 | Removed support to whitespaces by default |
|   0.5.0 | Renamed from `Digits` to `Digit`          |
|   0.3.9 | Created as `Digits`                       |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Consonant](Consonant.md)
- [CreditCard](CreditCard.md)
- [Emoji](Emoji.md)
- [Factor](Factor.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NumericVal](NumericVal.md)
- [Regex](Regex.md)
- [Uuid](Uuid.md)
- [Vowel](Vowel.md)
- [Xdigit](Xdigit.md)
