<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# FilterVar

- `FilterVar(int $filter)`
- `FilterVar(int $filter, mixed $options)`

Validates the input with the PHP's [filter_var()](http://php.net/filter_var) function.

```php
v::filterVar(FILTER_VALIDATE_EMAIL)->assert('bob@example.com');
// Validation passes successfully

v::filterVar(FILTER_VALIDATE_URL)->assert('http://example.com');
// Validation passes successfully

v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->assert('http://example.com');
// → "http://example.com" must be valid

v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->assert('http://example.com/path');
// Validation passes successfully

v::filterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)->assert('webserver.local');
// Validation passes successfully

v::filterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)->assert('@local');
// → "@local" must be valid
```

## Templates

### `FilterVar::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} must be valid     |
| `inverted` | {{subject}} must not be valid |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description                                                        |
| ------: | ------------------------------------------------------------------ |
|   2.3.0 | `v::filterVar(FILTER_VALIDATE_INT)->isValid(0)` is no longer false |
|  2.0.15 | Allow validating domains                                           |
|   0.8.0 | Created                                                            |

---

See also:

- [Callback](Callback.md)
- [Json](Json.md)
- [Url](Url.md)
