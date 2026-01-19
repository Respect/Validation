<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# FloatType

- `FloatType()`

Validates whether the type of the input is [float](http://php.net/types.float).

```php
v::floatType()->assert(1.5);
// Validation passes successfully

v::floatType()->assert('1.5');
// → "1.5" must be float

v::floatType()->assert(0e5);
// Validation passes successfully
```

## Templates

### `FloatType::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} must be float     |
| `inverted` | {{subject}} must not be float |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Types

## Changelog

| Version | Description |
| ------: | ----------- |
|   1.0.0 | Created     |

---

See also:

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
