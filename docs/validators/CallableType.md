<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# CallableType

- `CallableType()`

Validates whether the pseudo-type of the input is [callable](http://php.net/types.callable).

```php
v::callableType()->assert(function () {});
// Validation passes successfully

v::callableType()->assert('trim');
// Validation passes successfully

v::callableType()->assert([new DateTime(), 'format']);
// Validation passes successfully
```

## Templates

### `CallableType::TEMPLATE_STANDARD`

|       Mode | Template                           |
| ---------: | :--------------------------------- |
|  `default` | {{subject}} must be a callable     |
| `inverted` | {{subject}} must not be a callable |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Callables
- Types

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.0.0 | Created     |

## See Also

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [Callback](Callback.md)
- [Factory](Factory.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
