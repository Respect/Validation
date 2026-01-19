<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
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

| Mode       | Template                                            |
| ---------- | --------------------------------------------------- |
| `default`  | {{subject}} must contain only lowercase letters     |
| `inverted` | {{subject}} must not contain only lowercase letters |

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
- [Uppercase](Uppercase.md)
