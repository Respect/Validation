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

|       Mode | Template                           |
| ---------: | :--------------------------------- |
|  `default` | {{subject}} must be a resource     |
| `inverted` | {{subject}} must not be a resource |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.0.0 | Created     |

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
