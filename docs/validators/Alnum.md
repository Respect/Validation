<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Alnum

- `Alnum()`
- `Alnum(string ...$additionalChars)`

Validates whether the input is alphanumeric or not.

Alphanumeric is a combination of alphabetic (a-z and A-Z) and numeric (0-9)
characters.

```php
v::alnum()->assert('foo 123');
// → "foo 123" must contain only letters (a-z) and digits (0-9)

v::alnum(' ')->assert('foo 123');
// Validation passes successfully

v::alnum()->assert('100%');
// → "100%" must contain only letters (a-z) and digits (0-9)

v::alnum('%')->assert('100%');
// Validation passes successfully

v::alnum('%', ',')->assert('10,5%');
// Validation passes successfully
```

You can restrict case using the [Lowercase](Lowercase.md) and
[Uppercase](Uppercase.md) validators.

```php
v::alnum()->uppercase()->assert('example');
// → "example" must contain only uppercase letters
```

Message template for this validator includes `{{additionalChars}}` as the string
of extra chars passed as the parameter.

## Templates

### `Alnum::TEMPLATE_STANDARD`

| Mode       | Template                                                     |
| ---------- | ------------------------------------------------------------ |
| `default`  | {{subject}} must contain only letters (a-z) and digits (0-9) |
| `inverted` | {{subject}} must not contain letters (a-z) or digits (0-9)   |

### `Alnum::TEMPLATE_EXTRA`

| Mode       | Template                                                                           |
| ---------- | ---------------------------------------------------------------------------------- |
| `default`  | {{subject}} must contain only letters (a-z), digits (0-9), and {{additionalChars}} |
| `inverted` | {{subject}} must not contain letters (a-z), digits (0-9), or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                               |
| ------: | ----------------------------------------- |
|   2.0.0 | Removed support to whitespaces by default |
|   0.3.9 | Created                                   |

---

See also:

- [Alpha](Alpha.md)
- [Charset](Charset.md)
- [Consonant](Consonant.md)
- [Control](Control.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Emoji](Emoji.md)
- [Lowercase](Lowercase.md)
- [Regex](Regex.md)
- [Spaced](Spaced.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Uppercase](Uppercase.md)
- [Vowel](Vowel.md)
- [Xdigit](Xdigit.md)
