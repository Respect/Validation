<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Spaced

- `Spaced()`

Validates if a string contains at least one whitespace (spaces, tabs, or line breaks);

```php
v::spaced()->assert('foo bar');
// Validation passes successfully

v::spaced()->assert("foo\nbar");
// Validation passes successfully
```

This is most useful when inverting the validator as `notSpaced()`, and chaining with other validators such as [Alnum](Alnum.md) or [Alpha](Alpha.md) to ensure that a string contains no whitespace characters:

```php
v::notSpaced()->alnum()->assert('username');
// Validation passes successfully

v::notSpaced()->alnum()->assert('user name');
// → - "user name" must pass all the rules
// →   - "user name" must not contain whitespaces
// →   - "user name" must contain only letters (a-z) and digits (0-9)
```

## Templates

### `Spaced::TEMPLATE_STANDARD`

|       Mode | Template                                         |
| ---------: | :----------------------------------------------- |
|  `default` | {{subject}} must contain at least one whitespace |
| `inverted` | {{subject}} must not contain whitespaces         |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                                  |
| ------: | :------------------------------------------- |
|   3.0.0 | Renamed to `Spaced` and changed the behavior |
|   0.3.9 | Created as `NoWhitespace`                    |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Blank](Blank.md)
- [CreditCard](CreditCard.md)
- [Falsy](Falsy.md)
- [Undef](Undef.md)
- [UndefOr](UndefOr.md)
