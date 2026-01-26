<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# StringType

- `StringType()`

Validates whether the type of an input is string or not.

```php
v::stringType()->assert('hi');
// Validation passes successfully
```

## Templates

### `StringType::TEMPLATE_STANDARD`

|       Mode | Template                         |
| ---------: | :------------------------------- |
|  `default` | {{subject}} must be a string     |
| `inverted` | {{subject}} must not be a string |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings
- Types

## Changelog

| Version | Description                           |
| ------: | :------------------------------------ |
|   1.0.0 | Renamed from `String` to `StringType` |
|   0.3.9 | Created as `String`                   |

## See Also

- [Alnum](Alnum.md)
- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [ScalarVal](ScalarVal.md)
- [StringVal](StringVal.md)
