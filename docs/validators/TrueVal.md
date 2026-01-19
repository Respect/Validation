<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# TrueVal

- `TrueVal()`

Validates if a value is considered as `true`.

```php
v::trueVal()->assert(true);
// Validation passes successfully

v::trueVal()->assert(1);
// Validation passes successfully

v::trueVal()->assert('1');
// Validation passes successfully

v::trueVal()->assert('true');
// Validation passes successfully

v::trueVal()->assert('on');
// Validation passes successfully

v::trueVal()->assert('yes');
// Validation passes successfully

v::trueVal()->assert('0.5');
// → "0.5" must evaluate to `true`

v::trueVal()->assert('2');
// → "2" must evaluate to `true`
```

## Templates

### `TrueVal::TEMPLATE_STANDARD`

| Mode       | Template                                |
| ---------- | --------------------------------------- |
| `default`  | {{subject}} must evaluate to `true`     |
| `inverted` | {{subject}} must not evaluate to `true` |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans

## Changelog

| Version | Description                      |
| ------: | -------------------------------- |
|   1.0.0 | Renamed from `True` to `TrueVal` |
|   0.8.0 | Created as `True`                |

---

See also:

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [FalseVal](FalseVal.md)
