<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Uppercase

- `Uppercase()`

Validates whether the characters in the input are uppercase.

```php
v::uppercase()->assert('W3C');
// Validation passes successfully
```

This validator does not validate if the input a numeric value, so `123` and `%` will
be valid. Please add more validations to the chain if you want to refine your
validation.

```php
v::not(v::numericVal())->uppercase()->assert('42');
// → "42" must not be numeric

v::alnum()->uppercase()->assert('#$%!');
// → "#$%!" must consist only of letters (a-z) and digits (0-9)

v::not(v::numericVal())->alnum()->uppercase()->assert('W3C');
// Validation passes successfully
```

## Templates

### `Uppercase::TEMPLATE_STANDARD`

|       Mode | Template                                               |
| ---------: | :----------------------------------------------------- |
|  `default` | {{subject}} must consist only of uppercase letters     |
| `inverted` | {{subject}} must not consist only of uppercase letters |

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
- [Lowercase](Lowercase.md)
- [NumericVal](NumericVal.md)
- [Roman](Roman.md)
