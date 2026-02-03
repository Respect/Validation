<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# NullType

- `NullType()`

Validates whether the input is [null](http://php.net/types.null).

```php
v::nullType()->assert(null);
// Validation passes successfully
```

## Templates

### `NullType::TEMPLATE_STANDARD`

|       Mode | Template                     |
| ---------: | :--------------------------- |
|  `default` | {{subject}} must be null     |
| `inverted` | {{subject}} must not be null |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description                            |
| ------: | :------------------------------------- |
|   1.0.0 | Renamed from `NullValue` to `NullType` |
|   0.3.9 | Created as `NullValue`                 |

## See Also

- [ArrayType](ArrayType.md)
- [Blank](Blank.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [Falsy](Falsy.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullOr](NullOr.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Undef](Undef.md)
- [UndefOr](UndefOr.md)
