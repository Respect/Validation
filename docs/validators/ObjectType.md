<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# ObjectType

- `ObjectType()`

Validates whether the input is an [object](http://php.net/types.object).

```php
v::objectType()->assert(new stdClass);
// Validation passes successfully
```

## Templates

### `ObjectType::TEMPLATE_STANDARD`

|       Mode | Template                          |
| ---------: | :-------------------------------- |
|  `default` | {{subject}} must be an object     |
| `inverted` | {{subject}} must not be an object |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Objects
- Types

## Changelog

| Version | Description                           |
| ------: | :------------------------------------ |
|   1.0.0 | Renamed from `Object` to `ObjectType` |
|   0.3.9 | Created as `Object`                   |

## See Also

- [ArrayType](ArrayType.md)
- [Attributes](Attributes.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [Instance](Instance.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
