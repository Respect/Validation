<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# ArrayType

- `ArrayType()`

Validates whether the type of an input is array.

```php
v::arrayType()->assert([]);
// Validation passes successfully

v::arrayType()->assert([1, 2, 3]);
// Validation passes successfully

v::arrayType()->assert(new ArrayObject());
// → `ArrayObject { getArrayCopy() => [] }` must be an array
```

## Templates

### `ArrayType::TEMPLATE_STANDARD`

| Mode       | Template                         |
| ---------- | -------------------------------- |
| `default`  | {{subject}} must be an array     |
| `inverted` | {{subject}} must not be an array |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Types

## Changelog

| Version | Description |
| ------: | ----------- |
|   1.0.0 | Created     |

---

See also:

- [ArrayVal](ArrayVal.md)
- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [Countable](Countable.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Subset](Subset.md)
- [Unique](Unique.md)
