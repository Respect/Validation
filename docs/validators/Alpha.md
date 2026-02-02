<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Alpha

- `Alpha()`
- `Alpha(string ...$additionalChars)`

Validates whether the input contains only alphabetic characters. This is similar
to [Alnum](Alnum.md), but it does not allow numbers.

```php
v::alpha(' ')->assert('some name');
// Validation passes successfully

v::alpha()->assert('some name');
// → "some name" must consist only of letters (a-z)

v::alpha()->assert('Cedric-Fabian');
// → "Cedric-Fabian" must consist only of letters (a-z)

v::alpha('-')->assert('Cedric-Fabian');
// Validation passes successfully

v::alpha('-', '\'')->assert('\'s-Gravenhage');
// Validation passes successfully
```

You can restrict case using the [Lowercase](Lowercase.md) and
[Uppercase](Uppercase.md) validators.

```php
v::alpha()->uppercase()->assert('example');
// → "example" must consist only of uppercase letters
```

## Templates

### `Alpha::TEMPLATE_STANDARD`

|       Mode | Template                                           |
| ---------: | :------------------------------------------------- |
|  `default` | {{subject}} must consist only of letters (a-z)     |
| `inverted` | {{subject}} must not consist only of letters (a-z) |

### `Alpha::TEMPLATE_EXTRA`

|       Mode | Template                                                                  |
| ---------: | :------------------------------------------------------------------------ |
|  `default` | {{subject}} must consist only of letters (a-z) or {{additionalChars}}     |
| `inverted` | {{subject}} must not consist only of letters (a-z) or {{additionalChars}} |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                               |
| ------: | :---------------------------------------- |
|   3.0.0 | Templates changed                         |
|   2.0.0 | Removed support to whitespaces by default |
|   0.3.9 | Created                                   |

## See Also

- [Alnum](Alnum.md)
- [Charset](Charset.md)
- [Consonant](Consonant.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Emoji](Emoji.md)
- [Lowercase](Lowercase.md)
- [Regex](Regex.md)
- [Spaced](Spaced.md)
- [Uppercase](Uppercase.md)
- [Vowel](Vowel.md)
