<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
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
// → "42" must not be a numeric value

v::alnum()->uppercase()->assert('#$%!');
// → "#$%!" must contain only letters (a-z) and digits (0-9)

v::not(v::numericVal())->alnum()->uppercase()->assert('W3C');
// Validation passes successfully
```

## Templates

### `Uppercase::TEMPLATE_STANDARD`

| Mode       | Template                                            |
| ---------- | --------------------------------------------------- |
| `default`  | {{subject}} must contain only uppercase letters     |
| `inverted` | {{subject}} must not contain only uppercase letters |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Lowercase](Lowercase.md)
- [NumericVal](NumericVal.md)
- [Roman](Roman.md)
