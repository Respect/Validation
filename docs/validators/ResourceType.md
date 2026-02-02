<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# ResourceType

- `ResourceType()`

Validates whether the input is a [resource](http://php.net/types.resource).

```php
v::resourceType()->assert(fopen('/path/to/file.txt', 'r'));
// Validation passes successfully
```

## Templates

### `ResourceType::TEMPLATE_STANDARD`

|       Mode | Template                                     |
| ---------: | :------------------------------------------- |
|  `default` | {{subject}} must be an internal resource     |
| `inverted` | {{subject}} must not be an internal resource |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   1.0.0 | Created           |

## See Also

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
