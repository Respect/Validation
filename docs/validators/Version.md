<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Version

- `Version()`

Validates version numbers using Semantic Versioning.

```php
v::version()->assert('1.0.0');
// Validation passes successfully
```

## Templates

### `Version::TEMPLATE_STANDARD`

| Mode       | Template                          |
| ---------- | --------------------------------- |
| `default`  | {{subject}} must be a version     |
| `inverted` | {{subject}} must not be a version |

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

- [Equals](Equals.md)
- [Regex](Regex.md)
- [Roman](Roman.md)
