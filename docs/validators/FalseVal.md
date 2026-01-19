<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# FalseVal

- `FalseVal()`

Validates if a value is considered as `false`.

```php
v::falseVal()->assert(false);
// Validation passes successfully

v::falseVal()->assert(0);
// Validation passes successfully

v::falseVal()->assert('0');
// Validation passes successfully

v::falseVal()->assert('false');
// Validation passes successfully

v::falseVal()->assert('off');
// Validation passes successfully

v::falseVal()->assert('no');
// Validation passes successfully

v::falseVal()->assert('0.5');
// → "0.5" must evaluate to `false`

v::falseVal()->assert('2');
// → "2" must evaluate to `false`
```

## Templates

### `FalseVal::TEMPLATE_STANDARD`

| Mode       | Template                                 |
| ---------- | ---------------------------------------- |
| `default`  | {{subject}} must evaluate to `false`     |
| `inverted` | {{subject}} must not evaluate to `false` |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans

## Changelog

| Version | Description                        |
| ------: | ---------------------------------- |
|   1.0.0 | Renamed from `False` to `FalseVal` |
|   0.8.0 | Created as `False`                 |

---

See also:

- [TrueVal](TrueVal.md)
